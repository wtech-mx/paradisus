<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use App\Models\NotasCosmes;
use App\Models\NotasPaquetes;
use App\Models\NotasPedidos;
use App\Models\NotasPropinas;
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
        $paquetes = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('paquetes', '=', '1')->get();
        $registros_hoy = RegistroSemanal::where('fecha', '=', $fecha)->get();
        $notasPedidos = NotasPedidos::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('estatus', '!=', 'Cancelada')->get();
        $paquetesFaciales = Notas::join('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->Join('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where(function($query) {
            $query->whereIn('notas_paquetes.id_servicio', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio2', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio3', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio4', [138, 139, 140, 141, 142, 270]);
        })
        ->select('notas.id', 'notas.fecha', 'notas_paquetes.id_servicio', 'notas_paquetes.id_servicio2', 'notas_paquetes.id_servicio3', 'notas_paquetes.id_servicio4', DB::raw('MIN(pagos.pago) as primer_pago'))
        ->groupBy('notas.id', 'notas.fecha', 'notas_paquetes.id_servicio', 'notas_paquetes.id_servicio2', 'notas_paquetes.id_servicio3', 'notas_paquetes.id_servicio4')
        ->get();

        $notasServicios = Notas::leftJoin('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->leftJoin('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('notas.anular', '=', NULL)
        ->where(function ($query) {
            $query->whereNotIn('notas.id', function ($subquery) {
                $subquery->select('id_nota')
                    ->from('notas_paquetes')
                    ->whereIn('id_servicio', [138, 139, 140, 141, 142, 270])
                    ->orWhereIn('id_servicio2', [138, 139, 140, 141, 142, 270])
                    ->orWhereIn('id_servicio3', [138, 139, 140, 141, 142, 270])
                    ->orWhereIn('id_servicio4', [138, 139, 140, 141, 142, 270]);
            });
        })
        ->select('notas.*', DB::raw('MIN(pagos.pago) as primer_pago'))
        ->groupBy('notas.id')
        ->get();

        $notasMaFer = Notas::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('anular', '=', NULL)->get();

        $propinas = NotasPropinas::whereBetween('created_at', [$fechaInicioSemana, $fechaFinSemana])->get();

        //Agregar sueldo de recepcion
        $recepcionistas = User::where('puesto', 'Recepcionista')->get();
        $fechaLunes = Carbon::now()->startOfWeek()->format('Y-m-d');
        foreach ($recepcionistas as $recepcionista) {
            $paquetes2 = ($recepcionista->id == 26) ? 0 : 1;

            $registroExistente = RegistroSueldoSemanal::where('id_cosme', $recepcionista->id)
                ->where('fecha', $fechaLunes)
                ->exists();

            // Si no hay un registro existente, crea uno nuevo
            if (!$registroExistente) {
                RegistroSueldoSemanal::create([
                    'id_cosme' => $recepcionista->id,
                    'fecha' => $fechaLunes,
                    'puntualidad' => 0,
                    'paquetes' => $paquetes2,
                ]);
            }
        }

        return view('sueldo_cosmes.index', compact('notasMaFer','propinas','paquetesFaciales','notasServicios','paquetes','notasPedidos','fechaInicioSemana','fechaFinSemana','registros_hoy','registroSueldoSemanal','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'regcosmessum'));
    }

    public function index_sueldo($id){

        $cosme = User::where('id', '=', $id)->first();

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('cosmetologo_id', '=', $id)->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();
        $registroSueldoSemanalActual = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();
        $paquetes = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();
        $notasPedidos = NotasPedidos::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('estatus', '!=', 'Cancelada')->get();
        $notasServicios = Notas::leftJoin('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->leftJoin('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('notas.anular', '=', NULL)
        ->where(function ($query) {
            $query->whereNotIn('notas.id', function ($subquery) {
                $subquery->select('id_nota')
                    ->from('notas_paquetes')
                    ->where(function ($subquery) {
                        $subquery->whereIn('id_servicio', [138, 139, 140, 141, 142, 270])
                            ->orWhereIn('id_servicio2', [138, 139, 140, 141, 142, 270])
                            ->orWhereIn('id_servicio3', [138, 139, 140, 141, 142, 270])
                            ->orWhereIn('id_servicio4', [138, 139, 140, 141, 142, 270]);
                    })
                    ->orWhere(function ($subquery) {
                        $subquery->whereIn('id_servicio', [138, 139, 140, 141, 142, 270])
                            ->whereNotIn('id_servicio2', [138, 139, 140, 141, 142, 270]);
                    })
                    ->orWhere(function ($subquery) {
                        $subquery->whereIn('id_servicio', [138, 139, 140, 141, 142, 270])
                            ->whereNotIn('id_servicio3', [138, 139, 140, 141, 142, 270]);
                    })
                    ->orWhere(function ($subquery) {
                        $subquery->whereIn('id_servicio', [138, 139, 140, 141, 142, 270])
                            ->whereNotIn('id_servicio4', [138, 139, 140, 141, 142, 270]);
                    });
            });
        })
        ->groupBy('notas.id')
        ->select('notas.*', DB::raw('MIN(pagos.pago) as primer_pago'))
        ->get();


        $notasMaFer = Notas::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('anular', '=', NULL)->get();

        $paquetesFaciales = Notas::join('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->Join('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where(function($query) {
            $query->whereIn('notas_paquetes.id_servicio', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio2', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio3', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio4', [138, 139, 140, 141, 142, 270]);
        })
        ->select('notas.id', 'notas.fecha', 'notas_paquetes.id_servicio', 'notas_paquetes.id_servicio2', 'notas_paquetes.id_servicio3', 'notas_paquetes.id_servicio4', DB::raw('MIN(pagos.pago) as primer_pago'))
        ->groupBy('notas.id', 'notas.fecha', 'notas_paquetes.id_servicio', 'notas_paquetes.id_servicio2', 'notas_paquetes.id_servicio3', 'notas_paquetes.id_servicio4')
        ->get();

        $propinas = NotasPropinas::whereBetween('created_at', [$fechaInicioSemana, $fechaFinSemana])->where('id_user', '=', $id)->get();


        return view('sueldo_cosmes.firma_sueldos', compact('notasMaFer','propinas','paquetesFaciales','notasServicios','paquetes','notasPedidos','fechaInicioSemana','fechaFinSemana','registroSueldoSemanalActual','registroSueldoSemanal', 'cosme','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'regcosmessum'));

    }

    public function pdf($id){
        $cosme = User::where('id', '=', $id)->first();

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('cosmetologo_id', '=', $id)->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();
        $registroSueldoSemanalActual = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();
        $paquetes = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();
        $notasPedidos = NotasPedidos::where('id_user', '=', $id)->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('estatus', '!=', 'Cancelada')->get();
        $notasServicios = Notas::leftJoin('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->leftJoin('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->where('notas.anular', '=', NULL)
        ->whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where(function ($query) {
            $query->whereNotIn('notas.id', function ($subquery) {
                $subquery->select('id_nota')
                    ->from('notas_paquetes')
                    ->whereIn('id_servicio', [138, 139, 140, 141, 142, 270])
                    ->orWhereIn('id_servicio2', [138, 139, 140, 141, 142, 270])
                    ->orWhereIn('id_servicio3', [138, 139, 140, 141, 142, 270])
                    ->orWhereIn('id_servicio4', [138, 139, 140, 141, 142, 270]);
            });
        })
        ->groupBy('notas.id')
        ->select('notas.*', DB::raw('MIN(pagos.pago) as primer_pago'))
        ->get();

        $notasMaFer = Notas::whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])->where('anular', '=', NULL)->get();

        $paquetesFaciales = Notas::join('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->Join('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->whereBetween('notas.fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where(function($query) {
            $query->whereIn('notas_paquetes.id_servicio', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio2', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio3', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio4', [138, 139, 140, 141, 142, 270]);
        })
        ->select('notas.id', 'notas.fecha', 'notas_paquetes.id_servicio', 'notas_paquetes.id_servicio2', 'notas_paquetes.id_servicio3', 'notas_paquetes.id_servicio4', DB::raw('MIN(pagos.pago) as primer_pago'))
        ->groupBy('notas.id', 'notas.fecha', 'notas_paquetes.id_servicio', 'notas_paquetes.id_servicio2', 'notas_paquetes.id_servicio3', 'notas_paquetes.id_servicio4')
        ->get();

        $propinas = NotasPropinas::whereBetween('created_at', [$fechaInicioSemana, $fechaFinSemana])->where('id_user', '=', $id)->get();

        $pdf = \PDF::loadView('sueldo_cosmes.pdf', ['notasPedidosVacia' => $notasPedidos->isEmpty()],compact('notasMaFer','propinas', 'notasServicios', 'paquetesFaciales','paquetes','notasPedidos','fechaInicioSemana','fechaFinSemana','registroSueldoSemanalActual','registroSueldoSemanal', 'cosme','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'regcosmessum'));

        return $pdf->download('sueldo_cosmes_'.$cosme->name.'_'.$id.'.pdf');

        // return $pdf->stream();
       // return $pdf->download('Sueldo '.$cosme->name.'-'.$fechaInicioSemana.'.pdf');
    }

    public function index_recepcion(){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();
        $fechaLunes = Carbon::now()->startOfWeek()->format('Y-m-d');

        $recepcion_pagos = User::where('puesto', 'Recepcionista')->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $paquetes = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('paquetes', '=', '1')->get();

        return view('sueldo_cosmes.sueldos_recepcion', compact('fechaFinSemana','fechaInicioSemana','recepcion_pagos','registroSueldoSemanal', 'regcosmessum', 'fechaLunes', 'paquetes'));
    }

    public function index_firma_recepcion($id){

        $cosme = User::where('id', '=', $id)->first();

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();
        $fechaLunes = Carbon::now()->startOfWeek()->format('Y-m-d');

        $registroSueldoSemanal = RegistroSueldoSemanal::where('id_cosme', '=', $id)->where('fecha', $fechaInicioSemana)->first();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->get();

        return view('sueldo_cosmes.firma_recepcion', compact('registroSueldoSemanal', 'cosme', 'regcosmessum', 'fechaLunes', 'fechaInicioSemana', 'fechaFinSemana'));

    }

    public function advance2(Request $request, $id) {
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

        return view('sueldo_cosmes.firma_recepcion', compact('registroSueldoSemanalActual','pagos','registroSueldoSemanal', 'cosme','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'notasDespedidas', 'regcosmessum'));
    }

    public function advance(Request $request, $id) {
        $cosme = User::where('id', '=', $id)->first();

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('cosmetologo_id', '=', $id)->get();
        $paquetes_vendidos = Paquetes::whereBetween('fecha_inicial', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '!=', NULL)->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('puntualidad', '=', '1')->get();
        $registroSueldoSemanalActual = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();
        $paquetes = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();
        $notasPedidos = NotasPedidos::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('estatus', '!=', 'Cancelada')->get();
        $notasServicios = Notas::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();

        //Buscador
        $fecha = $request->get('fecha');
        $fecha2 = $request->get('fecha2');

        $todosPagos = RegistroSueldoSemanal::whereBetween('fecha', [$fecha, $fecha2])->where('id_cosme', '=', $id)->get();

        return view('sueldo_cosmes.firma_sueldos', compact('todosPagos','notasServicios','paquetes','notasPedidos','fechaInicioSemana','fechaFinSemana','registroSueldoSemanalActual','registroSueldoSemanal', 'cosme','registros_cubriendose','registros_puntualidad', 'registros_sueldo', 'paquetes_vendidos', 'regcosmessum'));
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

    public function recepcion_pdf($id){

        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();
        $fechaLunes = Carbon::now()->startOfWeek()->format('Y-m-d');

        $recepcion_pagos = User::where('id', $id)->first();
        $registroSueldoSemanal = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $regcosmessum = RegCosmesSum::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();
        $paquete = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->where('paquetes', '=', '1')->first();
        $firma = RegistroSueldoSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $id)->first();

        $pdf = \PDF::loadView('sueldo_cosmes.pdf_recepcion',compact('firma','fechaFinSemana','fechaInicioSemana','recepcion_pagos','registroSueldoSemanal', 'regcosmessum', 'fechaLunes', 'paquete'));

        return $pdf->download('Sueldo_recepcion'.$recepcion_pagos->name.'-'.$fechaInicioSemana.'.pdf');

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
                if ($registroSemanal->puntualidad == 0) {
                    $registroExistente->puntualidad = 0;
                    $registroExistente->save();
                } else {

                }
            }
        }

        //quitar_comida privilegios a la que falto
        if($registroSemanal->cosmetologo_cubriendo != NULL){
            $registroExistente = RegistroSueldoSemanal::where('id_cosme', $registroSemanal->cosmetologo_cubriendo)
            ->where('fecha', $fechaInicioSemana)
            ->first();

            $registroExistente->puntualidad = 0;
            $registroExistente->paquetes = 0;
            $registroExistente->save();
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

        return redirect()->back()
        ->with('edit','Se agrego con exito.');
    }

    public function corte(Request $request){
        $fecha = date('Y-m-d');
        $registros_hoy = RegistroSemanal::where('fecha', '=', $fecha)->get();
        $fecha_domingo = date("w", strtotime($fecha));
        foreach ($registros_hoy as $registro_hoy) {
            $cosmetologoId = $registro_hoy->cosmetologo->id;
            if($fecha_domingo == 0){
                $sueldo_horas = $registro_hoy->cosmetologo->comision_despedida;
            }else{
                $sueldo_horas = $registro_hoy->cosmetologo->sueldo_hora;
            }
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

    public function comida(Request $request){
        $fecha = date('Y-m-d');
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();

        // Obtener todos los registros de la semana actual para todos los cosmetólogos
        $id_cosme = $request->get('id_cosme');
        $hora_inicio_comida = $request->get('hora_inicio_comida');
        $hora_fin_comida = $request->get('hora_fin_comida');

        for ($count = 0; $count < count($id_cosme); $count++) {
            $cosmetologoId = $id_cosme[$count];
            $registro_update = RegistroSemanal::where('cosmetologo_id', $cosmetologoId)
            ->where('fecha', '=', $fecha)->first();
            $registro_update->hora_inicio_comida = $hora_inicio_comida[$count];
            $registro_update->hora_fin_comida = $hora_fin_comida[$count];
            $registro_update->update();

            if($hora_inicio_comida != $hora_fin_comida){
                $horaInicioComida = Carbon::parse($registro_update->hora_inicio_comida);
                $horaFinComida = Carbon::parse($registro_update->hora_fin_comida);
                $diferenciaEnMinutos = $horaInicioComida->diffInMinutes($horaFinComida);
                $limiteMinutos = 55;

                $registro = RegistroSueldoSemanal::where('id_cosme', $cosmetologoId)
                    ->where('fecha', $fechaInicioSemana)
                    ->first();

                if ($diferenciaEnMinutos <= $limiteMinutos && $registro->paquetes !== 0) {
                    $registro->paquetes = 1;
                } else {
                    $registro->paquetes = 0;
                }

                $registro->update();
            }
        }


        return redirect()->back()
        ->with('edit','Registro de comida con exito.');
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

        $pedidoCosmes = NotasPedidos::where('id_user', $cosmetologoId)->whereDate('fecha', $fecha)->where('estatus', '!=', 'Cancelada')->get();
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

    public function quitar_comida(Request $request, $id){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();

        $registroSueldoSemanal = RegistroSueldoSemanal::where('id_cosme', '=', $id)->where('fecha', $fechaInicioSemana)->first();
        $registroSueldoSemanal->paquetes = $request->paquetes;
        $registroSueldoSemanal->update();

        return back()->with('success', 'Se quito con exito');
    }

    public function quitar_puntualidad(Request $request, $id){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();

        $registroSueldoSemanal = RegistroSueldoSemanal::where('id_cosme', '=', $id)->where('fecha', $fechaInicioSemana)->first();
        $registroSueldoSemanal->puntualidad = $request->puntualidad;
        $registroSueldoSemanal->update();

        return back()->with('success', 'Se quito con exito');
    }

}
