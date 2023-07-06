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
    public function reporte()
    {
        $productos_por_agotar = Productos::where('cantidad','<=', 2)->where('cantidad','>=', 1)->count();
        $productos_agotado = Productos::where('cantidad','=', 0)->count();
        $productos_stock = Productos::where('cantidad','>=', 3)->count();

        $productos = Productos::where('cantidad', '>', 2)->orderBy('cantidad', 'asc')->get();
        $productosporagotar = Productos::where('cantidad', '<=', 2)->orderBy('cantidad', 'asc')->get();

        $labels = [];
        $labels2 = [];
        $data = [];
        $data2 = [];
        $backgroundColor = [];
        $backgroundColor2 = [];

        foreach ($productos as $producto) {
            $labels[] = $producto->nombre; // Reemplaza 'nombre' con el nombre correcto de la columna en tu tabla de productos
            $data[] = $producto->cantidad; // Reemplaza 'cantidad' con el nombre correcto de la columna en tu tabla de productos
            $backgroundColor[] = '#' . substr(md5(mt_rand()), 0, 6); // Generar colores aleatorios para cada barra
        }

        foreach ($productosporagotar as $producto) {
            $labels2[] = $producto->nombre; // Reemplaza 'nombre' con el nombre correcto de la columna en tu tabla de productos
            $data2[] = $producto->cantidad; // Reemplaza 'cantidad' con el nombre correcto de la columna en tu tabla de productos
            $backgroundColor2[] = '#' . substr(md5(mt_rand()), 0, 6); // Generar colores aleatorios para cada barra
        }

        return view('cabina_inventario.index', compact('productos_por_agotar', 'productos_agotado', 'productos_stock','labels', 'data', 'backgroundColor','labels2', 'data2', 'backgroundColor2'));
    }

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
