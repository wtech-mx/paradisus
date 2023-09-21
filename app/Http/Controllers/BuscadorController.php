<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Notas;
use App\Models\Paquetes;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function index() {

        $clients = Client::all();
        return view('buscador.index', compact('clients'));
    }

    public function advance(Request $request) {


        if( $request->id_client !== 'null'){
            $id_client = $request->id_client;
            $nota = Notas::where('id_client', $id_client)->get();
            $paquetes = Paquetes::where('id_client', $id_client)->get();
        }else if($request->phone !== 'null'){
            $phone = $request->phone;
            $nota = Notas::where('id_client', $phone)->get();
            $paquetes = Paquetes::where('id_client', $id_client)->get();
        }

        return view('buscador.index', compact('nota', 'paquetes'));
    }
}
