<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notas;
use App\Models\User;
use App\Models\Client;
use App\Models\NotasCosmes;
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
        $fechaActual = date('N');

        $nota = Notas::orderBy('id','DESC')->get();
        $client = Client::orderBy('name','ASC')->get();
        $servicio = Servicios::orderBy('nombre','ASC')->get();
        $pago = Pagos::get();

        $folio = Notas::orderBy('id', 'desc')->first();
        $nota_cosme = NotasCosmes::get();

        if($fechaActual == '1'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.lunes', '=', 1)
            ->get();
        }elseif($fechaActual == '2'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.martes', '=', 1)
            ->get();
        }elseif($fechaActual == '3'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.miercoles', '=', 1)
            ->get();
        }elseif($fechaActual == '4'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.jueves', '=', 1)
            ->get();
        }elseif($fechaActual == '5'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.viernes', '=', 1)
            ->get();
        }elseif($fechaActual == '6'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.sabado', '=', 1)
            ->get();
        }elseif($fechaActual == '7'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.domingo', '=', 1)
            ->get();
        }


        return view('notas.index', compact('nota', 'user', 'client', 'servicio', 'pago', 'nota_cosme', 'folio'));
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

        $fechaActual = date('Y-m-d');
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           $client->email = $request->get('email');
           $client->save();
        }

        $nota = new Notas;
        if($request->get('name') != NULL){
            $nota->id_client = $client->id;
        }else{
            $nota->id_client = $request->get('id_client');
        }
        $nota->id_servicio = $request->get('id_servicio');
        $nota->fecha = $fechaActual;
        $nota->nota = $request->get('nota');
        $nota->save();

        $id_user = $request->get('id_user');

        for ($count = 0; $count < count($id_user); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'id_user' => $id_user[$count],
            );
            $insert_data2[] = $data;
        }

        NotasCosmes::insert($insert_data2);

        $pago = new Pagos;
        $pago->id_nota = $nota->id;
        $pago->fecha = $request->get('fecha_pago');
        $pago->pago = $request->get('pago');
        $pago->num_sesion = $request->get('num_sesion');
        $pago->forma_pago = $request->get('forma_pago');
        $pago->nota = $request->get('nota2');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/foto_servicios';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pago->foto = $fileName;
        }

        $pago->save();

        $pago = Pagos::orderBy('id', 'desc')->first();
        $restante = $nota->Servicios->precio - $pago->pago;
        //  dd($pago->pago);
        $nota_pago = Notas::find($nota->id);
        $nota_pago->restante = $restante;
        $nota_pago->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas.index')
                        ->with('success','Nota Servicio Creado.');
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

        $nota = Notas::find($id);
        // $nota->id_user = $request->get('id_user');
        // $nota->id_client = $request->get('id_client');
        // $nota->id_servicio = $request->get('id_servicio');
        // $nota->fecha = $request->get('fecha');
        // $nota->nota = $request->get('nota');
        // $nota->update();

        $pago = new Pagos;
        $pago->id_nota = $nota->id;
        $pago->fecha = $request->get('fecha_pago');
        $pago->pago = $request->get('pago');
        $pago->num_sesion = $request->get('num_sesion');
        $pago->forma_pago = $request->get('forma_pago');
        $pago->nota = $request->get('nota2');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/foto_servicios';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pago->foto = $fileName;
        }

        $pago->save();

        $pago = Pagos::orderBy('id', 'desc')->first();
        $restante = $nota->restante - $pago->pago;

        $nota_pago = Notas::find($nota->id);
        $nota_pago->restante = $restante;
        $nota_pago->update();

        return redirect()->route('notas.index')
        ->with('edit','Nota Servicio Actualizado.');
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
            ->with('delete', 'Nota Servicio Eliminado.');
    }

    public function usuario($id)
    {
        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        return view('clientes.notas.show', compact('notas_pedidos', 'pago', 'nota_cosme'));
    }

    public function usuario_print($id){
        $today =  date('d-m-Y');
        $notas_pedidos = Notas::where('id', '=', $id)
        ->first();

        $pago = Pagos::where('id_nota', '=', $id)
        ->get();

        $nota_cosme = NotasCosmes::where('id_nota', '=', $id)
        ->get();

        $pdf = \PDF::loadView('notas.recibo_pdf', compact('today', 'notas_pedidos', 'pago', 'nota_cosme'));
        return $pdf->stream();
       // return $pdf->download('Reporte Caja '.$today.'.pdf');
    }

}
