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
        $client = Client::orderBy('name', 'asc')->get();
        $cosme = User::get();
        $estatus = Status::get();
        $alert = Alertas::get();
        $cosmes_alerts = AlertasCosmes::get();
        $servicios = Servicios::get();
        // $especialist = DB::table('especialists')->get();
        $especialist = User::get();
        $colores = Colores::get();
        $Configuracion = Configuracion::first();

        $modulos = [];

        for ($i = 1; $i <= $Configuracion->modulos; $i++) {
            $letra = chr(64 + $i);
            $modulos[] = ['id' => $letra, 'title' => 'Modulo ' . $letra];
        }

        return view('dashboard', compact('client', 'alert','especialist', 'colores','servicios','cosme','cosmes_alerts','estatus','modulos'));

    }

    public function store_calendar(Request $request)
    {

        $datosEvento = new Alertas;
        $datosEvento->start = $request->start;
        $datosEvento->end = $request->end;
        $datosEvento->id_color = $request->id_color;
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
        $datosEvento->image = asset('img/iconos_serv/'.$datosEvento->Colores->imagen);

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
        $datosEvento->id_color = $request->id_color;
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
        $datosEvento->image = asset('img/iconos_serv/'.$datosEvento->Colores->imagen);
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
}
