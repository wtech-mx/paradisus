<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\HuellaLog;
use App\Models\User;
use App\Models\RegistroSemanal;
use Carbon\Carbon;

class ProcesarHuellas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'huellas:procesar';
    protected $description = 'Procesa nuevos logs de huella y crea registros de asistencia';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
   public function handle()
    {
        $lastId = Cache::get('huella_last_id', 0);
        $nuevos = HuellaLog::where('id', '>', $lastId)
                          ->orderBy('id')
                          ->get();

        foreach ($nuevos as $log) {
            $fechaHora = Carbon::parse($log->fecha_hora);
            $fecha     = $fechaHora->toDateString();

            // 1) Encuentra el usuario por huella
            $user = User::where('huella1', $log->huella_id)
                        ->orWhere('huella2', $log->huella_id)
                        ->orWhere('huella3', $log->huella_id)
                        ->first();
            if (! $user) {
                $this->warn("Huella {$log->huella_id} sin usuario");
                Cache::put('huella_last_id', $log->id);
                continue;
            }

            // 2) Busca registro del día
            $registro = RegistroSemanal::firstOrNew([
                'cosmetologo_id' => $user->id,
                'fecha'          => $fecha,
            ]);

            // 3) Si no tenía hora_inicio, es la primera pasada
            if (! $registro->exists) {
                // Puntual si antes de 10:00
                $puntual = $fechaHora->lt($fechaHora->copy()->setTime(10,0,0)) ? 1 : 0;
                $registro->hora_inicio     = $fechaHora->toTimeString();
                $registro->puntualidad     = $puntual;
                // Inicializamos otros campos
                $registro->hora_fin        = null;
                $registro->horas_trabajadas= null;
                $registro->monto_pago      = null;
                $registro->save();

                $this->info("Inicio asistencia user {$user->id} a las {$registro->hora_inicio}");
            }
            // 4) Si ya existía y no tiene hora_fin, cerramos la jornada
            elseif (is_null($registro->hora_fin)) {
                $inicio   = Carbon::createFromFormat('H:i:s', $registro->hora_inicio);
                $segundos = $inicio->diffInSeconds($fechaHora);

                // Define aquí tu umbral (e.g. 60 segundos)
                $umbralSegundos = 60;

                // Si aún no ha pasado el umbral, ignoramos este log
                if ($segundos < $umbralSegundos) {
                    $this->info("Escaneo duplicado a {$fechaHora->toTimeString()}, ignoro (<{$umbralSegundos}s).");
                    Cache::put('huella_last_id', $log->id);
                    continue;
                }

                $horaFin = $fechaHora->toTimeString();

                // Calcula horas trabajadas
                $fin    = Carbon::createFromFormat('H:i:s', $horaFin);
                $diffH  = $inicio->diffInHours($fin);

                // Calcula sueldo_por_hora
                $domingo = $fechaHora->isSunday();
                $sueldoHora = $domingo
                    ? $user->comision_despedida
                    : $user->sueldo_hora;

                // Regla especial de aumento
                $sueldo = $diffH * $sueldoHora;

                // Actualiza el registro
                $registro->hora_fin         = $horaFin;
                $registro->horas_trabajadas = $diffH;
                $registro->monto_pago       = $sueldo;
                $registro->save();

                $this->info("Cerrada asistencia user {$user->id} a las {$horaFin}, horas={$diffH}, pago=\${$sueldo}");
            }
            else {
                // ya tenía hora_fin, nada que hacer
                $this->info("Asistencia user {$user->id} del {$fecha} ya cerrada.");
            }

            // Guarda el último ID procesado
            Cache::put('huella_last_id', $log->id);
        }

        return 0;
    }
}
