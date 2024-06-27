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
        $hoy = Carbon::now();
        // Fecha dentro de 3 días
        $fechaDentroDeTresDias = $hoy->copy()->addDays(3)->format('Y-m-d');

        // Filtrar alertas que inician dentro de 3 días
        $alertas = Alertas::whereRaw("DATE(start) = ?", [$fechaDentroDeTresDias])->get();
        $estatus = Status::get();

        return view('alerts_recordatorios.index', compact('alertas', 'estatus'));
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
}
