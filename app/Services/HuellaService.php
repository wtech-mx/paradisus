<?php
// app/Services/HuellaService.php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\HuellaLog;
use App\Models\User;
use App\Models\RegistroSemanal;
use Carbon\Carbon;

class HuellaService
{
    /**
     * Procesa todos los logs nuevos de huella y actualiza los registros.
     *
     * @param  int  $umbralSegundos  Mínimo en segundos para considerar un cierre válido
     * @return void
     */
    public function procesarNuevasHuellas(int $umbralSegundos = 60): void
    {
        $lastId = Cache::get('huella_last_id', 0);

        $logs = HuellaLog::where('id', '>', $lastId)
                        ->orderBy('id')
                        ->get();

        foreach ($logs as $log) {
            $fechaHora = Carbon::parse($log->fecha_hora);
            $fecha     = $fechaHora->toDateString();

            // 1) Encuentra el usuario
            $user = User::where('huella1', $log->huella_id)
                        ->orWhere('huella2', $log->huella_id)
                        ->orWhere('huella3', $log->huella_id)
                        ->first();
            if (! $user) {
                Cache::put('huella_last_id', $log->id);
                continue;
            }

            // 2) firstOrCreate para hora_inicio
            $registro = RegistroSemanal::firstOrCreate(
                ['cosmetologo_id' => $user->id, 'fecha' => $fecha],
                [
                    'hora_inicio'      => $fechaHora->toTimeString(),
                    'puntualidad'      => $fechaHora->lt($fechaHora->copy()->setTime(10,0)) ? 1 : 0,
                    'hora_fin'         => null,
                    'horas_trabajadas' => null,
                    'monto_pago'       => null,
                ]
            );

            // 3) Si no es recién creado y aún no tiene hora_fin, puede cerrar jornada
            if (! $registro->wasRecentlyCreated && is_null($registro->hora_fin)) {
                $inicio   = Carbon::createFromFormat('H:i:s', $registro->hora_inicio);
                $segundos = $inicio->diffInSeconds($fechaHora);

                if ($segundos >= $umbralSegundos) {
                    // cierra jornada...
                    $registro->hora_fin = $fechaHora->toTimeString();
                    $diffH = $inicio->diffInHours($fechaHora);

                    // calcula su sueldo
                    $domingo    = $fechaHora->isSunday();
                    $horaSalario = $domingo ? $user->comision_despedida : $user->sueldo_hora;
                    $monto = $diffH * $horaSalario;

                    $registro->horas_trabajadas = $diffH;
                    $registro->monto_pago       = $monto;
                    $registro->save();
                }
            }

            // 4) Guarda el último ID procesado
            Cache::put('huella_last_id', $log->id);
        }
    }

    /**
     * Obtiene el total de ventas del día para un cosmetólogo.
     * (Implementa este método según tu lógica).
     */
    protected function obtenerVentasDelDia(int $cosmetologoId, string $fecha): float
    {
        // ...
    }
}
