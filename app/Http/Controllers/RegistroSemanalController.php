<?php

namespace App\Http\Controllers;

use App\Models\NotasCosmes;
use App\Models\NotasPaquetes;
use App\Models\NotasPedidos;
use App\Models\Paquetes;
use App\Models\RegCosmesSum;
use App\Models\RegistroSemanal;
use App\Models\RegistroSueldoSemanal;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class RegistroSemanalController extends Controller
{
    public function index(){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();
        $fecha = date('Y-m-d');

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();
        $registros_hoy = RegistroSemanal::where('fecha', '=', $fecha)->get();

        $despedidas = Servicios::whereIn('nombre', ['Day Spa Despedida de Soltera', 'Despedida de Soltera 4 personas', 'Despedida de soltera 6 personas', 'Day despedida de Soltera 8 personas', 'DESPEDIDA DE SOLTERA 3 PERSONAS', 'DESPEDIDA DE SOLTERA 1 PERSONA'])->get();
        $notasDespedidas = NotasPaquetes::whereIn('id_servicio', $despedidas->pluck('id')->toArray())
        ->whereHas('Notas', function ($query) use ($fechaInicioSemana, $fechaFinSemana) {
            $query->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana]);
        })
        ->get();

        return view('sueldo_cosmes.index', compact('registros_hoy','registroSueldoSemanal','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'notasDespedidas', 'regcosmessum'));
    }

    public function index_sueldo($id){

        $cosme = User::where('id', '=', $id)->first();

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();
        $registroSueldoSemanalActual = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();

        $despedidas = Servicios::whereIn('nombre', ['Day Spa Despedida de Soltera', 'Despedida de Soltera 4 personas', 'Despedida de soltera 6 personas', 'Day despedida de Soltera 8 personas', 'DESPEDIDA DE SOLTERA 3 PERSONAS', 'DESPEDIDA DE SOLTERA 1 PERSONA'])->get();
        $notasDespedidas = NotasPaquetes::whereIn('id_servicio', $despedidas->pluck('id')->toArray())
        ->whereHas('Notas', function ($query) use ($fechaInicioSemana, $fechaFinSemana) {
            $query->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana]);
        })
        ->get();

        return view('sueldo_cosmes.firma_sueldos', compact('registroSueldoSemanalActual','registroSueldoSemanal', 'cosme','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'notasDespedidas', 'regcosmessum'));

    }

    public function advance(Request $request, $id) {
        $cosme = User::where('id', '=', $id)->first();

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();
        $registroSueldoSemanalActual = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();

        $despedidas = Servicios::whereIn('nombre', ['Day Spa Despedida de Soltera', 'Despedida de Soltera 4 personas', 'Despedida de soltera 6 personas', 'Day despedida de Soltera 8 personas', 'DESPEDIDA DE SOLTERA 3 PERSONAS', 'DESPEDIDA DE SOLTERA 1 PERSONA'])->get();
        $notasDespedidas = NotasPaquetes::whereIn('id_servicio', $despedidas->pluck('id')->toArray())
        ->whereHas('Notas', function ($query) use ($fechaInicioSemana, $fechaFinSemana) {
            $query->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana]);
        })
        ->get();

        $pagos = DB::table('registro_sueldo_semanal');
        if( $request->fecha && $request->fecha2 ){
            $pagos = $pagos->where('id_cosme', '=', $id)
            ->where('fecha', '>=', $request->fecha)
            ->where('fecha', '<=', $request->fecha2);
        }
        $pagos = $pagos->get();

        return view('sueldo_cosmes.firma_sueldos', compact('registroSueldoSemanalActual','pagos','registroSueldoSemanal', 'cosme','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'notasDespedidas', 'regcosmessum'));
    }

    public function firma(Request $request, $id){

        if($request->signed != NULL){
            $folderPath = public_path('firmaCosme/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("firmaCosme/", $image_parts[0]);
            $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : null;

            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.png' ;
            $file = $folderPath . $signature;
            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = RegistroSueldoSemanal::where('id', '=', $request->id)->first();
            $firma->firma = $signature;
            $firma->monto = $request->monto;
            $firma->update();
        }

        return back()->with('success', 'Firma guardada con exito');
    }

    public function pdf(){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();

        $despedidas = Servicios::whereIn('nombre', ['Day Spa Despedida de Soltera', 'Despedida de Soltera 4 personas', 'Despedida de soltera 6 personas', 'Day despedida de Soltera 8 personas', 'DESPEDIDA DE SOLTERA 3 PERSONAS', 'DESPEDIDA DE SOLTERA 1 PERSONA'])->get();
        $notasDespedidas = NotasPaquetes::whereIn('id_servicio', $despedidas->pluck('id')->toArray())
        ->whereHas('Notas', function ($query) use ($fechaInicioSemana, $fechaFinSemana) {
            $query->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana]);
        })
        ->get();

        $pdf = \PDF::loadView('sueldo_cosmes.pdf', compact('registroSueldoSemanal','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'notasDespedidas', 'regcosmessum'));
        return $pdf->stream();
       // return $pdf->download('Sueldo Cosmes '.$fechaInicioSemana.'.pdf');
    }

    public function store(Request $request){
        $fecha = date('Y-m-d');
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        // Ejemplo de cómo guardar un registro semanal en un controlador

        $registroSemanal = new RegistroSemanal;
        $registroSemanal->cosmetologo_id = $request->get('cosmetologo_id');
        $registroSemanal->puntualidad = $request->get('puntualidad');
        $registroSemanal->hora_inicio = $request->get('hora_inicio');
        $registroSemanal->cosmetologo_cubriendo = $request->get('cosmetologo_cubriendo');
        $registroSemanal->fecha = $fecha;
        $registroSemanal->save();

        $registroExistente = RegistroSueldoSemanal::where('id_cosme', $registroSemanal->cosmetologo_id)
            ->where('fecha', $fechaInicioSemana)
            ->first();

        if (!$registroExistente) {
            $nuevoRegistro = new RegistroSueldoSemanal();
            $nuevoRegistro->id_cosme = $registroSemanal->cosmetologo_id;
            $nuevoRegistro->fecha = $fechaInicioSemana;
            if($registroSemanal->puntualidad == 1){
                $nuevoRegistro->puntualidad = 1;
            }else{
                $nuevoRegistro->puntualidad = 0;
            }
            $nuevoRegistro->save();
        }else{
            if ($registroExistente->puntualidad == 0) {
                // Si ya es 0, no permite actualizar
            } else {
                // Verifica si la puntualidad en RegistroSemanal es 0
                if ($registroSemanal->puntualidad == 0) {
                    $registroExistente->puntualidad = 0;
                    $registroExistente->save();
                } else {

                }
            }
        }

        return redirect()->route('pagos.index')
        ->with('edit','Lista Agregada con exito.');
    }

    public function adicional(Request $request){
        $fecha = date('Y-m-d');
        // Ejemplo de cómo guardar un registro semanal en un controlador

        $registroSemanal = new RegCosmesSum;
        $registroSemanal->id_cosme = $request->get('id_cosme');
        $registroSemanal->tipo = $request->get('tipo');
        $registroSemanal->concepto = $request->get('concepto');
        $registroSemanal->fecha = $fecha;
        if ($request->hasFile("comprobante")) {
            $file = $request->file('comprobante');
            $path = public_path() . '/comprobante_cosmes';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registroSemanal->comprobante = $fileName;
        }
        $registroSemanal->monto = $request->get('monto');
        $registroSemanal->save();

        return redirect()->route('pagos.index')
        ->with('edit','Se agrego con exito.');
    }

    public function corte(Request $request){
        $fecha = date('Y-m-d');
        $registros_hoy = RegistroSemanal::where('fecha', '=', $fecha)->get();

        foreach ($registros_hoy as $registro_hoy) {
            $cosmetologoId = $registro_hoy->cosmetologo->id;
            $sueldo_horas = $registro_hoy->cosmetologo->sueldo_hora;
            $horaInicio = $registro_hoy->hora_inicio;
            $horaFin = $request->input('hora_fin_' . $cosmetologoId);

            // Calcula las horas trabajadas utilizando Carbon
            $horaInicio = trim($registro_hoy->hora_inicio);
            $carbonInicio = Carbon::createFromFormat('H:i:s', $horaInicio);
            $carbonFin = trim($registro_hoy->hora_fin);
            $carbonFin = Carbon::createFromFormat('H:i', $horaFin);
            $horasTrabajadas = $carbonInicio->diffInHours($carbonFin);

            // Calcula sueldo
            $sueldo = $horasTrabajadas * $sueldo_horas;

            // Obtén el total de ventas del día para el cosmetólogo
            $ventasDelDia = $this->obtenerVentasDelDia($cosmetologoId, $fecha);

            // Cosmetólogos específicos con regla de aumentar sueldo a 1000 si las ventas son mayores o iguales a 5000
            $cosmetologosConAumento = [3, 6, 4];

            // Aplica la regla de aumentar el sueldo a 1000 si las ventas son mayores o iguales a 5000
            if (in_array($cosmetologoId, $cosmetologosConAumento) && $ventasDelDia >= 5000) {
                $sueldo = 1000;
            }

            // Actualiza el registro en la base de datos
            $registro_hoy->hora_fin = $horaFin;
            $registro_hoy->monto_pago = $sueldo;
            $registro_hoy->horas_trabajadas = $horasTrabajadas;
            $registro_hoy->save();
        }

        return redirect()->back()
        ->with('edit','Corte de Sueldo con exito.');
    }

    private function obtenerVentasDelDia($cosmetologoId, $fecha){
        // Inicializa el total de ventas del día
        $totalVentas = 0;
        $totalNotas = 0;
        $totalPedido = 0;

        // Obtén las notasCosmes para el cosmetólogo y la fecha específica
        $notasCosmes = NotasCosmes::whereHas('Notas', function ($query) use ($cosmetologoId, $fecha) {
            $query->where('id_user', $cosmetologoId)
                ->whereDate('fecha', $fecha);
        })->get();

        $pedidoCosmes = NotasPedidos::where('id_user', $cosmetologoId)->whereDate('fecha', $fecha)->get();
        //$paquetesCosmes = Paquetes::where('id_user1', $cosmetologoId)->get();

        // Suma los precios de las notas para obtener el total de ventas del día
        foreach ($notasCosmes as $notaCosme) {
            $pagos = $notaCosme->Notas->Pagos;
            if ($pagos->isNotEmpty()) {
                // Suma los montos de los pagos
                $totalPagos = $pagos->sum('pago');

                // Ahora puedes utilizar $totalPagos en tus cálculos
                $totalNotas += $totalPagos;
            }
        }
        foreach ($pedidoCosmes as $pedidoCosme) {
            $totalPedido += $pedidoCosme->total;
        }

        $totalVentas = $totalNotas + $totalPedido;

        return $totalVentas;
    }
}
