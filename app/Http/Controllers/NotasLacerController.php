<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\ConfiguracionLaser;
use App\Models\Laser;
use App\Models\NotasLacer;
use App\Models\User;
use App\Models\ZonasLaser;
use App\Models\PagosLaser;
use App\Models\RegistroZonas;
use App\Models\HojaSaludLaser;
use GuzzleHttp\Client as GuzzleClient;
Use Alert;
use App\Models\ConsentimientoLaser;
use App\Models\RegCosmesSum;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;

use Illuminate\Http\Request;

class NotasLacerController extends Controller
{
    public function index_consentimiento($id){
        $consentimiento = ConsentimientoLaser::where('id_cliente', '=', $id)->first();

        return view('notas_lacer.index_consentimiento', compact('consentimiento'));
    }

    public function index(){
        $nota_lacer = NotasLacer::orderBy('id','DESC')->get();

        return view('notas_lacer.index', compact('nota_lacer'));
    }

    public function getZonasByTipoZona($tipoZona){
        try {
            $data = Laser::where('tipo_zona', $tipoZona)->get(['id', 'zona', 'costo_paquete']);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    public function crear(){
        $zonas = Laser::get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.crear',compact('client', 'user', 'zonas'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'tipo_servicio' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fechaActual = date('Y-m-d');

        // N U E V O  U S U A R I O
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           //$client->email = $request->get('email');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota_laser = new NotasLacer;

        $nota_laser->id_user = $request->get('id_user');

        if($request->get('name') != NULL){
            $nota_laser->id_client = $client->id;
        }else{
            $nota_laser->id_client = $request->get('id_client');
        }

        if($request->get('tipo_servicio') == 'paquete'){
            $tipo = $request->get('paquete_select');
        }else if($request->get('tipo_servicio') == 'sesion'){
            $tipo = 'Sesiones';
        }else{
            $tipo = 'Personalizado';
        }

        $nota_laser->total =  $request->get('total_suma');
        $nota_laser->restante = $request->get('restante');
        $nota_laser->tipo = $tipo;
        $nota_laser->fecha = $fechaActual;
        $nota_laser->save();

        // G U A R D A R  S E R V I C I O  Y  C O M I S I O N  C O S M E

        if($request->get('tipo_servicio') == 'sesion'){

            for ($i = 1; $i <= 4; $i++) {
                $zonaSelect = $request->get("zona_select_$i");

                if ($zonaSelect !== NULL) {
                    $zona_laser = new ZonasLaser;
                    $zona_laser->id_nota = $nota_laser->id;
                    $zona_laser->id_zona = $zonaSelect;
                    $zona_laser->sesiones_compradas = $request->get("cantidad_$i");
                    $zona_laser->sesiones_restantes = $request->get("cantidad_$i");
                    $zona_laser->subtotal = $request->get("subtotal_$i");
                    $zona_laser->save();
                }
            }

        }else if($request->get('tipo_servicio') == 'paquete'){
            if($request->get('paquete_select') == 'Zona Mini' || $request->get('paquete_select') == 'Zonas Pequeñas'){
                $sesiones = 12;
            }else if($request->get('paquete_select') == 'Zonas Medianas' || $request->get('paquete_select') == 'Zonas Grandes'){
                $sesiones = 15;
            }
            for ($i = 1; $i <= 2; $i++) {
                $zonaSelect = $request->get("zona_paquete_$i");

                $zona_laser = new ZonasLaser;
                $zona_laser->id_nota = $nota_laser->id;
                $zona_laser->id_zona = $zonaSelect;
                $zona_laser->sesiones_compradas = $sesiones;
                $zona_laser->sesiones_restantes = $sesiones;
                $zona_laser->save();
            }

            // G U A R D A R  C O M I S I O N  C O S M E
            if($request->get('id_user') == 6 || $request->get('id_user') == 3 || $request->get('id_user') == 5){
                if($request->get('paquete_select') == 'Zona Mini'){
                    $montoComision = 400;
                }else if($request->get('paquete_select') == 'Zonas Pequeñas'){
                    $montoComision = 500;
                }else if($request->get('paquete_select') == 'Zonas Medianas'){
                    $sesiones = 700;
                }else if($request->get('paquete_select') == 'Zonas Grandes'){
                    $sesiones = 1000;
                }

                $registroSemanal = new RegCosmesSum;
                $registroSemanal->id_cosme = $request->get('id_user');
                $registroSemanal->tipo = 'Extra';
                $registroSemanal->concepto = 'Bono Venta Laser en nota: ' . $nota_laser->id;
                $registroSemanal->id_nota = $nota_laser->id;
                $registroSemanal->fecha = $fechaActual;
                $registroSemanal->monto = $montoComision;
                $registroSemanal->save();
            }
        }else{
            $zonasSeleccionadas = array_filter($request->only(['zona_personalizado_1', 'zona_personalizado_2', 'zona_personalizado_3', 'zona_personalizado_4']));
            $comisionTotal = 0;
            foreach ($zonasSeleccionadas as $zonaSelect) {
                // Verifica si la zonaSelect es diferente de NULL
                if ($zonaSelect !== NULL) {
                    // Busca la zona en la base de datos
                    $zona = Laser::find($zonaSelect);

                    // Verifica si la zona fue encontrada
                    if ($zona) {
                        if ($zona->tipo_zona == 'Zona Mini') {
                            $comisionTotal += 200;
                            $sesiones = 12;
                        } elseif ($zona->tipo_zona == 'Zonas Pequeñas') {
                            $comisionTotal += 250;
                            $sesiones = 12;
                        } elseif ($zona->tipo_zona == 'Zonas Medianas') {
                            $comisionTotal += 350;
                            $sesiones = 15;
                        } elseif ($zona->tipo_zona == 'Zonas Grandes') {
                            $comisionTotal += 500;
                            $sesiones = 15;
                        }

                        // Crea y guarda el registro en la tabla ZonasLaser
                        $zona_laser = new ZonasLaser;
                        $zona_laser->id_nota = $nota_laser->id;
                        $zona_laser->id_zona = $zonaSelect;
                        $zona_laser->sesiones_compradas = $sesiones;
                        $zona_laser->sesiones_restantes = $sesiones;
                        $zona_laser->save();
                    }
                }
            }
            // G U A R D A R  C O M I S I O N  C O S M E
            if($request->get('id_user') == 6 || $request->get('id_user') == 3 || $request->get('id_user') == 5){
                $registroSemanal = new RegCosmesSum;
                $registroSemanal->id_cosme = $request->get('id_user');
                $registroSemanal->tipo = 'Extra';
                $registroSemanal->concepto = 'Bono Venta Laser en nota: ' . $nota_laser->id;
                $registroSemanal->id_nota = $nota_laser->id;
                $registroSemanal->fecha = $fechaActual;
                $registroSemanal->monto = $comisionTotal;
                $registroSemanal->save();
            }
        }

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){

            $pago = new PagosLaser;
            $pago->id_nota = $nota_laser->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->id_user = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_laser';
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

                $cajera_id =  User::find($nota_laser->id_user);
                $cajera = $cajera_id->name;


                $amount = $request->get('pago');
                $assigned_user = 'ventas@paradisus.com.mx';
                $reference = $nota_laser->id;
                $message = 'N Laser :#'.$nota_laser->id.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

                // Realiza la solicitud GET a la API de Clip
                $client = new GuzzleClient();

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

                $body = $response->getBody()->getContents();

                // Decodificar el cuerpo si es JSON
                $data = json_decode($body, true);

            }

        }

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I O
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->egresos = $request->get('cambio');
            $caja->motivo = 'Retiro';
            $caja->concepto = 'Cambio nota laser: ' . $nota_laser->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }


