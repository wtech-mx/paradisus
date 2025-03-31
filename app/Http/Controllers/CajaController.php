<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\CajaDia;
use App\Models\Notas;
use App\Models\NotasPaquetes;
use App\Models\NotasPedidos;
use App\Models\NotasPropinas;
use App\Models\Pagos;
use App\Models\Paquetes;
use App\Models\PaquetesPago;
use App\Models\Pedido;
use Session;
use DB;
Use Alert;
use App\Models\NotasCosmes;
use App\Models\RegistroSemanal;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Bitacora;
use App\Models\NotasLacer;
use App\Models\PagosLaser;

class CajaController extends Controller
{
    public function index()
    {
        $fechaActual = date('Y-m-d');
        $diaActual = date('d');

        $caja = Caja::where('fecha', '=', $fechaActual)
        ->first();

        $caja_vista = Caja::where('fecha', '=', $fechaActual)
        ->first();

        if($caja == null){
            $caja=0;
        }else{
            $caja=$caja->ingresos;
        }

        $propinas = NotasPropinas::where('fecha', '=', $fechaActual)->where('metdodo_pago', '=', 'Efectivo')->get();

        $propinas_suma = NotasPropinas::where('fecha', '=', $fechaActual)
        ->where('metdodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(propina) as total'))
        ->first();

        $pago = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->get();

