<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\CajaDia;
use App\Models\Notas;
use App\Models\NotasPedidos;
use App\Models\Pagos;
use Session;
use DB;

class CajaController extends Controller
{
    public function index()
    {
        $fechaActual = date('Y-m-d');
        $diaActual = date('d');

        $caja = Caja::get();

        $servicios_individual = Notas::
        where('fecha', '=', $fechaActual)
        ->select(DB::raw('count(*) as filas'), 'id_servicio')
        ->groupBy('id_servicio')
        ->get();

        $pago = Pagos::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Efectivo')->get();
        $pago_suma = Pagos::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(pago) as total'))
        ->first();

        $pago_pedidos = NotasPedidos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Efectivo')->get();
        $pago_pedidos_suma = NotasPedidos::where('fecha', '=', $fechaActual)
        ->where('metodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(total) as total'))
        ->first();

        $caja_dia = CajaDia::where('fecha', '=', $fechaActual)->get();
        $caja_dia_suma = CajaDia::where('fecha', '=', $fechaActual)
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        return view('caja.index', compact('caja', 'pago', 'pago_suma', 'caja_dia', 'caja_dia_suma','pago_pedidos', 'pago_pedidos_suma', 'servicios_individual', 'diaActual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'egresos' => 'required',
            'concepto' => 'required'
        ]);

        $fechaActual = date('Y-m-d');
        $caja = new CajaDia;
        $caja->egresos = $request->get('egresos');
        $caja->concepto = $request->get('concepto');
        $caja->fecha = $fechaActual;
        $caja->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'caja created successfully.');
    }

    public function imprimir_caja(){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $caja = CajaDia::where(DB::raw('fecha'), '=', $diaActual)->get();

        $servicios = Pagos::where(DB::raw('fecha'), '=', $diaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->get();

        $productos = NotasPedidos::where(DB::raw('fecha'), '=', $diaActual)
        ->where('metodo_pago', '=', 'Efectivo')
        ->get();

        $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $pago_pedidos_suma = NotasPedidos::where('fecha', '=', $diaActual)
        ->where('metodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(total) as total'))
        ->first();

        $pago_suma = Pagos::where('fecha', '=', $diaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(pago) as total'))
        ->first();

        $pdf = \PDF::loadView('caja.pdf', compact('today', 'caja', 'servicios', 'productos', 'caja_dia_suma', 'pago_pedidos_suma', 'pago_suma'));
        return $pdf->stream();
        // return $pdf->download('Reporte Caja '.$today.'.pdf');
    }
}
