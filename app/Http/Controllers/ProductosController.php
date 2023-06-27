<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\ProductosInventario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;

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

    public function create_cabina1(){
        // Obtener el mes actual
        $mesActual = date('m');

        // Obtener el año actual
        $añoActual = date('Y');

        // Crear una instancia del objeto DateTime para el primer día del mes actual
        $primerDiaMes = new DateTime("$añoActual-$mesActual-01");

        // Obtener el último día del mes actual
        $ultimoDiaMes = new DateTime($primerDiaMes->format('Y-m-t'));

        // Contador de miércoles
        $contadorMiercoles = 0;

        // Iterar desde el primer día hasta el último día del mes
        while ($primerDiaMes <= $ultimoDiaMes) {
            // Verificar si el día actual es miércoles (formato 'N': 1 para lunes, 2 para martes, etc.)
            if ($primerDiaMes->format('N') == 3) {
                $contadorMiercoles++;
            }

            // Avanzar al siguiente día
            $primerDiaMes->modify('+1 day');
        }

        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.create', compact('productos', 'contadorMiercoles'));
    }

    public function edit_cabina1($id){
        // Obtener el mes actual
        $mesActual = date('m');

        // Obtener el año actual
        $añoActual = date('Y');

        // Crear una instancia del objeto DateTime para el primer día del mes actual
        $primerDiaMes = new DateTime("$añoActual-$mesActual-01");

        // Obtener el último día del mes actual
        $ultimoDiaMes = new DateTime($primerDiaMes->format('Y-m-t'));

        // Contador de miércoles
        $contadorMiercoles = 0;

        // Iterar desde el primer día hasta el último día del mes
        while ($primerDiaMes <= $ultimoDiaMes) {
            // Verificar si el día actual es miércoles (formato 'N': 1 para lunes, 2 para martes, etc.)
            if ($primerDiaMes->format('N') == 3) {
                $contadorMiercoles++;
            }

            // Avanzar al siguiente día
            $primerDiaMes->modify('+1 day');
        }

        $product_inv = ProductosInventario::where('id_cabina_inv', '=', $id)->first();
        $products_invs = ProductosInventario::where('id_cabina_inv', '=', $id)->get();
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.edit', compact('productos', 'contadorMiercoles', 'product_inv', 'products_invs'));
    }



}
