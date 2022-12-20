<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notas;
use App\Models\User;
use App\Models\Client;
use App\Models\Pagos;
use App\Models\Servicios;
use Session;

class NotasController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota = Notas::paginate();
        $user = User::get();
        $client = Client::get();
        $servicio = Servicios::get();
        $pago = Pagos::get();

        $folio = Notas::orderBy('id', 'desc')->first();
        $nota_usuario = Notas::where('id_user', '=', auth()->id())->get();

        return view('notas.index', compact('nota', 'user', 'client', 'servicio', 'pago', 'nota_usuario', 'folio'))
            ->with('i', (request()->input('page', 1) - 1) * $nota->perPage());
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
            'id_user' => 'required',
            'id_client' => 'required',
            'id_servicio' => 'required'
        ]);

        $nota = new Notas;
        $nota->id_user = $request->get('id_user');
        $nota->id_client = $request->get('id_client');
        $nota->id_servicio = $request->get('id_servicio');
        $nota->fecha = $request->get('fecha');
        $nota->nota = $request->get('nota');
        $nota->restante = $request->get('restante');
        $nota->save();

        $fecha_pago = $request->get('fecha_pago');
        $pago = $request->get('pago');
        $num_sesion = $request->get('num_sesion');
        $forma_pago = $request->get('forma_pago');

        for ($count = 0; $count < count($fecha_pago); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'fecha' => $fecha_pago[$count],
                'pago' => $pago[$count],
                'num_sesion' => $num_sesion[$count],
                'forma_pago' => $forma_pago[$count],
            );
            $insert_data[] = $data;
        }

        Pagos::insert($insert_data);
        // $restante = $nota->Servicios->precio - $data->pago;
        // dd($restante);

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = Notas::find($id);

        return view('notas.show', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notas $nota
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'id_client' => 'required',
            'id_servicio' => 'required'
        ]);

        $nota = Notas::find($id);
        $nota->id_user = $request->get('id_user');
        $nota->id_client = $request->get('id_client');
        $nota->id_servicio = $request->get('id_servicio');
        $nota->fecha = $request->get('fecha');
        $nota->nota = $request->get('nota');
        $nota->restante = $request->get('restante');
        $nota->update();

        $fecha_pago = $request->get('fecha_pago');
        $pago = $request->get('pago');
        $num_sesion = $request->get('num_sesion');
        $forma_pago = $request->get('forma_pago');

        for ($count = 0; $count < count($fecha_pago); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'fecha' => $fecha_pago[$count],
                'pago' => $pago[$count],
                'num_sesion' => $num_sesion[$count],
                'forma_pago' => $forma_pago[$count],
            );
            $insert_data[] = $data;
        }

        Pagos::insert($insert_data);

        return redirect()->route('notas.index')
        ->with('edit','nota Has Been updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
//         $pago = Pagos::where('id_nota', '=', $id)->delete();
// dd($pago);
        // for(){

        // }

        $nota = Notas::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('notas.index')
            ->with('success', 'nota deleted successfully');
    }

    public function usuario($id)
    {
        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        return view('notas.nota_user', compact('notas_pedidos', 'pago'));
    }
}
