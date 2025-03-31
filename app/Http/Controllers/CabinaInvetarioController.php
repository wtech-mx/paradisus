<?php

namespace App\Http\Controllers;

use App\Models\CabinaInvetario;
use App\Models\Productos;
use App\Models\ProductosBodega;
use App\Models\ProductosBodegaInv;
use App\Models\ProductosInventario;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class CabinaInvetarioController extends Controller
{
    public function index1()
    {
        if(request()->is('inventario/cabina1')){
            $cabinas = CabinaInvetario::where('num_cabina','=', '1')->get();
        }elseif(request()->is('inventario/cabina2')){
            $cabinas = CabinaInvetario::where('num_cabina','=', '2')->get();
        }elseif(request()->is('inventario/cabina3')){
            $cabinas = CabinaInvetario::where('num_cabina','=', '3')->get();
        }elseif(request()->is('inventario/cabina4')){
            $cabinas = CabinaInvetario::where('num_cabina','=', '4')->get();
        }elseif(request()->is('inventario/cabina5')){
            $cabinas = CabinaInvetario::where('num_cabina','=', '5')->get();
        }


        $productos_cabinas = Productos::where('cabinas','=', 1)->get();

        return view('cabina_inventario.cabina1',compact('cabinas','productos_cabinas'));
    }

    public function index2()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '2')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->get();

        return view('cabina_inventario.cabina2',compact('cabinas','productos_cabinas'));
    }

    public function index3()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '3')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->get();

        return view('cabina_inventario.cabina3',compact('cabinas','productos_cabinas'));
    }

    public function index4()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '4')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->get();

        return view('cabina_inventario.cabina4',compact('cabinas','productos_cabinas'));
    }

    public function index5()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '5')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->get();

        return view('cabina_inventario.cabina5',compact('cabinas','productos_cabinas'));
    }

    public function create(){

        $productos_cabinas = Productos::where('cabina1','=', 1)->get();

        return view('cabina_inventario.modal_cabina', compact('productos_cabinas'));
    }

    public function create3(){

        $productos_cabinas = Productos::where('cabina3','=', 1)->get();

        return view('cabina_inventario.create_3', compact('productos_cabinas'));
    }

    public function create4(){

        $productos_cabinas = Productos::where('cabina4','=', 1)->get();

        return view('cabina_inventario.create_4', compact('productos_cabinas'));
    }

    public function create5(){

        $productos_cabinas = Productos::where('cabina5','=', 1)->get();

        return view('cabina_inventario.create_5', compact('productos_cabinas'));
    }

    public function store(Request $request){
        $today =  date('Y-m-d H:i:s');
        $cabina = new CabinaInvetario;
        $cabina->fecha = $request->get('fecha1');
        $cabina->num_semana = $request->get('num_semana');
        $cabina->num_cabina = $request->get('cabina');
        $cabina->save();

        $producto = $request->get('producto');
        $cantidad = $request->get('stock');
        $estatus = $request->get('estatus');

        $insert_data = [];

        for ($count = 0; $count < count($cantidad); $count++) {
            $producto_db = Productos::where('id', $producto[$count])->first();

            if ($estatus[$count] != null || $producto_db->cantidad != $cantidad[$count]) {
                $producto_db->cantidad = $cantidad[$count];
                $producto_db->update();

                $estatus_value = ($estatus[$count] == null) ? 'En stock' : $estatus[$count];

                $data = [
                    'id_cabina_inv' => $cabina->id,
                    'id_producto' => $producto[$count],
                    'num_semana' => $cabina->num_semana,
                    'created_at' => $today,
                    'cantidad' => $cantidad[$count],
                    'estatus' => $estatus_value
                ];

                $insert_data[] = $data;
            }
        }

        // Verificar si hay datos para insertar
        if (!empty($insert_data)) {
            ProductosInventario::insert($insert_data);
        }


        Session::flash('success', 'Se ha guardado sus datos con exito');
        if($request->get('cabina') == 1){
            return redirect()->route('inventario.index1')->with('success', 'Corte con exito.');
        }elseif($request->get('cabina') == 3){
            return redirect()->route('inventario.index3')->with('success', 'Corte con exito.');
        }elseif($request->get('cabina') == 4){
            return redirect()->route('inventario.index4')->with('success', 'Corte con exito.');
        }elseif($request->get('cabina') == 5){
            return redirect()->route('inventario.index5')->with('success', 'Corte con exito.');
        }

    }

    public function update_cabina1(Request $request, $id){
        $today =  date('Y-m-d H:i:s');
        $cabina_inv = CabinaInvetario::where('id', '=', $id)->first();
        $cabina_inv->num_semana = $request->get('num_semana');
        $cabina_inv->update();

            $producto = $request->get('producto');
            $estatus = $request->get('estatus');
            $cantidad = $request->get('stock');
            $num_semana = $request->get('num_semana');

            $insert_data = [];

            for ($count = 0; $count < count($estatus); $count++) {
                $producto_db = Productos::where('id', $producto[$count])->first();

                if ($estatus[$count] != null || $producto_db->cantidad != $cantidad[$count]) {
                    $producto_db->cantidad = $cantidad[$count];
                    $producto_db->update();

                    $estatus_value = ($estatus[$count] == null) ? 'En stock' : $estatus[$count];

                    $data = [
                        'id_cabina_inv' => $id,
                        'id_producto' => $producto[$count],
                        'num_semana' => $num_semana,
                        'created_at' => $today,
                        'cantidad' => $cantidad[$count],
                        'estatus' => $estatus_value
                    ];

                    $insert_data[] = $data;
                }
            }

            // Verificar si hay datos para insertar
            if (!empty($insert_data)) {
                ProductosInventario::insert($insert_data);
            }


        Session::flash('success', 'Se ha editado sus datos con exito');
        return redirect()->back()
        ->with('success', 'caja created successfully.');
    }

    public function imprimir(Request $request){
        $productos_por_agotar = Productos::where('cantidad','<=', 2)->where('cantidad','>=', 1)->count();
        $productos_agotado = Productos::where('cantidad','=', 0)->count();
        $productos_stock = Productos::where('cantidad','>=', 3)->count();

        $hoy = Carbon::now();
        // Obtener la fecha de inicio de la semana (lunes)
        $inicioSemana = $hoy->startOfWeek();
        // Obtener los productos editados en la semana
        $productosSemana = Productos::where('updated_at', '>=', $inicioSemana)->get();

        $productosinvSemana1 = ProductosInventario::join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
            ->where('cabina_inventario.num_cabina', '=', '1')
            ->where('productos_inventario.created_at', '>=', $inicioSemana)
            ->select('productos_inventario.*')
            ->get();

        $productosinvSemana2 = ProductosInventario::join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
            ->where('cabina_inventario.num_cabina', '=', '2')
            ->where('productos_inventario.created_at', '>=', $inicioSemana)
            ->select('productos_inventario.*')
            ->get();

        $productosinvSemana3 = ProductosInventario::join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
            ->where('cabina_inventario.num_cabina', '=', '3')
            ->where('productos_inventario.created_at', '>=', $inicioSemana)
            ->select('productos_inventario.*')
            ->get();

        $productosinvSemana4 = ProductosInventario::join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
            ->where('cabina_inventario.num_cabina', '=', '4')
            ->where('productos_inventario.created_at', '>=', $inicioSemana)
            ->select('productos_inventario.*')
            ->get();

        $productosinvSemana5 = ProductosInventario::join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
            ->where('cabina_inventario.num_cabina', '=', '5')
            ->where('productos_inventario.created_at', '>=', $inicioSemana)
            ->select('productos_inventario.*')
            ->get();

        $pdf = PDF::loadView('cabina_inventario.reporte',compact('productos_por_agotar', 'productos_agotado', 'productos_stock', 'hoy', 'productosSemana', 'productosinvSemana1', 'productosinvSemana2', 'productosinvSemana3', 'productosinvSemana4', 'productosinvSemana5'));

        return $pdf->download('reporte-productos.pdf');
    }

    public function reporte_inv(Request $request){
        $inicioMes = now()->firstOfMonth();
        $hoy = Carbon::now();
        // Obtener la fecha de inicio de la semana (lunes)
        $inicioSemana = $hoy->startOfWeek();

        $productos_cabina1 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '1')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'productos_inventario.num_semana'
        )
        ->get();

        $productos_cabina2 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '2')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'productos_inventario.num_semana'
        )
        ->get();

        $productos_cabina3 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '3')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'productos_inventario.num_semana'
        )
        ->get();

        $productos_cabina4 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '4')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'productos_inventario.num_semana'
        )
        ->get();

        $productos_cabina5 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '5')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'productos_inventario.num_semana'
        )
        ->get();

        // Consulta para obtener los productos de la semana actual y su estatus
        $productos_sem_cambios = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioSemana)
        ->where('productos_inventario.estatus', '=', 'Se cambio')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'cabina_inventario.num_cabina'
        )
        ->get();

        // Consulta para obtener los productos de la semana actual y su estatus
        $productos_sem_termino = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioSemana)
        ->where('productos_inventario.estatus', '=', 'Por Terminar')
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'cabina_inventario.num_cabina'
        )
        ->get();

        $productos_sem = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioSemana)
        ->select(
            'productos.nombre',
            'productos_inventario.estatus',
            'cabina_inventario.num_cabina',
            'productos_inventario.cantidad'
        )
        ->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_new',compact('productos_sem', 'inicioMes', 'productos_sem_cambios', 'productos_sem_termino', 'productos_cabina1', 'productos_cabina2', 'productos_cabina3', 'productos_cabina4', 'productos_cabina5', 'hoy'));
       // return $pdf->stream();
        return $pdf->download('reporte-general.pdf');
    }

    public function reporte_bodega(Request $request){
        $inicioMes = now()->firstOfMonth();
        $hoy = Carbon::now();
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $producto_bodega = ProductosBodega::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->first();
        $productos_bodega_inv = ProductosBodegaInv::where('id_productos_bodega', '=', $producto_bodega->id)->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_bodega',compact('inicioMes','producto_bodega', 'productos_bodega_inv','hoy'));
        return $pdf->stream();
        // return $pdf->download('reporte-general.pdf');
    }

    public function reporte_cabina1(Request $request){
        $inicioMes = now()->firstOfMonth();
        $hoy = Carbon::now();
        // Obtener la fecha de inicio de la semana (lunes)
        $inicioSemana = $hoy->startOfWeek();

        $productos_cabina1 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '1')
        ->select(
            'productos.nombre',
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.num_semana'
        )
        ->get();

        $registros_por_producto = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->where('cabina_inventario.num_cabina', '=', '1')
        ->orderBy('created_at')
        ->select(
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.created_at'
        )
        ->get()
        ->groupBy('id_producto');


        $productos = Productos::whereIn('id', $registros_por_producto->keys())->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_cabina1',compact('inicioMes','productos_cabina1','hoy', 'registros_por_producto', 'productos'));
        return $pdf->stream();
        // return $pdf->download('reporte-general.pdf');
    }

    public function reporte_cabina3(Request $request){
        $inicioMes = now()->firstOfMonth();
        $hoy = Carbon::now();
        // Obtener la fecha de inicio de la semana (lunes)
        $inicioSemana = $hoy->startOfWeek();

        $productos_cabina1 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '3')
        ->select(
            'productos.nombre',
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.num_semana'
        )
        ->get();

        $registros_por_producto = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->where('cabina_inventario.num_cabina', '=', '3')
        ->orderBy('created_at')
        ->select(
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.created_at'
        )
        ->get()
        ->groupBy('id_producto');

        $productos = Productos::whereIn('id', $registros_por_producto->keys())->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_cabina3',compact('inicioMes','productos_cabina1','hoy', 'registros_por_producto', 'productos'));
        return $pdf->stream();
        // return $pdf->download('reporte-general.pdf');
    }

    public function reporte_cabina4(Request $request){
        $inicioMes = now()->firstOfMonth();
        $hoy = Carbon::now();
        // Obtener la fecha de inicio de la semana (lunes)
        $inicioSemana = $hoy->startOfWeek();

        $productos_cabina1 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '4')
        ->select(
            'productos.nombre',
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.num_semana'
        )
        ->get();

        $registros_por_producto = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->where('cabina_inventario.num_cabina', '=', '4')
        ->orderBy('created_at')
        ->select(
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.created_at'
        )
        ->get()
        ->groupBy('id_producto');

        $productos = Productos::whereIn('id', $registros_por_producto->keys())->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_cabina4',compact('inicioMes','productos_cabina1','hoy', 'registros_por_producto', 'productos'));
        return $pdf->stream();
        // return $pdf->download('reporte-general.pdf');
    }

    public function reporte_cabina5(Request $request){
        $inicioMes = now()->firstOfMonth();
        $hoy = Carbon::now();
        // Obtener la fecha de inicio de la semana (lunes)
        $inicioSemana = $hoy->startOfWeek();

        $productos_cabina1 = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->join('productos', 'productos_inventario.id_producto', '=', 'productos.id')
        ->where('productos_inventario.created_at', '>=', $inicioMes)
        ->where('cabina_inventario.num_cabina', '=', '5')
        ->select(
            'productos.nombre',
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.num_semana'
        )
        ->get();

        $registros_por_producto = DB::table('productos_inventario')
        ->join('cabina_inventario', 'productos_inventario.id_cabina_inv', '=', 'cabina_inventario.id')
        ->where('cabina_inventario.num_cabina', '=', '5')
        ->orderBy('created_at')
        ->select(
            'productos_inventario.id_producto',
            'productos_inventario.estatus',
            'productos_inventario.cantidad',
            'productos_inventario.created_at'
        )
        ->get()
        ->groupBy('id_producto');

        $productos = Productos::whereIn('id', $registros_por_producto->keys())->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_cabina5',compact('inicioMes','productos_cabina1','hoy', 'registros_por_producto', 'productos'));
        return $pdf->stream();
        // return $pdf->download('reporte-general.pdf');
    }
}
