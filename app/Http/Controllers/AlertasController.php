<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

use App\Models\Alertas;
use App\Models\Client;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Servicios;
use App\Models\User;
use Carbon\Carbon;
use DateTime;


class AlertasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index_recordatorios()
    // {
    //     $servicios = Servicios::get();
    //     $alert_retenedores = Alertas::where('id_color', '=', 6)->get();
    //     $alert_limpieza = Alertas::where('id_color', '=', 2)->get();

    //     return view('recordatorios.view', compact('alert_retenedores','alert_limpieza','servicios'));
    // }

    public function index_calendar()
    {

        $client = Client::get();

        $cosme = User::get();

        $alert = Alertas::get();

        $servicios = Servicios::get();

        return view('calendario.calendar', compact('client', 'alert', 'servicios', 'cosme'));
    }

    public function store_calendar(Request $request)
    {

        $datosEvento = new Alertas;
        $datosEvento->start = $request->start;
        $datosEvento->end = $request->end;
        $datosEvento->image = $request->image;
        $datosEvento->id_client = $request->id_client;
        $datosEvento->id_especialist = $request->id_especialist;
        $datosEvento->title = $datosEvento->Client->name;
        $datosEvento->telefono = $datosEvento->Client->phone;
        $datosEvento->resource_id = $request->resource_id;
        $datosEvento->descripcion = $request->descripcion;
        $datosEvento->check = $request->check;
        $datosEvento->color = $datosEvento->Servicios->color;

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
        $datosEvento->image = $request->image;
        $datosEvento->id_client = $request->id_client;
        $datosEvento->id_especialist = $request->id_especialist;
        $datosEvento->title = $datosEvento->Client->name;
        $datosEvento->telefono = $datosEvento->Client->phone;
        $datosEvento->resource_id = $request->resource_id;
        $datosEvento->descripcion = $request->descripcion;
        $datosEvento->check = $request->check;
        $datosEvento->color = $datosEvento->Servicios->color;

        $datosEvento->update();

        // if ($datosEvento->check == 2){
        //     $controlpagos = new Controlpagos;
        //     $controlpagos->fecha = $datosEvento->start;
        //     $controlpagos->id_clients = $datosEvento->id_client;
        //     $controlpagos->id_alertas = $id;
        //     $controlpagos->id_doctor = $datosEvento->id_especialist;
        //     $controlpagos->id_color = $datosEvento->color;
        //     $controlpagos->save();
        // }
    }

    public function destroy_calendar($id)
    {
        Alertas::destroy($id);
        return response()->json($id);
    }
}
