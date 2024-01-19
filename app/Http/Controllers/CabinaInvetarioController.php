<?php

namespace App\Http\Controllers;

use App\Models\CabinaInvetario;
use App\Models\Productos;
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


        $productos_cabinas = Productos::where('cabinas','=', 1)->orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina1',compact('cabinas','productos_cabinas'));
    }

    public function index2()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '2')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina2',compact('cabinas','productos_cabinas'));
    }

    public function index3()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '3')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina3',compact('cabinas','productos_cabinas'));
    }

    public function index4()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '4')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina4',compact('cabinas','productos_cabinas'));
    }

    public function index5()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '5')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina5',compact('cabinas','productos_cabinas'));
    }

    public function create(){

        if(request()->is('inventario/cabinas')){

            $productos_cabinas = Productos::where('cabina1','=', 1)->orderBy('nombre','ASC')->get();

        }elseif(request()->is('inventario/cabina2')){

            $productos_cabinas = Productos::where('cabina2','=', 1)->orderBy('nombre','ASC')->get();

        }elseif(request()->is('inventario/cabina3')){

            $productos_cabinas = Productos::where('cabina3','=', 1)->orderBy('nombre','ASC')->get();

        }elseif(request()->is('inventario/cabina4')){

            $productos_cabinas = Productos::where('cabina4','=', 1)->orderBy('nombre','ASC')->get();

        }elseif(request()->is('inventario/cabina5')){

            $productos_cabinas = Productos::where('cabina5','=', 1)->orderBy('nombre','ASC')->get();
        }

        return view('cabina_inventario.modal_cabina', compact('productos_cabinas'));
    }

    public function store(Request $request){
        $today =  date('Y-m-d H:i:s');
        $cabina = new CabinaInvetario;
        $cabina->fecha = $request->get('fecha1');
        $cabina->num_semana = $request->get('num_semana');
        $cabina->num_cabina = $request->get('cabina');
        $cabina->save();

        $producto = $request->get('producto');
        $estatus = $request->get('estatus');

        // Verificar si hay al menos un valor en $estatus
        if (!empty(array_filter($estatus))) {
            $insert_data = [];

            for ($count = 0; $count < count($estatus); $count++) {
                if ($estatus[$count] != null) {
                    $data = array(
                        'id_cabina_inv' => $cabina->id,
                        'id_producto' => $producto[$count],
                        'num_semana' => $cabina->num_semana,
                        'created_at' => $today,
                        'estatus' => $estatus[$count]
                    );
                    $insert_data[] = $data;
                }
            }

            // Verificar si hay datos para insertar
            if (!empty($insert_data)) {
                ProductosInventario::insert($insert_data);
            }
        }


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success','Invemtario creado con exito.');
    }

    public function update_cabina1(Request $request, $id){
        $today =  date('Y-m-d H:i:s');
        if($request->has('estatus')){
            $producto = $request->get('producto');
            $estatus = $request->get('estatus');
            $num_semana = $request->get('num_semana');

            $existingData = ProductosInventario::where('id_cabina_inv', $id)->get();

            $insert_data = [];
            $update_data = [];

            for ($count = 0; $count < count($estatus); $count++) {
                // Verificar si el 'estatus' actual está vacío
                if (empty($estatus[$count])) {
                    continue; // Saltar esta iteración y pasar a la siguiente
                }

                $data = [
                    'id_cabina_inv' => $id,
                    'id_producto' => $producto[$count],
                    'num_semana' => $num_semana,
                    'created_at' => $today,
                    'estatus' => $estatus[$count]
                ];

                $existingRecord = $existingData->where('id_producto', $producto[$count])->first();

                $insert_data[] = $data;

            }

            ProductosInventario::insert($insert_data);
        }

        if($request->has('producto_extra') != NULL){
            $producto_extra = $request->get('producto_extra');
            $cantidad_extra = $request->get('cantidad_extra');
            $extra = $request->get('extra');
            $num_semana = $request->get('num_semana');

            $existingData = ProductosInventario::where('id_cabina_inv', $id)->get();

            $insert_data2 = [];
            $update_data2 = [];

            for ($count = 0; $count < count($producto_extra); $count++) {

                $data2 = array(
                    'id_cabina_inv' => $id,
                    'id_producto' => $producto_extra[$count],
                    'extra' => '1',
                    'num_semana' => $num_semana,
                    'created_at' => $today,
                    'cantidad' => $cantidad_extra[$count]
                );

                // Buscar el registro existente por su 'id' único en lugar de 'id_producto'
                $existingRecord = $existingData->where('id', $id)->first();

                $insert_data2[] = $data2;

            }

            ProductosInventario::insert($insert_data2);
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
            'cabina_inventario.num_cabina'
        )
        ->get();

        $pdf = PDF::loadView('cabina_inventario.reporte_new',compact('productos_sem', 'inicioMes', 'productos_sem_cambios', 'productos_sem_termino', 'productos_cabina1', 'productos_cabina2', 'productos_cabina3', 'productos_cabina4', 'productos_cabina5', 'hoy'));
        return $pdf->stream();
        // return $pdf->download('reporte-productos.pdf');
    }
}
