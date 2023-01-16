<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Caja;
use App\Models\Pagos;
use DB;
use App\Models\Client;
use App\Models\Notas;
use App\Models\NotasCosmes;
use App\Models\NotasPedidos;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $añoActual = date('Y');

        $caja = Caja::get();
        $pago = Pagos::get();
        $pago_pedidos = NotasPedidos::get();

        $pedidos_total = NotasPedidos::
        where(DB::raw("DATE_FORMAT(fecha,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        $servicios_total = Notas::
        where(DB::raw("DATE_FORMAT(fecha,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        $clientes_total = Client::
        where(DB::raw("DATE_FORMAT(created_at,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        return view('reportes.index', compact('añoActual' ,'caja', 'pago', 'pago_pedidos', 'pedidos_total', 'servicios_total', 'clientes_total'));
    }

    public function imprimir_serv(){
        $mesActual = date('m');
        $today =  date('d-m-Y');

        $servicios = Pagos::where(DB::raw("DATE_FORMAT(fecha,'%m')"), '=', $mesActual)->get();

        //         $servicios_cosmes =  Pagos::
        //         join('notas_cosmes', 'pagos.id_nota', '=', 'notas_cosmes.id_nota')
        //         ->where(DB::raw("DATE_FORMAT(fecha,'%m')"), '=', $mesActual)
        //         ->select('id_user', 'pagos.* as pag')
        //         ->groupBy('id_user')
        //         ->get();
        // dd( $servicios_cosmes );
        $pdf = \PDF::loadView('reportes.pdf', compact('today', 'servicios'));
        // return $pdf->stream();
        return $pdf->download('Reporte Servicios '.$today.'.pdf');
   }

   public function imprimir_prod(){
        $mesActual = date('m');
        $today =  date('d-m-Y');

        $productos = NotasPedidos::where(DB::raw("DATE_FORMAT(fecha,'%m')"), '=', $mesActual)->get();

        $pdf = \PDF::loadView('reportes.pdf_productos', compact('today', 'productos'));
        //return $pdf->stream();
         return $pdf->download('Reporte Productos '.$today.'.pdf');
    }
}
