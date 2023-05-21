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

        // Grafica notas servicio

        $reporte_notaservicio_trans = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA SERVICIO')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Transferencia')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaservicio_tarjeta = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA SERVICIO')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Tarjeta')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaservicio_efectivo = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA SERVICIO')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Efectivo')
            ->orderBy('fecha','DESC')
            ->get();

            $totalNotaTrans = 0;
            $totalNotaTarjeta = 0;
            $totalNotaEfectivo = 0;

            foreach ($reporte_notaservicio_trans as $notaservicio_trans) {
                $totalNotaTrans += $notaservicio_trans->pago;
            }
            foreach ($reporte_notaservicio_tarjeta as $notaservicio_tarjeta) {
                $totalNotaTarjeta += $notaservicio_tarjeta->pago;
            }
            foreach ($reporte_notaservicio_efectivo as $notaservicio_efectivo) {
                $totalNotaEfectivo += $notaservicio_efectivo->pago;
            }

            // Grafica notas PRODUCTOS

        $reporte_notasproducto_trans = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA PRODUCTOS')
            ->where('monto', '>','0')
            ->where('metodo_pago', '=','Transferencia')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notasproducto_tarjeta = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA PRODUCTOS')
            ->where('monto', '>','0')
            ->where('metodo_pago', '=','Tarjeta')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notasproducto_efectivo = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA PRODUCTOS')
            ->where('monto', '>','0')
            ->where('metodo_pago', '=','Efectivo')
            ->orderBy('fecha','DESC')
            ->get();

            $totalProductoTrans = 0;
            $totalProductoTarjeta = 0;
            $totalProductoEfectivo = 0;

            foreach ($reporte_notasproducto_trans as $notasproducto_trans) {
                $totalProductoTrans += $notasproducto_trans->monto;
            }
            foreach ($reporte_notasproducto_tarjeta as $notasproducto_tarjeta) {
                $totalProductoTarjeta += $notasproducto_tarjeta->monto;
            }
            foreach ($reporte_notasproducto_efectivo as $notasproducto_efectivo) {
                $totalProductoEfectivo += $notasproducto_efectivo->monto;
            }
            // Grafica notas PRODUCTOS

            $reporte_notaspaquete_trans = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA PAQUETE')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Transferencia')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaspaquete_tarjeta = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA PAQUETE')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Tarjeta')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaspaquete_efectivo = Reporte::whereYear('fecha', $añoActual)
            ->where('tipo', 'NOTA PAQUETE')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Efectivo')
            ->orderBy('fecha','DESC')
            ->get();

            $totalPaqueteTrans = 0;
            $totalPaqueteTarjeta = 0;
            $totalPaqueteEfectivo = 0;

            foreach ($reporte_notaspaquete_trans as $notaspaquete_trans) {
                $totalPaqueteTrans += $notaspaquete_trans->pago;
            }
            foreach ($reporte_notaspaquete_tarjeta as $notaspaquete_tarjeta) {
                $totalPaqueteTarjeta += $notaspaquete_tarjeta->pago;
            }
            foreach ($reporte_notaspaquete_efectivo as $notaspaquete_efectivo) {
                $totalPaqueteEfectivo += $notaspaquete_efectivo->pago;
            }

        return view('reportes.index', compact('pedidos_total', 'servicios_total', 'reporte','totalNotaTrans','totalNotaTarjeta','totalNotaEfectivo','totalProductoTrans','totalProductoTarjeta','totalProductoEfectivo','totalPaqueteTrans','totalPaqueteTarjeta','totalPaqueteEfectivo'));
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

        // Grafica notas servicio
        $reporte_notaservicio_trans = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA SERVICIO')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Transferencia')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaservicio_tarjeta = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA SERVICIO')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Tarjeta')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaservicio_efectivo = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA SERVICIO')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Efectivo')
            ->orderBy('fecha','DESC')
            ->get();

            $totalNotaTrans = 0;
            $totalNotaTarjeta = 0;
            $totalNotaEfectivo = 0;

            foreach ($reporte_notaservicio_trans as $notaservicio_trans) {
                $totalNotaTrans += $notaservicio_trans->pago;
            }
            foreach ($reporte_notaservicio_tarjeta as $notaservicio_tarjeta) {
                $totalNotaTarjeta += $notaservicio_tarjeta->pago;
            }
            foreach ($reporte_notaservicio_efectivo as $notaservicio_efectivo) {
                $totalNotaEfectivo += $notaservicio_efectivo->pago;
            }

            // Grafica notas PRODUCTOS

        $reporte_notasproducto_trans = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA PRODUCTOS')
            ->where('monto', '>','0')
            ->where('metodo_pago', '=','Transferencia')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notasproducto_tarjeta = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA PRODUCTOS')
            ->where('monto', '>','0')
            ->where('metodo_pago', '=','Tarjeta')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notasproducto_efectivo = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA PRODUCTOS')
            ->where('monto', '>','0')
            ->where('metodo_pago', '=','Efectivo')
            ->orderBy('fecha','DESC')
            ->get();

            $totalProductoTrans = 0;
            $totalProductoTarjeta = 0;
            $totalProductoEfectivo = 0;

            foreach ($reporte_notasproducto_trans as $notasproducto_trans) {
                $totalProductoTrans += $notasproducto_trans->monto;
            }
            foreach ($reporte_notasproducto_tarjeta as $notasproducto_tarjeta) {
                $totalProductoTarjeta += $notasproducto_tarjeta->monto;
            }
            foreach ($reporte_notasproducto_efectivo as $notasproducto_efectivo) {
                $totalProductoEfectivo += $notasproducto_efectivo->monto;
            }

            // Grafica notas PRODUCTOS

            $reporte_notaspaquete_trans = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA PAQUETE')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Transferencia')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaspaquete_tarjeta = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA PAQUETE')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Tarjeta')
            ->orderBy('fecha','DESC')
            ->get();

        $reporte_notaspaquete_efectivo = Reporte::whereBetween('fecha', [$request->fecha, $request->fecha2])
            ->where('tipo', 'NOTA PAQUETE')
            ->where('pago', '>','0')
            ->where('metodo_pago', '=','Efectivo')
            ->orderBy('fecha','DESC')
            ->get();

            $totalPaqueteTrans = 0;
            $totalPaqueteTarjeta = 0;
            $totalPaqueteEfectivo = 0;

            foreach ($reporte_notaspaquete_trans as $notaspaquete_trans) {
                $totalPaqueteTrans += $notaspaquete_trans->pago;
            }
            foreach ($reporte_notaspaquete_tarjeta as $notaspaquete_tarjeta) {
                $totalPaqueteTarjeta += $notaspaquete_tarjeta->pago;
            }
            foreach ($reporte_notaspaquete_efectivo as $notaspaquete_efectivo) {
                $totalPaqueteEfectivo += $notaspaquete_efectivo->pago;
            }


        return view('reportes.index', compact('reporte', 'pedidos_total', 'servicios_total','totalNotaTrans','totalNotaTarjeta','totalNotaEfectivo','totalProductoTrans','totalProductoTarjeta','totalProductoEfectivo','totalPaqueteTrans','totalPaqueteTarjeta','totalPaqueteEfectivo'));
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
