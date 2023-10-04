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
        $clients = Client::orderBy('id','DESC')->get();

        // IDs de los usuarios que deseas eliminar
        $usuarios_a_eliminar = [2, 18, 19, 17, 15, 10, 7];

        // ID del usuario al que deseas reasignar las notas
        $usuario_reemplazo_id = 14; // Cambia esto al ID del usuario al que deseas reasignar las notas

        foreach ($usuarios_a_eliminar as $usuario_id) {
            // Obtén el usuario que deseas eliminar
            $usuario_a_eliminar = User::find($usuario_id);

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas = NotasCosmes::where('id_user', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas2 = NotasPedidos::where('id_user', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas2 as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas3 = NotasPropinas::where('id_user', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas3 as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas4 = Pagos::where('cosmetologa', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas4 as $nota) {
                $nota->cosmetologa = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas5 = PaquetesPago::where('id_user', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas5 as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas6 = Paquetes::where('id_user1', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas6 as $nota) {
                $nota->id_user1 = $usuario_reemplazo_id;
                $nota->save();
            }

                // Obtén todas las notas relacionadas con ese usuario
                $notas_relacionadas61 = Paquetes::where('id_user2', $usuario_id)->get();

                // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                foreach ($notas_relacionadas61 as $nota) {
                    $nota->id_user2 = $usuario_reemplazo_id;
                    $nota->save();
                }

                            // Obtén todas las notas relacionadas con ese usuario
                            $notas_relacionadas62 = Paquetes::where('id_user3', $usuario_id)->get();

                            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                            foreach ($notas_relacionadas62 as $nota) {
                                $nota->id_user3 = $usuario_reemplazo_id;
                                $nota->save();
                            }

                                        // Obtén todas las notas relacionadas con ese usuario
                                        $notas_relacionadas63 = Paquetes::where('id_user4', $usuario_id)->get();

                                        // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                                        foreach ($notas_relacionadas63 as $nota) {
                                            $nota->id_user4 = $usuario_reemplazo_id;
                                            $nota->save();
                                        }


            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas7 = Paquete2::where('id_user5', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas7 as $nota) {
                $nota->id_user5 = $usuario_reemplazo_id;
                $nota->save();
            }

                // Obtén todas las notas relacionadas con ese usuario
                $notas_relacionadas71 = Paquete2::where('id_user6', $usuario_id)->get();

                // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                foreach ($notas_relacionadas71 as $nota) {
                    $nota->id_user6 = $usuario_reemplazo_id;
                    $nota->save();
                }

                            // Obtén todas las notas relacionadas con ese usuario
                            $notas_relacionadas72 = Paquete2::where('id_user7', $usuario_id)->get();

                            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                            foreach ($notas_relacionadas72 as $nota) {
                                $nota->id_user7 = $usuario_reemplazo_id;
                                $nota->save();
                            }

                                        // Obtén todas las notas relacionadas con ese usuario
                                        $notas_relacionadas73 = Paquete2::where('id_user8', $usuario_id)->get();

                                        // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                                        foreach ($notas_relacionadas73 as $nota) {
                                            $nota->id_user8 = $usuario_reemplazo_id;
                                            $nota->save();
                                        }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas8 = Paquete3::where('id_user9', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas8 as $nota) {
                $nota->id_user9 = $usuario_reemplazo_id;
                $nota->save();
            }

                // Obtén todas las notas relacionadas con ese usuario
                $notas_relacionadas81 = Paquete3::where('id_user10', $usuario_id)->get();

                // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                foreach ($notas_relacionadas81 as $nota) {
                    $nota->id_user10 = $usuario_reemplazo_id;
                    $nota->save();
                }

                DB::table('horario')
                ->whereIn('id_user', $usuarios_a_eliminar)
                ->delete();

                            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas9 = Alertas::where('id_especialist', $usuario_id)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas9 as $nota) {
                $nota->id_especialist = $usuario_reemplazo_id;
                $nota->save();
            }
            // Elimina el usuario una vez que las notas se han reasignado
            $usuario_a_eliminar->delete();
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

        $client = [];
        $paquetes = [];

        if ($id_client !== 'null' && $id_client !== null) {
            $client = Client::where('id', $id_client)->first();
        } elseif ($phone !== 'null' && $phone !== null) {
            $client = Client::where('id', $phone)->first();
        }

        Alert::success('Encontrado con exito ');

        return view('client.index', compact('client'));
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
