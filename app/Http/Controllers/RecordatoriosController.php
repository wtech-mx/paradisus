<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RecordatoriosController extends Controller
{
    public function index(Request $request){

        return view('alerts_recordatorios.index');
    }

    public function advance(Request $request) {

        $fecha = $request->input('fecha');;

        $alertas = Alertas::whereRaw('DATE(start) = ?', [$fecha])->get();

        return view('alerts_recordatorios.index', compact('alertas'));
    }

    public function getClientPhone($clientId){
        $client = Client::find($clientId);
        return response()->json(['phone' => $client->phone]);
    }

    public function update_recordatorios(Request $request,$id)
    {
        $alerta = Alertas::find($id);
        $alerta->id_status = $request->id_estatus;
        $alerta->estatus = $alerta->Status->estatus;
        $alerta->color = $alerta->Status->color;
        $alerta->descripcion = $request->descripcion;
        $alerta->update();

        Session::flash('edit', 'Se ha editado el estatus con exito');
        return redirect()->back();
    }

    public function ChangePendienteStatus(Request $request)
    {
        $servicio = Alertas::find($request->id);
        $servicio->recordatorio = $request->recordatorio;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }
}
