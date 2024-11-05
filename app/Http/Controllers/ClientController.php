<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientImport;
use App\Models\ConcentimientoFacial;
use App\Models\ConsentimeintoJacuzzi;
use App\Models\ConsentimientoCorporal;
use App\Models\ConsentimientoFirmasCorporal;
use App\Models\LashLifting;
use Session;
use DB;
use DataTables;
Use Alert;
use App\Models\Alertas;
use App\Models\NotasCosmes;
use App\Models\NotasPedidos;
use App\Models\NotasPropinas;
use App\Models\Pagos;
use App\Models\Paquete2;
use App\Models\Paquete3;
use App\Models\Paquetes;
use App\Models\PaquetesPago;
use App\Models\User;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::all();

        // Paso 1: Identificar duplicados por número de teléfono
        $duplicatedPhones = Client::select('phone')
            ->groupBy('phone')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('phone');

        foreach ($duplicatedPhones as $phone) {
            // Obtener todos los registros con el mismo número de teléfono
            $clientsWithSamePhone = Client::where('phone', $phone)->get();

            // Conservar uno de los registros y obtener su ID
            $clientToKeep = $clientsWithSamePhone->shift(); // Elimina y guarda el primero de la colección
            $clientToKeepId = $clientToKeep->id;

            // Paso 2: Actualizar las tablas relacionadas para que apunten al ID conservado
            $relatedTables = [
                'concentimiento_corporal' => 'id_client',
                'concentimiento_facial' => 'id_client',
                'configuracion_laser' => 'id_cliente',
                'consentimiento_jacuzzi' => 'id_client',
                'consentimiento_laser' => 'id_cliente',
                'hoja_salud_laser' => 'id_cliente',
                'lash_lifting' => 'id_client',
                'notas' => 'id_client',
                'notas_pedidos' => 'id_client',
                'nota_laser' => 'id_client',
                'paquetes_servicios' => 'id_client',
                'reporte' => 'id_client',
                'alertas' => 'id_client',
            ];

            foreach ($relatedTables as $table => $foreignKey) {
                // Verificar si ya existe un registro con el ID que se quiere actualizar
                $existingCount = DB::table($table)
                    ->where($foreignKey, $clientToKeepId)
                    ->count();

                if ($existingCount === 0) {
                    // Actualizar solo si no hay conflicto con el ID conservado
                    DB::table($table)
                        ->whereIn($foreignKey, $clientsWithSamePhone->pluck('id'))
                        ->update([$foreignKey => $clientToKeepId]);
                } else {
                    // Mover los registros a un `id_client` alternativo si ya hay un conflicto
                    $clientsWithSamePhone->shift(); // Avanza al siguiente cliente
                    $clientAlternativeId = $clientsWithSamePhone->first()->id ?? null;

                    if ($clientAlternativeId) {
                        DB::table($table)
                            ->whereIn($foreignKey, $clientsWithSamePhone->pluck('id'))
                            ->update([$foreignKey => $clientAlternativeId]);
                    }
                }
            }

            // Paso 3: Eliminar los registros duplicados
            Client::whereIn('id', $clientsWithSamePhone->pluck('id'))->delete();
        }


        return view('client.index', compact('clients'));
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
            $user = Client::where('id', $id_client)->get();

        } elseif ($phone !== 'null' && $phone !== null) {
            $user = Client::where('id', $phone)->get();
        }

        return view('client.index', compact('user'));
    }

    public function index_facial(Request $request)
    {
        $Concentimientos = ConcentimientoFacial::get();

        return view('client.index_facial', compact('Concentimientos'));
    }

    public function index_show_brow(Request $request)
    {
        $Concentimientos = ConsentimientoCorporal::get();

        return view('client.index_show_brow', compact('Concentimientos'));
    }

    public function index_lash(Request $request)
    {
        $Concentimientos = LashLifting::get();

        return view('client.index_lash', compact('Concentimientos'));
    }

    public function index_jacuzzi(Request $request)
    {
        $Concentimientos = ConsentimeintoJacuzzi::get();

        return view('client.index_jacuzzi', compact('Concentimientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required'
        ]);

        $input = $request->all();

        $servicio = Client::create($input);

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('success', 'Cliente Creado.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, $id)
    {

        $client = Client::find($id);
        $input = $request->all();
        $client->update($input);

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('edit', 'Cliente Actualizado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = Client::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('delete', 'Cliente Eliminado');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new Client, $file);

        return back()->with('message', 'Importanción de usuarios completada');
    }
}
