<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Reporte;
use App\Models\Caja;
use App\Models\Pagos;
use DB;
use App\Models\Client;
use App\Models\Notas;
use App\Models\NotasCosmes;
use App\Models\NotasLacer;
use App\Models\NotasPaquetes;
use App\Models\NotasPedidos;
use App\Models\Paquetes;
use App\Models\ZonasLaser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index_cosmes()
     {
         $añoActual = date('Y');
         $diaActual = date('d');
         $infoUsuarios = NotasCosmes::join('notas', 'notas_cosmes.id_nota', '=', 'notas.id')
         ->select('notas_cosmes.id_user', DB::raw('SUM(notas.precio) as total_precio'),
         DB::raw('COUNT(notas.id) as cantidad_notas'))
         ->groupBy('notas_cosmes.id_user')
         ->orderBy('total_precio', 'desc')
         ->get();

         $infoUsuarios_productos = NotasPedidos::select('id_user', DB::raw('SUM(total) as total_precio'),
         DB::raw('COUNT(id) as cantidad_notas'))
         ->groupBy('id_user')
         ->orderBy('total_precio', 'desc')
         ->get();

         $infoUsuarios_paquetes = Paquetes::select('id_user1', DB::raw('SUM(monto) as total_precio'),
         DB::raw('COUNT(id) as cantidad_notas'))
         ->groupBy('id_user1')
         ->orderBy('total_precio', 'desc')
         ->get();

         $seisMesesAtras = Carbon::now()->subMonths(6);

        $infoUsuarios_seismeses = NotasCosmes::join('notas', 'notas_cosmes.id_nota', '=', 'notas.id')
            ->select('notas_cosmes.id_user', DB::raw('SUM(notas.precio) as total_precio'), DB::raw('COUNT(notas.id) as cantidad_notas'))
            ->where('notas.fecha', '>=', $seisMesesAtras)  // Filtra las notas de los últimos 6 meses
            ->groupBy('notas_cosmes.id_user')
            ->orderBy('total_precio', 'desc')  // Ordena por total_precio de manera descendente
            ->get();

         $pdf = \PDF::loadView('reportes.pdf_cosmes', compact('diaActual', 'infoUsuarios_productos', 'infoUsuarios_paquetes','infoUsuarios_seismeses', 'infoUsuarios'));
         return $pdf->stream();

     }

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

    public function index_paquetes(){
        $paquetesFaciales = Notas::join('notas_paquetes', 'notas.id', '=', 'notas_paquetes.id_nota')
        ->Join('pagos', 'notas.id', '=', 'pagos.id_nota')
        ->where(function($query) {
            $query->whereIn('notas_paquetes.id_servicio', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio2', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio3', [138, 139, 140, 141, 142, 270])
                ->orWhereIn('notas_paquetes.id_servicio4', [138, 139, 140, 141, 142, 270]);
        })
        ->select('notas.*')
        ->groupBy('notas.id')
        ->get();

        $paquetesCorporales = Paquetes::get();

        $paquetesLaser = NotasLacer::where('tipo', '!=', 'Sesiones')->get();

        return view('reportes.reporte_paquetes', compact('paquetesFaciales', 'paquetesCorporales', 'paquetesLaser'));
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

    public function imprimir_mensual(){
        $mesActual = date('m');
        $mesAnterior = date('m', strtotime('-2 month'));
        $dosMesesAtras = date('m', strtotime('-3 months'));
        $today = date('d-m-Y');
dd($mesAnterior);
        $citasMesActual = Alertas::whereMonth('created_at', $mesActual)
            ->where('id_status', '!=', 7)
            ->count();

        $citasMesAnterior = Alertas::whereMonth('created_at', $mesAnterior)
        ->where('id_status', '!=', 7)
            ->count();

        $citasDosMesesAtras = Alertas::whereMonth('created_at', $dosMesesAtras)
        ->where('id_status', '!=', 7)
            ->count();


            $chartData = [
                "type" => 'doughnut',
                "data" => [
                    "labels" => ['Mes Actual', 'Mes Anterior', 'Hace Dos Meses'],
                    "datasets" => [
                        [
                        "label" => "",
                        "data" => [$citasMesActual, $citasMesAnterior, $citasDosMesesAtras],
                        "backgroundColor" => ['#f28482', '#84a59d', '#f5cac3']
                        ],
                    ],
                ],
                "options" => [
                    "plugins" => [
                        "datalabels" => [
                            "color" => 'white', // Cambia el color del texto a blanco
                        ],
                    ],
                    "legend" => [
                        "display" => false // Esto oculta la leyenda de colores
                    ],
                ],
                ];

            $chartData = json_encode($chartData);

            $chartURL = "https://quickchart.io/chart?width=180&height=180&c=".urlencode($chartData);

            $chartData = file_get_contents($chartURL);
            $chart = 'data:image/png;base64, '.base64_encode($chartData);

        $citasRealizadasMesActual = Alertas::whereMonth('updated_at', $mesActual)
        ->where('id_status', 2)
        ->count();

        $citasRealizadasMesAnterior = Alertas::whereMonth('updated_at', $mesAnterior)
            ->where('id_status', 2)
            ->count();

        $citasRealizadasDosMesesAtras = Alertas::whereMonth('updated_at', $dosMesesAtras)
            ->where('id_status', 2)
            ->count();

        $chartDataCitasRealizadas = [
            "type" => 'bar',
            "data" => [
                "labels" => ['Mes Actual', 'Mes Anterior', 'Hace Dos Meses'],
                "datasets" => [
                    [
                        "label" => "Citas Realizadas",
                        "data" => [$citasRealizadasMesActual, $citasRealizadasMesAnterior, $citasRealizadasDosMesesAtras],
                        "backgroundColor" => ['#f28482', '#84a59d', '#f5cac3']
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'white', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataCitasRealizadas = json_encode($chartDataCitasRealizadas);

        $chartURLCitasRealizadas = "https://quickchart.io/chart?width=180&height=180&c=".urlencode($chartDataCitasRealizadas);

        $chartDataCitasRealizadas = file_get_contents($chartURLCitasRealizadas);
        $chartCitasRealizadas = 'data:image/png;base64, '.base64_encode($chartDataCitasRealizadas);


        $citasCanceladasMesActual = Alertas::whereMonth('updated_at', $mesActual)
        ->where('id_status', 3)
        ->count();

        $citasCanceladasMesAnterior = Alertas::whereMonth('updated_at', $mesAnterior)
            ->where('id_status', 3)
            ->count();

        $citasCanceladasDosMesesAtras = Alertas::whereMonth('updated_at', $dosMesesAtras)
            ->where('id_status', 3)
            ->count();

        $chartDataCitasCanceladas = [
            "type" => 'polarArea',
            "data" => [
                "labels" => ['Mes Actual', 'Mes Anterior', 'Hace Dos Meses'],
                "datasets" => [
                    [
                        "label" => "Citas Realizadas",
                        "data" => [$citasCanceladasMesActual, $citasCanceladasMesAnterior, $citasCanceladasDosMesesAtras],
                        "backgroundColor" => ['#f28482', '#84a59d', '#f5cac3']
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'white', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataCitasCanceladas = json_encode($chartDataCitasCanceladas);

        $chartURLCitasCanceladas = "https://quickchart.io/chart?width=180&height=180&c=".urlencode($chartDataCitasCanceladas);

        $chartDataCitasCanceladas = file_get_contents($chartURLCitasCanceladas);
        $chartCitasCanceladas = 'data:image/png;base64, '.base64_encode($chartDataCitasCanceladas);

        $clientesNuevosMesActual = Alertas::whereMonth('created_at', $mesActual)
        ->where('nuevo_cliente', 1)
        ->count();

        $clientesNuevosMesAnterior = Alertas::whereMonth('created_at', $mesAnterior)
            ->where('nuevo_cliente', 1)
            ->count();

        $clientesNuevosDosMesesAtras = Alertas::whereMonth('created_at', $dosMesesAtras)
            ->where('nuevo_cliente', 1)
            ->count();

        $chartDataclientesNuevos = [
            "type" => 'pie',
            "data" => [
                "labels" => ['Mes Actual', 'Mes Anterior', 'Hace Dos Meses'],
                "datasets" => [
                    [
                        "label" => "Citas Realizadas",
                        "data" => [$clientesNuevosMesActual, $clientesNuevosMesAnterior, $clientesNuevosDosMesesAtras],
                        "backgroundColor" => ['#168aad', '#34a0a4', '#52b69a']
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'white', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataclientesNuevos = json_encode($chartDataclientesNuevos);

        $chartURLclientesNuevos = "https://quickchart.io/chart?width=180&height=180&c=".urlencode($chartDataclientesNuevos);

        $chartDataclientesNuevos = file_get_contents($chartURLclientesNuevos);
        $chartclientesNuevos = 'data:image/png;base64, '.base64_encode($chartDataclientesNuevos);

        $clientesRecurrentesMesActual = Alertas::select('id_client')
            ->whereMonth('created_at', $mesActual)
            ->groupBy('id_client')
            ->havingRaw('COUNT(id) > 1')
            ->count();

        $clientesRecurrentesMesAnterior = Alertas::select('id_client')
            ->whereMonth('created_at', $mesAnterior)
            ->groupBy('id_client')
            ->havingRaw('COUNT(id) > 1')
            ->count();

        $clientesRecurrentesDosMesesAtras = Alertas::select('id_client')
            ->whereMonth('created_at', $dosMesesAtras)
            ->groupBy('id_client')
            ->havingRaw('COUNT(id) > 1')
            ->count();

        $chartDataclientesRecurrentes = [
            "type" => 'line',
            "data" => [
                "labels" => ['Mes Actual', 'Mes Anterior', 'Hace Dos Meses'],
                "datasets" => [
                    [
                        "label" => "Clientes Recurrentes",
                        "data" => [$clientesRecurrentesMesActual, $clientesRecurrentesMesAnterior, $clientesRecurrentesDosMesesAtras],
                        "backgroundColor" => 'rgba(75,192,192,0.4)',
                        "borderColor" => 'rgba(75,192,192,1)',
                        "pointBackgroundColor" => 'rgba(75,192,192,1)',
                        "pointBorderColor" => '#fff',
                        "pointHoverBackgroundColor" => '#fff',
                        "pointHoverBorderColor" => 'rgba(75,192,192,1)'
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'black', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataclientesRecurrentes = json_encode($chartDataclientesRecurrentes);

        $chartURLclientesRecurrentes = "https://quickchart.io/chart?width=220&height=220&c=".urlencode($chartDataclientesRecurrentes);

        $chartDataclientesRecurrentes = file_get_contents($chartURLclientesRecurrentes);
        $chartclientesRecurrentes = 'data:image/png;base64, '.base64_encode($chartDataclientesRecurrentes);

        $serviciosMasSolicitados = Alertas::select('id_servicio', DB::raw('COUNT(id) as total'))
        ->where('nuevo_cliente', 1)
        ->groupBy('id_servicio')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();

        $serviciosLabels = $serviciosMasSolicitados->pluck('id_servicio')->toArray();
        $serviciosData = $serviciosMasSolicitados->pluck('total')->toArray();

        $chartDataServiciosMasSolicitados = [
            "type" => 'bar',
            "data" => [
                "labels" => $serviciosLabels,
                "datasets" => [
                    [
                        "label" => "Servicios Más Solicitados",
                        "data" => $serviciosData,
                        "backgroundColor" => ['#1a759f', '#168aad', '#34a0a4', '#52b69a', '#76c893']
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'black', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataServiciosMasSolicitados = json_encode($chartDataServiciosMasSolicitados);

        $chartURLServiciosMasSolicitados = "https://quickchart.io/chart?width=220&height=220&c=".urlencode($chartDataServiciosMasSolicitados);

        $chartDataServiciosMasSolicitados = file_get_contents($chartURLServiciosMasSolicitados);
        $chartServiciosMasSolicitados = 'data:image/png;base64, '.base64_encode($chartDataServiciosMasSolicitados);

        $serviciosMasSolicitadosRecurrentes = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
        ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
        ->whereIn('alertas.id_client', function($query) use ($mesActual, $mesAnterior, $dosMesesAtras) {
            $query->select('id_client')
                ->from('alertas')
                ->whereMonth('created_at', $mesActual)
                ->orWhereMonth('created_at', $mesAnterior)
                ->orWhereMonth('created_at', $dosMesesAtras)
                ->groupBy('id_client')
                ->havingRaw('COUNT(id) > 1');
        })
        ->groupBy('servicios.nombre')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();

        $serviciosLabelsRecurrentes = $serviciosMasSolicitadosRecurrentes->pluck('nombre')->toArray();
        $serviciosDataRecurrentes = $serviciosMasSolicitadosRecurrentes->pluck('total')->toArray();

        $chartDataServiciosMasSolicitadosRecurrentes = [
            "type" => 'bar',
            "data" => [
                "labels" => $serviciosLabelsRecurrentes,
                "datasets" => [
                    [
                        "label" => "Servicios Más Solicitados por Clientes Recurrentes",
                        "data" => $serviciosDataRecurrentes,
                        "backgroundColor" => ['#1a759f', '#168aad', '#34a0a4', '#52b69a', '#76c893']
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'black', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataServiciosMasSolicitadosRecurrentes = json_encode($chartDataServiciosMasSolicitadosRecurrentes);
        $chartURLServiciosMasSolicitadosRecurrentes = "https://quickchart.io/chart?width=220&height=220&c=".urlencode($chartDataServiciosMasSolicitadosRecurrentes);

        $chartDataServiciosMasSolicitadosRecurrentes = file_get_contents($chartURLServiciosMasSolicitadosRecurrentes);
        $chartServiciosMasSolicitadosRecurrentes = 'data:image/png;base64, '.base64_encode($chartDataServiciosMasSolicitadosRecurrentes);

        $serviciosFacialesMesActual = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'Faciales')
            ->whereMonth('alertas.created_at', $mesActual)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosFacialesMesAnterior = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'Faciales')
            ->whereMonth('alertas.created_at', $mesAnterior)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosFacialesDosMesesAtras = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'Faciales')
            ->whereMonth('alertas.created_at', $dosMesesAtras)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosCorporalesMesActual = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'Corporales')
            ->whereMonth('alertas.created_at', $mesActual)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosCorporalesMesAnterior = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'Corporales')
            ->whereMonth('alertas.created_at', $mesAnterior)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosCorporalesDosMesesAtras = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'Corporales')
            ->whereMonth('alertas.created_at', $dosMesesAtras)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosexperienciasMesActual = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'LIKE', '%Experiencia%')
            ->whereMonth('alertas.created_at', $mesActual)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosexperienciasMesAnterior = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'LIKE', '%Experiencia%')
            ->whereMonth('alertas.created_at', $mesAnterior)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosexperienciasDosMesesAtras = Alertas::select('servicios.nombre', DB::raw('COUNT(alertas.id) as total'))
            ->join('servicios', 'alertas.id_servicio', '=', 'servicios.id')
            ->where('servicios.categoria', 'LIKE', '%Experiencia%')
            ->whereMonth('alertas.created_at', $dosMesesAtras)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosPaquetesMesActual = NotasPaquetes::select('servicios.nombre', DB::raw('COUNT(notas_paquetes.id) as total'))
            ->join('servicios', 'notas_paquetes.id_servicio', '=', 'servicios.id')
            ->join('notas', 'notas_paquetes.id_nota', '=', 'notas.id')
            ->where('servicios.categoria', 'LIKE', '%Paquetes%')
            ->whereMonth('notas.created_at', $mesActual)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosPaquetesMesAnterior = NotasPaquetes::select('servicios.nombre', DB::raw('COUNT(notas_paquetes.id) as total'))
            ->join('servicios', 'notas_paquetes.id_servicio', '=', 'servicios.id')
            ->join('notas', 'notas_paquetes.id_nota', '=', 'notas.id')
            ->where('servicios.categoria', 'LIKE', '%Paquetes%')
            ->whereMonth('notas.created_at', $mesAnterior)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosPaquetesDosMesesAtras = NotasPaquetes::select('servicios.nombre', DB::raw('COUNT(notas_paquetes.id) as total'))
            ->join('servicios', 'notas_paquetes.id_servicio', '=', 'servicios.id')
            ->join('notas', 'notas_paquetes.id_nota', '=', 'notas.id')
            ->where('servicios.categoria', 'LIKE', '%Paquetes%')
            ->whereMonth('notas.created_at', $dosMesesAtras)
            ->groupBy('servicios.nombre')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosLaserMesActual = ZonasLaser::select('laser.zona', DB::raw('COUNT(zonas_laser.id) as total'))
            ->join('laser', 'zonas_laser.id_zona', '=', 'laser.id')
            ->join('nota_laser', 'zonas_laser.id_nota', '=', 'nota_laser.id')
            ->whereMonth('nota_laser.created_at', $mesActual)
            ->groupBy('laser.zona')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosLaserMesAnterior = ZonasLaser::select('laser.zona', DB::raw('COUNT(zonas_laser.id) as total'))
            ->join('laser', 'zonas_laser.id_zona', '=', 'laser.id')
            ->join('nota_laser', 'zonas_laser.id_nota', '=', 'nota_laser.id')
            ->whereMonth('nota_laser.created_at', $mesAnterior)
            ->groupBy('laser.zona')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviciosLaserDosMesesAtras = ZonasLaser::select('laser.zona', DB::raw('COUNT(zonas_laser.id) as total'))
            ->join('laser', 'zonas_laser.id_zona', '=', 'laser.id')
            ->join('nota_laser', 'zonas_laser.id_nota', '=', 'nota_laser.id')
            ->whereMonth('nota_laser.created_at', $dosMesesAtras)
            ->groupBy('laser.zona')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();


        $ticketPromedioMesActual = DB::table('notas')
        ->select('notas.id_client', DB::raw('AVG(notas.precio) as promedio'))
        ->whereMonth('notas.fecha', $mesActual)
        ->groupBy('notas.id_client')
        ->union(
            DB::table('nota_laser')
                ->select('nota_laser.id_client', DB::raw('AVG(nota_laser.total) as promedio'))
                ->whereMonth('nota_laser.fecha', $mesActual)
                ->groupBy('nota_laser.id_client')
        )
        ->union(
            DB::table('paquetes_servicios')
                ->select('paquetes_servicios.id_client', DB::raw('AVG(paquetes_servicios.monto) as promedio'))
                ->whereMonth('paquetes_servicios.fecha_inicial', $mesActual)
                ->groupBy('paquetes_servicios.id_client')
        )
        ->union(
            DB::table('notas_pedidos')
                ->select('notas_pedidos.id_client', DB::raw('AVG(notas_pedidos.total) as promedio'))
                ->whereMonth('notas_pedidos.fecha', $mesActual)
                ->groupBy('notas_pedidos.id_client')
        )
        ->get();

        $ticketPromedioMesAnterior = DB::table('notas')
        ->select('notas.id_client', DB::raw('AVG(notas.precio) as promedio'))
        ->whereMonth('notas.fecha', $mesAnterior)
        ->groupBy('notas.id_client')
        ->union(
            DB::table('nota_laser')
                ->select('nota_laser.id_client', DB::raw('AVG(nota_laser.total) as promedio'))
                ->whereMonth('nota_laser.fecha', $mesAnterior)
                ->groupBy('nota_laser.id_client')
        )
        ->union(
            DB::table('paquetes_servicios')
                ->select('paquetes_servicios.id_client', DB::raw('AVG(paquetes_servicios.monto) as promedio'))
                ->whereMonth('paquetes_servicios.fecha_inicial', $mesAnterior)
                ->groupBy('paquetes_servicios.id_client')
        )
        ->union(
            DB::table('notas_pedidos')
                ->select('notas_pedidos.id_client', DB::raw('AVG(notas_pedidos.total) as promedio'))
                ->whereMonth('notas_pedidos.fecha', $mesAnterior)
                ->groupBy('notas_pedidos.id_client')
        )
        ->get();

        $ticketPromedioHaceDosMeses = DB::table('notas')
        ->select('notas.id_client', DB::raw('AVG(notas.precio) as promedio'))
        ->whereMonth('notas.fecha', $dosMesesAtras)
        ->groupBy('notas.id_client')
        ->union(
            DB::table('nota_laser')
                ->select('nota_laser.id_client', DB::raw('AVG(nota_laser.total) as promedio'))
                ->whereMonth('nota_laser.fecha', $dosMesesAtras)
                ->groupBy('nota_laser.id_client')
        )
        ->union(
            DB::table('paquetes_servicios')
                ->select('paquetes_servicios.id_client', DB::raw('AVG(paquetes_servicios.monto) as promedio'))
                ->whereMonth('paquetes_servicios.fecha_inicial', $dosMesesAtras)
                ->groupBy('paquetes_servicios.id_client')
        )
        ->union(
            DB::table('notas_pedidos')
                ->select('notas_pedidos.id_client', DB::raw('AVG(notas_pedidos.total) as promedio'))
                ->whereMonth('notas_pedidos.fecha', $dosMesesAtras)
                ->groupBy('notas_pedidos.id_client')
        )
        ->get();

        $ticketPromedioMesActual = $ticketPromedioMesActual->avg('promedio');
        $ticketPromedioMesAnterior = $ticketPromedioMesAnterior->avg('promedio');
        $ticketPromedioHaceDosMeses = $ticketPromedioHaceDosMeses->avg('promedio');

        $serviciosPorCosmetologaMesActual = Alertas::join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
            ->join('users', 'alertas_cosmes.id_user', '=', 'users.id')
            ->select('users.name as cosmetologa', DB::raw('COUNT(alertas.id) as total'))
            ->whereMonth('alertas.created_at', $mesActual)
            ->groupBy('users.name')
            ->get();

        $serviciosPorCosmetologaMesAnterior = Alertas::join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
            ->join('users', 'alertas_cosmes.id_user', '=', 'users.id')
            ->select('users.name as cosmetologa', DB::raw('COUNT(alertas.id) as total'))
            ->whereMonth('alertas.created_at', $mesAnterior)
            ->groupBy('users.name')
            ->get();

        $serviciosPorCosmetologaDosMesesAtras = Alertas::join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
            ->join('users', 'alertas_cosmes.id_user', '=', 'users.id')
            ->select('users.name as cosmetologa', DB::raw('COUNT(alertas.id) as total'))
            ->whereMonth('alertas.created_at', $dosMesesAtras)
            ->groupBy('users.name')
            ->get();

    // I N I C I O  I N G R E S O S  G E N E R A D O S  C O S M E S
        $ingresosNotas = Notas::join('notas_cosmes', 'notas.id', '=', 'notas_cosmes.id_nota')
            ->join('users', 'notas_cosmes.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(notas.precio) as total'))
            ->whereMonth('notas.fecha', $mesActual)
            ->groupBy('users.id', 'users.name');

        $ingresosNotaLaser = DB::table('nota_laser')
            ->join('users', 'nota_laser.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(nota_laser.total) as total'))
            ->whereMonth('nota_laser.fecha', $mesActual)
            ->groupBy('users.id', 'users.name');

        $ingresosPaquetesServicios = DB::table('paquetes_servicios')
            ->join('users', 'paquetes_servicios.id_cosme', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(paquetes_servicios.monto) as total'))
            ->whereMonth('paquetes_servicios.fecha_inicial', $mesActual)
            ->groupBy('users.id', 'users.name');

        $ingresosNotasPedidos = DB::table('notas_pedidos')
            ->join('users', 'notas_pedidos.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(notas_pedidos.total) as total'))
            ->whereMonth('notas_pedidos.fecha', $mesActual)
            ->groupBy('users.id', 'users.name');

        $ingresosPorCosmetologaMesActual = $ingresosNotas
            ->union($ingresosNotaLaser)
            ->union($ingresosPaquetesServicios)
            ->union($ingresosNotasPedidos)
            ->get()
            ->groupBy('id')
            ->map(function ($row) {
                return [
                    'cosmetologa' => $row->first()->cosmetologa,
                    'total' => $row->sum('total')
                ];
            })
            ->values()
            ->sortByDesc('total');

        $MesAnterioringresosNotas = Notas::join('notas_cosmes', 'notas.id', '=', 'notas_cosmes.id_nota')
            ->join('users', 'notas_cosmes.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(notas.precio) as total'))
            ->whereMonth('notas.fecha', $mesAnterior)
            ->groupBy('users.id', 'users.name');

        $MesAnterioringresosNotaLaser = DB::table('nota_laser')
            ->join('users', 'nota_laser.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(nota_laser.total) as total'))
            ->whereMonth('nota_laser.fecha', $mesAnterior)
            ->groupBy('users.id', 'users.name');

        $MesAnterioringresosPaquetesServicios = DB::table('paquetes_servicios')
            ->join('users', 'paquetes_servicios.id_cosme', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(paquetes_servicios.monto) as total'))
            ->whereMonth('paquetes_servicios.fecha_inicial', $mesAnterior)
            ->groupBy('users.id', 'users.name');

        $MesAnterioringresosNotasPedidos = DB::table('notas_pedidos')
            ->join('users', 'notas_pedidos.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(notas_pedidos.total) as total'))
            ->whereMonth('notas_pedidos.fecha', $mesAnterior)
            ->groupBy('users.id', 'users.name');

        $MesAnterioringresosPorCosmetologaMesActual = $MesAnterioringresosNotas
            ->union($MesAnterioringresosNotaLaser)
            ->union($MesAnterioringresosPaquetesServicios)
            ->union($MesAnterioringresosNotasPedidos)
            ->get()
            ->groupBy('id')
            ->map(function ($row) {
                return [
                    'cosmetologa' => $row->first()->cosmetologa,
                    'total' => $row->sum('total')
                ];
            })
            ->values()
            ->sortByDesc('total');

        $HaceDosMesesingresosNotas = Notas::join('notas_cosmes', 'notas.id', '=', 'notas_cosmes.id_nota')
            ->join('users', 'notas_cosmes.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(notas.precio) as total'))
            ->whereMonth('notas.fecha', $dosMesesAtras)
            ->groupBy('users.id', 'users.name');

        $HaceDosMesesingresosNotaLaser = DB::table('nota_laser')
            ->join('users', 'nota_laser.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(nota_laser.total) as total'))
            ->whereMonth('nota_laser.fecha', $dosMesesAtras)
            ->groupBy('users.id', 'users.name');

        $HaceDosMesesingresosPaquetesServicios = DB::table('paquetes_servicios')
            ->join('users', 'paquetes_servicios.id_cosme', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(paquetes_servicios.monto) as total'))
            ->whereMonth('paquetes_servicios.fecha_inicial', $dosMesesAtras)
            ->groupBy('users.id', 'users.name');

        $HaceDosMesesingresosNotasPedidos = DB::table('notas_pedidos')
            ->join('users', 'notas_pedidos.id_user', '=', 'users.id')
            ->select('users.id', 'users.name as cosmetologa', DB::raw('SUM(notas_pedidos.total) as total'))
            ->whereMonth('notas_pedidos.fecha', $dosMesesAtras)
            ->groupBy('users.id', 'users.name');

        $HaceDosMesesingresosPorCosmetologaMesActual = $HaceDosMesesingresosNotas
            ->union($HaceDosMesesingresosNotaLaser)
            ->union($HaceDosMesesingresosPaquetesServicios)
            ->union($HaceDosMesesingresosNotasPedidos)
            ->get()
            ->groupBy('id')
            ->map(function ($row) {
                return [
                    'cosmetologa' => $row->first()->cosmetologa,
                    'total' => $row->sum('total')
                ];
            })
            ->values()
            ->sortByDesc('total');
    // F I N  I N G R E S O S  G E N E R A D O S  C O S M E S

    // I N I C I O  D E  C A N C E L C I O N E S  D E  C O S M E S
        $cosmetologasConMasCancelacionesMesActual = Alertas::join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
            ->join('users', 'alertas_cosmes.id_user', '=', 'users.id')
            ->select('users.name as cosmetologa', DB::raw('COUNT(alertas.id) as total_cancelaciones'))
            ->where('alertas.id_status', 3)
            ->whereMonth('alertas.updated_at', $mesActual)
            ->groupBy('users.name')
            ->orderBy('total_cancelaciones', 'desc')
            ->get();

        $cosmetologasConMasCancelacionesMesAnterior = Alertas::join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
            ->join('users', 'alertas_cosmes.id_user', '=', 'users.id')
            ->select('users.name as cosmetologa', DB::raw('COUNT(alertas.id) as total_cancelaciones'))
            ->where('alertas.id_status', 3)
            ->whereMonth('alertas.updated_at', $mesAnterior)
            ->groupBy('users.name')
            ->orderBy('total_cancelaciones', 'desc')
            ->get();

        $cosmetologasConMasCancelacionesDosMesesAtras = Alertas::join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
            ->join('users', 'alertas_cosmes.id_user', '=', 'users.id')
            ->select('users.name as cosmetologa', DB::raw('COUNT(alertas.id) as total_cancelaciones'))
            ->where('alertas.id_status', 3)
            ->whereMonth('alertas.updated_at', $dosMesesAtras)
            ->groupBy('users.name')
            ->orderBy('total_cancelaciones', 'desc')
            ->get();
    // F I N  D E  C A N C E L A C I O N E S  D E  C O S M E S

    // I N I C I O  T O T A L  I N G R E S O S
        // Sumar pagos del mes actual
        $pagosMesActual = DB::table('pagos')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->first()->total;

        $pagosLaserMesActual = DB::table('pagos_laser')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->first()->total;

        $paquetesPagoMesActual = DB::table('paquetes_pago')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->first()->total;

        $notasPedidosMesActual = DB::table('notas_pedidos')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->whereMonth('fecha', $mesActual)
            ->first()->total;

        $totalPagosMesActual = $pagosMesActual + $pagosLaserMesActual + $paquetesPagoMesActual + $notasPedidosMesActual;

        // Sumar pagos del mes anterior
        $pagosMesAnterior = DB::table('pagos')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesAnterior)
            ->first()->total;

        $pagosLaserMesAnterior = DB::table('pagos_laser')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesAnterior)
            ->first()->total;

        $paquetesPagoMesAnterior = DB::table('paquetes_pago')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesAnterior)
            ->first()->total;

        $notasPedidosMesAnterior = DB::table('notas_pedidos')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->whereMonth('fecha', $mesAnterior)
            ->first()->total;

        $totalPagosMesAnterior = $pagosMesAnterior + $pagosLaserMesAnterior + $paquetesPagoMesAnterior + $notasPedidosMesAnterior;

        // Sumar pagos de hace dos meses
        $pagosDosMesesAtras = DB::table('pagos')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $dosMesesAtras)
            ->first()->total;

        $pagosLaserDosMesesAtras = DB::table('pagos_laser')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $dosMesesAtras)
            ->first()->total;

        $paquetesPagoDosMesesAtras = DB::table('paquetes_pago')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $dosMesesAtras)
            ->first()->total;

        $notasPedidosDosMesesAtras = DB::table('notas_pedidos')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->whereMonth('fecha', $dosMesesAtras)
            ->first()->total;

        $totalPagosDosMesesAtras = $pagosDosMesesAtras + $pagosLaserDosMesesAtras + $paquetesPagoDosMesesAtras + $notasPedidosDosMesesAtras;

        $chartDataPagos = [
            "type" => 'pie',
            "data" => [
                "labels" => ['Mes Actual', 'Mes Anterior', 'Hace Dos Meses'],
                "datasets" => [
                    [
                        "label" => "Total Pagos",
                        "data" => [$totalPagosMesActual, $totalPagosMesAnterior, $totalPagosDosMesesAtras],
                        "backgroundColor" => ['#a4133c', '#c9184a', '#ff4d6d']
                    ],
                ],
            ],
            "options" => [
                "plugins" => [
                    "datalabels" => [
                        "color" => 'white', // Cambia el color del texto a blanco
                    ],
                ],
                "legend" => [
                    "display" => false // Esto oculta la leyenda de colores
                ],
            ],
        ];

        $chartDataPagos = json_encode($chartDataPagos);

        $chartURLPagos = "https://quickchart.io/chart?width=220&height=220&c=".urlencode($chartDataPagos);

        $chartDataPagos = file_get_contents($chartURLPagos);
        $chartPagos = 'data:image/png;base64, '.base64_encode($chartDataPagos);
    // F I N  T O T A L  I N G R E S O S

    // I N I C I O  M E T O D O S  D E  P A G O S  I N G R E S O S
        $pagosTarjetaMesActual = DB::table('pagos')
        ->select(DB::raw('SUM(pago) as total'))
        ->whereMonth('fecha', $mesActual)
        ->where('forma_pago', 'Tarjeta')
        ->first()->total;

        $pagosLaserTarjetaMesActual = DB::table('pagos_laser')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('forma_pago', 'Tarjeta')
            ->first()->total;

        $paquetesPagoTarjetaMesActual = DB::table('paquetes_pago')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('forma_pago', 'Tarjeta')
            ->first()->total;

        $notasPedidosTarjetaMesActual = DB::table('notas_pedidos')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('metodo_pago', 'Tarjeta')
            ->first()->total;

        $totalPagosTarjetaMesActual = $pagosTarjetaMesActual + $pagosLaserTarjetaMesActual + $paquetesPagoTarjetaMesActual + $notasPedidosTarjetaMesActual;

        $pagosEfectivoMesActual = DB::table('pagos')
        ->select(DB::raw('SUM(pago) as total'))
        ->whereMonth('fecha', $mesActual)
        ->where('forma_pago', 'Efectivo')
        ->first()->total;

        $pagosLaserEfectivoMesActual = DB::table('pagos_laser')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('forma_pago', 'Efectivo')
            ->first()->total;

        $paquetesPagoEfectivoMesActual = DB::table('paquetes_pago')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('forma_pago', 'Efectivo')
            ->first()->total;

        $notasPedidosEfectivoMesActual = DB::table('notas_pedidos')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('metodo_pago', 'Efectivo')
            ->first()->total;

        $totalPagosEfectivoMesActual = $pagosEfectivoMesActual + $pagosLaserEfectivoMesActual + $paquetesPagoEfectivoMesActual + $notasPedidosEfectivoMesActual;

        $pagosTransferenciaMesActual = DB::table('pagos')
        ->select(DB::raw('SUM(pago) as total'))
        ->whereMonth('fecha', $mesActual)
        ->where('forma_pago', 'Transferencia')
        ->first()->total;

        $pagosLaserTransferenciaMesActual = DB::table('pagos_laser')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('forma_pago', 'Transferencia')
            ->first()->total;

        $paquetesPagoTransferenciaMesActual = DB::table('paquetes_pago')
            ->select(DB::raw('SUM(pago) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('forma_pago', 'Transferencia')
            ->first()->total;

        $notasPedidosTransferenciaMesActual = DB::table('notas_pedidos')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->whereMonth('fecha', $mesActual)
            ->where('metodo_pago', 'Transferencia')
            ->first()->total;

        $totalPagosTransferenciaMesActual = $pagosTransferenciaMesActual + $pagosLaserTransferenciaMesActual + $paquetesPagoTransferenciaMesActual + $notasPedidosTransferenciaMesActual;
    // F I N  M E T O D O S  D E  P A G O S  I N G R E S O S

    // I N I C I O  D E  O C U P A C I O N
    $now = Carbon::now();
    $mesActual2 = $now->copy()->format('Y-m');
    $mesAnterior2 = $now->copy()->subMonth()->format('Y-m');
    $dosMesesAtras2 = $now->copy()->subMonths(2)->format('Y-m');

        $citas = DB::table('alertas')
        ->selectRaw("DATE_FORMAT(start, '%Y-%m') as mes, COUNT(*) as citas_agendadas")
        ->whereIn(DB::raw("DATE_FORMAT(start, '%Y-%m')"), [$mesActual2, $mesAnterior2, $dosMesesAtras2])
        ->groupBy('mes')
        ->pluck('citas_agendadas', 'mes');

        // Obtener la cantidad de cosmetólogos por día
        $horarios = DB::table('horario')
            ->selectRaw("
                SUM(lunes) as lunes,
                SUM(martes) as martes,
                SUM(miercoles) as miercoles,
                SUM(jueves) as jueves,
                SUM(viernes) as viernes,
                SUM(sabado) as sabado,
                SUM(domingo) as domingo
            ")
            ->first();

        // Horario de trabajo: 10 AM - 7 PM (9 horas por día)
        $horasPorDia = 9;

        // Espacios disponibles por mes
        $espaciosPorMes = [
            $mesActual2 => 0,
            $mesAnterior2 => 0,
            $dosMesesAtras2 => 0,
        ];

        // Recorremos cada día del mes y sumamos los espacios disponibles
        foreach ([$mesActual2, $mesAnterior2, $dosMesesAtras2] as $mes) {
            $primerDia = Carbon::createFromFormat('Y-m', $mes)->startOfMonth();
            $ultimoDia = Carbon::createFromFormat('Y-m', $mes)->endOfMonth();

            for ($date = $primerDia; $date->lte($ultimoDia); $date->addDay()) {
                $diaSemana = strtolower($date->format('l')); // Obtiene el día en inglés (monday, tuesday, etc.)
                $cosmesDisponibles = $horarios->$diaSemana ?? 0; // Cuántos trabajan ese día
                $espaciosPorMes[$mes] += ($cosmesDisponibles * $horasPorDia);
            }
        }
    // F I N  D E  O C U P A C I O N
        $pdf = \PDF::loadView('reportes.pdf_mensual', compact('today', 'chart', 'chartCitasRealizadas', 'chartCitasCanceladas', 'chartclientesNuevos', 'chartclientesRecurrentes',
         'chartServiciosMasSolicitados', 'chartServiciosMasSolicitadosRecurrentes',
         'serviciosFacialesMesAnterior', 'serviciosFacialesDosMesesAtras', 'serviciosFacialesMesActual',
         'serviciosCorporalesMesActual', 'serviciosCorporalesMesAnterior', 'serviciosCorporalesDosMesesAtras',
         'serviciosexperienciasMesActual', 'serviciosexperienciasMesAnterior', 'serviciosexperienciasDosMesesAtras',
         'serviciosPaquetesMesActual', 'serviciosPaquetesMesAnterior', 'serviciosPaquetesDosMesesAtras',
         'serviciosLaserMesActual', 'serviciosLaserMesAnterior', 'serviciosLaserDosMesesAtras',
         'ticketPromedioMesActual', 'ticketPromedioMesAnterior', 'ticketPromedioHaceDosMeses',
         'serviciosPorCosmetologaMesActual', 'serviciosPorCosmetologaMesAnterior', 'serviciosPorCosmetologaDosMesesAtras',
         'ingresosPorCosmetologaMesActual', 'MesAnterioringresosPorCosmetologaMesActual', 'HaceDosMesesingresosPorCosmetologaMesActual',
         'cosmetologasConMasCancelacionesMesActual', 'cosmetologasConMasCancelacionesMesAnterior', 'cosmetologasConMasCancelacionesDosMesesAtras',
         'chartPagos', 'totalPagosMesActual', 'totalPagosMesAnterior', 'totalPagosDosMesesAtras',
         'totalPagosTarjetaMesActual', 'totalPagosEfectivoMesActual', 'totalPagosTransferenciaMesActual',
         'citas', 'espaciosPorMes'))->setPaper([0, 0, 700, 600], 'landscape');
         return $pdf->stream();
    }
}
