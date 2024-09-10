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
use App\Models\Horario;
use App\Models\BiracoraHorariosAlertas;

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

    public function falta_cosmes(){
        $bitacora_horario = BiracoraHorariosAlertas::where('fecha_inicio', '<', Carbon::now())->get();

        return view('alerts.index_faltas', compact('bitacora_horario'));
    }

    public function index_calendar()
    {
        // Obtener la fecha y hora actual
        $now = Carbon::now();
        $fechaActual = date('Y-m-d');
        $estatus = Status::get();
        $alert = Alertas::get();
        $cosmes_alerts = AlertasCosmes::get();
        $servicios = Servicios::where('estatus', '=', null)->orderBy('nombre')->get();
        $colores = Colores::get();
        $Configuracion = Configuracion::first();
        $bitacora_horario = BiracoraHorariosAlertas::where('fecha_inicio', '>', Carbon::now())->get();

        $dia_bitacora = BiracoraHorariosAlertas::where('fecha_inicio','=',$fechaActual)->get();
        $fechaActualhorario = Carbon::now()->format('Y-m-d');

        // Buscar registros en BiracoraHorariosAlertas donde la fecha_inicio sea la fecha actual
        $alertasHoy = BiracoraHorariosAlertas::whereDate('fecha_inicio', $fechaActualhorario)->get();

        // Procesar alertas para la fecha actual (intercambio de horarios)
        foreach ($alertasHoy as $item) {
            $this->intercambiarHorarios($item);
            $cosme_faltante = User::where('id', $item->id_cosmetologa_faltante)->first();
            $cosme_sustituye = User::where('id', $item->id_cosmetologa_sustituye)->first();
            $alertas = Alertas::whereDate('start', $item->fecha_inicio)->where('resourceId', $cosme_faltante->resourceId)->get();
            foreach ($alertas as $alerta) {
                $alerta->resourceId = $cosme_sustituye->resourceId;
                $alerta->save();
            }
        }

        // Buscar registros en BiracoraHorariosAlertas donde la fecha_inicio sea un día antes de la fecha actual
        $alertasDespues = BiracoraHorariosAlertas::whereDate('fecha_inicio', '<', $fechaActual)
        ->whereDate('fecha_inicio', '=', Carbon::parse($fechaActual)->subDay()->format('Y-m-d'))
        ->get();


        // Procesar alertas para el día siguiente a la fecha_inicio (restauración de horarios)
        foreach ($alertasDespues as $item) {
            $this->restaurarHorarios($item);
            $cosme_faltante = User::where('id', $item->id_cosmetologa_faltante)->first();
            $cosme_sustituye = User::where('id', $item->id_cosmetologa_sustituye)->first();
            $alertas = Alertas::whereDate('start', $item->fecha_inicio)->where('resourceId', $cosme_sustituye->resourceId)->get();
            foreach ($alertas as $alerta) {
                $alerta->resourceId = $cosme_faltante->resourceId;
                $alerta->save();
            }
        }

        $user_cosmes = User::get();

        $user_cosmetologas = User::where('puesto', 'Cosme')
        ->orderby('name', 'ASC')
        ->get();

        $modulos = [];


        // Iterar sobre los usuarios y generar los módulos
        foreach ($user_cosmetologas as $user) {
            $modulos[] = [
                'id' => $user->resourceId,
                'title' => $user->name,
                'horario' => $user->horario // Incluye el horario del usuario
            ];
        }

        // Obtener los registros que coincidan con la fecha actual
        $horario_alertas = BiracoraHorariosAlertas::whereDate('fecha_inicio', now()->toDateString())->get();
        // Iterar sobre cada registro y actualizar el estatus
        foreach ($horario_alertas as $item) {
            $item->estatus = 'Realizado';
            $item->update();
        }

        $estatus_contador = Status::count();
        $servicios_contador = Servicios::count();
        $t_citas_contador = Alertas::count();
        $p_citas_contador = Alertas::where('start', '>=', $now)->count();
        //Alertas::query()->update(['color' => '#ffca99']);

        return view('dashboard', compact('bitacora_horario','dia_bitacora','user_cosmes','alert', 'colores','servicios', 'servicios_contador', 't_citas_contador', 'p_citas_contador','cosmes_alerts','estatus', 'estatus_contador','modulos'));

    }

