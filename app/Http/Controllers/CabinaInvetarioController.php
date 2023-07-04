<?php

namespace App\Http\Controllers;

use App\Models\CabinaInvetario;
use App\Models\Productos;
use App\Models\ProductosInventario;
use Illuminate\Http\Request;
use Session;

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

        if($request->get('cantidad_extra') == NULL){
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
                    'estatus' => $estatus[$count]
                );
                $insert_data[] = $data;
            }

            ProductosInventario::insert($insert_data);
        }

        if($request->get('cantidad_extra') != NULL){
            $cabina = new CabinaInvetario;
            $cabina->fecha = $request->get('fecha1');
            $cabina->num_semana = $request->get('num_semana');
            $cabina->num_cabina = $request->get('cabina');
            $cabina->save();

            $producto_extra = $request->get('producto_extra');
            $cantidad_extra = $request->get('cantidad_extra');
            $extra = $request->get('extra');


            for ($count = 0; $count < count($producto_extra); $count++) {
                $data = array(
                    'id_cabina_inv' => $cabina->id,
                    'id_producto' => $producto_extra[$count],
                    'num_semana' => $cabina->num_semana,
                    'extra' => $extra,
                    'cantidad' => $cantidad_extra[$count]
                );
                $insert_data[] = $data;
            }

            ProductosInventario::insert($insert_data);
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success','Nota Productos Creado.');
    }

    public function update_cabina1(Request $request, $id){

        if($request->get('cantidad_extra') == NULL){
            $producto = $request->get('producto');
            $estatus = $request->get('estatus');
            $num_semana = $request->get('num_semana');

            $existingData = ProductosInventario::where('id_cabina_inv', $id)->get();

            $insert_data = [];
            $update_data = [];

            for ($count = 0; $count < count($producto); $count++) {
                $data = [
                    'id_cabina_inv' => $id,
                    'id_producto' => $producto[$count],
                    'num_semana' => $num_semana,
                    'estatus' => $estatus[$count]
                ];

                $existingRecord = $existingData->where('id_producto', $producto[$count])->first();

                if ($existingRecord) {
                    // Verificar si 'estatus' está presente antes de la actualización
                    if (isset($estatus[$count])) {
                        $existingRecord->update($data);
                        $update_data[] = $existingRecord;
                    }
                } else {
                    // Guardar el nuevo registro solo si 'estatus' está presente
                    if (isset($estatus[$count])) {
                        $insert_data[] = $data;
                    }
                }
            }

            ProductosInventario::insert($insert_data);
        }

        if($request->get('cantidad_extra') != NULL){

            $producto_extra = $request->get('producto_extra');
            $cantidad_extra = $request->get('cantidad_extra');
            $extra = $request->get('extra');

            $existingData = ProductosInventario::where('id_cabina_inv', $id)->get();

            $insert_data2 = [];
            $update_data2 = [];

            for ($count = 0; $count < count($producto_extra); $count++) {
                $data2 = array(
                    'id_cabina_inv' => $id,
                    'id_producto' => $producto_extra[$count],
                    'extra' => $extra,
                    'cantidad' => $cantidad_extra[$count]
                );

                $existingRecord = $existingData->where('id_producto', $producto_extra[$count])->first();

                if ($existingRecord) {
                    // Verificar si 'cantidad_extra' está presente antes de la actualización
                    if (isset($cantidad_extra[$count])) {
                        $existingRecord->update($data2);
                        $update_data2[] = $existingRecord;
                    }
                } else {
                    // Guardar el nuevo registro solo si 'cantidad_extra' está presente
                    if (isset($cantidad_extra[$count])) {
                        $insert_data2[] = $data2;
                    }
                }
            }

            ProductosInventario::insert($insert_data2);
        }

        Session::flash('success', 'Se ha editado sus datos con exito');
        return redirect()->back()
        ->with('success', 'caja created successfully.');
    }

}
