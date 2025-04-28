<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Client;
use App\Models\ConcentimientoFacial;
use App\Models\ConsentimeintoJacuzzi;
use App\Models\ConsentimientoCorporal;
use App\Models\LashLifting;
use App\Models\Notas;
use App\Models\NotasLacer;
use App\Models\NotasPedidos;
use App\Models\Paquetes;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilClienteController extends Controller
{
    public function index(){
        $clientes = Client::get();
        return view('client.perfil.index', compact('clientes'));
    }

    public function searchName(Request $request){
        $search = $request->get('q');

        $users = Client::where('name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->get();

        // Combina los resultados y elimina duplicados
        $results = $users->unique('name');

        return response()->json($results);
    }

    public function searchPhone(Request $request){
        $search = $request->get('q');

        $users = Client::where('phone', 'LIKE', "%{$search}%")->get();

        // Combina los resultados y elimina duplicados
        $results = $users->unique('phone');

        return response()->json($results);
    }

    public function buscador(Request $request){
        $phone = $request->phone;
        $name = $request->id_client;

        $cliente = null;

        if ($phone !== null) {
            $cliente = Client::where('phone', '=', $phone)->first();
        }

        if ($name !== null) {
            $cliente = Client::where('id', '=', $name)->first();
        }

        return view('client.perfil.index', compact('cliente'));
    }

    public function informacion(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();

        return view('client.perfil.index',compact('cliente'));
    }

    public function servicios(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();
        $servicios = Notas::where('id_client', '=', $id)->orderBy('id','DESC')->get();

        return view('client.perfil.index',compact('cliente', 'servicios'));
    }

    public function paquetes(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();
        $paquetes = Paquetes::where('id_client', '=', $id)->orderBy('id','DESC')->get();

        return view('client.perfil.index',compact('cliente', 'paquetes'));
    }

    public function laser(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();
        $laser = NotasLacer::where('id_client', '=', $id)->orderBy('id','DESC')->get();

        return view('client.perfil.index',compact('cliente', 'laser'));
    }

    public function consentimientos(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();
        $ConcentimientoFacial = ConcentimientoFacial::where('id_client', '=', $id)->get();
        $ConsentimeintoJacuzzi = ConsentimeintoJacuzzi::where('id_client', '=', $id)->get();
        $ConsentimientoCorporal = ConsentimientoCorporal::where('id_client', '=', $id)->get();
        $LashLifting = LashLifting::where('id_client', '=', $id)->get();

        return view('client.perfil.index',compact('cliente', 'ConcentimientoFacial', 'ConsentimeintoJacuzzi', 'ConsentimientoCorporal', 'LashLifting'));
    }

    public function citas(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();
        $subquery = Alertas::where('id_client', '=', $id)->where('start', '>', now())->orderBy('id','DESC')->get();
        $servicios_select = Servicios::select('nombre', 'id')->get();
        $alertas = $subquery;

        $User = User::whereNotNull('resourceId')->pluck('name', 'resourceId');

        $servicios = Servicios::pluck('nombre', 'id');
        foreach ($alertas as $alerta) {
            $alerta->cosmetologa = $User->get($alerta->resourceId, 'Desconocido'); // Por si el resourceId no existe en clientes
            $alerta->service_name = $servicios->get($alerta->id_servicio, 'No asignado'); // Nombre del servicio
        }

        return view('client.perfil.index',compact('cliente', 'alertas', 'servicios_select'));
    }

    public function productos(Request $request, $id){

        $cliente = Client::where('id', '=', $id)->first();
        $productos = NotasPedidos::where('id_client', '=', $id)->orderBy('id','DESC')->get();

        return view('client.perfil.index',compact('cliente', 'productos'));
    }
}
