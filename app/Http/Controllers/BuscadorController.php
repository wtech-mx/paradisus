<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Client;
use App\Models\ConcentimientoFacial;
use App\Models\ConsentimeintoFirmasJacuzzi;
use App\Models\ConsentimeintoJacuzzi;
use App\Models\ConsentimientoCorporal;
use App\Models\ConsentimientoFirmasCorporal;
use App\Models\ConsentimientoFirmasFacial;
use App\Models\LashLifting;
use App\Models\LashLiftingFirma;
use App\Models\Notas;
use App\Models\NotasPedidos;
use App\Models\Paquetes;
use App\Models\Reporte;
use Illuminate\Http\Request;
use DB;
Use Alert;

class BuscadorController extends Controller
{
    public function index() {

        $clients = Client::all();

        return view('buscador.index', compact('clients'));
    }

    public function advance(Request $request) {

        $request->validate([
            'id_client' => 'required_without_all:phone',
            'phone' => 'required_without_all:id_client',
        ]);


        $id_client = $request->id_client;
        $phone = $request->phone;

        $nota = [];
        $paquetes = [];

        if ($id_client !== 'null' && $id_client !== null) {
            $nota = Notas::where('id_client', $id_client)->get();
            $paquetes = Paquetes::where('id_client', $id_client)->get();
        } elseif ($phone !== 'null' && $phone !== null) {
            $nota = Notas::where('id_client', $phone)->get();
            $paquetes = Paquetes::where('id_client', $phone)->get();
        }

        Alert::success('Encontrado con exito ');

        return view('buscador.index', compact('nota', 'paquetes'));
    }



}
