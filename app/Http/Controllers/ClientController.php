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
        $HistorialVendidos = collect(); // Inicializa como colección vacía

        return view('client.index', compact('clients', 'HistorialVendidos'));
    }


    public function filtro(Request $request){
        $fechaInicialDe = \Carbon\Carbon::parse($request->fecha_inicial_de)->startOfDay();
        $fechaInicialA = \Carbon\Carbon::parse($request->fecha_inicial_a)->endOfDay();

        $HistorialVendidos = Alertas::where('nuevo_cliente', '=', '1')->orderBy('resourceId', 'ASC');

        if ($request->fecha_inicial_de && $request->fecha_inicial_a) {
            $HistorialVendidos = $HistorialVendidos->where('start', '>=', $fechaInicialDe)
                ->where('start', '<=', $fechaInicialA);
        }

        if ($request->cosme && $request->cosme !== 'todos') {
            $HistorialVendidos = $HistorialVendidos->where('resourceId', $request->cosme);
        }

        $HistorialVendidos = $HistorialVendidos->get()
            ->groupBy('id_client')
            ->map(function ($group) {
                // Ordenar el grupo por `resourceId` en orden descendente
                $sortedGroup = $group->sortByDesc('resourceId');
                $firstItem = $sortedGroup->first(); // Usar el primer registro del grupo
                $firstItem->resourceIds = $sortedGroup->pluck('resourceId')->unique()->implode(', '); // Concatenar `resourceId`
                return $firstItem; // Retornar el registro procesado
            });


        return view('client.index', compact('HistorialVendidos'));
    }

    public function clients_nuevos(Request $request)
    {
        $today =  date('d-m-Y');
        $fechaInicialDe = \Carbon\Carbon::parse($request->fecha_inicial_de)->startOfDay();
        $fechaInicialA = \Carbon\Carbon::parse($request->fecha_inicial_a)->endOfDay();

        $HistorialVendidos = Alertas::where('nuevo_cliente', '=', '1')->orderBy('start', 'ASC');

        // Verificar filtro de fechas
        if ($request->fecha_inicial_de && $request->fecha_inicial_a) {
            $HistorialVendidos = $HistorialVendidos->where('start', '>=', $fechaInicialDe)
                ->where('start', '<=', $fechaInicialA);
        }

        // Verificar filtro de `cosme`


        $HistorialVendidos = $HistorialVendidos->get()
            ->groupBy('id_client')
            ->map(function ($group) {
                // Ordenar el grupo por `resourceId` en orden descendente
                $sortedGroup = $group->sortByDesc('resourceId');
                $firstItem = $sortedGroup->first(); // Usar el primer registro del grupo
                $firstItem->resourceIds = $sortedGroup->pluck('resourceId')->unique()->implode(', '); // Concatenar `resourceId`
                return $firstItem; // Retornar el registro procesado
            });


        $pdf = \PDF::loadView('client.pdf_nuevos', compact('HistorialVendidos', 'today'));
        return $pdf->stream();
         //return $pdf->download('Nota cotizacion'. $folio .'/'.$today.'.pdf');

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
