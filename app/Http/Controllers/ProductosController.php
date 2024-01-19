<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\ProductosInventario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductosController extends Controller
{

    public function index_productos()
    {
        $productos_inventarios = Productos::orderBy('nombre','ASC')->get();

        return view('productos.index', compact('productos_inventarios'));
    }

    public function store_productos(Request $request)
    {
        $productos = new Productos;
        $productos->nombre = $request->get('nombre');
        $productos->cabinas = $request->get('cabinas');
        $productos->cantidad = $request->get('cantidad');
        $productos->categoria = "Sin Categoria";
        $productos->save();

        return redirect()->back()->with('success','Producto creado.');
    }

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

        // Obtener la fecha actual
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

        return view('cabina_inventario.index', compact('productosSemana', 'productosinvSemana1', 'productosinvSemana2', 'productosinvSemana3', 'productosinvSemana4', 'productosinvSemana5', 'productos_por_agotar', 'productos_agotado', 'productos_stock','labels', 'data', 'backgroundColor','labels2', 'data2', 'backgroundColor2'));
    }

    public function index()
    {
        $productos_bodega = Productos::where('cabinas','=', NULL)->orderBy('nombre','ASC')->get();

        $productosSinSku = Productos::where('cabinas','=', NULL)->whereNull('sku')->get();

        // Recorrer los productos y asignarles un SKU aleatorio
        foreach ($productosSinSku as $producto) {
            $skuAleatorio = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT); // Generar SKU aleatorio de 5 dígitos
            $producto->sku = $skuAleatorio;
            $producto->save();
        }

        return view('productos.bodega', compact('productos_bodega'));
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

        $productos = Productos::where('cabinas','=', NULL)->orderBy('nombre','ASC')->get();

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
        $products_invs1 = ProductosInventario::where('id_cabina_inv', '=', $id)->where('num_semana', '=', '1')->get();
        $products_invs2 = ProductosInventario::where('id_cabina_inv', '=', $id)->where('num_semana', '=', '2')->get();
        $products_invs3 = ProductosInventario::where('id_cabina_inv', '=', $id)->where('num_semana', '=', '3')->get();
        $products_invs4 = ProductosInventario::where('id_cabina_inv', '=', $id)->where('num_semana', '=', '4')->get();
        $products_invs5 = ProductosInventario::where('id_cabina_inv', '=', $id)->where('num_semana', '=', '5')->get();
        $productos_cabinas = Productos::where('cabinas','=', 1)->orderBy('nombre','ASC')->get();

        return view('cabina_inventario.edit', compact('productos_cabinas', 'contadorMiercoles', 'product_inv', 'products_invs1', 'products_invs2', 'products_invs3', 'products_invs4', 'products_invs5'));
    }

    public function imprimir(Request $request, $id){

        $producto = Productos::find($id);

        $pdf = PDF::loadView('productos.pdf_sku',compact('producto'));
        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0,141.732,70.8661], 'portrair');
        return $pdf->download('etiqueta-'.$producto->sku.'.pdf');
    }

}
