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
            $modulos[] = ['id' => $user->resourceId, 'title' => $user->name];
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
        $resultado = Alertas::all();

        $resultado->each(function ($alerta) {
            $alerta->cosmes = AlertasCosmes::where('id_alerta', $alerta->id)->pluck('id_user')->toArray();
        });


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

        $datosEvento->id_nota = $request->id_notaModal;
        $datosEvento->id_laser = $request->id_laserModal;
        $datosEvento->id_paquete = $request->id_paqueteModal;


        $clienteUpdate = Client::find($request->cliente_id);

        $datosEvento->id_client = $request->id_client;
        $full_name = $clienteUpdate->name.$clienteUpdate->last_name;
        $datosEvento->title = $full_name;
        $datosEvento->telefono = $clienteUpdate->phone;

        // $datosEvento->resourceId = $request->resourceId;
        $datosEvento->id_especialist = $request->id_especialist;
        $datosEvento->descripcion = $request->descripcion;

        if( $request->id_status == '1'){

            $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');

        }else if( $request->id_status == '2'){

            $datosEvento->image = asset('img/iconos_serv/cancelado.png');

        }else if( $request->id_status == '3'){

             $datosEvento->image = asset('img/iconos_serv/sin_asistencia.png');

        }else if( $request->id_status == '4'){

             $datosEvento->image = asset('img/iconos_serv/pendiente.png');

        }else if( $request->id_status == '5'){

             $datosEvento->image = asset('img/iconos_serv/pagadoo.png');
        }
        else if( $request->id_status == '6'){

            $datosEvento->image = asset('img/iconos_serv/reagendado.png');

        }

        $datosEvento->update();

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
        }else{
            $cliente = $request->get('id_client');
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

        $cosmes = $request->get('cosmes');

        $users = User::whereIn('name', $cosmes)->get();

        $colors = $users->pluck('color')->filter()->all();
        $finalColor = $this->combineColors($colors);

        foreach ($users as $user) {
            $datosEvento = new Alertas;
            $datosEvento->start = $startDateTime;
            $datosEvento->end = $endDateTime;
            $datosEvento->id_servicio = $request->servicioIdInput;
            if($request->get('pagoInput') == NULL){
                $datosEvento->id_status = 5;
            }else{
                $datosEvento->id_status = 1;
            }
            $datosEvento->estatus = $datosEvento->Status->estatus;
            $datosEvento->color = $datosEvento->Status->color;
            $datosEvento->id_client = $cliente;
            $full_name = $datosEvento->Client->name.$datosEvento->Client->last_name;
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
            $data = array(
                'id_alerta' => $datosEvento->id,
                'id_user' => $user->id,
            );

            $insert_data[] = $data;

            AlertasCosmes::insert($insert_data);
        }

        Session::flash('success', 'Se ha guardado su nota con exito');
        return redirect()->back()->with('success', 'Agenda created successfully');
    }

    public function store_agenda_manual(Request $request)
    {
        $fechaActual = date('Y-m-d');

        if ($request->get('name') != NULL) {
            $client = new Client;
            $client->name = $request->get('name');
            $client->last_name = $request->get('last_name');
            $client->phone = $request->get('phone');
            //$client->email = $request->get('email');
            $client->save();
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
            $datosEvento->id_client = $request->id_client_manual;
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
        return redirect()->back()->with('success', 'Agenda created successfully');
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