        // G U A R D A R  H O J A  S A L U D
        $hoja_salud = new HojaSaludLaser;
        $hoja_salud->id_cliente = $nota_laser->id_client;
        $hoja_salud->save();

        // G U A R D A R  C O N S E N T I M I E N T O
        $consentimiento = new ConsentimientoLaser;
        $consentimiento->id_cliente = $nota_laser->id_client;
        $consentimiento->save();

        $recibo = [
            "id" => $nota_laser->id,
            "Cliente" => $nota_laser->Client->name,
            "Total" => $nota_laser->total,
            "Restante" => $nota_laser->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => [$pago],
            'cosmetologa' => $nota_laser->User->name,
            // Agrega cualquier otro dato necesario para el recibo
        ];

        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);


    }

    public function store_sesion(Request $request){

        // G U A R D A R  N O T A  P R I N C I P A L
        $fechaActual = date('Y-m-d');
        $registrosZonas = new RegistroZonas;
        $registrosZonas->id_nota = $request->get('id_nota');
        $registrosZonas->id_zona = $request->get('id_zona');
        $registrosZonas->sesion = $request->get('sesion');
        $registrosZonas->parametros = $request->get('parametros');
        $registrosZonas->nota = $request->get('nota');
        $registrosZonas->fecha = $fechaActual;

        if ($request->hasFile('foto1')) {
                $foto1 = $request->file('foto1');
                $path = public_path() . '/evidencias';
                $fileNameFotouno = uniqid() . $foto1->getClientOriginalName();
                $foto1->move($path, $fileNameFotouno);
                $registrosZonas->foto1 = $fileNameFotouno;
        }

        if ($request->hasFile('foto2')) {
            $foto2 = $request->file('foto2');
            $path = public_path() . '/evidencias';
            $fileNameFotDos = uniqid() . $foto2->getClientOriginalName();
            $foto2->move($path, $fileNameFotDos);
            $registrosZonas->foto2 = $fileNameFotDos;
        }

        if($request->signed_pago3 != NULL){
            $folderPath = public_path('image/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $registrosZonas->firma = $signature;
        }


        $registrosZonas->save();

        $zona_lacer = ZonasLaser::where('id_nota', '=', $request->get('id_nota'))->where('id_zona', '=', $request->get('id_zona'))->first();
        $sesiones_restantes = $zona_lacer->sesiones_restantes - 1;
        $zona_lacer->sesiones_restantes = $sesiones_restantes;
        $zona_lacer->update();

        Session::flash('success', 'Se registro exitosamente');
        return redirect()->back()
        ->with('success', 'Se registro exitosamente.');

    }

    public function store_config(Request $request){
        $validator = Validator::make($request->all(), [
            'area' => 'required',
            'skyn_type' => 'required',
            'hair_type' => 'required',
            'hair_density' => 'required',
            'hair_tickness' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Faltan campos. Por favor, completa todos los campos correctamente.');
        }

        try {
            $area = $request->get('area');
            $skyn_type = $request->get('skyn_type');
            $hair_type = $request->get('hair_type');
            $hair_density = $request->get('hair_density');
            $hair_tickness = $request->get('hair_tickness');

            for ($count = 0; $count < count($area); $count++) {
                $data = array(
                    'id_cliente' => $request->get('id_client'),
                    'area' => $area[$count],
                    'skyn_type' => $skyn_type[$count],
                    'hair_type' => $hair_type[$count],
                    'hair_density' => $hair_density[$count],
                    'hair_tickness' => $hair_tickness[$count],
                );
                $insert_data[] = $data;
            }

            ConfiguracionLaser::insert($insert_data);

            alert()->success('Creado con éxito', 'Operación exitosa');
            return back();
        } catch (\Exception $e) {
            // En caso de error, regresa con un mensaje de error
            return back()
                ->with('error', 'Se produjo un error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }

    public function edit($id){
        $zonas = Laser::get();
        $nota_laser = NotasLacer::find($id);
        $pago = PagosLaser::where('id_nota', '=', $id)->get();
        $zonas_lacer = ZonasLaser::where('id_nota', '=', $id)->get();
        $configuraciones_laser = ConfiguracionLaser::where('id_cliente', '=', $nota_laser->id_client)->get();

        $registrosZonas  = RegistroZonas::where('id_nota', '=', $id)->get();

        $zonas = Laser::get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.index_laser',compact('user', 'zonas', 'nota_laser', 'pago', 'zonas_lacer', 'registrosZonas', 'configuraciones_laser'));
    }

    public function hoja_salud($id){

        $client =  Client::where('id','=',$id)->first();

        $hoja_salud = HojaSaludLaser::where('id_cliente','=',$id)->first();

        return view('notas_lacer.hoja_salud',compact('client','hoja_salud'));
    }

    public function update_hoja_salud(Request $request,$id){

        $hoja_salud = HojaSaludLaser::find($id);
        $hoja_salud->fecha = $request->get('fecha');
        $hoja_salud->p1 = $request->get('p1');
        $hoja_salud->p2 = $request->get('p2');
        $hoja_salud->p3 = $request->get('p3');
        $hoja_salud->p4 = $request->get('p4');
        $hoja_salud->p5 = $request->get('p5');
        $hoja_salud->p6 = $request->get('p6');
        $hoja_salud->p7 = $request->get('p7');
        $hoja_salud->p8 = $request->get('p8');
        $hoja_salud->p9 = $request->get('p9');
        $hoja_salud->p10 = $request->get('p10');
        $hoja_salud->p11 = $request->get('p11');
        $hoja_salud->p12 = $request->get('p12');
        $hoja_salud->p13 = $request->get('p13');
        $hoja_salud->p14 = $request->get('p14');
        $hoja_salud->p15 = $request->get('p15');
        $hoja_salud->p16 = $request->get('p16');
        $hoja_salud->p17 = $request->get('p17');
        $hoja_salud->p18 = $request->get('p18');
        $hoja_salud->p19 = $request->get('p19');
        $hoja_salud->p20 = $request->get('p20');
        $hoja_salud->p21 = $request->get('p21');
        $hoja_salud->p22 = $request->get('p22');
        $hoja_salud->p23 = $request->get('p23');
        $hoja_salud->p24 = $request->get('p24');
        $hoja_salud->p25 = $request->get('p25');
        $hoja_salud->p26 = $request->get('p26');
        $hoja_salud->p27 = $request->get('p27');
        $hoja_salud->p28 = $request->get('p28');
        $hoja_salud->p29 = $request->get('p29');
        $hoja_salud->p30 = $request->get('p30');
        $hoja_salud->p31 = $request->get('p31');
        $hoja_salud->p32 = $request->get('p32');

            if($request->firma != NULL){
                $folderPath = public_path('firmaCosme/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->firma);
                $image_type_aux = explode("firmaCosme/", $image_parts[0]);
                $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : null;

                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.png' ;
                $file = $folderPath . $signature;
                file_put_contents($file, $image_base64);

                $hoja_salud->firma = $signature;
            }

            if($request->firma2 != NULL){
                $folderPath = public_path('firmaCosme/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->firma2);
                $image_type_aux = explode("firmaCosme/", $image_parts[0]);
                $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : null;

                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.png' ;
                $file = $folderPath . $signature;
                file_put_contents($file, $image_base64);

                $hoja_salud->firma2 = $signature;
            }

        $hoja_salud->update();


        return redirect()->back();

    }

    public function update(Request $request, $id){

        // G U A R D A R  P A G O S
        if($request->get('pago') != NULL){
            $pago = new PagosLaser;
            $pago->id_nota = $id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->id_user = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_laser';
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
                }

                $cajera_id =  User::find($pago->id_user);
                $cajera = $cajera_id->name;


                $amount = $pago->pago;
                $assigned_user = 'ventas@paradisus.com.mx';
                $reference = $pago->id_nota;
                $message = 'N Laser :#'.$pago->id_nota.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

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

                $body = $response->getBody()->getContents();

                // Decodificar el cuerpo si es JSON
                $data = json_decode($body, true);

            }


        }else{
            $pago = '';
        }
            $nota_laser = NotasLacer::find($id);
            $pagos = PagosLaser::where('id_nota', $id)->get();
            $totalPagos = $pagos->sum('pago');
            $restante =  $nota_laser->total - $totalPagos;

            $nota_laser->restante = $restante;
            $nota_laser->update();

            if ($pago->cambio > 0 && $pago->forma_pago == 'Efectivo') {
                $fechaActual = date('Y-m-d');
                $concepto = 'Cambio nota laser: ' . $id;

                // Crear un nuevo registro
                $caja = new CajaDia;
                $caja->motivo = 'Retiro';
                $caja->egresos = $pago->cambio;
                $caja->concepto = $concepto;
                $caja->fecha = $fechaActual;
                $caja->save();
            }


            $recibo = [
                "id" => $nota_laser->id,
                "Cliente" => $nota_laser->Client->name,
                "Total" => $nota_laser->total,
                "Restante" => $nota_laser->restante,
                "nombreImpresora" => "ZJ-58",
                'pago' => [$pago],
                'cosmetologa' => $nota_laser->User->name,
                // Agrega cualquier otro dato necesario para el recibo
            ];


            // Devuelve los datos en formato JSON
            return response()->json(['success' => true, 'recibo' => $recibo]);
    }

    public function pdf_laser($id){
        $today =  date('d-m-Y');

        $nota_laser = NotasLacer::find($id);
        $pagos = PagosLaser::where('id_nota', '=', $id)->get();
        $zonas_laser = ZonasLaser::where('id_nota', '=', $id)->get();

        $pdf = \PDF::loadView('notas_lacer.recibo_pdf', compact('nota_laser', 'pagos', 'zonas_laser'));
        // return $pdf->stream();
        return $pdf->download('Recibo Nota Laser '.$today.'.pdf');
    }

    public function update_consentimiento(Request $request,$id){

        $consentimiento = ConsentimientoLaser::where('id_cliente', '=', $id)->first();
        $consentimiento->edad = $request->get('edad');
        $consentimiento->domicilio = $request->get('domicilio');

            if($request->firma != NULL){
                $folderPath = public_path('firmaCosme/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->firma);
                $image_type_aux = explode("firmaCosme/", $image_parts[0]);
                $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : null;

                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.png' ;
                $file = $folderPath . $signature;
                file_put_contents($file, $image_base64);

                $consentimiento->firma = $signature;
            }

        $consentimiento->update();


        return redirect()->back();

    }

    public function recomendaciones(){


        return view('notas_lacer.recomendaciones');

    }
}
