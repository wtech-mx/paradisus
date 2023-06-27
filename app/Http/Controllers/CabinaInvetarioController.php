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
        $cabinas = CabinaInvetario::where('num_cabina','=', 'Cabina 1')->get();

        return view('cabina_inventario.cabina1',compact('cabinas'));
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


        $cabina = new CabinaInvetario;
        $cabina->fecha = $request->get('fecha1');
        $cabina->num_semana = $request->get('num_semana');
        $cabina->num_cabina = $request->get('cabina');
        $cabina->save();

        $producto = $request->get('producto');
        $cantidad = $request->get('cantidad');
        $estatus = $request->get('estatus');


        for ($count = 0; $count < count($producto); $count++) {
            $data = array(
                'id_cabina_inv' => $cabina->id,
                'id_producto' => $producto[$count],
                'cantidad' => $cantidad[$count],
                'estatus' => $estatus[$count]
            );
            $insert_data[] = $data;
        }

        ProductosInventario::insert($insert_data);


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('inventario.index1')
        ->with('success', 'caja created successfully.');

    }

    public function update_cabina1(Request $request, $id){

        $producto = $request->get('producto');
        $cantidad = $request->get('cantidad');
        $estatus = $request->get('estatus');
        $num_semana = $request->get('num_semana');

        $existingData = ProductosInventario::where('id_cabina_inv', $id)->get();

        $insert_data = [];
        $update_data = [];

        for ($count = 0; $count < count($producto); $count++) {
            $data = [
                'id_cabina_inv' => $id,
                'id_producto' => $producto[$count],
                'cantidad' => $cantidad[$count],
                'num_semana' => $num_semana,
                'estatus' => $estatus[$count]
            ];

            $existingRecord = $existingData->where('id_producto', $producto[$count])->first();

            if ($existingRecord) {
                // Actualizar el registro existente
                $existingRecord->update($data);
                $update_data[] = $existingRecord;
            } else {
                // Guardar el nuevo registro
                $insert_data[] = $data;
            }
        }

        ProductosInventario::insert($insert_data);

        Session::flash('success', 'Se ha editado sus datos con exito');
        return redirect()->route('inventario.index1')
        ->with('success', 'caja created successfully.');

    }

}