        $pago_suma = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.dinero_recibido) as total'))
        ->first();

        $pago_pedidos = NotasPedidos::where('fecha', $fechaActual)
        ->where(function ($query) {
            $query->where('metodo_pago', 'Efectivo')
                ->orWhere('metodo_pago2', 'Efectivo');
        })
        ->where('estatus', '!=', 'Cancelada')
        ->get();

        $pago_pedidos_suma = NotasPedidos::where('fecha', $fechaActual)
        ->where(function ($query) {
            $query->where('metodo_pago', 'Efectivo')
                ->orWhere('metodo_pago2', 'Efectivo');
        })
        ->where('estatus', '!=', 'Cancelada')
        ->select(DB::raw('SUM(
            CASE
                WHEN metodo_pago = "Efectivo" THEN COALESCE(dinero_recibido, 0)
                ELSE 0
            END +
            CASE
                WHEN metodo_pago2 = "Efectivo" THEN COALESCE(dinero_recibido2, 0)
                ELSE 0
            END
        ) AS total'))
        ->first();

        $pago_laser = PagosLaser::where('fecha', $fechaActual)->where('forma_pago', 'Efectivo')->get();
        $pago_laser_suma = PagosLaser::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(dinero_recibido) as total'))
        ->first();

        $pago_paquete = PaquetesPago::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Efectivo')->get();
        $pago_paquete_suma = PaquetesPago::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(dinero_recibido) as total'))
        ->first();

        $caja_dia = CajaDia::where('fecha', '=', $fechaActual)->get();
        $caja_dia_suma = CajaDia::where('fecha', '=', $fechaActual)->where('motivo', '=', 'Retiro')->select(DB::raw('SUM(egresos) as total'))->first();

        $caja_dia_suma_Ingreso = CajaDia::where('fecha', '=', $fechaActual)
        ->where('motivo', '=', 'Ingreso')
        ->select(DB::raw('SUM(egresos) as total'))->first();

        $notas_paquetes = NotasPaquetes::get();

        return view('caja.index', compact('propinas','propinas_suma','pago_laser','pago_laser_suma','caja_dia_suma_Ingreso','caja_vista','caja', 'pago', 'pago_suma', 'caja_dia', 'caja_dia_suma','pago_pedidos', 'pago_pedidos_suma', 'diaActual', 'notas_paquetes', 'caja', 'pago_paquete', 'pago_paquete_suma'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function update_caja(Request $request, $id){

         $caja = CajaDia::find($id);
         $caja->egresos = $request->get('egresos');
         $caja->motivo = $request->get('motivo');
         $caja->concepto = $request->get('concepto');

         if ($request->hasFile("foto")) {
             $file = $request->file('foto');
             $path = public_path() . '/foto_retiros';
             $fileName = uniqid() . $file->getClientOriginalName();
             $file->move($path, $fileName);
             $caja->foto = $fileName;
         }
         $caja->update();

         Session::flash('success', 'Se ha guardado sus datos con exito');
         return redirect()->route('caja.index')
             ->with('success', 'caja created successfully.');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'egresos' => 'required',
            'concepto' => 'required',
            'motivo' => 'required'
        ]);

        $fechaActual = date('Y-m-d');

            $caja = new CajaDia;
            $caja->egresos = $request->get('egresos');
            $caja->concepto = $request->get('concepto');
            $caja->motivo = $request->get('motivo');
            $caja->fecha = $fechaActual;

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_retiros';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $caja->foto = $fileName;
            }

            $caja->save();


        $recibo = [
            "id" => $caja->id,
            "Monto" => $caja->egresos,
            "Fecha" => $caja->fecha,
            "Concepto" => $caja->concepto,
            "Motivo" => $caja->motivo,
            "nombreImpresora" => "ZJ-58",
        ];


        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);

    }

    public function imprimir_recibo($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $caja = CajaDia::where('id', '=', $id)->first();

        $pdf = \PDF::loadView('caja.pdf_retiro', compact('caja', 'today'));
        // return $pdf->stream();
        return $pdf->download('Retiro '.$today.'.pdf');
    }

    public function caja_inicial(Request $request){
        $fechaActual = date('Y-m-d');
        $caja = new Caja;
        $caja->ingresos = $request->get('ingresos');
        $caja->fecha = $fechaActual;
        $caja->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'caja created successfully.');
    }

    public function corte(){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $caja_final = Caja::where('fecha', '=', $diaActual)
        ->first();
        if($caja_final == null){
            $caja_final2=0;
        }else{
            $caja_final2=$caja_final->ingresos;
        }

        $pago_suma = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $diaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.dinero_recibido) as total'))
        ->first();

        $pago_pedidos_suma = NotasPedidos::where('fecha', $diaActual)
        ->where(function ($query) {
            $query->where('metodo_pago', 'Efectivo')
                ->orWhere('metodo_pago2', 'Efectivo');
        })
        ->where('estatus', '!=', 'Cancelada')
        ->select(DB::raw('SUM(
            CASE
                WHEN metodo_pago = "Efectivo" THEN COALESCE(dinero_recibido, 0)
                ELSE 0
            END +
            CASE
                WHEN metodo_pago2 = "Efectivo" THEN COALESCE(dinero_recibido2, 0)
                ELSE 0
            END
        ) AS total'))
        ->first();

        $pago_paquete_suma = PaquetesPago::where('fecha', '=', $diaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(dinero_recibido) as total'))
        ->first();

        $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
        ->where('motivo', '=', 'Ingreso')
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $pago_laser_suma = PagosLaser::where('fecha', '=', $diaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(dinero_recibido) as total'))
        ->first();

        $caja_dia_resta = CajaDia::where('fecha', '=', $diaActual)
        ->where('motivo', '=', 'Retiro')
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $propinas_suma = NotasPropinas::where('fecha', '=', $diaActual)
        ->where('metdodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(propina) as total'))
        ->first();

        $total_ing = 0;
        $total_ing = $caja_dia_suma->total + $propinas_suma->total + $pago_suma->total +  $pago_pedidos_suma->total + $pago_paquete_suma->total + $pago_laser_suma->total + $caja_final->ingresos;

        $total_egresos = 0;
        $total_egresos = $total_ing - $caja_dia_resta->total;

        if($caja_dia_resta->total == NULL){
            $caja_egre = 0;
        }else{
            $caja_egre = $caja_dia_resta->total;
        }

        $nota = Caja::find($caja_final->id);
        $nota->ingresos = $total_ing;
        $nota->egresos = $caja_egre;
        $nota->total = $total_egresos;
        $nota->update();

        Alert::success('El corte de caja se ha realizado');

        return redirect()->route('caja.index')
            ->with('success', 'Corte con exito.');
    }

    public function imprimir_caja(){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $bitacora = Bitacora::where('fecha','=',$diaActual)->get();

        //====================================== LLAMADO DE LA CAJA ======================================
        $caja = CajaDia::where(DB::raw('fecha'), '=', $diaActual)->get();

        $caja_dia_suma_vista = CajaDia::where('fecha', '=', $diaActual)
        ->where('concepto', 'LIKE', '%Cambio%')
        ->where('motivo', '=', 'Ingreso')
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $caja_rep = Caja::where('fecha', '=', $diaActual)
        ->first();

        //====================================== LLAMADO DE LOS REGISTROS ======================================

        $servicios = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where(DB::raw('pagos.fecha'), '=', $diaActual)
        ->where('notas.anular', '=', NULL)
        ->get();

        $productos_rep = NotasPedidos::where('fecha', $diaActual)
        ->where('estatus', '!=', 'Cancelada')
        ->with('Pedido')
        ->get();

        $paquetes = PaquetesPago::where(DB::raw('fecha'), '=', $diaActual)
        ->get();

        $notas_laser = PagosLaser::where(DB::raw('fecha'), '=', $diaActual)
        ->get();

        $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
        ->where('motivo', '=', 'Ingreso')
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $notas_paquetes = NotasPaquetes::get();

        $propinasHoy = NotasPropinas::whereDate('created_at', $diaActual)->get();

        //====================================== TOTALES PARA TRANSFERENCIA ======================================
            $servicios_trans = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Transferencia')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $laser_trans = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Transferencia')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $productos_trans = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Transferencia')
                    ->orWhere('metodo_pago2', 'Transferencia');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Transferencia" THEN COALESCE(dinero_recibido, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Transferencia" THEN COALESCE(dinero_recibido2, 0)
                    ELSE 0
                END
            ) AS total'), DB::raw('count(*) as filas'))
            ->first();

            $paquete_trans = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Transferencia')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $propinasTrans = NotasPropinas::whereDate('fecha', $diaActual)
            ->where('metdodo_pago', '=', 'Transferencia')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $suma_pago_trans = $servicios_trans->total + $productos_trans->total + $paquete_trans->total + $laser_trans->total + $propinasTrans->total;
            $suma_filas_trans = $servicios_trans->filas + $productos_trans->filas + $paquete_trans->filas + $laser_trans->filas;

            $total_servicios_trans = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)->where('pagos.forma_pago', '=', 'Transferencia')->where('notas.anular', '=', NULL)->get();

            $total_producto_trans = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Transferencia')
                    ->orWhere('metodo_pago2', 'Transferencia');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $total_laser_trans = PagosLaser::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Transferencia')->get();
            $total_paquetes_trans = PaquetesPago::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Transferencia')->get();
        //====================================== END TOTALES PARA TRANSFERENCIA ======================================

        //====================================== TOTALES PARA MERCADO PAGO ======================================
            $servicios_mercado = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Efectivo')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $productos_mercado = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Efectivo')
                    ->orWhere('metodo_pago2', 'Efectivo');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Efectivo" THEN COALESCE(dinero_recibido, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Efectivo" THEN COALESCE(dinero_recibido2, 0)
                    ELSE 0
                END
            ) AS total'), DB::raw('count(*) as filas'))
            ->first();

            $paquete_mercado = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $laser_mercado = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $propinasEfect = NotasPropinas::whereDate('fecha', $diaActual)
            ->where('metdodo_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $suma_pago_mercado = $servicios_mercado->total + $productos_mercado->total + $paquete_mercado->total + $laser_mercado->total;

            $suma_filas_mercado = $servicios_mercado->filas + $productos_mercado->filas + $paquete_mercado->filas + $laser_mercado->filas;

            $total_ing = 0;
            $total_ing = $caja_dia_suma->total + $caja_rep->inicio + $servicios_mercado->total +  $productos_mercado->total + $paquete_mercado->total + $laser_mercado->total + $propinasEfect->total;

            $total_servicios_mercado = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)->where('pagos.forma_pago', '=', 'Efectivo')->where('notas.anular', '=', NULL)->get();

            $sumaServiciosEfectivoCambio = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Efectivo')
            ->where('notas.anular', '=', NULL)
            ->sum('pago');
            // Reemplaza 'nombre_del_campo_que_quieres_sumar' con el nombre real del campo que deseas sumar.

            $total_producto_mercado = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Efectivo')
                    ->orWhere('metodo_pago2', 'Efectivo');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $total_paquetes_mercado = PaquetesPago::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Mercado Pago')->get();
            $total_laser_mercado = PagosLaser::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Mercado Pago')->get();

        //====================================== END TOTALES PARA MERCADO PAGO ======================================

        //====================================== TOTALES PARA TARJETA ======================================
            $servicios_tarjeta = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Tarjeta')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $productos_tarjeta = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Tarjeta')
                    ->orWhere('metodo_pago2', 'Tarjeta');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Tarjeta" THEN COALESCE(dinero_recibido, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Tarjeta" THEN COALESCE(dinero_recibido2, 0)
                    ELSE 0
                END
            ) AS total'), DB::raw('count(*) as filas'))
            ->first();

            $paquete_tarjeta = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Tarjeta')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $laser_tarjeta = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Tarjeta')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $propinasTarjeta = NotasPropinas::whereDate('created_at', $diaActual)
            ->where('metdodo_pago', '=', 'Tarjeta')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $suma_pago_tarjeta = $servicios_tarjeta->total + $productos_tarjeta->total + $paquete_tarjeta->total + $laser_tarjeta->total + $propinasTarjeta->total;
            $suma_filas_tarjeta = $servicios_tarjeta->filas + $productos_tarjeta->filas + $paquete_tarjeta->filas + $laser_tarjeta->filas;

            $total_servicios_tarjeta = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)->where('pagos.forma_pago', '=', 'Tarjeta')->where('notas.anular', '=', NULL)->get();

            $total_producto_tarjeta = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Tarjeta')
                    ->orWhere('metodo_pago2', 'Tarjeta');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $total_paquetes_tarjeta = PaquetesPago::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Tarjeta')->get();
            $total_laser_tarjeta = PagosLaser::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Tarjeta')->get();

        //====================================== END TOTALES PARA TARJETA ======================================

        //====================================== GRAFICAS ======================================

            $chartData = [
                "type" => 'bar',
                "data" => [
                    "labels" => ['Ingresos', 'Egresos', 'Total'],
                    "datasets" => [
                        [
                        "label" => "",
                        "data" => [$caja_rep->ingresos, $caja_rep->egresos, $caja_rep->total],
                        "backgroundColor" => ['#27ae60', '#f1c40f', '#e74c3c']
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

            $chartDatamp = [
                "type" => 'bar',
                "data" => [
                    "labels" => ['Transferencia', 'Efectivo', 'Tarjeta'],
                    "datasets" => [
                        [
                            "label" => "",
                            "data" => [$suma_pago_trans, $suma_pago_mercado, $suma_pago_tarjeta],
                            "backgroundColor" => ['#2E86C1', '#28B463', '#D4AC0D']
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




            $chartDatamp = json_encode($chartDatamp);

            $chartURLmp = "https://quickchart.io/chart?width=180&height=180&c=".urlencode($chartDatamp);

            $chartDatamp = file_get_contents($chartURLmp);
            $chartmp = 'data:image/png;base64, '.base64_encode($chartDatamp);
        //====================================== END GRAFICAS ======================================

        $caja_dia_suma_cambios = CajaDia::where('fecha', '=', $diaActual)
        ->where('concepto', 'LIKE', '%Cambio nota%')
        ->where('motivo', '=', 'Retiro')
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $propinas_efectivo = NotasPropinas::where('fecha', '=', $diaActual)->where('metdodo_pago', '=', 'Efectivo')->get();
        $propinas_tarjeta = NotasPropinas::where('fecha', '=', $diaActual)->where('metdodo_pago', '=', 'Tarjeta')->get();
        $propinas_transferencia = NotasPropinas::where('fecha', '=', $diaActual)->where('metdodo_pago', '=', 'Transferencia')->get();

        $propinas_suma = NotasPropinas::where('fecha', '=', $diaActual)
        ->where('metdodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(propina) as total'))
        ->first();

        $pdf = \PDF::loadView('caja.pdf_nuevo',['chart' => $chart,'chartmp' => $chartmp], compact('propinas_efectivo', 'propinas_tarjeta', 'propinas_transferencia', 'propinas_suma','caja_dia_suma_cambios','sumaServiciosEfectivoCambio','suma_pago_tarjeta', 'suma_filas_tarjeta','suma_pago_mercado', 'suma_filas_mercado','suma_pago_trans',
        'suma_filas_trans','propinasHoy','caja_rep','paquetes','today', 'caja', 'servicios', 'productos_rep', 'caja_dia_suma', 'notas_paquetes', 'total_ing',
        'total_servicios_trans', 'total_servicios_mercado', 'total_servicios_tarjeta', 'total_producto_trans', 'total_producto_mercado', 'total_producto_tarjeta',
        'total_paquetes_trans', 'total_paquetes_mercado', 'total_paquetes_tarjeta','bitacora', 'notas_laser', 'total_laser_trans', 'total_laser_mercado', 'total_laser_tarjeta', 'caja_dia_suma_vista'));
       //  return $pdf->stream();
         return $pdf->download('Reporte Caja '.$today.'.pdf');
    }

    public function imprimir_precorte(){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $bitacora = Bitacora::where('fecha','=',$diaActual)->get();

        Carbon::setLocale('es');
        $fechaYHoraActual = Carbon::now();
        $fechaYHoraFormateada = $fechaYHoraActual;

        //====================================== LLAMADO DE LA CAJA ======================================
            $caja = CajaDia::where(DB::raw('fecha'), '=', $diaActual)->get();
            $caja_final = Caja::where('fecha', '=', $diaActual)
            ->first();
            if($caja_final == null){
                $caja_final2=0;
            }else{
                $caja_final2=$caja_final->ingresos;
            }

            $pago_suma = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Efectivo')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.dinero_recibido) as total'))
            ->first();

            $pago_pedidos_suma = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Efectivo')
                    ->orWhere('metodo_pago2', 'Efectivo');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Efectivo" THEN COALESCE(dinero_recibido, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Efectivo" THEN COALESCE(dinero_recibido2, 0)
                    ELSE 0
                END
            ) AS total'))
            ->first();

            $propinas_suma = NotasPropinas::where('fecha', '=', $diaActual)
            ->where('metdodo_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $pago_paquete_suma = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->first();

            $pago_laser_suma = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(dinero_recibido) as total'))
            ->first();

            $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
            ->where('motivo', '=', 'Ingreso')
            ->select(DB::raw('SUM(egresos) as total'))
            ->first();

            $caja_dia_suma_vista = CajaDia::where('fecha', '=', $diaActual)
            ->where('concepto', 'LIKE', '%Cambio%')
            ->where('motivo', '=', 'Ingreso')
            ->select(DB::raw('SUM(egresos) as total'))
            ->first();

            $caja_dia_resta = CajaDia::where('fecha', '=', $diaActual)
            ->where('motivo', '=', 'Retiro')
            ->select(DB::raw('SUM(egresos) as total'))
            ->first();

            $caja_dia_suma_cambios = CajaDia::where('fecha', '=', $diaActual)
            ->where('concepto', 'LIKE', '%Cambio nota%')
            ->where('motivo', '=', 'Retiro')
            ->select(DB::raw('SUM(egresos) as total'))
            ->first();

            $total_ing = 0;
            $total_ing = $caja_dia_suma->total + $caja_final->inicio + $pago_suma->total +  $pago_pedidos_suma->total + $pago_paquete_suma->total + $pago_laser_suma->total + $propinas_suma->total;

            $total_ing_vista = 0;
            $total_ing_vista =  $pago_suma->total +  $pago_pedidos_suma->total + $pago_paquete_suma->total + $pago_laser_suma->total;

            $total_egresos = 0;
            $total_egresos = $total_ing - $caja_dia_resta->total;

            if($caja_dia_resta->total == NULL){
                $caja_egre = 0;
            }else{
                $caja_egre = $caja_dia_resta->total;
            }
        //====================================== END LLAMADO DE LA CAJA ======================================

        //====================================== LLAMADO DE LOS REGISTROS ======================================
            $servicios = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where(DB::raw('pagos.fecha'), '=', $diaActual)
            ->where('notas.anular', '=', NULL)
            ->get();

            $productos_rep = NotasPedidos::where('fecha', $diaActual)
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $paquetes = PaquetesPago::where(DB::raw('fecha'), '=', $diaActual)
            ->get();

            $pago_laser = PagosLaser::where('fecha', $diaActual)->get();
            $notas_laser = NotasLacer::where('fecha', $diaActual)->get();

            $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
            ->select(DB::raw('SUM(egresos) as total'))
            ->first();

            $notas_paquetes = NotasPaquetes::get();

            $propinasHoy = NotasPropinas::whereDate('created_at', $diaActual)->get();
        //====================================== END LLAMADO DE LOS REGISTROS ======================================

        //====================================== TOTALES PARA TRANSFERENCIA ======================================
            $servicios_trans = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Transferencia')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $laser_trans = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Transferencia')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $productos_trans = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Transferencia')
                    ->orWhere('metodo_pago2', 'Transferencia');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Transferencia" THEN COALESCE(dinero_recibido, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Transferencia" THEN COALESCE(dinero_recibido2, 0)
                    ELSE 0
                END
            ) AS total'), DB::raw('count(*) as filas'))
            ->first();

            $paquete_trans = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Transferencia')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $propinasTrans = NotasPropinas::whereDate('fecha', $diaActual)
            ->where('metdodo_pago', '=', 'Transferencia')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $suma_pago_trans = $servicios_trans->total + $productos_trans->total + $paquete_trans->total + $laser_trans->total + $propinasTrans->total;
            $suma_filas_trans = $servicios_trans->filas + $productos_trans->filas + $paquete_trans->filas + $laser_trans->filas;

            $total_servicios_trans = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)->where('pagos.forma_pago', '=', 'Transferencia')->where('notas.anular', '=', NULL)->get();

            $total_laser_trans = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Transferencia')->get();

            $total_producto_trans = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Transferencia')
                    ->orWhere('metodo_pago2', 'Transferencia');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $total_paquetes_trans = PaquetesPago::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Transferencia')->get();
        //====================================== END TOTALES PARA TRANSFERENCIA ======================================

        //====================================== TOTALES PARA EFECTIVO ======================================
            $servicios_mercado = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Efectivo')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.pago) as total'), DB::raw('count(*) as filas'))
            ->first();

            $laser_mercado = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $productos_mercado = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Efectivo')
                    ->orWhere('metodo_pago2', 'Efectivo');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Efectivo" THEN COALESCE(total, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Efectivo" THEN COALESCE(total, 0)
                    ELSE 0
                END
            ) AS total'), DB::raw('count(*) as filas'))
            ->first();

            $paquete_mercado = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $propinasEfect = NotasPropinas::whereDate('created_at', $diaActual)
            ->where('metdodo_pago', '=', 'Efectivo')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $suma_pago_mercado = $servicios_mercado->total + $productos_mercado->total + $paquete_mercado->total + $laser_mercado->total;

            $suma_filas_mercado = $servicios_mercado->filas + $productos_mercado->filas + $paquete_mercado->filas + $laser_mercado->filas;

            $total_servicios_mercado = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)->where('pagos.forma_pago', '=', 'Efectivo')->where('notas.anular', '=', NULL)->get();

            $sumaServiciosEfectivoCambio = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Efectivo')
            ->where('notas.anular', '=', NULL)
            ->sum('pago');
            // Reemplaza 'nombre_del_campo_que_quieres_sumar' con el nombre real del campo que deseas sumar.

            $total_producto_mercado = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Efectivo')
                    ->orWhere('metodo_pago2', 'Efectivo');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $total_laser_mercado = PagosLaser::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Efectivo')->get();

            $total_paquetes_mercado = PaquetesPago::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Efectivo')->get();

        //====================================== END TOTALES PARA MERCADO PAGO ======================================

        //====================================== TOTALES PARA TARJETA ======================================
            $servicios_tarjeta = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)
            ->where('pagos.forma_pago', '=', 'Tarjeta')
            ->where('notas.anular', '=', NULL)
            ->select(DB::raw('SUM(pagos.dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $laser_tarjeta = PagosLaser::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Tarjeta')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $productos_tarjeta = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Tarjeta')
                    ->orWhere('metodo_pago2', 'Tarjeta');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->select(DB::raw('SUM(
                CASE
                    WHEN metodo_pago = "Tarjeta" THEN COALESCE(dinero_recibido, 0)
                    ELSE 0
                END +
                CASE
                    WHEN metodo_pago2 = "Tarjeta" THEN COALESCE(dinero_recibido2, 0)
                    ELSE 0
                END
            ) AS total'), DB::raw('count(*) as filas'))
            ->first();

            $paquete_tarjeta = PaquetesPago::where('fecha', '=', $diaActual)
            ->where('forma_pago', '=', 'Tarjeta')
            ->select(DB::raw('SUM(dinero_recibido) as total'), DB::raw('count(*) as filas'))
            ->first();

            $propinasTarjeta = NotasPropinas::whereDate('fecha', $diaActual)
            ->where('metdodo_pago', '=', 'Tarjeta')
            ->select(DB::raw('SUM(propina) as total'))
            ->first();

            $suma_pago_tarjeta = $servicios_tarjeta->total + $productos_tarjeta->total + $paquete_tarjeta->total + $laser_tarjeta->total + $propinasTarjeta->total;
            $suma_filas_tarjeta = $servicios_tarjeta->filas + $productos_tarjeta->filas + $paquete_tarjeta->filas + $laser_tarjeta->filas;

            $total_servicios_tarjeta = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
            ->where('pagos.fecha', '=', $diaActual)->where('pagos.forma_pago', '=', 'Tarjeta')->where('notas.anular', '=', NULL)->get();

            $total_producto_tarjeta = NotasPedidos::where('fecha', $diaActual)
            ->where(function ($query) {
                $query->where('metodo_pago', 'Tarjeta')
                    ->orWhere('metodo_pago2', 'Tarjeta');
            })
            ->where('estatus', '!=', 'Cancelada')
            ->with('Pedido')
            ->get();

            $total_laser_tarjeta = PagosLaser::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Tarjeta')->get();
            $total_paquetes_tarjeta = PaquetesPago::where('fecha', '=', $diaActual)->where('forma_pago', '=', 'Tarjeta')->get();
        //====================================== END TOTALES PARA TARJETA ======================================

        $propinas_efectivo = NotasPropinas::where('fecha', '=', $diaActual)->where('metdodo_pago', '=', 'Efectivo')->get();
        $propinas_tarjeta = NotasPropinas::where('fecha', '=', $diaActual)->where('metdodo_pago', '=', 'Tarjeta')->get();
        $propinas_transferencia = NotasPropinas::where('fecha', '=', $diaActual)->where('metdodo_pago', '=', 'Transferencia')->get();

        $pdf = \PDF::loadView('caja.precorte', compact('propinas_efectivo','propinas_tarjeta','propinas_transferencia', 'propinas_suma','total_ing_vista','notas_laser','total_laser_trans','total_laser_mercado','total_laser_tarjeta','pago_laser','caja_dia_suma_cambios','sumaServiciosEfectivoCambio','suma_pago_tarjeta', 'suma_filas_tarjeta',
        'suma_pago_mercado', 'suma_filas_mercado','suma_pago_trans', 'caja_final','suma_filas_trans','propinasHoy','total_ing','caja_egre','total_egresos','paquetes',
        'fechaYHoraFormateada', 'caja', 'servicios', 'productos_rep', 'caja_dia_suma', 'notas_paquetes','total_servicios_trans', 'total_servicios_mercado', 'total_servicios_tarjeta',
        'total_producto_trans', 'total_producto_mercado', 'total_producto_tarjeta','total_paquetes_trans', 'total_paquetes_mercado', 'total_paquetes_tarjeta','bitacora', 'caja_dia_suma_vista', 'caja_dia_resta'));
        //  return $pdf->stream();
       return $pdf->download('Precorte '.$fechaYHoraFormateada.'.pdf');
    }
}
