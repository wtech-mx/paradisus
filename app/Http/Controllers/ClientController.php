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
        $clients = Client::orderBy('id','DESC')->get();

        return view('client.index', compact('clients'));
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

    public function advance(Request $request, Client $cliente) {
        $clients = $cliente;

        if( $request->name){
            $clients = $clients->where('name', 'LIKE', "%" . $request->name . "%");
        }
        if( $request->last_name){
            $clients = $clients->where('last_name', 'LIKE', "%" . $request->last_name . "%");
        }
        if( $request->phone){
            $clients = $clients->where('phone', 'LIKE', "%" . $request->phone . "%");
        }
        $clients = $clients->paginate(10);

        return view('client.index', compact('clients'));
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
            'email' => 'required',
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
