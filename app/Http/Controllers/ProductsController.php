<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductosBundleId;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
{

    // Método privado para obtener productos desde la API
    private function obtenerProductosDesdeAPI($request)
    {
        $dominio = $request->getHost();
        $api_url = $dominio == 'paradisus.mx'
            ? 'https://plataforma.imnasmexico.com/api/enviar-productos'
            : 'http://imnasmexico_platform.test/api/enviar-productos';

        $api_platform_Productos = Http::get($api_url);
        $api_platform_Productos_Array = $api_platform_Productos->json();

        // Asegurarnos de que estamos trabajando solo con la parte 'data' del array de la API
        $api_productos_data = $api_platform_Productos_Array['data'];

        // Transformar el array de la API en una colección de Laravel para que funcione como los productos de Eloquent
        return collect($api_productos_data)->map(function ($product) {
            return (object)[
                'id' => $product['id'],
                'sku' => $product['sku'],
                'nombre' => $product['nombre'],
                'stock_nas' => $product['stock_nas'],
                'categoria' => $product['categoria'],
                'subcategoria' => $product['subcategoria'],
                'stock' => $product['stock'],
                'descripcion' => $product['descripcion'],
                'precio_rebajado' => $product['precio_rebajado'],
                'precio_normal' => $product['precio_normal'],
                'imagenes' => $product['imagenes'],
                'laboratorio' => $product['laboratorio'],
                'stock_cosmica' => $product['stock_cosmica'],
                'fecha_fin' => $product['fecha_fin'],
            ];
        });
    }

    public function index_bundle(Request $request){

        // $productsKit = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Kit')->orderby('nombre','asc')->get();

        // Obtener productos a través del método común
        $productsKit = $this->obtenerProductosDesdeAPI($request);

        return view('products.index_bundle', compact('productsKit'));
    }


    public function create_bundle(Request $request){

        // $products = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '!=', 'Kit')->get();

        $products = $this->obtenerProductosDesdeAPI($request);

        return view('products.bundle', compact('products'));
    }

    public function store_bundle(Request $request)
    {

        $dominio = $request->getHost();
        if($dominio == 'paradisus.mx'){
            $ruta_comentarios = base_path('../public_html/paradisus.mx/products');
        }else{
            $ruta_comentarios = public_path() . '/products';
        }

        $product = new Products;
        $product->nombre = $request->get('nombre');
        $product->subcategoria = 'Kit';
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $request->get('total');
        $product->precio_normal = $request->get('totalDescuento');
        $product->fecha_fin = $request->get('fecha_fin');
        $product->categoria = $request->get('categoria');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_comentarios;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $product->imagenes = $fileName;
        }

        $product->save();

        if ($request->has('campo')) {
            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo4');
            $nuevosCampos3 = $request->input('campo3');
            $nuevosCampos4 = $request->input('descuento_prod');

            foreach ($nuevosCampos as $index => $campo) {
                $notas_inscripcion = new ProductosBundleId;
                $notas_inscripcion->id_product = $product->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');

        return redirect()->back()->with('success', 'Bundle Creado con exito.');

    }

    public function edit_bundle(Request $request,$id){
        // $cotizacion = Products::find($id);
        // Obtén los productos desde la API
        $cotizacion = $this->obtenerProductosDesdeAPI($request);

        // Busca el producto que coincida con el ID que se pasó al método
        $cotizacion = $cotizacion->firstWhere('id', $id);

        // Si no encuentra el producto, puedes manejar el error (por ejemplo, lanzando una excepción o devolviendo un mensaje)
        if (!$cotizacion) {
            abort(404, "Producto no encontrado");
        }

        $cotizacion_productos = ProductosBundleId::where('id_product', '=', $id)->where('price', '!=', NULL)->get();

        // Obtén los productos desde la API
        $products = $this->obtenerProductosDesdeAPI($request);

        // Excluir productos cuya subcategoría sea "Kit"
        $products = $products->reject(function ($product) {
            return $product->subcategoria === 'Kit';
        });

        return view('products.edit_bundle', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update_bundle(Request $request, $id){

        $dominio = $request->getHost();
        if($dominio == 'paradisus.mx'){
            $ruta_comentarios = base_path('../public_html/paradisus.mx/products');
        }else{
            $ruta_comentarios = public_path() . '/products';
        }

        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');
        $total = 0;
        $resta = 0;
        $suma = 0;
        // Obtener los productos actuales de la base de datos para esa cotización
        $productosExistentes = ProductosBundleId::where('id_product', $id)->get();

        // Crear un array para almacenar los IDs de los productos enviados
        $productosIdsEnviados = [];

        // Actualizar productos existentes
        for ($count = 0; $count < count($producto); $count++) {
            // Buscar el producto en la base de datos
            $productos = ProductosBundleId::where('producto', $producto[$count])
                ->where('id_product', $id)
                ->firstOrFail();


            $producto_db = Products::where('nombre', $producto[$count])->first();
            $producto_cot = ProductosBundleId::where('producto', $producto[$count])->where('id_product', $id)->first();

            if ($producto_db && $producto_cot) {
                if ($producto_cot->cantidad != $cantidad[$count]) {
                    $suma = $producto_db->stock + $producto_cot->cantidad;
                    $resta = $suma - $cantidad[$count];
                    $producto_db->stock = $resta;
                    $producto_db->update();
                }
            }

            // Guardar el ID del producto en el array de productos enviados
            $productosIdsEnviados[] = $productos->id;

            // Limpiar el precio y preparar los datos para la actualización
            $precio = $price[$count];
            $cleanPrice2 = floatval(str_replace(['$', ','], '', $precio));
            $data = array(
                'price' => $cleanPrice2,
                'cantidad' => $cantidad[$count],
                'descuento' => $descuento[$count],
            );

            // Actualizar el producto en la base de datos
            $productos->update($data);
            $total += $cleanPrice2;
        }

        // Eliminar los productos que ya no están en la solicitud
        foreach ($productosExistentes as $productoExistente) {
            if (!in_array($productoExistente->id, $productosIdsEnviados)) {
                $productoExistente->delete();
            }
        }

        $campo = $request->input('campo');
        if(!empty(array_filter($campo, fn($value) => !is_null($value)))){
            $campo4 = $request->input('campo4');
            $campo3 = $request->input('campo3');
            $descuento_prod = $request->input('descuento_prod');
            $resta = 0;
            // Agregar nuevos productos
            for ($count = 0; $count < count($campo); $count++) {
                $producto = Products::where('nombre', $campo[$count])->first();
                $resta = $producto->stock - $campo3[$count];
                $producto->stock = $resta;
                $producto->update();

                $price = $campo4[$count];

                $cleanPrice = floatval(str_replace(['$', ','], '', $price));
                $data = array(
                    'id_product' => $id,
                    'producto' => $campo[$count],
                    'price' => $cleanPrice,
                    'cantidad' => $campo3[$count],
                    'descuento' => $descuento_prod[$count],
                );
                ProductosBundleId::create($data);
                $total += $cleanPrice;
            }
        }

        $product = Products::findOrFail($id);

        $product->nombre = $request->get('nombre');
        $product->subcategoria = 'Kit';
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $total;
        $cleanPriceNormal = floatval(str_replace(['$', ','], '', $request->get('total_final')));
        $product->precio_normal = $cleanPriceNormal;

        $product->fecha_fin = $request->get('fecha_fin');
        $product->categoria = $request->get('categoria');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_comentarios;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $product->imagenes = $fileName;
        }

        $product->save();

        Session::flash('success', 'Bundle actualizado con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function update_ocultar(Request $request, $id)
    {
        $product = Products::find($id);
        $product->categoria = $request->get('categoria');
        $product->update();

        return response()->json([
            'id' => $product->id,
            'categoria' => $product->categoria,
        ]);

        // Session::flash('success', 'Se ha guardado sus datos con exito');
        // return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

}
