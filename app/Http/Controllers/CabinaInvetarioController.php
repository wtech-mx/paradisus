<?php

namespace App\Http\Controllers;

use App\Models\CabinaInvetario;
use App\Models\Productos;
use App\Models\ProductosInventario;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina1',compact('cabinas','productos'));
    }

    public function index2()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '2')->get();
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina2',compact('cabinas','productos'));
    }

    public function index3()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '3')->get();
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina3',compact('cabinas','productos'));
    }

    public function index4()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '4')->get();
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina4',compact('cabinas','productos'));
    }

    public function index5()
    {
        $cabinas = CabinaInvetario::where('num_cabina','=', '5')->get();
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina5',compact('cabinas','productos'));
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

        for ($count = 0; $count < count($producto); $count++) {
            $data = array(
                'id_cabina_inv' => $cabina->id,
                'id_producto' => $producto[$count],
                'num_semana' => $cabina->num_semana,
                'created_at' => $today,
                'estatus' => $estatus[$count]
            );
            $insert_data[] = $data;
        }

        ProductosInventario::insert($insert_data);

        if($request->get('cantidad_extra') != NULL){

            $producto_extra = $request->get('producto_extra');
            $cantidad_extra = $request->get('cantidad_extra');
            $extra = $request->get('extra');

            for ($count2 = 0; $count2 < count($producto_extra); $count2++) {
                $data2 = array(
                    'id_cabina_inv' => $cabina->id,
                    'id_producto' => $producto_extra[$count2],
                    'num_semana' => $cabina->num_semana,
                    'extra' => $extra,
                    'created_at' => $today,
                    'cantidad' => $cantidad_extra[$count2]
                );
                $insert_data2[] = $data2;
            }

            ProductosInventario::insert($insert_data2);
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success','Nota Productos Creado.');
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

            for ($count = 0; $count < count($producto); $count++) {
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

}
