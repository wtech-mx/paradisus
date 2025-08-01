<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\NotaReposicion;
use App\Models\NotaReposicionProducto;
use App\Models\NotasPedidos;
use App\Models\Pedido;
use App\Models\Reporte;
use App\Models\User;
use App\Models\NotasCosmes;
use App\Models\ProductosBundleId;
use App\Models\ProductosNAS;
use App\Models\Products;
use App\Models\RegCosmesSum;
use Codexshaper\WooCommerce\Models\Product;
use Session;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


// use Automattic\WooCommerce\Client;

// use Product;
// use Codexshaper\WooCommerce\Facades\Product;

class NotasPedidoController extends Controller
{

    public function index(Request $request)
    {
        // Capturamos los parámetros de fecha
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Verificamos si los parámetros están presentes para filtrar
        if ($startDate && $endDate) {
            // Filtramos por el rango de fechas
            $nota_pedido = NotasPedidos::whereBetween('fecha', [$startDate, $endDate])
                            ->where('estatus', '!=', 'Cancelada')
                            ->orderBy('id', 'DESC')
                            ->get();
        } else {
            // Si no se proporcionan fechas, traemos los registros del mes actual
            $nota_pedido = NotasPedidos::whereMonth('fecha', date('m'))
                            ->whereYear('fecha', date('Y'))
                            ->where('estatus', '!=', 'Cancelada')
                            ->orderBy('id', 'DESC')
                            ->get();
        }

        $nota_pedidoCancelado = NotasPedidos::where('estatus', '=', 'Cancelada')
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('notas_pedidos.index', compact('nota_pedido', 'nota_pedidoCancelado'));
    }

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

    private function obtenerProductosBundleDesdeAPI($request)
    {
        $dominio = $request->getHost();
        $api_url = $dominio == 'paradisus.mx'
            ? 'https://plataforma.imnasmexico.com/api/enviar-productos/bundle-pack'
            : 'http://imnasmexico_platform.test/api/enviar-productos/bundle-pack';

        $api_platform_ProductosBundle = Http::get($api_url);
        $api_platform_ProductosBundle_Array = $api_platform_ProductosBundle->json();

        // Asegurarnos de que estamos trabajando solo con la parte 'data' del array de la API
        $api_productos_dataBundle = $api_platform_ProductosBundle_Array['data'];

        // Transformar el array de la API en una colección de Laravel para que funcione como los productos de Eloquent
        return collect($api_productos_dataBundle)->map(function ($productsBundle) {
            return (object)[
                'id' => $productsBundle['id'],
                'id_product' => $productsBundle['id_product'],
                'producto' => $productsBundle['producto'],
                'price' => $productsBundle['price'],
                'cantidad' => $productsBundle['cantidad'],
            ];
        });
    }