protected function intercambiarHorarios($item){
    // Obtener id_cosmetologa_faltante y id_cosmetologa_sustituye
    $id_cosmetologa_faltante = $item->id_cosmetologa_faltante;
    $id_cosmetologa_sustituye = $item->id_cosmetologa_sustituye;

    // Obtener el día de la semana y el valor faltante y sustituye
    [$dia_faltante, $valor_faltante] = explode(' = ', strtolower($item->dia_se_semana_faltante));
    [$dia_sustituye, $valor_sustituye] = explode(' = ', strtolower($item->dia_se_semana_sustituye));

    // Buscar el registro en la tabla 'horario' para el id_cosmetologa_faltante
    $horario_faltante = Horario::where('id_user', $id_cosmetologa_faltante)->first();

    // Buscar el registro en la tabla 'horario' para el id_cosmetologa_sustituye
    $horario_sustituye = Horario::where('id_user', $id_cosmetologa_sustituye)->first();

    if ($horario_faltante && $horario_sustituye) {
        // Intercambiar los valores en el horario
        $horario_faltante->$dia_faltante = $valor_sustituye;
        $horario_sustituye->$dia_sustituye = $valor_faltante;

        // Guardar los cambios en la base de datos
        $horario_faltante->save();
        $horario_sustituye->save();
    }
}


protected function restaurarHorarios($item)
{
    // Obtener id_cosmetologa_faltante y id_cosmetologa_sustituye
    $id_cosmetologa_faltante = $item->id_cosmetologa_faltante;
    $id_cosmetologa_sustituye = $item->id_cosmetologa_sustituye;

    // Obtener el día de la semana y el valor faltante y sustituye
    [$dia_faltante, $valor_sustituye] = explode(' = ', strtolower($item->dia_se_semana_faltante));
    [$dia_sustituye, $valor_faltante] = explode(' = ', strtolower($item->dia_se_semana_sustituye));

    // Buscar el registro en la tabla 'horario' para el id_cosmetologa_faltante
    $horario_faltante = Horario::where('id_user', $id_cosmetologa_faltante)->first();

    // Buscar el registro en la tabla 'horario' para el id_cosmetologa_sustituye
    $horario_sustituye = Horario::where('id_user', $id_cosmetologa_sustituye)->first();

    if ($horario_faltante && $horario_sustituye) {

        // Restaurar los valores originales en el horario
        // Primero guardamos los valores actuales en variables temporales
        $valor_faltante_actual = $horario_faltante->$dia_faltante;
        $valor_sustituye_actual = $horario_sustituye->$dia_sustituye;

        // Actualizamos los valores en el horario
        $horario_faltante->$dia_faltante = $valor_sustituye;
        $horario_sustituye->$dia_sustituye = $valor_faltante;

        $actualzaicion_bitacora = BiracoraHorariosAlertas::find($item->id);
        $actualzaicion_bitacora->estatus = 'Finalizado';
        $actualzaicion_bitacora->save();


        // Guardar los cambios en la base de datos
        $horario_faltante->save();
        $horario_sustituye->save();
    }
}

public function index_calendar_anterior()
    {
        $estatus = Status::get();
        $alert = Alertas::get();
        $cosmes_alerts = AlertasCosmes::get();
        $servicios = Servicios::orderBy('nombre')->get();
        $colores = Colores::get();

        $user_cosmes = User::get();

        $user_cosmetologas = User::where('puesto', 'Cosme')
        ->orderby('name', 'ASC')
        ->get();

        $modulos = [];

        // Iterar sobre los usuarios y generar los módulos
        foreach ($user_cosmetologas as $user) {
            $modulos[] = [
                'id' => $user->resourceId,
                'title' => $user->name,
                'horario' => $user->horario // Incluye el horario del usuario
            ];
        }

        return view('dashboard_anterior', compact('user_cosmes','alert', 'colores','servicios', 'cosmes_alerts','estatus','modulos'));

    }

