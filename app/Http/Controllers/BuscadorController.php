<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Client;
use App\Models\ConsentimeintoFirmasJacuzzi;
use App\Models\ConsentimeintoJacuzzi;
use App\Models\ConsentimientoCorporal;
use App\Models\Notas;
use App\Models\NotasPedidos;
use App\Models\Paquetes;
use App\Models\Reporte;
use Illuminate\Http\Request;
use DB;

class BuscadorController extends Controller
{
    public function index() {

        $clients = Client::all();
        // $telefonosDuplicados = DB::table('clients')
        // ->select('phone', DB::raw('COUNT(*) as cantidad'))
        // ->groupBy('phone')
        // ->having('cantidad', '>', 1)
        // ->pluck('phone');

        // foreach ($telefonosDuplicados as $telefono) {
        //     // Encuentra los registros duplicados con el mismo número de teléfono
        //     $clientesDuplicados = Client::where('phone', $telefono)->get();

        //     // Mantén el cliente más antiguo y actualiza las relaciones en las notas
        //     $clientePrincipal = $clientesDuplicados->sortBy('created_at')->first();

        //     // Actualiza las relaciones en las notas para apuntar al cliente principal
        //     foreach ($clientesDuplicados as $cliente) {
        //         if ($cliente->id !== $clientePrincipal->id) {
        //             Notas::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //             Paquetes::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //             NotasPedidos::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //             Reporte::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //             Alertas::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //             ConsentimeintoJacuzzi::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //             ConsentimientoCorporal::where('id_client', $cliente->id)->update(['id_client' => $clientePrincipal->id]);
        //         }
        //     }

        //     // Elimina los clientes duplicados, excepto el principal
        //     $clientesDuplicados->except($clientePrincipal->id)->each->delete();
        // }
        return view('buscador.index', compact('clients'));
    }

    public function advance(Request $request) {
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

        return view('buscador.index', compact('nota', 'paquetes'));
    }



}
