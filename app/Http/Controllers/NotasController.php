<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alertas;
use App\Models\CajaDia;
use App\Models\Notas;
use App\Models\User;
use App\Models\Client;
use App\Models\NotasCosmes;
use App\Models\NotasExtras;
use App\Models\NotasPropinas;
use App\Models\NotasPaquetes;
use App\Models\NotasSesion;
use App\Models\Pagos;
use App\Models\Reporte;
use App\Models\Servicios;
use App\Models\Bitacora;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;
Use Alert;
use App\Models\AlertasCosmes;
use App\Models\NotasPedidos;
use App\Models\Pedido;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\ProductosNAS;
use Illuminate\Support\Facades\Http;

class NotasController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota = Notas::orderBy('id', 'DESC')
        ->select('id', 'fecha', 'restante', 'id_client', 'id_servicio')
        ->get();

        return view('notas.index', compact('nota'));
    }

    public function index_pendientes()
    {
        $nota = Notas::where('restante', '>', 0)->where('anular', '=', NULL)
        ->where('cancelado', '=', NULL)->orderBy('id','DESC')->get();

        $nota_cosme = NotasCosmes::orderBy('id','DESC')->get();

        return view('notas.index_pendientes', compact('nota', 'nota_cosme'));
    }

    public function index_completadas()
    {
        $nota = Notas::where('restante', '<=', 0)->where('anular', '=', NULL)
        ->where('cancelado', '=', NULL)->orderBy('id','DESC')->get();

        $nota_cosme = NotasCosmes::get();

        return view('notas.index_completadas', compact('nota', 'nota_cosme'));
    }

    public function advance(Request $request, Notas $nota) {
        $nota_cosme = NotasCosmes::get();

        if( $request->id_client){
            $id_client = $request->id_client;
            $nota = Notas::whereHas('Client', function(Builder $query) use($id_client) {
                     $query->where('name', $id_client);
            });
        }

        if( $request->id){
            $nota = $nota->where('id', 'LIKE', "%" . $request->id . "%");
        }

        $nota = $nota->paginate();

        return view('notas.index', compact('nota', 'nota_cosme'));
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

    public function create(Request $request) {

        $client = Client::orderBy('name','ASC')->get();
        $servicio = Servicios::orderBy('nombre','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        // $products = ProductosNAS::get();

        // Obtener productos a través del método común
        $products = $this->obtenerProductosDesdeAPI($request);

        return view('notas.create',compact('client', 'servicio', 'user', 'products'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_servicio' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // N U E V O  U S U A R I O
        $fechaActual = date('Y-m-d');
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           //$client->email = $request->get('email');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota = new Notas;
        if($request->get('name') != NULL){
            $nota->id_client = $client->id;
        }else{
            $nota->id_client = $request->get('id_client');
        }
        $nota->fecha = $fechaActual;
        $nota->nota = $request->get('nota');
        $nota->precio = $request->get('total-suma');
        $nota->restante = $request->get('restante');

        if($request->signed_ini != NULL){
            $folderPath = public_path('firmas_notas/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $nota->firma = $signature;
        }

        $nota->save();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I |
        // if($request->get('cambio') > '0'){
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->egresos = $request->get('cambio');
            $caja->motivo = 'Retiro';
            $caja->concepto = 'Cambio nota servicio: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        // G U A R D A R  S E R V I C I O
        $nota_paquete = new NotasPaquetes;
        $nota_paquete->id_nota = $nota->id;
        $nota_paquete->id_servicio = $request->get('id_servicio');
        $nota_paquete->num = $request->get('num1');
        $nota_paquete->descuento = $request->get('descuento');

        $nota_paquete->id_servicio2 = $request->get('id_servicio2');
        $nota_paquete->num2 = $request->get('num2');
        $nota_paquete->descuento2 = $request->get('descuento2');

        $nota_paquete->id_servicio3 = $request->get('id_servicio3');
        $nota_paquete->num3 = $request->get('num3');
        $nota_paquete->descuento3 = $request->get('descuento3');

        $nota_paquete->id_servicio4 = $request->get('id_servicio4');
        $nota_paquete->num4 = $request->get('num4');
        $nota_paquete->descuento4 = $request->get('descuento4');

        $nota_paquete->save();

        // G U A R D A R  S E S I O N
        if($request->get('sesion') != NULL){
            $nota_sesion = new NotasSesion();
            $nota_sesion->id_nota = $nota->id;
            $nota_sesion->fecha = $request->get('fecha_sesion');
            $nota_sesion->sesion = $request->get('sesion');
            $nota_sesion->nota = $request->get('nota3');
            $nota_sesion->start = $request->get('start');
            $nota_sesion->end = $request->get('end');
            $nota_sesion->resourceId = $request->get('resourceId');
            $nota_sesion->save();

            $status = Status::find(1);
            $client =  Client::find($nota->id_client);
            $img =  Servicios::find($request->get('id_servicio'));
            $full_name = $client->name.$client->last_name;
            $especialista = $request->get('id_user');

            $datosEvento = new Alertas;
            $datosEvento->start = $nota_sesion->start;
            $datosEvento->end = $nota_sesion->end;
            $datosEvento->id_color = $request->id_color;
            $datosEvento->id_nota = $nota->id;
            $datosEvento->id_status = $status->id;
            $datosEvento->estatus = $status->estatus;
            $datosEvento->color = $status->color;
            $datosEvento->id_client = $client->id;
            $datosEvento->title = $full_name;
            $datosEvento->telefono = $client->phone;
            $datosEvento->resourceId = $nota_sesion->resourceId;
            $datosEvento->id_especialist = $especialista[0];
            $datosEvento->descripcion = "Agendado desde Notas";
            $datosEvento->image = asset('img/iconos_serv/'.$img->imagen);

            if ( $datosEvento->end == $datosEvento->start){
                $now = date($datosEvento->end);
                $now2 = date($datosEvento->start);

                $new_time = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now; // Combinar la fecha y hora
                $new_time_aumentada = date("Y-m-d H:i", strtotime('+1 hour', strtotime($new_time)));

                $new_time2 = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now2; // Combinar la fecha y hora
                $new_time_aumentada2 = date("Y-m-d H:i", strtotime('+1 hour', strtotime($new_time2)));

                $datosEvento->end = $new_time_aumentada;
                $datosEvento->start = $new_time_aumentada2;
            }else{
                $now = date($datosEvento->end);
                $now2 = date($datosEvento->start);
                $new_time = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now;
                $new_time2 = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now2;
                $datosEvento->end = $new_time;
                $datosEvento->start = $new_time2;
            }
            // dd($datosEvento);
            $datosEvento->save();

        }

        // G U A R D A R  C O S M E S
        $id_user = $request->get('id_user');
        for ($count = 0; $count < count($id_user); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'id_user' => $id_user[$count],
            );
            $insert_data2[] = $data;
        }

        NotasCosmes::insert($insert_data2);

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){

            $pago = new Pagos;
            $pago->id_nota = $nota->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->cosmetologa = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_servicios';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();


            if($request->get('forma_pago') == 'Tarjeta'){

                // Define las credenciales de la API
                // $apiKey = '70f7c836-9e76-4303-ad9f-e9768633da6d';
                // $clave = '0d32cc34-098a-455b-8873-f4c0434e44e0';

                $apiKey = '23bb7433-1bae-4f0d-92f9-dc96990a8efb';
                $clave = 'd9a61a7b-2658-41d2-96b8-f6d235dfb5e9';
                //$token = 'Basic MjNiYjc0MzMtMWJhZS00ZjBkLTkyZjktZGM5Njk5MGE4ZWZiOmQ5YTYxYTdiLTI2NTgtNDFkMi05NmI4LWY2ZDIzNWRmYjVlOQ==';
                // Genera el token de autorización
                $token = base64_encode($apiKey . ':' . $clave);

                if($request->get('name') != NULL){
                   $nombre_cliente = $request->get('name');
                }else{
                    $client =  Client::find($request->get('id_client'));
                    $nombre_cliente = $client->name;
                }

                $cajera_id =  User::find($pago->cosmetologa);
                $cajera = $cajera_id->name;


                $amount = $request->get('pago');
                $assigned_user = 'adrianwebtech@gmail.com';
                $reference = $nota->id;
                $message = 'Nota :#'.$nota->id.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

                // Realiza la solicitud GET a la API de Clip
               $client_gz = new GuzzleClient();

                // Formatear los datos como JSON
                $data_items = [
                    'amount' => (int)$amount,
                    'assigned_user' => $assigned_user,
                    'reference' => $reference,
                    'message' => $message
                ];

                $jsonData = json_encode($data_items);


                $response = $client_gz->request('POST', 'https://api-gw.payclip.com/paymentrequest', [
                    'body' => $jsonData,
                    'headers' => [
                        'accept' => 'application/vnd.com.payclip.v1+json',
                        'content-type' => 'application/json; charset=UTF-8',
                        'x-api-key' => 'Basic ' . $token,
                      ],

                ]);

              //  $body = $response->getBody()->getContents();

                // Decodificar el cuerpo si es JSON
               // $data = json_decode($body, true);
            }

        }

        // G U A R D A R  E X T R A S
        if($request->get('concepto') != NULL){
            $notas_extra = new NotasExtras;
            $notas_extra->id_nota = $nota->id;
            $notas_extra->concepto = $request->get('concepto');
            $notas_extra->precio = $request->get('precio');
            $notas_extra->save();
        }

        // inicio de code ajax
        $notas_paquetes = NotasPaquetes::where('id_nota', '=',$nota->id)
        ->first();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $nota->id)
        ->get();

        foreach ($nota_cosme as $notacosme){
            $cadena = $notacosme->User->name;
        }

        $servicio = $notas_paquetes->Servicios->nombre;
        if ($notas_paquetes->id_servicio2 !== null) {
            $servicio .= ' ' . $notas_paquetes->Servicios2->nombre;
        }

        if ($notas_paquetes->id_servicio3 !== null) {
            $servicio .= ' ' . $notas_paquetes->Servicios3->nombre;
        }

        if ($notas_paquetes->id_servicio4 !== null) {
            $servicio .= ' ' . $notas_paquetes->Servicios4->nombre;
        }

        if ($request->get('producto_concepto') !== null) {
            $cosme_id = NotasCosmes::where('id_nota', '=', $nota->id)
            ->first();
            $nota_pedido = new NotasPedidos;
            $nota_pedido->id_user = $cosme_id->id_user;
            $nota_pedido->estatus = 'Aprobada';
            $nota_pedido->aprobado_hora_y_guia = date("Y-m-d H:i:s");
            $nota_pedido->id_client = $nota->id_client;
            $nota_pedido->metodo_pago = 'Gratis';
            $nota_pedido->fecha = $fechaActual;
            $nota_pedido->descuento = '0';
            $nota_pedido->total = 0.0;
            $nota_pedido->restante = '0';
            $nota_pedido->dinero_recibido = '0';
            $nota_pedido->save();


            $nota_producto = new Pedido;
            $nota_producto->id_nota = $nota_pedido->id;
            $nota_producto->concepto = $request->get('producto_concepto');
            $nota_producto->cantidad = 1;
            $nota_producto->importe = 0;
            $nota_producto->save();
        }

        $recibo = [
            "id" => $nota->id,
            "Cliente" => $nota->Client->name,
            "Total" => $nota->precio,
            "Restante" => $nota->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => [$pago],
            'cosmetologa' => $cadena,
            'notas_paquetes' => $servicio,
            // Agrega cualquier otro dato necesario para el recibo
        ];

        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);

        // return redirect()->route('notas.edit',$nota->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = Notas::find($id);

        return view('notas.show', compact('nota'));
    }

    public function edit($id)
    {
        $notas = Notas::find($id);
        $client = Client::orderBy('name','ASC')->get();
        $servicio = Servicios::orderBy('nombre','ASC')->get();

        $pago = Pagos::where('id_nota', '=', $id)->get();
        $notas_paquetes = NotasPaquetes::get();
        $notas_extras = NotasExtras::where('id_nota', '=', $id)->get();
        $notas_propinas = NotasPropinas::where('id_nota', '=', $id)->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)->get();
        $user = User::where('id', '!=', 1)->get();

        $sesiones = Alertas::where('id_nota', $id)
        ->groupBy('id_nota', 'start')
        ->select('id_nota', 'start', 'estatus', 'descripcion', \DB::raw('MIN(id) as id'))  // Puedes seleccionar más columnas si lo necesitas
        ->get();

        return view('notas.edit',compact('client', 'servicio', 'user', 'pago', 'nota_cosme', 'notas_paquetes', 'notas_extras','notas_propinas', 'notas', 'sesiones'));
    }

    public function propina_store(Request $request){
        $notas_propinas = new NotasPropinas;
        $fechaActual = date('Y-m-d');
        $notas_propinas->id_user = $request->get('id_user_propina');
        $notas_propinas->propina = $request->get('propina');
        $notas_propinas->metdodo_pago = $request->get('forma_pago_propina');
        $notas_propinas->fecha = $fechaActual;
        $notas_propinas->save();

        Session::flash('success', 'Se ha creado propina con exito');
        return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notas $nota
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $nota = Notas::find($id);
        $nota->anular = $request->get('anular');
        $nota->id_client = $request->get('id_client');
        $nota->nota = $request->get('nota');
        $nota->restante = $request->get('restante_paquetes');
        if($request->signed_ini != NULL){
            $folderPath = public_path('firmas_notas/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $nota->firma = $signature;
        }
        $nota->update();

        if ($request->has('editarsi')) {

            $usuario = auth()->user()->name;

            $pago_ids = $request->get('pago_id_edit');
            $fechas_pago = $request->get('fecha_pago_edit');
            $cosmetologas = $request->get('cosmetologa_edit');
            $pagos = $request->get('pago_edit');
            $dineros_recibidos = $request->get('dinero_recibido_edit');
            $formas_pago = $request->get('forma_pago_edit');
            $notas = $request->get('nota_edit');

            // Iterar sobre los datos y guardar en la base de datos
            foreach ($pago_ids as $key => $pago_id) {
                $pago = Pagos::find($pago_id);

                // Guardar los valores actuales antes de la actualización para este registro
                $antes = $pago->getAttributes(); // Obtiene los atributos actuales

                // Actualizar el registro
                $pago->id_nota = $id;
                $pago->fecha = $fechas_pago[$key];
                $pago->cosmetologa = $cosmetologas[$key];
                $pago->pago = $pagos[$key];
                $pago->dinero_recibido = $dineros_recibidos[$key];
                $pago->forma_pago = $formas_pago[$key];
                $pago->nota = $notas[$key];
                // Calcular cambio si dinero_recibido es mayor que pago
                    if ($pago->dinero_recibido > $pago->pago) {
                        $pago->cambio = $pago->dinero_recibido - $pago->pago;
                    } else {
                        $pago->cambio = 0; // No hay cambio si dinero_recibido no es mayor que pago
                    }
                $pago->save();

                if ($pago->cambio > 0 && $pago->forma_pago == 'Efectivo') {
                    $fechaActual = date('Y-m-d');
                    $concepto = 'Cambio nota servicio: ' . $id;

                    // Buscar el registro existente en CajaDia
                    $cajaExistente = CajaDia::where('concepto', $concepto)
                        ->where('fecha', $fechaActual)
                        ->first();

                    if ($cajaExistente) {
                        // Actualizar el registro existente
                        $cajaExistente->egresos = $pago->cambio;
                        $cajaExistente->update();
                    } else {
                        // Crear un nuevo registro
                        $caja = new CajaDia;
                        $caja->motivo = 'Cambio nota servicio: ' . $id;
                        $caja->egresos = $pago->cambio;
                        $caja->concepto = $concepto;
                        $caja->fecha = $fechaActual;
                        $caja->save();
                    }
                }

                // Guardar los cambios en la bitácora después de la actualización
                $despues = $pago->getAttributes(); // Obtiene los nuevos atributos

                Bitacora::create([
                    'id_nota' => $pago->id_nota,
                    'id_pago' => $pago->id,
                    'usuario' => $usuario,
                    'tipo' => 'Actualizacion',
                    'antes' => json_encode($antes),
                    'despues' => json_encode($despues),
                    'fecha' => now()
                ]);
            }

        }

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I O
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $request->get('cambio');
            $caja->concepto = 'Cambio nota servicio: ' . $id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        // G U A R D A R  C O S M E S
        $id_notas_cosmes = $request->get('id_notas_cosmes');
        $id_user = $request->get('id_user');
        for ($count = 0; $count < count($id_user); $count++) {

            $data = array(
                // 'id' =>  $id_notas_cosmes[$count],
                'id_user' => $id_user[$count],
            );
            $insert_data2[] = $data;
            NotasCosmes::find($id_notas_cosmes)->update($data);
        }

        // G U A R D A R  E X T R A S
        if($request->get('concepto') != NULL){
            $notas_extra = new NotasExtras;
            $notas_extra->id_nota = $nota->id;
            $notas_extra->concepto = $request->get('concepto');
            $notas_extra->precio = $request->get('precio');
            $notas_extra->save();
        }

        // G U A R D A R   P R O P I N A S
        if($request->get('propina') != NULL){
            $notas_propinas = new NotasPropinas;
            $notas_propinas->id_nota = $nota->id;
            $notas_propinas->id_user = $request->get('id_user_propina');
            $notas_propinas->propina = $request->get('propina');
            $notas_propinas->metdodo_pago = $request->get('forma_pago_propina');
            $notas_propinas->save();
        }

        // G U A R D A R  P A G O S
        if($request->get('pago') != NULL){
            $pago = new Pagos;
            $pago->id_nota = $nota->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->cosmetologa = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_servicios';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();


            if($request->get('forma_pago') == 'Tarjeta'){

                // Define las credenciales de la API
                $apiKey = '70f7c836-9e76-4303-ad9f-e9768633da6d';
                $clave = '0d32cc34-098a-455b-8873-f4c0434e44e0';

                // Genera el token de autorización
                $token = base64_encode($apiKey . ':' . $clave);

                if($request->get('name') != NULL){
                   $nombre_cliente = $request->get('name');
                }else{
                    $client =  Client::find($request->get('id_client'));
                    $nombre_cliente = $client->name;
                }

                $cajera_id =  User::find($pago->cosmetologa);
                $cajera = $cajera_id->name;


                $amount = $request->get('pago');
                $assigned_user = 'ventas@paradisus.com.mx';
                $reference = $nota->id;
                $message = 'Nota :#'.$nota->id.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

                // Realiza la solicitud GET a la API de Clip
              //  $client = new GuzzleClient();

                // Formatear los datos como JSON
                $data_items = [
                    'amount' => (int)$amount,
                    'assigned_user' => $assigned_user,
                    'reference' => $reference,
                    'message' => $message
                ];


                $jsonData = json_encode($data_items);

                $response = $client->request('POST', 'https://api-gw.payclip.com/paymentrequest', [
                    'body' => $jsonData,
                    'headers' => [
                        'accept' => 'application/vnd.com.payclip.v1+json',
                        'content-type' => 'application/json; charset=UTF-8',
                        'x-api-key' => 'Basic ' . $token,
                      ],

                ]);

              //  $body = $response->getBody()->getContents();

                // Decodificar el cuerpo si es JSON
             //   $data = json_decode($body, true);

            }

        }else{
            $pago = '';
        }

        // G U A R D A R  S E R V I C I O
        $id_notas_paquetes = $request->get('id_notas_paquetes');

        $nota_paquete = NotasPaquetes::find($id_notas_paquetes);

        // G U A R D A R  S E R V I C I O
            $id_notas_paquetes = $request->get('id_notas_paquetes');

            $nota_paquete = NotasPaquetes::find($id_notas_paquetes);
            $nota_paquete->id_servicio = $request->get('id_servicio');
            $nota_paquete->num = $request->get('num1_paquetes');
            $nota_paquete->descuento = $request->get('descuento-adicional1_paquetes');

            $nota_paquete->id_servicio2 = $request->get('id_servicio2');
            $nota_paquete->num2 = $request->get('num2_paquetes');
            $nota_paquete->descuento2 = $request->get('descuento-adicional2_paquetes');

            $nota_paquete->id_servicio3 = $request->get('id_servicio3');
            $nota_paquete->num3 = $request->get('num3_paquetes');
            $nota_paquete->descuento3 = $request->get('descuento-adicional3_paquetes');

            $nota_paquete->id_servicio4 = $request->get('id_servicio4');
            $nota_paquete->num4 = $request->get('num4_paquetes');
            $nota_paquete->descuento4 = $request->get('descuento-adicional4_paquetes');
            $nota_paquete->update();

            // Recupera los ID de los servicios del formulario
            $servicioIds = [
                $request->get('id_servicio'),
                $request->get('id_servicio2'),
                $request->get('id_servicio3'),
                $request->get('id_servicio4'),
            ];
            $notasExtras = NotasExtras::where('id_nota', $id)->get();
            $notasPropinas = NotasPropinas::where('id_nota', $id)->get();

            $totalSuma = 0;
            $precio = 0;
            $extras = 0;
            $propinas = 0;
            foreach ($servicioIds as $index => $servicioId) {
                if ($servicioId) {
                    $servicio = Servicios::find($servicioId);
                    $descuentoAdicionalCampo = "descuento-adicional" . ($index + 1) . "_paquetes";
                    $descuentoAdicional = $request->get($descuentoAdicionalCampo);

                    // Verifica si el servicio tiene descuento
                    if ($servicio->act_descuento === 1) {
                        // Si tiene descuento, usa el precio de la columna "descuento"
                        $precio = $servicio->descuento;
                    }elseif(!is_null($descuentoAdicional) && is_numeric($descuentoAdicional)){
                        // Aplica el descuento adicional en porcentaje
                        $descuentoPorcentaje = $descuentoAdicional / 100;
                        $precio = ($servicio->precio * (1 - $descuentoPorcentaje));
                    } else {
                        // Si no tiene descuento o es NULL, usa el precio de la columna "precio"
                        $precio = $servicio->precio;
                    }

                    // Obtén el número de paquetes para este servicio
                    $numPaquetesCampo = "num" . ($index + 1) . "_paquetes";
                    $numPaquetes = $request->get($numPaquetesCampo);

                    // Multiplica el precio por la cantidad de paquetes
                    $totalSuma += $precio * $numPaquetes;
                }
            }
            // Sumar los precios de las NotasExtras
            foreach ($notasExtras as $notaExtra) {
                $extras += $notaExtra->precio;
            }
            // Sumar los precios de las notasPropinas
            foreach ($notasPropinas as $notaPropina) {
                $propinas += $notaPropina->precio;
            }
            $sum = $totalSuma + $extras + $propinas;

            $pagos = Pagos::where('id_nota', $id)->get();
            $totalPagos = $pagos->sum('pago');

            $restante =  $sum - $totalPagos;

            $nota = Notas::find($id);
            $nota->precio = $sum;
            $nota->restante = $restante;
            $nota->update();
        // E N D  G U A R D A R  S E R V I C I O

        if($request->get('sesion') != NULL){
            $nota_sesion = new NotasSesion;
            $nota_sesion->id_nota = $nota->id;
            $nota_sesion->fecha = $request->get('fecha_sesion');
            $nota_sesion->sesion = $request->get('sesion');
            $nota_sesion->nota = $request->get('nota3');
            $nota_sesion->start = $request->get('start');
            $nota_sesion->end = $request->get('end');
            $nota_sesion->resourceId = $request->get('resourceId');
            $nota_sesion->save();

            $status = Status::find(1);
            $client =  Client::find($nota->id_client);
            $img =  Servicios::find($request->get('id_servicio'));
            $full_name = $client->name.$client->last_name;
            $especialista = $request->get('id_user');

            $datosEvento = new Alertas;
            $datosEvento->start = $nota_sesion->start;
            $datosEvento->end = $nota_sesion->end;
            $datosEvento->id_color = $request->id_color;
            $datosEvento->id_nota = $nota->id;
            $datosEvento->id_status = $status->id;
            $datosEvento->estatus = $status->estatus;
            $datosEvento->color = $status->color;
            $datosEvento->id_client = $client->id;
            $datosEvento->title = $full_name;
            $datosEvento->telefono = $client->phone;
            $datosEvento->resourceId = $nota_sesion->resourceId;
            $datosEvento->id_especialist = $especialista[0];
            $datosEvento->descripcion = "Agendado desde Notas. " . $request->get('nota3');
            $datosEvento->image = asset('img/iconos_serv/'.$img->imagen);

            if ( $datosEvento->end == $datosEvento->start){
                $now = date($datosEvento->end);
                $now2 = date($datosEvento->start);

                $new_time = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now; // Combinar la fecha y hora
                $new_time_aumentada = date("Y-m-d H:i", strtotime('+1 hour', strtotime($new_time)));

                $new_time2 = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now2; // Combinar la fecha y hora
                $new_time_aumentada2 = date("Y-m-d H:i", strtotime('+1 hour', strtotime($new_time2)));

                $datosEvento->end = $new_time_aumentada;
                $datosEvento->start = $new_time_aumentada2;
            }else{
                $now = date($datosEvento->end);
                $now2 = date($datosEvento->start);
                $new_time = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now;
                $new_time2 = date("Y-m-d", strtotime($nota_sesion->fecha)) . " " . $now2;
                $datosEvento->end = $new_time;
                $datosEvento->start = $new_time2;
            }
            //dd($datosEvento);
            $datosEvento->save();
        }

        $pago_reciente = Pagos::where('id_nota', '=', $nota->id)->orderBy('id','DESC')->first();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        foreach ($nota_cosme as $notacosme){
            $cadena = $notacosme->User->name;
        }

        $notas_paquetes = NotasPaquetes::where('id_nota', '=', $id)
        ->first();

        $servicio = $notas_paquetes->Servicios->nombre;

        if ($notas_paquetes->id_servicio2 !== null) {
            $servicio .= ' ' . $notas_paquetes->Servicios2->nombre;
        }

        if ($notas_paquetes->id_servicio3 !== null) {
            $servicio .= ' ' . $notas_paquetes->Servicios3->nombre;
        }

        if ($notas_paquetes->id_servicio4 !== null) {
            $servicio .= ' ' . $notas_paquetes->Servicios4->nombre;
        }


        $recibo = [
            "id" => $nota->id,
            "Cliente" => $nota->Client->name,
            "Total" => $nota->precio,
            "Restante" => $nota->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => [$pago],
            'cosmetologa' => $cadena,
            'notas_paquetes' => $servicio,
            // Agrega cualquier otro dato necesario para el recibo
        ];
        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);


        Alert::success('Actualizado con exito ');

        return redirect()->back()->with('edit','Nota Servicio Actualizado.');
    }

    public function ChangeCosme(Request $request)
    {
        $pagos = Pagos::find($request->id);
        $pagos->cosmetologa = $request->cosmetologa;
        $pagos->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $nota = Notas::findOrFail($id);

        // Borra las relaciones one-to-many y one-to-one
        $nota->Encuesta()->delete();
        $nota->Pagos()->delete();
        $nota->NotasCosmes()->delete();
        $nota->NotasPaquetes()->delete();
        $nota->NotasPropinas()->delete();
        // Si tienes NotasExtras, añade también:
        if (method_exists($nota, 'Extras')) {
            $nota->Extras()->delete();
        }

        // Finalmente borras la propia nota
        $nota->delete();

        Session::flash('delete', 'Se ha eliminado la nota y todos sus datos relacionados con éxito');
        return redirect()->route('notas.index');
    }


    public function usuario($id)
    {
        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        $notas_paquetes = NotasPaquetes::where('id_nota', '=', $id)
        ->get();

        return view('clientes.notas.show', compact('notas_pedidos', 'pago', 'nota_cosme', 'notas_paquetes'));
    }

    public function imprimir($id){
        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        $notas_paquetes = NotasPaquetes::where('id_nota', '=', $id)
        ->get();

        $pdf = PDF::loadView('notas.recibo_pdf_print',compact('notas_pedidos', 'pago', 'nota_cosme', 'notas_paquetes'));

        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0, 165, 500], 'portrait'); // Ancho: 58 mm, Alto: 500 mm (ajustar según tus necesidades)

        return $pdf->download('Recibo_'.$id.'.pdf');
    }


    public function imprimir2($id){

        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        $notas_paquetes = NotasPaquetes::where('id_nota', '=', $id)
        ->get();

        foreach ($nota_cosme as $nota){
            $cadena = $nota->User->name;
        }

        foreach ($notas_paquetes as $item) {
            $servicios = [];

            $servicios[] = $item->Servicios->nombre;

            if ($item->id_servicio2 != NULL || $item->id_servicio2 != 0) {
                $servicios[] = $item->Servicios2->nombre;
            }

            if ($item->id_servicio3 != NULL || $item->id_servicio3 != 0) {
                $servicios[] = $item->Servicios3->nombre;
            }

            if ($item->id_servicio4 != NULL || $item->id_servicio4 != 0) {
                $servicios[] = $item->Servicios4->nombre;
            }

            $notas_paquetes_data[] = [
                'servicios' => $servicios,
            ];
        }

        $recibo = [
            "id" => $notas_pedidos->id,
            "Cliente" => $notas_pedidos->Client->name ,
            "Total" => $notas_pedidos->precio,
            "Restante" => $notas_pedidos->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => $pago,
            'cosmetologa' => $cadena,
            'notas_paquetes' => $notas_paquetes_data,
            // Agrega cualquier otro dato necesario para el recibo
        ];


        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);

    }

    public function usuario_print($id){
        $today =  date('d-m-Y');
        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        $pdf = \PDF::loadView('notas.recibo_pdf', compact('today', 'notas_pedidos', 'pago', 'nota_cosme'));
        return $pdf->stream();
       // return $pdf->download('Reporte Caja '.$today.'.pdf');
    }
}