    public function create(Request $request)
    {
        $cosme = auth()->user();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        // $products = ProductosNAS::where('categoria', '!=', 'Ocultar')->get();

        // Obtener productos a través del método común
        $products = $this->obtenerProductosDesdeAPI($request);

        return view('notas_pedidos.create', compact('cosme','user', 'client', 'products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'phone' => [
                Rule::unique('clients')->where(function ($query) use ($request) {
                    return $query->where('phone', $request->input('phone'));
                }),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fechaActual = date('Y-m-d');

        if($request->get('name') != NULL){
            $client = new Client;
            $client->name = $request->get('name');
            $client->last_name = $request->get('last_name');
            $client->phone = $request->get('phone');
            $client->email = $request->get('email');
            $client->save();
        }

        $nota = new NotasPedidos;
        $nota->id_user = $request->get('id_user');

        $nota->estatus = 'Aprobada';
        $nota->aprobado_hora_y_guia = date("Y-m-d H:i:s");

        if($request->get('name') != NULL){
            $nota->id_client = $client->id;

        }else{
            $nota->id_client = $request->get('id_client');
        }

        $nota->metodo_pago = $request->get('metodo_pago');
        $nota->fecha = $fechaActual;

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/foto_producto';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->foto = $fileName;
        }

        $nota->descuento = $request->get('descuento_porcentaje');
        $nota->total = $request->get('totalSuma');
        $nota->restante = $request->get('restante');
        $nota->dinero_recibido = $request->get('dinero_recibido');

        if($request->get('dinero_recibido2') > '0' ){
            $nota->dinero_recibido2 = $request->get('dinero_recibido2');
            $nota->metodo_pago2 = $request->get('metodo_pago2');

            if ($request->hasFile("foto2")) {
                $file = $request->file('foto2');
                $path = public_path() . '/foto_producto';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $nota->foto2 = $fileName;
            }
        }
        $suma_pagos = $request->get('dinero_recibido') + $request->get('dinero_recibido2');
        if(($request->get('dinero_recibido') > $request->get('totalSuma')) && ($request->get('metodo_pago') == 'Efectivo')){
            $cambio = $request->get('dinero_recibido') - $request->get('totalSuma');
            $nota->cambio = $cambio;
        }elseif($suma_pagos > $request->get('totalSuma')){
            $cambio = $suma_pagos - $request->get('totalSuma');
            $nota->cambio = $cambio;
        }else{
            $nota->cambio = '0';
        }

        $nota->save();

        // if($request->get('metodo_pago') == 'Tarjeta' or $request->get('metodo_pago2')){


        //     // Define las credenciales de la API
        //     $apiKey = '23bb7433-1bae-4f0d-92f9-dc96990a8efb';
        //     $clave = 'd9a61a7b-2658-41d2-96b8-f6d235dfb5e9';
        //     // Genera el token de autorización
        //     $token = base64_encode($apiKey . ':' . $clave);

        //     if($request->get('name') != NULL){
        //        $nombre_cliente = $request->get('name');
        //     }else{
        //         $client =  Client::find($request->get('id_client'));
        //         $nombre_cliente = $client->name;
        //     }

        //     $cajera_id =  User::find($nota->id_user);
        //     $cajera = $cajera_id->name;


        //     $amount = $nota->total;
        //     $assigned_user = 'ventas@paradisus.com.mx';
        //     $reference = $nota->id;
        //     $message = 'Nota Product :#'.$nota->id.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

        //     // Realiza la solicitud GET a la API de Clip
        //     $client = new GuzzleClient();

        //     // Formatear los datos como JSON
        //     $data_items = [
        //         'amount' => (int)$amount,
        //         'assigned_user' => $assigned_user,
        //         'reference' => $reference,
        //         'message' => $message
        //     ];

        //     $jsonData = json_encode($data_items);

        //     $response = $client->request('POST', 'https://api-gw.payclip.com/paymentrequest', [
        //         'body' => $jsonData,
        //         'headers' => [
        //             'accept' => 'application/vnd.com.payclip.v1+json',
        //             'content-type' => 'application/json; charset=UTF-8',
        //             'x-api-key' => 'Basic ' . $token,
        //           ],

        //     ]);

        //     $body = $response->getBody()->getContents();

        //     // Decodificar el cuerpo si es JSON
        //     $data = json_decode($body, true);

        // }

        // G U A R D A R  C A M B I O
        $suma_pagos = $request->get('dinero_recibido') + $request->get('dinero_recibido2');

        if($request->get('dinero_recibido') > $request->get('totalSuma') && $request->get('metodo_pago') == 'Efectivo'){
            $cambio = $request->get('dinero_recibido') - $request->get('totalSuma');
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $cambio;
            $caja->concepto = 'Cambio nota productos: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }elseif($suma_pagos > $request->get('totalSuma')){
            $cambio = $suma_pagos - $request->get('totalSuma');
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $cambio;
            $caja->concepto = 'Cambio nota productos: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        $concepto = $request->get('concepto');
        $cantidad = $request->get('cantidad');
        $importe = $request->get('importe');

        for ($count = 0; $count < count($concepto); $count++) {
            if($concepto[$count] != NULL){
                $data = array(
                    'id_nota' => $nota->id,
                    'concepto' => $concepto[$count],
                    'cantidad' => $cantidad[$count],
                    'importe' => $importe[$count],
                );
                $insert_data[] = $data;

                // $producto = Products::where('nombre', $concepto[$count])->first();

                // Busca el producto en los productos obtenidos de la API
                $productsApi = $this->obtenerProductosDesdeAPI($request);
                $productsBundleApi = $this->obtenerProductosBundleDesdeAPI($request);

                $producto = $productsApi->firstWhere('nombre', $concepto[$count]);

                if($producto->subcategoria == 'Kit'){
                    // $productos_bundle = ProductosBundleId::where('id_product', $producto->id)->get();
                    $productoBundle = $productsBundleApi->where('id_product', $producto->id);
                    foreach($productoBundle as $producto_bundle){
                        $notas_inscripcion = new Pedido;
                        $notas_inscripcion->id_nota = $nota->id;
                        $notas_inscripcion->concepto = $producto_bundle->producto;
                        $notas_inscripcion->importe = '0';
                        $notas_inscripcion->cantidad = $producto_bundle->cantidad;
                        $notas_inscripcion->save();
                    }
                    $nota->id_kit = $producto->id;
                    $nota->update();
                }else{
                    if($concepto[$count] != NULL){
                        $notas_inscripcion = new Pedido;
                        $notas_inscripcion->id_nota = $nota->id;
                        $notas_inscripcion->concepto = $concepto[$count];
                        $notas_inscripcion->importe = $importe[$count];
                        $notas_inscripcion->cantidad = $cantidad[$count];
                        $notas_inscripcion->save();
                    }
                }
            }
        }

        $pedidos = Pedido::where('id_nota', '=', $nota->id)->get();
        $user_cosme = User::where('id','=',$request->get('id_user'))->first();

        $pedido_paquetes_data = []; // Inicializamos la variable antes del foreach

        foreach ($pedidos as $item) {
            $pedido = [];

            $pedido[] = $item->cantidad;
            $pedido[] = $item->concepto;
            $pedido[] = $item->importe;

            $pedido_paquetes_data[] = [
                'pedido' => $pedido,
            ];
        }

        $recibo = [
            "id" => $nota->id,
            "fecha" => $nota->fecha,
            "Metodo_pago" => $nota->metodo_pago,
            "Metodo_pago_2" => $request->get('metodo_pago2'),
            "Cliente" => $nota->Client->name,
            "Total" => $nota->total,
            "Restante" => $nota->restante,
            "Cambio" => $nota->cambio,
            "dinero_recibido" => $nota->dinero_recibido,
            "nombreImpresora" => "ZJ-58",
            'pago' => $pedido_paquetes_data, // Ahora contiene los datos del pedido
            'cosmetologa' => $user_cosme->name,
        ];

        return response()->json(['success' => true, 'recibo' => $recibo]);
    }

    public function edit(Request $request, $id){
         $cosme = auth()->user();
         $nota_pedido = NotasPedidos::find($id);
         $pedido = Pedido::get();
         $nota_pedido_cosme = NotasPedidos::where('id_user', '=',$cosme->id)->get();
         $client = Client::orderBy('name','ASC')->get();
         $user = User::where('id', '!=', 1)->get();
        //  $products = ProductosNAS::get();

        // Obtener productos a través del método común
        $products = $this->obtenerProductosDesdeAPI($request);

         return view('notas_pedidos.edit', compact('pedido', 'cosme', 'client','user','nota_pedido', 'nota_pedido_cosme','products'));
     }

     public function imprimir($id){
        $cosme = auth()->user();
        $nota_pedido = NotasPedidos::find($id);
        $pedido = Pedido::get();
        $nota_pedido_cosme = NotasPedidos::where('id_user', '=',$cosme->id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::get();

        $pdf = PDF::loadView('notas_pedidos.recibo_pdf_print',compact('pedido', 'cosme', 'client','user','nota_pedido', 'nota_pedido_cosme'));

        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0, 165, 500], 'portrait'); // Ancho: 58 mm, Alto: 500 mm (ajustar según tus necesidades)

        return $pdf->download('Recibo_'.$id.'.pdf');
    }

    public function show($id)
    {
        $nota = NotasPedidos::find($id);

        return view('notas_pedidos.show', compact('nota'));
    }

    public function eliminarProducto($id){
        $producto = Pedido::find($id);

        if ($producto) {
            $producto->delete();

            return response()->json(['message' => 'Producto eliminado correctamente']);
        }

        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    public function update(Request $request, $id)
    {

        $conceptoBuscar = 'Cambio nota productos: ' . $id;
        // Encuentra el registro en la tabla CajaDia que tiene el concepto con el ID de la nota
        $registroExistente = CajaDia::where('concepto', $conceptoBuscar)->first();

        // Si existe un registro con ese concepto, lo eliminamos
        if ($registroExistente) {
            CajaDia::where('concepto', $conceptoBuscar)->delete();
        }

        $nota = NotasPedidos::find($id);

        if($nota->total != $request->get('totalSuma') && $request->get('metodo_pago') == 'Efectivo'){
            $suma_pagos = $request->get('dinero_recibido') + $request->get('dinero_recibido2');

            if($request->get('dinero_recibido') > $request->get('totalSuma')){
                $cambio = $request->get('dinero_recibido') - $request->get('totalSuma');
                $fechaActual = date('Y-m-d');
                $caja = new CajaDia;
                $caja->motivo = 'Retiro';
                $caja->egresos = $cambio;
                $caja->concepto = 'Cambio nota productos: ' . $nota->id;
                $caja->fecha = $fechaActual;
                $caja->save();
            }elseif($suma_pagos > $request->get('totalSuma')){
                $cambio = $suma_pagos - $request->get('totalSuma');
                $fechaActual = date('Y-m-d');
                $caja = new CajaDia;
                $caja->motivo = 'Retiro';
                $caja->egresos = $cambio;
                $caja->concepto = 'Cambio nota productos: ' . $nota->id;
                $caja->fecha = $fechaActual;
                $caja->save();
            }
        }

        $concepto = $request->get('concepto');
        $cantidad = $request->get('cantidad');
        $importe = $request->get('importe');

        if($concepto[0] == null){

        }else{
            $insert_data = [];

            for ($count = 0; $count < count($concepto); $count++) {
                // Verificar si el producto contiene la palabra "Kit"

                if (Str::contains(strtolower($concepto[$count]), ['kit', 'paquete'])) {

                    $productsApi = $this->obtenerProductosDesdeAPI($request);
                    $productsBundleApi = $this->obtenerProductosBundleDesdeAPI($request);
                    $producto = $productsApi->firstWhere('nombre', $concepto[$count]);

                    // Insertar cada producto del bundle
                    $productoBundle = $productsBundleApi->where('id_product', $producto->id);

                    foreach($productoBundle as $producto_bundle){
                        $insert_data[] = [
                            'id_nota' => $nota->id,
                            'concepto' => $producto_bundle->producto,
                            'cantidad' => $producto_bundle->cantidad,
                            'importe' => 0, // Bundle no tiene importe directo
                        ];
                    }
                }else {
                    // Producto normal, agregarlo directamente
                    $insert_data[] = [
                        'id_nota' => $nota->id,
                        'concepto' => $concepto[$count],
                        'cantidad' => $cantidad[$count],
                        'importe' => $importe[$count],
                    ];
                }
            }

            // Guardar todos los registros en la tabla Pedido
            Pedido::insert($insert_data);
        }


        $sum = 0;
        if($request->get('totalSuma') == NULL){
            $nota->total = $request->get('total_anterior');
        }else if($nota->id_kit != NULL){
            $nota->total = $request->get('total_anterior');
        }else{
            $nota->total = $request->get('totalSuma');
        }
        $nota->id_user = $request->get('id_user');
        $nota->id_client = $request->get('id_client');
        $nota->descuento = $request->get('descuento_porcentaje');
        $nota->metodo_pago = $request->get('metodo_pago');
        $nota->dinero_recibido = $request->get('dinero_recibido');
        $nota->metodo_pago2 = $request->get('metodo_pago2');
        $nota->dinero_recibido2 = $request->get('dinero_recibido2');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/foto_producto';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->foto = $fileName;
        }
        $nota->update();

        $user_cosme = User::where('id','=',$request->get('id_user'))->first();

        $pedidos = Pedido::where('id_nota', '=', $nota->id)->get();

        foreach ($pedidos as $item) {

            $pedido = [];

            $pedido[] = $item->cantidad;
            $pedido[] = $item->concepto;
            $pedido[] = $item->importe;

            $pedido_paquetes_data[] = [
                'pedido' => $pedido,
            ];
        }

        $recibo = [
            "id" => $nota->id,
            "fecha" => $nota->fecha,
            "Metodo_pago" => $nota->metodo_pago,
            "Metodo_pago_2" => $request->get('metodo_pago2'),
            "Cliente" => $nota->Client->name,
            "Total" => $nota->total,
            "Restante" => $nota->restante,
            "Cambio" => $nota->cambio,
            "dinero_recibido" => $nota->dinero_recibido,
            "nombreImpresora" => "ZJ-58",
            'pago' => $pedido_paquetes_data,
            'cosmetologa' => $user_cosme->name,
            // Agrega cualquier otro dato necesario para el recibo
        ];

        return response()->json(['success' => true, 'recibo' => $recibo]);
    }

    public function update_estatus(Request $request, $id){
        $nota = NotasPedidos::find($id);
        $nota->estatus = $request->get('estatus_cotizacion');
        $nota->update();

        return redirect()->back()->with('edit','Nota Productos Actualizado.');
    }

    public function destroy($id)
    {
            //         $pago = Pagos::where('id_nota', '=', $id)->delete();
            // dd($pago);
            // for(){

            // }

        $nota = NotasPedidos::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('notas_pedidos.index')
            ->with('success', 'nota deleted successfully');
    }

    public function index_cabinas(Request $request)
    {
        // Capturamos los parámetros de fecha
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Verificamos si los parámetros están presentes para filtrar
        if ($startDate && $endDate) {
            // Filtramos por el rango de fechas
            $nota_pedido = NotaReposicion::whereBetween('fecha', [$startDate, $endDate])
                            ->where('estatus_reposicion', '=', 'Pendiente')
                            ->orderBy('id', 'DESC')
                            ->get();
        } else {
            // Si no se proporcionan fechas, traemos los registros del mes actual
            $nota_pedido = NotaReposicion::whereMonth('fecha', date('m'))
                            ->whereYear('fecha', date('Y'))
                            ->where('estatus_reposicion', '=', 'Pendiente')
                            ->orderBy('id', 'DESC')
                            ->get();
        }

        $nota_pedidoEnviada = NotaReposicion::where('estatus_reposicion', '=', 'Enviado')
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('notas_pedidos.cabinas.index', compact('nota_pedido', 'nota_pedidoEnviada'));
    }

    public function create_cabinas(Request $request)
    {
        $products = $this->obtenerProductosDesdeAPI($request);
        $productos_recepcion = $this->obtenerProductosDesdeAPI($request)
        ->whereIn('id', [1302, 1301, 1300, 1726, 1299, 1329, 1334, 1377, 1330, 1332, 1342, 1343, 1694, 1695, 1693])
        ->values();

        $productos_manos = $this->obtenerProductosDesdeAPI($request)
            ->whereIn('id', [1282, 1692, 1673, 1691, 1690, 1363, 1348, 1309])
            ->values();

        $productos_pies = $this->obtenerProductosDesdeAPI($request)
            ->whereIn('id', [1363, 1597, 1348])
            ->values();

        $productos_despedidas = $this->obtenerProductosDesdeAPI($request)
            ->whereIn('id', [1317,1275, 1282, 1393, 1365, 1596, 1320, 1322, 1284, 1283, 1382, 1293, 1311, 1318,1285,1402,1379,1311,1928,1678,1773,1774	])
            ->values();

        return view('notas_pedidos.cabinas.create', [
            'productos_recepcion' => $productos_recepcion->toArray(),
            'productos_manos' => $productos_manos->toArray(),
            'productos_pies' => $productos_pies->toArray(),
            'products' => $products->toArray(),
            'productos_despedidas' => $productos_despedidas->toArray(),
        ]);
    }

    public function store_cabinas(Request $request)
    {

        $fechaActual = date('Y-m-d');


        $nota = new NotaReposicion;
        $nota->id_user = auth()->user()->id;
        $nota->cabina = $request->get('cabina');
        $nota->estatus_reposicion = 'Pendiente';
        $nota->nota_reposicion = $request->get('nota_reposicion');
        $nota->fecha = $fechaActual;
        $nota->save();

        $concepto = $request->get('producto');

        for ($count = 0; $count < count($concepto); $count++) {
            if($concepto[$count] != NULL){
                $data = array(
                    'id_nota' => $nota->id,
                    'concepto' => $concepto[$count],
                );
                $insert_data[] = $data;

                // $producto = Products::where('nombre', $concepto[$count])->first();

                // Busca el producto en los productos obtenidos de la API
                $productsApi = $this->obtenerProductosDesdeAPI($request);
                $productsBundleApi = $this->obtenerProductosBundleDesdeAPI($request);

                $producto = $productsApi->firstWhere('nombre', $concepto[$count]);

                if($concepto[$count] != NULL){
                    $notas_inscripcion = new NotaReposicionProducto;
                    $notas_inscripcion->id_nota = $nota->id;
                    $notas_inscripcion->concepto = $concepto[$count];
                    $notas_inscripcion->cantidad = 1;
                    $notas_inscripcion->save();
                }
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas_cabinas.index')->with('success', 'Creado exitosamente.');
    }

    public function liga_reposicion($id){
        $pedido = NotaReposicion::where('id', $id)->first();
        $pedido_productos = NotaReposicionProducto::where('id_nota', $id)->get();

        $pedido_original = NotaReposicion::where('id', '!=', $pedido->id)->where('cabina', $pedido->cabina)->orderBy('fecha','desc')->first();
        if($pedido_original != NULL){
            $pedido_original_productos = NotaReposicionProducto::where('id_nota', $pedido_original->id)->get();
        }else{
            $pedido_original_productos = [];
        }
        return view('notas_pedidos.cabinas.firma', compact('pedido', 'pedido_productos', 'pedido_original', 'pedido_original_productos'));
    }

    public function update_cabinas(Request $request, $id)
    {
        $fechaActual = date('Y-m-d');
        $nota = NotaReposicion::find($id);
        if($request->signed != NULL){
            $folderPath = public_path('firma_reposicion/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $nota->firma_reposicion = $signature;
        }
        $nota->fecha_aprobado = $fechaActual;
        $nota->estatus_reposicion = 'Aprobada';
        $nota->update();

        return redirect()->back()->with('success','Reposicion aceptada');
    }
}
