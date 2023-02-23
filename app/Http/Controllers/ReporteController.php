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
        $diaActual = date('d');

        $pedidos_total = NotasPedidos::
        where(DB::raw("DATE_FORMAT(fecha,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        $servicios_total = Notas::
        where(DB::raw("DATE_FORMAT(fecha,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        $reporte = Reporte::get();

        return view('reportes.index', compact('pedidos_total', 'servicios_total', 'reporte'));
    }

    public function advance(Request $request) {
        $reporte = DB::table('reporte');
   
        if( $request->fecha != NULL && $request->fecha2 != NULL){
            $reporte = $reporte->where('fecha', '>=', $request->fecha)
                                ->where('fecha', '<=', $request->fecha2);
        }
        if( $request->tipo){
            $reporte = $reporte->where('tipo', 'LIKE', "%" . $request->tipo . "%");
        }
        if( $request->metodo_pago){
            $reporte = $reporte->where('metodo_pago', 'LIKE', "%" . $request->metodo_pago . "%");
        }
        $reporte = $reporte->paginate(10);

        $añoActual = date('Y');
        $diaActual = date('d');

        $pedidos_total = NotasPedidos::
        where(DB::raw("DATE_FORMAT(fecha,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        $servicios_total = Notas::
        where(DB::raw("DATE_FORMAT(fecha,'%Y')"), '=', $añoActual)
        ->select(DB::raw('count(*) as filas'))
        ->first();

        return view('reportes.index', compact('reporte', 'pedidos_total', 'servicios_total'));
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
