<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('productos.bodega', compact('productos'));
    }

    public function actualizarCantidad(Request $request)
    {
        $id = $request->input('id');
        $cantidad = $request->input('cantidad');

        $producto = Productos::find($id);
        $producto->cantidad = $cantidad;
        $producto->save();

        return response()->json(['success' => true]);
    }

}
