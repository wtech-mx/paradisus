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
        dd($colores);

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

        $modulos = [];

        for ($i = 1; $i <= $Configuracion->modulos; $i++) {
            $letra = chr(64 + $i);
            $modulos[] = ['id' => $letra, 'title' => 'Modulo ' . $letra];
        }

        // Obtener la fecha y hora actual
        $now = Carbon::now();

        $estatus_contador = Status::count();
        $servicios_contador = Servicios::count();
        $t_citas_contador = Alertas::count();
        $p_citas_contador = Alertas::where('start', '>=', $now)->count();

        return view('dashboard', compact('user_cosmes','alert', 'colores','servicios', 'servicios_contador', 't_citas_contador', 'p_citas_contador','cosmes_alerts','estatus', 'estatus_contador','modulos'));

    }

    public function store_calendar(Request $request)
    {

        $datosEvento = new Alertas;
        $datosEvento->start = $request->start;
        $datosEvento->end = $request->end;
        $datosEvento->id_servicio = $request->id_servicio;
        $datosEvento->id_status = $request->id_status;
        $datosEvento->estatus = $datosEvento->Status->estatus;
        $datosEvento->color = $datosEvento->Status->color;
        $datosEvento->id_client = $request->cliente_id;
        $full_name = $datosEvento->Client->name.$datosEvento->Client->last_name;
        $datosEvento->title = $full_name;
        $datosEvento->telefono = $datosEvento->Client->phone;
        $datosEvento->resourceId = $request->resourceId;
        $datosEvento->id_especialist = $request->id_especialist;
        $datosEvento->descripcion = $request->descripcion;
        $datosEvento->image = asset('img/iconos_serv/'.$datosEvento->Servicios->imagen);

        if ( $datosEvento->end == $datosEvento->start){
            $now = date($datosEvento->end);
            $new_time = date("Y-m-d H:i", strtotime('+1 hours', strtotime($now))); // $now + 3 hours
            $datosEvento->end = $new_time;
        }

        $datosEvento->save();
    }

    public function show_calendar()
    {
        //Trae datos de db to jason
        $json2 = $data2['alertas'] = Alertas::all();

        //los convieerte en array
        $decode2 = json_decode($json2);

        //Une los array en uno solo
        $resultado = array_merge($decode2);

        //retorna a la vista sn json
        return response()->json($resultado);
    }

    public function update_calendar(Request $request, $id)
    {
        $datosEvento = Alertas::find($id);
        $datosEvento->start = $request->start;
        $datosEvento->end = $request->end;
        $datosEvento->id_servicio = $request->id_servicio;
        $datosEvento->id_status = $request->id_status;
        $datosEvento->estatus = $datosEvento->Status->estatus;
        $datosEvento->color = $datosEvento->Status->color;
        $datosEvento->id_client = $request->id_client;
        $full_name = $datosEvento->Client->nombre.$datosEvento->Client->apellido;
        $datosEvento->title = $full_name;
        $datosEvento->telefono = $datosEvento->Client->telefono;
        $datosEvento->resourceId = $request->resourceId;
        $datosEvento->id_especialist = $request->id_especialist;
        $datosEvento->descripcion = $request->descripcion;
        $datosEvento->image = asset('img/iconos_serv/'.$datosEvento->Servicios->imagen);
        $datosEvento->update();

        // if ($datosEvento->check == 2){
        //     $controlpagos = new Controlpagos;
        //     $controlpagos->fecha = $datosEvento->start;
        //     $controlpagos->id_clients = $datosEvento->id_client;
        //     $controlpagos->id_alertas = $id;
        //     $controlpagos->id_doctor = $datosEvento->id_especialist;
        //     $controlpagos->id_color = $datosEvento->id_color;
        //     $controlpagos->save();
        // }
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
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota = new Notas();
        if($request->get('name') != NULL){
            $nota->id_client = $client->id;
        }else{
            $nota->id_client = $request->get('id_client');
        }
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
        if($request->get('pagoInput') != NULL){

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

        // Obtener el servicio para acceder a la duración
        $servicio = Servicios::find($request->servicioIdInput);
        $duracion = $servicio->duracion; // Duración en minutos

        // Combina la fecha y la hora seleccionada
        $startDateTimeString = $request->fechaSeleccionada . ' ' . $request->horaSeleccionada;
        $startDateTime = Carbon::parse($startDateTimeString);

        // Calcula la hora de finalización
        $endDateTime = $startDateTime->copy()->addMinutes($duracion);

        $datosEvento = new Alertas;
        $datosEvento->start = $startDateTime;
        $datosEvento->end = $endDateTime;
        $datosEvento->id_servicio = $request->servicioIdInput;
        $datosEvento->id_status = 1;
        $datosEvento->estatus = 'Agendado';
        $datosEvento->color ='#667cea';
        $datosEvento->id_client = $request->id_client;
        $full_name = $datosEvento->Client->name.$datosEvento->Client->last_name;
        $datosEvento->title = $full_name;
        $datosEvento->telefono = $datosEvento->Client->phone;
        $datosEvento->resourceId = 'A';
        $datosEvento->id_especialist = $request->id_user;
        $datosEvento->id_nota = $nota->id;
        $datosEvento->descripcion = $request->nota2;
        $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');

        if ( $datosEvento->end == $datosEvento->start){
            $now = date($datosEvento->end);
            $new_time = date("Y-m-d H:i", strtotime('+1 hours', strtotime($now))); // $now + 3 hours
            $datosEvento->end = $new_time;
        }

        $datosEvento->save();

        $cosmes = $request->get('cosmes');

        for ($count = 0; $count < count($cosmes); $count++) {
            $data = array(
                'id_nota' => $datosEvento->id,
                'concepto' => $cosmes[$count],
            );
            $insert_data[] = $data;
        }

        AlertasCosmes::insert($insert_data);

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
    }

    public function store_agenda_manual(Request $request)
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
        }

        // Obtener el servicio para acceder a la duración
        $servicio = Servicios::find($request->servicio);
        $duracion = $servicio->duracion; // Duración en minutos

        // Combina la fecha y la hora seleccionada
        $startDateTimeString = $request->fechaSeleccionada . ' ' . $request->horaSeleccionada;
        $startDateTime = Carbon::parse($startDateTimeString);

        // Calcula la hora de finalización
        $endDateTime = $startDateTime->copy()->addMinutes($duracion);

        $datosEvento = new Alertas;
        $datosEvento->start = $startDateTime;
        $datosEvento->end = $endDateTime;
        $datosEvento->id_servicio = $request->servicio;
        $datosEvento->id_status = 1;
        $datosEvento->estatus = 'Agendado';
        $datosEvento->color ='#667cea';
        $datosEvento->id_client = $request->id_client;
        $full_name = $datosEvento->Client->name.$datosEvento->Client->last_name;
        $datosEvento->title = $full_name;
        $datosEvento->telefono = $datosEvento->Client->phone;
        $datosEvento->resourceId = 'A';
        $datosEvento->id_especialist = $request->id_user;
        $datosEvento->id_nota = $request->id_nota;
        $datosEvento->descripcion = $request->nota2;
        $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');

        if ( $datosEvento->end == $datosEvento->start){
            $now = date($datosEvento->end);
            $new_time = date("Y-m-d H:i", strtotime('+1 hours', strtotime($now))); // $now + 3 hours
            $datosEvento->end = $new_time;
        }

        $datosEvento->save();

        $cosmes = $request->get('cosmes');

        for ($count = 0; $count < count($cosmes); $count++) {
            $data = array(
                'id_alerta' => $datosEvento->id,
                'id_user' => $cosmes[$count],
            );
            $insert_data[] = $data;
        }

        AlertasCosmes::insert($insert_data);

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
                        ->with('success','Agenda created successfully');
    }

    public function buscarDisponibilidad(Request $request)
    {
        Carbon::setLocale('es');
        $servicioId = $request->input('servicioId');
        $duracion = $request->input('duracion');
        $numPersonas = $request->input('numPersonas');

        // Obtener el servicio seleccionado
        $servicio = Servicios::find($servicioId);

        // Obtener todos los cosmes con sus horarios
        $cosmes = User::where('puesto', 'Cosme')->with('horario')->get();

        // Filtrar cosmes disponibles en los próximos 30 días
        $disponibilidad = [];
        $today = Carbon::now();

        for ($i = 0; $i < 30; $i++) {
            $fecha = $today->copy()->addDays($i); // Clonar la fecha actual antes de modificarla
            $diaSemana = strtolower($fecha->isoFormat('dddd')); // 'lunes', 'martes', etc.

            // Filtrar cosmes que trabajan en el día específico y tienen disponibilidad
            $cosmesDisponibles = $cosmes->filter(function ($cosme) use ($diaSemana) {
                return $cosme->horario->{$diaSemana} == 1;
            });

            $horariosDisponibles = $this->buscarHorariosDisponibles($fecha, $cosmesDisponibles, $duracion, $numPersonas);

            if (!empty($horariosDisponibles)) {
                $disponibilidad[$fecha->toDateString()] = $horariosDisponibles;

                if (count($disponibilidad) >= 5) {
                    break;
                }
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