public function buscarAlertas(Request $request)
    {
        $titulo = $request->input('titulo');
        //    $alertas = Alertas::where('title', 'LIKE', "%{$titulo}%")->get();

        $subquery = Alertas::select(DB::raw('MAX(id) as latest_id'))
            ->where('title', 'LIKE', "%{$titulo}%")
            ->groupBy('id_servicio');

        $alertas = Alertas::whereIn('id', $subquery->pluck('latest_id'))->get();

        // Obtener todos los clientes (usuarios) con resourceId
        $clientes = User::whereNotNull('resourceId')->pluck('name', 'resourceId');

        // Obtener todos los servicios con id_servicio
        $servicios = Servicios::pluck('nombre', 'id');

        $servicios_select = Servicios::select('nombre', 'id')->get();
        // Añadir el nombre del cliente a cada alerta
        foreach ($alertas as $alerta) {
            $alerta->cosmetologa = $clientes->get($alerta->resourceId, 'Desconocido'); // Por si el resourceId no existe en clientes
            $alerta->service_name = $servicios->get($alerta->id_servicio, 'No asignado'); // Nombre del servicio
        }

        // dd($alertas);

        return view('alerts.resultados', compact('alertas', 'servicios_select'));
    }

public function store_prox_cita(Request $request)
    {
       // Combina la fecha y la hora seleccionada
       $startDateTime = $request->start;
       $cosmes = $request->get('modal_cita_cosme');

       $users = User::whereIn('id', $cosmes)->get();
       $colors = $users->pluck('color')->filter()->all();

       $insert_data = [];

       foreach ($users as $user) {
           $datosEvento = new Alertas;
           $datosEvento->id_color = $request->modal_cita_num_sesion;
           $datosEvento->id_servicio = $request->modal_cita_id_servicio;
           $datosEvento->id_status = 1;
           $datosEvento->estatus = $datosEvento->Status->estatus;
           $datosEvento->color = $datosEvento->Status->color;
           $datosEvento->id_client = $request->get('modal_cita_cliente_id');
           $full_name = $datosEvento->Client->name . ' ' . $datosEvento->Client->last_name;
           $datosEvento->title = $full_name;
           $datosEvento->telefono = $datosEvento->Client->phone;
           $datosEvento->id_especialist = auth()->user()->id;
           $datosEvento->id_nota = $request->modal_cita_id_nota;
           $datosEvento->id_paquete = $request->modal_cita_id_paquete;
           $datosEvento->id_laser = $request->modal_cita_id_laser;
           $datosEvento->descripcion = $request->modal_cita_descripcion;
           $datosEvento->image = asset('img/iconos_serv/1686195647.voto-positivo.png');
           $datosEvento->resourceId = $user->resourceId;

           $servicio = Servicios::find($request->modal_cita_id_servicio);
           $duracion = $servicio->duracion; // Duración en minutos

           $servicio2 = Servicios::find($request->id_servicio2);
           if($servicio2 == null){
               $duracion2 = '0';
           }else{
               $duracion2 = $servicio2->duracion; // Duración en minutos
           }
           $suma_duracion = $duracion + $duracion2;

           // Combina la fecha y la hora seleccionada
           $startDateTimeString = $request->modal_cita_fecha_inicio . $request->modal_cita_hora_inicio;
           $startDateTime = Carbon::parse($startDateTimeString);

           if($request->mod_hora_fin == 'si'){

               $datosEvento->start = $startDateTime->format('Y-m-d H:i:s');
               $datosEvento->end = $request->end;

           }else{
               // Calcula la hora de finalización
               $endDateTime = $startDateTime->copy()->addMinutes($suma_duracion);
               $datosEvento->start = $startDateTime->format('Y-m-d H:i:s');
               $datosEvento->end = $endDateTime->format('Y-m-d H:i:s');
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

           return response()->json(['success' => true]);

       }
    //    return redirect()->back()->with('success', 'Alerta actualizada con éxito');


    }

    public function show_calendar(Request $request)
    {
        // Obtener la fecha de inicio y fin del rango visible en el calendario
        $start = $request->query('start'); // Fecha de inicio
        $end = $request->query('end'); // Fecha de fin

        // Filtrar las alertas solo dentro del rango de fechas proporcionado
        $alertas = Alertas::with('Servicios_id')
            ->whereBetween('start', [$start, $end])
            ->get()
            ->makeHidden(['comprobante_gratis','tarjeta_regalo','recordatorio','confirmo_whats','created_at','updated_at','id_color']);

        $alertas->each(function ($alerta) {
            $alerta->cosmes = AlertasCosmes::where('id_alerta', $alerta->id)->pluck('id_user')->toArray();
            $alerta->nombre_servicio = $alerta->Servicios_id ? $alerta->Servicios_id->nombre : null;
            $alerta->nombre_servicio2 = $alerta->Servicios_id2 ? $alerta->Servicios_id2->nombre : '.';
            $alerta->duracion = $alerta->Servicios_id ? $alerta->Servicios_id->duracion : null;
            $alerta->duracion2 = $alerta->Servicios_id2 ? $alerta->Servicios_id2->duracion : null;

            // Obtener los servicios anteriores del mismo cliente
            $serviciosAnteriores = Alertas::select('id', 'id_client', 'id_especialist', 'start', 'end', 'estatus')
                ->where('id_client', $alerta->id_client)
                ->where('start', '<', $alerta->start)
                ->get()
                ->makeHidden(['nombre_servicio']);


            $serviciosAnteriores->each(function ($servicioAnterior) {
                $servicioAnterior->cosmes = AlertasCosmes::where('id_alerta', $servicioAnterior->id)->pluck('id_user')->toArray();
                $servicioAnterior->nombre_servicio = $servicioAnterior->Servicios_id ? $servicioAnterior->Servicios_id->nombre : null;
            });

            $alerta->servicios_anteriores = $serviciosAnteriores;
        });

        return response()->json($alertas);
    }

    public function show_calendar_anterior()
    {
        $currentDate = Carbon::now();

        // Obtener la fecha de inicio del mes actual y del mes anterior
        $startOfCurrentMonth = $currentDate->copy()->startOfMonth();
        $startOfPreviousMonth = $startOfCurrentMonth->copy()->subMonth();

        // Filtrar alertas que tienen una fecha de inicio antes del inicio del mes actual
        // y desde el inicio del mes anterior hacia atrás
        $alertas = Alertas::select('id', 'id_client', 'id_especialist', 'id_servicio', 'id_status', 'color', 'resourceId', 'estatus', 'image', 'descripcion', 'telefono', 'title', 'start', 'end', 'id_nota', 'id_laser', 'id_paquete', 'id_servicio2')
            ->where('start', '<', $startOfCurrentMonth)
            ->where('start', '>=', $startOfPreviousMonth)
            ->get();

        $alertas->each(function ($alerta) {
            // Obtener las cosmetólogas asociadas
            $alerta->cosmes = AlertasCosmes::where('id_alerta', $alerta->id)->pluck('id_user')->toArray();
            $alerta->nombre_servicio = $alerta->Servicios_id ? $alerta->Servicios_id->nombre : null;
            $alerta->nombre_servicio2 = $alerta->Servicios_id2 ? $alerta->Servicios_id2->nombre : '.';
            $alerta->duracion = $alerta->Servicios_id ? $alerta->Servicios_id->duracion : null; // Añadir la duración del servicio
            $alerta->duracion2 = $alerta->Servicios_id2 ? $alerta->Servicios_id2->duracion : null; // Añadir la duración del servicio

            // Obtener los servicios anteriores del mismo cliente con los campos necesarios
            $serviciosAnteriores = Alertas::select('id', 'id_client', 'id_especialist','start','end','estatus')

                ->where('id_client', $alerta->id_client)
                ->where('start', '<', $alerta->start)
                ->get();

            // Añadir detalles adicionales a cada servicio anterior
            $serviciosAnteriores->each(function ($servicioAnterior) {
                $servicioAnterior->cosmes = AlertasCosmes::where('id_alerta', $servicioAnterior->id)->pluck('id_user')->toArray();
                // Traer el nombre del servicio si es necesario
                $servicioAnterior->nombre_servicio = $servicioAnterior->Servicios_id ? $servicioAnterior->Servicios_id->nombre : null;
            });

            // Anidar los servicios anteriores en el objeto alerta
            $alerta->servicios_anteriores = $serviciosAnteriores;
        });

        return response()->json($alertas);
    }

    public function store_comidas(Request $request)
    {
        $cosmes = $request->get('cosmesComida');
        $users = User::whereIn('id', $cosmes)->get();

        $fechaInicioComida = $request->get('fecha_inicio_comida');
        $horaInicioComida = $request->get('hora_inicio_comida');

        $fechaFinComida = $request->get('fecha_fin_comida');
        $horaFinComida = $request->get('hora_fin_comida');

        // Mapeo de días en inglés a español sin acentos
        $diasSemana = [
            'monday'    => 'lunes',
            'tuesday'   => 'martes',
            'wednesday' => 'miercoles',
            'thursday'  => 'jueves',
            'friday'    => 'viernes',
            'saturday'  => 'sabado',
            'sunday'    => 'domingo',
        ];

        // Convierte las fechas en objetos Carbon
        $startCarbon = Carbon::createFromFormat('Y-m-d', $fechaInicioComida);
        $endCarbon = Carbon::createFromFormat('Y-m-d', $fechaFinComida);

        // Itera sobre cada día entre las fechas de inicio y fin
        for ($date = $startCarbon; $date->lte($endCarbon); $date->addDay()) {
            // Obtener el nombre del día en inglés y luego traducirlo al español
            $nombreDiaIngles = strtolower($date->format('l')); // Ejemplo: 'monday', 'tuesday'
            $nombreDia = $diasSemana[$nombreDiaIngles]; // Convertir a español sin acentos

            foreach ($users as $user) {
                // Verificar si el usuario trabaja ese día
                $horario = $user->horario; // Acceder al horario del usuario
                if ($horario && $horario->{$nombreDia} == 1) {

                    // Combina la fecha actual del bucle con las horas especificadas
                    $startOfDay = $date->copy()->format('Y-m-d') . ' ' . $horaInicioComida;
                    $endOfDay = $date->copy()->format('Y-m-d') . ' ' . $horaFinComida;

                    // Convierte las cadenas en objetos Carbon
                    $startFormatted = Carbon::createFromFormat('Y-m-d H:i', $startOfDay)->format('Y-m-d H:i:s');
                    $endFormatted = Carbon::createFromFormat('Y-m-d H:i', $endOfDay)->format('Y-m-d H:i:s');
                    // Crear el evento si trabaja ese día
                    $datosEvento = new Alertas;
                    $datosEvento->start = $startFormatted;
                    $datosEvento->end = $endFormatted;
                    $datosEvento->id_status = 7;
                    $datosEvento->color = $datosEvento->Status->color;
                    $datosEvento->title = $user->name . ' Comida';
                    $datosEvento->image = asset('assets/icons/muchacha.png');
                    $datosEvento->resourceId = $user->resourceId;
                    $datosEvento->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Alerta actualizada con éxito');
    }



    public function updateMultipleUsers(Request $request)
    {
        $usuarios = $request->input('usuarios');

        foreach ($usuarios as $userId => $horarios) {
            $horario = Horario::where('id_user', $userId)->first();

            if ($horario) {
                $horario->update([
                    'lunes' => isset($horarios['lunes']) ? 1 : 0,
                    'martes' => isset($horarios['martes']) ? 1 : 0,
                    'miercoles' => isset($horarios['miercoles']) ? 1 : 0,
                    'jueves' => isset($horarios['jueves']) ? 1 : 0,
                    'viernes' => isset($horarios['viernes']) ? 1 : 0,
                    'sabado' => isset($horarios['sabado']) ? 1 : 0,
                    'domingo' => isset($horarios['domingo']) ? 1 : 0,
                ]);
            } else {
                Horario::create([
                    'id_user' => $userId,
                    'lunes' => isset($horarios['lunes']) ? 1 : 0,
                    'martes' => isset($horarios['martes']) ? 1 : 0,
                    'miercoles' => isset($horarios['miercoles']) ? 1 : 0,
                    'jueves' => isset($horarios['jueves']) ? 1 : 0,
                    'viernes' => isset($horarios['viernes']) ? 1 : 0,
                    'sabado' => isset($horarios['sabado']) ? 1 : 0,
                    'domingo' => isset($horarios['domingo']) ? 1 : 0,
                ]);
            }
        }

        // return redirect()->back()->with('success', 'Alerta actualizada con éxito');

        return response()->json(['success' => true]);
    }

    public function bitacora_horarios(Request $request)
    {
        // Obtener datos del request
        $horaio_fecha_inicio = $request->input('horaio_fecha_inicio');
        $horario_cosme_faltante = $request->input('horario_cosme_faltante');
        $horario_cosme_sustituye = $request->input('horario_cosme_sustituye');

        // Extraer el día de la semana de la fecha_inicio
        $dia_de_la_semana = \Carbon\Carbon::parse($horaio_fecha_inicio)->format('l'); // Día de la semana en inglés

        // Traducir el día al español
        $dias_en_espanol = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sabado',
            'Sunday' => 'domingo',
        ];
        $dia_de_la_semana_es = $dias_en_espanol[$dia_de_la_semana]; // Traducir el día al español

        // Buscar en la tabla 'horario' el registro que corresponde a id_cosmetologa_faltante
        $cosme_horaio_faltante = Horario::where('id_user', $horario_cosme_faltante)->first();
        $cosme_horaio_sustituye = Horario::where('id_user', $horario_cosme_sustituye)->first();

        // Obtener dinámicamente el valor del día de la semana (por ejemplo, 'sabado')
        $valor_dia_faltante = $cosme_horaio_faltante->$dia_de_la_semana_es;
        $valor_dia_sustituye = $cosme_horaio_sustituye->$dia_de_la_semana_es;

        $dia_y_valor_faltante = ucfirst($dia_de_la_semana_es) . " = " . $valor_dia_faltante;
        $dia_y_valor_sustituye = ucfirst($dia_de_la_semana_es) . " = " . $valor_dia_sustituye;

        // Crear un nuevo registro en bitacora_horarios_alertas
        $bitacora_horario = new BiracoraHorariosAlertas;
        $bitacora_horario->fecha_inicio = $horaio_fecha_inicio;
        $bitacora_horario->fecha_fin = $request->get('horario_fecha_fin');
        $bitacora_horario->id_cosmetologa_faltante = $horario_cosme_faltante;
        $bitacora_horario->id_cosmetologa_sustituye = $horario_cosme_sustituye;
        $bitacora_horario->comentario = $request->get('horario_descripcion');
        $bitacora_horario->estatus = 'Pendiente';

        // Guardar el día de la semana correspondiente en dia_se_semana_faltante y dia_se_semana_sustituye
        $bitacora_horario->dia_se_semana_faltante = $dia_y_valor_faltante;
        $bitacora_horario->dia_se_semana_sustituye = $dia_y_valor_sustituye;

        // Guardar el registro
        $bitacora_horario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Alerta actualizada con éxito');
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

        // Combina la fecha y la hora seleccionada
        $startDateTime = $request->start;

        $cosmes = $request->get('cosmesInput');

        $users = User::whereIn('id', $cosmes)->get();
        $colors = $users->pluck('color')->filter()->all();

        $insert_data = [];

        foreach ($users as $user) {
            $datosEvento = new Alertas;
            $datosEvento->id_servicio = $request->id_servicio;
            $datosEvento->id_servicio2 = $request->id_servicio2;
            if ($cliente == 3841) {
                $datosEvento->id_status = 5;
            } else {
                $datosEvento->id_status = $request->id_status;
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

            $servicio2 = Servicios::find($request->id_servicio2);
            if($servicio2 == null){
                $duracion2 = '0';
            }else{
                $duracion2 = $servicio2->duracion; // Duración en minutos
            }
            $suma_duracion = $duracion + $duracion2;

            // Combina la fecha y la hora seleccionada
            $startDateTimeString = $request->start;
            $startDateTime = Carbon::parse($startDateTimeString);

            if($request->mod_hora_fin == 'si'){

                $datosEvento->start = $startDateTime->format('Y-m-d H:i:s');
                $datosEvento->end = $request->end;

            }else{
                // Calcula la hora de finalización
                $endDateTime = $startDateTime->copy()->addMinutes($suma_duracion);
                $datosEvento->start = $startDateTime->format('Y-m-d H:i:s');
                $datosEvento->end = $endDateTime->format('Y-m-d H:i:s');
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

        if (strpos($servicio->nombre, 'Jacuzzi') !== false) {
            $datosEvento_jacuzzi = new Alertas;
            $datosEvento_jacuzzi->start = $datosEvento->end;
            $start = Carbon::parse($datosEvento_jacuzzi->start);
            $datosEvento_jacuzzi->end = $start->addMinutes(30);
            $datosEvento_jacuzzi->id_servicio = $request->id_servicio;
            if ($cliente == 3841) {
                $datosEvento_jacuzzi->id_status = 5;
            } else {
                $datosEvento_jacuzzi->id_status = $request->id_status;
            }
            $datosEvento_jacuzzi->estatus = $datosEvento_jacuzzi->Status->estatus;
            $datosEvento_jacuzzi->color = $datosEvento_jacuzzi->Status->color;
            $datosEvento_jacuzzi->id_client = $cliente;
            $full_name = $datosEvento_jacuzzi->Client->name . ' ' . $datosEvento_jacuzzi->Client->last_name;
            $datosEvento_jacuzzi->title = $full_name;
            $datosEvento_jacuzzi->telefono = $datosEvento_jacuzzi->Client->phone;
            $datosEvento_jacuzzi->id_especialist = $request->id_especialist;
            $datosEvento_jacuzzi->id_nota = $request->id_notaModal;
            $datosEvento_jacuzzi->id_paquete = $request->id_paqueteModal;
            $datosEvento_jacuzzi->id_laser = $request->id_laserModal;
            $datosEvento_jacuzzi->descripcion = $request->descripcion;
            $datosEvento_jacuzzi->image = asset('img/iconos_serv/1686195647.voto-positivo.png');
            $datosEvento_jacuzzi->resourceId = 'J';
            $datosEvento_jacuzzi->save();

            $cosme_jacuzzi = new AlertasCosmes;
            $cosme_jacuzzi->id_alerta = $datosEvento_jacuzzi->id;
            $cosme_jacuzzi->id_user = 38;
            $cosme_jacuzzi->save();
        }

        if (!empty($insert_data)) {
            AlertasCosmes::insert($insert_data);
        }
    }

    public function update_calendar(Request $request, $id)
    {

        if($request->id_status == 7){
            $startDateTimeString = $request->start;
            $startDateTime = Carbon::parse($startDateTimeString);

            $datosEvento = Alertas::find($id);
            $datosEvento->start = $startDateTime->format('Y-m-d H:i:s');
            $datosEvento->end = $request->end;
            $datosEvento->update();

            return redirect()->back()->with('success', 'Alerta actualizada con éxito');
        }

        $cliente = $request->cliente_id;
        $startDateTime = Carbon::parse($request->start);;
        $datosEvento = Alertas::find($id);
        $datosEventoStart = Carbon::parse($datosEvento->start);


        if ($datosEventoStart->format('Y-m-d') != $startDateTime->format('Y-m-d')) {
            $diaSemana = strtolower($startDateTime->format('l')); // Obtiene el día de la semana en inglés
            $diasSemanaEspañol = [
                'monday' => 'lunes',
                'tuesday' => 'martes',
                'wednesday' => 'miercoles',
                'thursday' => 'jueves',
                'friday' => 'viernes',
                'saturday' => 'sabado',
                'sunday' => 'domingo'
            ];
            $diaEnEspanol = $diasSemanaEspañol[$diaSemana]; // Traduce el día al español

            // Obtener IDs de cosmetólogas seleccionadas
            $cosmesSeleccionadas = $request->input('cosmesInput', []);

            // Verificar disponibilidad de cada cosmetóloga
            foreach ($cosmesSeleccionadas as $idCosme) {
                $horario = Horario::where('id_user', $idCosme)->first();

                if ($horario && $horario->$diaEnEspanol != 1) {

                    return response()->json([
                        'success' => false,
                        'message' => "La cosmetóloga con ID {$idCosme} no trabaja el día {$diaEnEspanol}."
                    ]);

                }
            }
        }

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
                foreach($alertas as $alerta){
                    AlertasCosmes::where('id_alerta', '=', $alerta->id)->whereIn('id_user', $cosmesAEliminar)->delete();
                }
            }
        }

        // Actualiza cada alerta encontrada
        foreach ($alertas as $alerta) {
            $servicio = Servicios::find($request->id_servicio);
            $duracion = $servicio->duracion; // Duración en minutos

            $servicio2 = Servicios::find($request->id_servicio2);
            if($servicio2 == null){
                $duracion2 = '0';
            }else{
                $duracion2 = $servicio2->duracion; // Duración en minutos
            }
            $suma_duracion = $duracion + $duracion2;

            // Combina la fecha y la hora seleccionada
            $startDateTimeString = $request->start;
            $startDateTime = Carbon::parse($startDateTimeString);

            $requestStart = Carbon::parse($request->start);
            $requestStartFormatted = $requestStart->format('Y-m-d H:i:s');

            if($request->mod_hora_fin == 'si'){
                $alerta->start = $startDateTime->format('Y-m-d H:i:s');
                $alerta->end = $request->end;

            }elseif($alerta->id_servicio != $request->id_servicio){
                $endDateTime = $startDateTime->copy()->addMinutes($suma_duracion);
                $alerta->start = $startDateTime->format('Y-m-d H:i:s');
                $alerta->end = $endDateTime->format('Y-m-d H:i:s');

            }elseif($alerta->id_servicio2 != NULL){
                if($alerta->id_servicio2 != $request->id_servicio2){
                    $endDateTime = $startDateTime->copy()->addMinutes($suma_duracion);
                    $alerta->start = $startDateTime->format('Y-m-d H:i:s');
                    $alerta->end = $endDateTime->format('Y-m-d H:i:s');
                }

            }elseif($alerta->start != $requestStartFormatted){
                $endDateTime = $startDateTime->copy()->addMinutes($suma_duracion);
                $alerta->start = $startDateTime->format('Y-m-d H:i:s');
                $alerta->end = $endDateTime->format('Y-m-d H:i:s');
            }
            $alerta->id_servicio = $request->id_servicio;
            $alerta->id_servicio2 = $request->id_servicio2;
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
            AlertasCosmes::where('id_alerta', $alerta->id)->whereIn('id_user', $cosmesAEliminar)->delete();
            AlertasCosmes::where('id_alerta', $alerta->id)->delete();
            Alertas::where('id', '=', $alerta->id)->delete();
        }
        // return redirect()->back()->with('success', 'Alerta actualizada con éxito');

        return response()->json([
            'success' => true,
            'message' => "La Cita se actualizo Correctamente. (Se vera actualizado en algunos segundos)"
        ]);
    }

    public function destroy_calendar($id)
    {
        DB::transaction(function() use ($id) {
            // Encontrar la alerta original
            $alerta = Alertas::find($id);

            if ($alerta) {
                // Encontrar todas las alertas con los mismos datos excepto resourceId
                $alertasParaEliminar = Alertas::where('id_client', $alerta->id_client)
                    ->where('id_especialist', $alerta->id_especialist)
                    ->where('id_nota', $alerta->id_nota)
                    ->where('title', $alerta->title)
                    ->where('descripcion', $alerta->descripcion)
                    ->where('image', $alerta->image)
                    ->where('color', $alerta->color)
                    ->where('start', $alerta->start)
                    ->where('end', $alerta->end)
                    ->where('estatus', $alerta->estatus)
                    ->where('id_servicio', $alerta->id_servicio)
                    ->get();

                foreach ($alertasParaEliminar as $alertaEliminar) {
                    // Eliminar todas las alertas_cosmes relacionadas con id_alerta
                    AlertasCosmes::where('id_alerta', $alertaEliminar->id)->delete();

                    // Eliminar la alerta
                    $alertaEliminar->delete();
                }
            }
        });

        return response()->json(['success' => true, 'id' => $id]);
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

    public function create_falta(Request $request){
        $duracion = 600; // Duración en minutos

        // Combina la fecha y la hora seleccionada
        $startDateTimeString = $request->fecha_falta_disponibilidad . '  10:00:00';
        $startDateTime = Carbon::parse($startDateTimeString);

        // Calcula la hora de finalización
        $endDateTime = $startDateTime->copy()->addMinutes($duracion);
        $user = User::where('id', $request->cosme_falta_disponibilidad)->first();

        $datosEvento = new Alertas;
        $datosEvento->start = $startDateTime;
        $datosEvento->end = $endDateTime;
        $datosEvento->id_status = 8;
        $datosEvento->estatus = 'Falta disponibilidad';
        $datosEvento->color = $datosEvento->Status->color;
        $datosEvento->id_especialist = $request->cosme_falta_disponibilidad;
        $full_name = $datosEvento->User->name . ' Falta disponibilidad';
        $datosEvento->title = $full_name;
        $datosEvento->descripcion = 'Falta disponibilidad';
        $datosEvento->image = $datosEvento->Status->icono;
        $datosEvento->resourceId = $user->resourceId;
        $datosEvento->save();

        return redirect()->back()->with('success', 'Falta de disponibilidad');
    }

}
