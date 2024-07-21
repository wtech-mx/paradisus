<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Colores;
use App\Models\Status;
use App\Models\User;
use App\Models\Controlpagos;
use Carbon\Carbon;
use DateTime;
use App\Models\Configuracion;
use App\Models\Client;
use App\Models\Servicios;
use App\Models\Alertas;
use App\Models\AlertasCosmes;
use App\Models\CajaDia;
use App\Models\Notas;
use App\Models\NotasCosmes;
use App\Models\NotasPaquetes;
use App\Models\Pagos;
use GuzzleHttp\Client as GuzzleClient;

class AlertasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_recordatorios()
    {
        $colores = Colores::get();
        $estatus = Status::get();

        // $alert_retenedores = Alertas::where('id_color', '=', 6)->get();
        // $alert_limpieza = Alertas::where('id_color', '=', 2)->get();

        return view('recordatorios.view', compact('colores','estatus'));
    }

    public function index_calendar()
    {
        $fechaActual = date('Y-m-d');
        $estatus = Status::get();
        $alert = Alertas::get();
        $cosmes_alerts = AlertasCosmes::get();
        $servicios = Servicios::orderBy('nombre')->get();
        $colores = Colores::get();
        $Configuracion = Configuracion::first();

        $user_cosmes = User::get();

        $user_cosmetologas = User::where('puesto', 'Cosme')
        ->orderby('name', 'ASC')
        ->get();

        $modulos = [];

        // for ($i = 1; $i <= $Configuracion->modulos; $i++) {
        //     $letra = chr(64 + $i);
        //     $modulos[] = ['id' => $letra, 'title' => 'Modulo ' . $letra];
        // }

        // Iterar sobre los usuarios y generar los módulos
        foreach ($user_cosmetologas as $user) {
            $modulos[] = [
                'id' => $user->resourceId,
                'title' => $user->name,
                'horario' => $user->horario // Incluye el horario del usuario
            ];
        }

        // Obtener la fecha y hora actual
        $now = Carbon::now();

        $estatus_contador = Status::count();
        $servicios_contador = Servicios::count();
        $t_citas_contador = Alertas::count();
        $p_citas_contador = Alertas::where('start', '>=', $now)->count();
        //Alertas::query()->update(['color' => '#ffca99']);

        return view('dashboard', compact('user_cosmes','alert', 'colores','servicios', 'servicios_contador', 't_citas_contador', 'p_citas_contador','cosmes_alerts','estatus', 'estatus_contador','modulos'));

    }

    public function store_calendar(Request $request)
    {
        // N U E V O  U S U A R I O
        $fechaActual = date('Y-m-d');
        if($request->get('name_full') != NULL){
           $client = new Client;
           $client->name = $request->get('name_full');
           $client->last_name = $request->get('last_name_full');
           $client->phone = $request->get('phone_full');
           $client->save();
           $cliente = $client->id;
        }elseif($request->get('cliente_id') != NULL){
            $cliente = $request->get('cliente_id');
        }else{
            $cliente = 3841;
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        if($request->get('pagoInput') != NULL){
            $nota = new Notas();
            $nota->id_client = $cliente;
            $nota->fecha = $fechaActual;
            $nota->precio = $request->get('total-suma');
            $nota->restante = $request->get('id_servicio');
            $nota->save();

            $cambio = $request->get('dineroRecibidoInput') - $request->get('pagoInput');

            // G U A R D A R  C A M B I |
            // if($request->get('cambio') > '0'){
            if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
                $fechaActual = date('Y-m-d');
                $caja = new CajaDia;
                $caja->egresos = $request->get('cambioInput');
                $caja->motivo = 'Retiro';
                $caja->concepto = 'Cambio nota servicio: ' . $nota->id;
                $caja->fecha = $fechaActual;
                $caja->save();
            }

            // G U A R D A R  S E R V I C I O
            $nota_paquete = new NotasPaquetes;
            $nota_paquete->id_nota = $nota->id;
            $nota_paquete->id_servicio = $request->get('id_servicio');
            $nota_paquete->num = $request->get('num_servicio');
            $nota_paquete->save();

            // G U A R D A R  C O S M I S I O N
            $nota_paquete = new NotasCosmes;
            $nota_paquete->id_nota = $nota->id;
            $nota_paquete->id_user = $request->get('id_user');
            $nota_paquete->save();

            // G U A R D A R  P A G O
            $pago = new Pagos;
            $pago->id_nota = $nota->id;
            $pago->fecha = $fechaActual;
            $pago->cosmetologa = $request->get('cajera');
            $pago->pago = $request->get('pagoInput');
            $pago->dinero_recibido = $request->get('dineroRecibidoInput');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambioInput');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_servicios';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();
        }

        // Combina la fecha y la hora seleccionada
        $startDateTime = $request->start;

        $cosmes = $request->get('cosmesInput');

        $users = User::whereIn('id', $cosmes)->get();
        $colors = $users->pluck('color')->filter()->all();
        $finalColor = $this->combineColors($colors);

        $insert_data = [];

        foreach ($users as $user) {
            $datosEvento = new Alertas;
            $datosEvento->id_servicio = $request->id_servicio;
            if ($cliente == 3841) {
                $datosEvento->id_status = 5;
            } else {
                $datosEvento->id_status = 1;
            }
            $datosEvento->estatus = $datosEvento->Status->estatus;
            $datosEvento->color = $datosEvento->Status->color;
            $datosEvento->id_client = $cliente;
            $full_name = $datosEvento->Client->name . ' ' . $datosEvento->Client->last_name;
            $datosEvento->title = $full_name;
            $datosEvento->telefono = $datosEvento->Client->phone;
            $datosEvento->id_especialist = $request->id_especialist;
            $datosEvento->id_nota = $request->id_notaModal;
            $datosEvento->id_paquete = $request->id_paqueteModal;
            $datosEvento->id_laser = $request->id_laserModal;
            $datosEvento->descripcion = $request->descripcion;
            $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');
            $datosEvento->resourceId = $user->resourceId;

            $servicio = Servicios::find($request->id_servicio);
            $duracion = $servicio->duracion; // Duración en minutos

            // Combina la fecha y la hora seleccionada
            $startDateTimeString = $request->start;
            $startDateTime = Carbon::parse($startDateTimeString);

            // Calcula la hora de finalización
            $endDateTime = $startDateTime->copy()->addMinutes($duracion);

            $datosEvento->start = $startDateTime->format('Y-m-d H:i:s');
            $datosEvento->end = $endDateTime->format('Y-m-d H:i:s');

            $datosEvento->save();

            foreach ($users as $cosme) {
                $data = [
                    'id_alerta' => $datosEvento->id,
                    'id_user' => $cosme->id,
                ];
                $insert_data[] = $data;
            }
        }

        if (!empty($insert_data)) {
            AlertasCosmes::insert($insert_data);
        }
    }

    public function show_calendar()
    {
        $alertas = Alertas::with('Servicios_id')->get();

        $alertas->each(function ($alerta) {
            // Obtener las cosmetólogas asociadas
            $alerta->cosmes = AlertasCosmes::where('id_alerta', $alerta->id)->pluck('id_user')->toArray();
            $alerta->nombre_servicio = $alerta->Servicios_id ? $alerta->Servicios_id->nombre : null; // Agregar el nombre del servicio

            // Obtener los servicios anteriores del mismo cliente
            $serviciosAnteriores = Alertas::where('id_client', $alerta->id_client)
                ->where('start', '<', $alerta->start) // Asegurarse de que los servicios sean anteriores a la fecha del evento actual
                ->with('Servicios_id')
                ->get();

            $serviciosAnteriores->each(function ($servicioAnterior) {
                $servicioAnterior->cosmes = AlertasCosmes::where('id_alerta', $servicioAnterior->id)->pluck('id_user')->toArray();
                $servicioAnterior->nombre_servicio = $servicioAnterior->Servicios_id ? $servicioAnterior->Servicios_id->nombre : null;
            });

            // Anidar los servicios anteriores en el objeto alerta
            $alerta->servicios_anteriores = $serviciosAnteriores;
        });

        return response()->json($alertas);
    }

    public function update_calendar(Request $request, $id)
    {
        $cliente = $request->cliente_id;
        $startDateTime = $request->start;
        $datosEvento = Alertas::find($id);

        // Obtener todas las alertas relacionadas
        $alertas = Alertas::where('id_client', $datosEvento->id_client)
            ->where('start', $datosEvento->start)
            ->where('id_servicio', $datosEvento->id_servicio)
            ->get();

        // Obtener los IDs de las cosmetólogas seleccionadas en el formulario
        $cosmesSeleccionadas = $request->input('cosmesInput', []);

        // Obtener los IDs de las cosmetólogas asociadas a las alertas
        $cosmesActuales = AlertasCosmes::whereIn('id_alerta', $alertas->pluck('id'))->pluck('id_user')->toArray();

        // Cosmetólogas que deben eliminarse
        $cosmesAEliminar = array_diff($cosmesActuales, $cosmesSeleccionadas);

        // Cosmetólogas que deben agregarse
        $cosmesAAgregar = array_diff($cosmesSeleccionadas, $cosmesActuales);

        if(count($cosmesSeleccionadas) < count($alertas)){
            $cosmes = AlertasCosmes::whereIn('id_user', $cosmesAEliminar)->first();
            $alerta = Alertas::where('id', '=', $cosmes->id_alerta)->first();
        }
        // Eliminar las alertas y relaciones de cosmetólogas que ya no están seleccionadas
        if(count($cosmesSeleccionadas) >= count($alertas)){
            if (!empty($cosmesAEliminar)) {
                AlertasCosmes::whereIn('id_user', $cosmesAEliminar)->delete();
                Alertas::whereIn('id_especialist', $cosmesAEliminar)->delete();
            }
        }

        // Actualiza cada alerta encontrada
        foreach ($alertas as $alerta) {
            $alerta->id_servicio = $request->id_servicio;
            $alerta->id_status = $request->id_status;
            $alerta->estatus = $alerta->Status->estatus;
            $alerta->color = $alerta->Status->color;
            $alerta->image = $alerta->Status->icono;
            $alerta->id_client = $cliente;
            $full_name = $alerta->Client->name . ' ' . $alerta->Client->last_name;
            $alerta->title = $full_name;
            $alerta->telefono = $alerta->Client->phone;
            $alerta->id_especialist = $request->id_especialist;
            $alerta->id_nota = $request->id_notaModal;
            $alerta->id_laser = $request->id_laserModal;
            $alerta->id_paquete = $request->id_paqueteModal;
            $alerta->descripcion = $request->descripcion;

            $servicio = Servicios::find($request->id_servicio);
            $duracion = $servicio->duracion; // Duración en minutos

            // Combina la fecha y la hora seleccionada
            $startDateTimeString = $request->start;
            $startDateTime = Carbon::parse($startDateTimeString);

            // Calcula la hora de finalización
            $endDateTime = $startDateTime->copy()->addMinutes($duracion);

            $alerta->start = $startDateTime->format('Y-m-d H:i:s');
            $alerta->end = $endDateTime->format('Y-m-d H:i:s');
            $alerta->save();
        }

        // Actualizar los resourceId en las alertas según los cosmetólogos seleccionados
        foreach ($alertas as $alerta) {
            // Obtener la relación actual de AlertasCosmes
            $alertaCosmes = AlertasCosmes::where('id_alerta', $alerta->id)->get();

            // Eliminar todas las relaciones actuales
            foreach ($alertaCosmes as $alertaCosme) {
                $alertaCosme->delete();
            }

            // Crear nuevas relaciones y actualizar resourceId
            foreach ($cosmesSeleccionadas as $index => $idCosme) {
                AlertasCosmes::create([
                    'id_alerta' => $alerta->id,
                    'id_user' => $idCosme
                ]);

                // Solo actualizar el resourceId para la alerta correspondiente
                if ($index < count($alertas)) {
                    $alertas[$index]->resourceId = User::find($idCosme)->resourceId;
                    $alertas[$index]->save();
                }
            }
        }

        // Verifica si hay nuevos IDs de cosmetólogas
        if ($request->input('cosmesnueva') != NULL) {

            // Obtener los IDs de cosmetólogas nuevas y existentes
            $cosmesExistentes = $request->get('cosmesInput', []);
            $cosmesNuevas = $request->get('cosmesnueva', []);

            // Obtener detalles de la alerta existente
            $datosEvento = Alertas::find($request->get('id'));

            // Iterar a través de cada nuevo ID de cosmetóloga
            foreach ($cosmesNuevas as $nuevaCosmeId) {
                // Añadir la nueva relación en alertas_cosmes para la alerta principal
                AlertasCosmes::create([
                    'id_alerta' => $datosEvento->id,
                    'id_user' => $nuevaCosmeId,
                ]);

                // Obtener el resourceId del nuevo ID de cosmetóloga
                $nuevaCosmetologa = User::find($nuevaCosmeId);
                $nuevoResourceId = $nuevaCosmetologa->resourceId;

                // Crear una nueva alerta duplicada con el nuevo resourceId
                $nuevaAlerta = $datosEvento->replicate();
                $nuevaAlerta->resourceId = $nuevoResourceId;
                $nuevaAlerta->save();

                // Añadir relaciones en alertas_cosmes para la nueva alerta duplicada
                foreach ($cosmesExistentes as $existenteCosmeId) {
                    AlertasCosmes::create([
                        'id_alerta' => $nuevaAlerta->id,
                        'id_user' => $existenteCosmeId,
                    ]);
                }
                AlertasCosmes::create([
                    'id_alerta' => $nuevaAlerta->id,
                    'id_user' => $nuevaCosmeId,
                ]);

                // Obtener todas las alertas que comparten el mismo id_alerta
                $alertasRelacionadas = Alertas::where('id_client', $datosEvento->id_client)
                                            ->where('descripcion', $datosEvento->descripcion)
                                            ->where('start', $datosEvento->start)
                                            ->get();

                // Actualizar las relaciones en alertas_cosmes para todas las alertas relacionadas
                foreach ($alertasRelacionadas as $alertaRelacionada) {
                    AlertasCosmes::create([
                        'id_alerta' => $alertaRelacionada->id,
                        'id_user' => $nuevaCosmeId,
                    ]);
                }
            }
        }

        if(count($cosmesSeleccionadas) < count($alertas)){
            AlertasCosmes::whereIn('id_user', $cosmesAEliminar)->delete();
            AlertasCosmes::where('id_alerta', $alerta->id)->delete();
            Alertas::where('id', '=', $alerta->id)->delete();
        }
        return redirect()->back()->with('success', 'Alerta actualizada con éxito');
    }

    public function destroy_calendar($id)
    {
        Alertas::destroy($id);
        return response()->json($id);
    }

    public function store_agenda(Request $request)
    {
        // N U E V O  U S U A R I O
        $fechaActual = date('Y-m-d');
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           //$client->email = $request->get('email');
           $client->save();
           $cliente = $client->id;
        }elseif($request->get('id_client') != NULL){
            $cliente = $request->get('id_client');
        }else{
            $cliente = 3841;
        }

        if($request->option_nota == 'nota'){
            // G U A R D A R  N O T A  P R I N C I P A L
            if($request->get('pagoInput') != NULL){
                $nota = new Notas();
                $nota->id_client = $cliente;
                $nota->fecha = $fechaActual;
                $nota->precio = $request->get('total-suma');
                $nota->restante = $request->get('restanteInput');
                $nota->save();

                $cambio = $request->get('dineroRecibidoInput') - $request->get('pagoInput');

                // G U A R D A R  C A M B I |
                // if($request->get('cambio') > '0'){
                if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
                    $fechaActual = date('Y-m-d');
                    $caja = new CajaDia;
                    $caja->egresos = $request->get('cambioInput');
                    $caja->motivo = 'Retiro';
                    $caja->concepto = 'Cambio nota servicio: ' . $nota->id;
                    $caja->fecha = $fechaActual;
                    $caja->save();
                }

                // G U A R D A R  S E R V I C I O
                $nota_paquete = new NotasPaquetes;
                $nota_paquete->id_nota = $nota->id;
                $nota_paquete->id_servicio = $request->get('servicioIdInput');
                $nota_paquete->num = $request->get('num_servicio');
                $nota_paquete->save();

                // G U A R D A R  C O S M I S I O N
                $nota_paquete = new NotasCosmes;
                $nota_paquete->id_nota = $nota->id;
                $nota_paquete->id_user = $request->get('id_user');
                $nota_paquete->save();

                // G U A R D A R  P A G O
                $pago = new Pagos;
                $pago->id_nota = $nota->id;
                $pago->fecha = $fechaActual;
                $pago->cosmetologa = $request->get('cajera');
                $pago->pago = $request->get('pagoInput');
                $pago->dinero_recibido = $request->get('dineroRecibidoInput');
                $pago->forma_pago = $request->get('forma_pago');
                $pago->nota = $request->get('nota2');
                $pago->cambio = $request->get('cambioInput');

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


                    $amount = $request->get('pagoInput');
                    $assigned_user = 'ventas@paradisus.com.mx';
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

                    $body = $response->getBody()->getContents();

                    // Decodificar el cuerpo si es JSON
                    $data = json_decode($body, true);

                }

            }
        }

        // Obtener el servicio para acceder a la duración
        $servicio = Servicios::find($request->servicioIdInput);
        $duracion = $servicio->duracion; // Duración en minutos

        // Combina la fecha y la hora seleccionada
        $startDateTimeString = $request->fechaSeleccionada . ' ' . $request->horaSeleccionada;
        $startDateTime = Carbon::parse($startDateTimeString);

        // Calcula la hora de finalización
        $endDateTime = $startDateTime->copy()->addMinutes($duracion);

        $cosmes = $request->get('cosme_disp');

        $users = User::whereIn('name', $cosmes)->get();
        $colors = $users->pluck('color')->filter()->all();
        $finalColor = $this->combineColors($colors);


        $insert_data = [];

        foreach ($users as $user) {
            $datosEvento = new Alertas;
            $datosEvento->start = $startDateTime;
            $datosEvento->end = $endDateTime;
            $datosEvento->id_servicio = $request->servicioIdInput;
            if ($request->get('pagoInput') == NULL) {
                $datosEvento->id_status = 5;
            } else {
                $datosEvento->id_status = 1;
            }
            $datosEvento->estatus = $datosEvento->Status->estatus;
            $datosEvento->color = $datosEvento->Status->color;
            $datosEvento->id_client = $cliente;
            $full_name = $datosEvento->Client->name . ' ' . $datosEvento->Client->last_name;
            $datosEvento->title = $full_name;
            $datosEvento->telefono = $datosEvento->Client->phone;
            $datosEvento->id_especialist = $request->id_user;
            $datosEvento->id_nota = $request->id_nota;
            $datosEvento->id_paquete = $request->id_paquete;
            $datosEvento->id_laser = $request->id_laser;
            $datosEvento->descripcion = $request->descripcion;
            $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');
            $datosEvento->resourceId = $user->resourceId;

            if ($datosEvento->end == $datosEvento->start) {
                $now = date($datosEvento->end);
                $new_time = date("Y-m-d H:i", strtotime('+1 hours', strtotime($now)));
                $datosEvento->end = $new_time;
            }

            if($request->option_nota == 'gratis'){
                $datosEvento->tarjeta_regalo = '1';
                $datosEvento->descripcion = $request->nota2_gratis;

                if ($request->hasFile("foto_gratis")) {
                    $file = $request->file('foto_gratis');
                    $path = public_path() . '/foto_gratis';
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $datosEvento->comprobante_gratis = $fileName;
                }
            }else{
                $datosEvento->descripcion = $request->nota2;
                if($request->get('pagoInput') != NULL){
                    $datosEvento->id_nota = $nota->id;
                }
            }

            $datosEvento->save();

            foreach ($users as $cosme) {
                $data = [
                    'id_alerta' => $datosEvento->id,
                    'id_user' => $cosme->id,
                ];
                $insert_data[] = $data;
            }
        }

        if (!empty($insert_data)) {
            AlertasCosmes::insert($insert_data);
        }

        Session::flash('success', 'Se ha guardado su nota con exito');
        return redirect()->back()->with('success', 'Agenda created successfully');
    }

    public function store_agenda_manual(Request $request)
    {
        $fechaActual = date('Y-m-d');

        if($request->get('id_client_manual') != NULL){
            $cliente = $request->get('id_client_manual');
        }else{
            $cliente = 3841;
        }

        $servicio = Servicios::find($request->servicio_manual);
        $duracion = $servicio->duracion;

        $startDateTimeString = $request->fechaSeleccionada . ' ' . $request->horaSeleccionada;
        $startDateTime = Carbon::parse($startDateTimeString);
        $endDateTime = $startDateTime->copy()->addMinutes($duracion);

        $cosmes = $request->get('cosmes_manual');

        $users = User::whereIn('id', $cosmes)->get();
        $colors = $users->pluck('color')->filter()->all();
        $finalColor = $this->combineColors($colors);

        foreach ($users as $user) {
            $datosEvento = new Alertas;
            $datosEvento->start = $startDateTime;
            $datosEvento->end = $endDateTime;
            $datosEvento->id_servicio = $request->servicio_manual;
            $datosEvento->id_status = 1;
            $datosEvento->estatus = $datosEvento->Status->estatus;
            $datosEvento->id_client = $cliente;
            $full_name = $datosEvento->Client->name . ' ' . $datosEvento->Client->last_name;
            $datosEvento->title = $full_name;
            $datosEvento->telefono = $datosEvento->Client->phone;
            $datosEvento->id_especialist = $request->id_user_manual;
            $datosEvento->id_nota = $request->id_nota;
            $datosEvento->id_paquete = $request->id_paquete;
            $datosEvento->id_laser = $request->id_laser;
            $datosEvento->descripcion = $request->descripcion;
            $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');
            $datosEvento->resourceId = $user->resourceId;
            $datosEvento->color = $datosEvento->Status->color;;

            if ($datosEvento->end == $datosEvento->start) {
                $now = date($datosEvento->end);
                $new_time = date("Y-m-d H:i", strtotime('+1 hours', strtotime($now)));
                $datosEvento->end = $new_time;
            }

            $datosEvento->save();

            $data = array(
                'id_alerta' => $datosEvento->id,
                'id_user' => $user->id,
            );
            $insert_data[] = $data;
        }

        AlertasCosmes::insert($insert_data);

        Session::flash('success', 'Se ha guardado sus datos con exito');
    }

    private function combineColors(array $colors)
    {
        if (count($colors) === 0) {
            return null; // Retornar nulo si no hay colores
        }

        // Convertir los colores hexadecimales a sus componentes RGB
        $rgbColors = array_map([$this, 'hexToRgb'], $colors);

        // Mezclar los colores RGB
        $combinedRgb = array_reduce($rgbColors, function($carry, $item) {
            return [
                'r' => $carry['r'] + $item['r'],
                'g' => $carry['g'] + $item['g'],
                'b' => $carry['b'] + $item['b']
            ];
        }, ['r' => 0, 'g' => 0, 'b' => 0]);

        $colorCount = count($colors);
        $combinedRgb = array_map(function($value) use ($colorCount) {
            return round($value / $colorCount);
        }, $combinedRgb);

        // Convertir el color combinado de RGB a hexadecimal
        return $this->rgbToHex($combinedRgb);
    }

    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) == 6) {
            list($r, $g, $b) = [hexdec($hex[0].$hex[1]), hexdec($hex[2].$hex[3]), hexdec($hex[4].$hex[5])];
        } elseif (strlen($hex) == 3) {
            list($r, $g, $b) = [hexdec(str_repeat($hex[0], 2)), hexdec(str_repeat($hex[1], 2)), hexdec(str_repeat($hex[2], 2))];
        } else {
            return ['r' => 0, 'g' => 0, 'b' => 0];
        }

        return ['r' => $r, 'g' => $g, 'b' => $b];
    }

    private function rgbToHex($rgb)
    {
        return sprintf("#%02x%02x%02x", $rgb['r'], $rgb['g'], $rgb['b']);
    }

    public function buscarDisponibilidad(Request $request)
    {
        Carbon::setLocale('es');
        $servicioId = $request->input('servicioId');
        $duracion = $request->input('duracion');
        $numPersonas = $request->input('numPersonas');
        $pagina = $request->input('pagina', 1);

        // Obtener el servicio seleccionado
        $servicio = Servicios::find($servicioId);

        // Obtener todos los cosmes con sus horarios
        $cosmes = User::where('puesto', 'Cosme')->with('horario')->get();

        // Filtrar cosmes disponibles en los próximos 30 días
        $disponibilidad = [];
        $today = Carbon::now();
        $startDay = ($pagina - 1) * 5;  // Calcular el día inicial en función de la página
        $endDay = $startDay + 5;  // Calcular el día final para el rango de fechas a buscar

        for ($i = $startDay; $i < $endDay; $i++) {
            $fecha = $today->copy()->addDays($i); // Clonar la fecha actual antes de modificarla
            $diaSemana = strtolower($fecha->isoFormat('dddd')); // 'lunes', 'martes', etc.

            // Filtrar cosmes que trabajan en el día específico y tienen disponibilidad
            $cosmesDisponibles = $cosmes->filter(function ($cosme) use ($diaSemana) {
                return $cosme->horario->{$diaSemana} == 1;
            });

            $horariosDisponibles = $this->buscarHorariosDisponibles($fecha, $cosmesDisponibles, $duracion, $numPersonas);

            if (!empty($horariosDisponibles)) {
                $disponibilidad[$fecha->toDateString()] = $horariosDisponibles;
            }
        }

        return response()->json($disponibilidad);
    }

    private function buscarHorariosDisponibles($fecha, $cosmesDisponibles, $duracion, $numPersonas)
    {
        $horaInicio = Carbon::createFromTime(9, 0, 0, $fecha->timezone);
        $horaFin = Carbon::createFromTime(17, 0, 0, $fecha->timezone);

        $horaInicio->setDateFrom($fecha);
        $horaFin->setDateFrom($fecha);

        $horariosDisponibles = [];

        while ($horaInicio->lessThan($horaFin)) {
            $horaDisponible = true;
            $cosmesDisponiblesEnHora = [];

            foreach ($cosmesDisponibles as $cosme) {
                $reservas = DB::table('alertas')
                    ->join('alertas_cosmes', 'alertas.id', '=', 'alertas_cosmes.id_alerta')
                    ->where('alertas_cosmes.id_user', $cosme->id)
                    ->whereDate('alertas.start', $fecha->toDateString())
                    ->where(function ($query) use ($horaInicio, $duracion) {
                        $query->whereBetween('alertas.start', [$horaInicio, $horaInicio->copy()->addMinutes($duracion)])
                              ->orWhereBetween('alertas.end', [$horaInicio, $horaInicio->copy()->addMinutes($duracion)]);
                    })
                    ->exists();

                if (!$reservas) {
                    $cosmesDisponiblesEnHora[] = $cosme->name;
                }

                if (count($cosmesDisponiblesEnHora) >= $numPersonas) {
                    break;
                }
            }

            if (count($cosmesDisponiblesEnHora) >= $numPersonas) {
                $horariosDisponibles[] = [
                    'hora' => $horaInicio->format('H:i'),
                    'cosmes' => array_slice($cosmesDisponiblesEnHora, 0, $numPersonas)
                ];
            }

            $horaInicio->addMinutes($duracion);
        }

        return $horariosDisponibles;
    }

}
