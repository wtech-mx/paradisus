<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notas;
use App\Models\User;
use App\Models\Client;
use App\Models\NotasCosmes;
use App\Models\NotasPaquetes;
use App\Models\NotasSesion;
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
        $cosme = auth()->user();
        $nota = Notas::orderBy('id','DESC')->get();
        $client = Client::orderBy('name','ASC')->get();
        $servicio = Servicios::orderBy('nombre','ASC')->get();
        $pago = Pagos::get();
        $notas_sesiones = NotasSesion::get();
        $notas_paquetes = NotasPaquetes::get();

        $folio = Notas::orderBy('id', 'desc')->first();
        $nota_cosme = NotasCosmes::get();

        $nota_cosme_ind = NotasCosmes::where('id_user', '=',$cosme->id)->get();

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

        return view('notas.index', compact('nota', 'user', 'client', 'servicio', 'pago', 'nota_cosme', 'folio','nota_cosme_ind', 'notas_sesiones', 'notas_paquetes'));
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
        ]);

        // N U E V O  U S U A R I O
        $fechaActual = date('Y-m-d');
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           $client->email = $request->get('email');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota = new Notas;
        if($request->get('name') != NULL){
            $nota->id_client = $client->id;
        }else{
            $nota->id_client = $request->get('id_client');
        }
        $nota->fecha = $fechaActual;
        $nota->nota = $request->get('nota');
        $nota->save();

        // G U A R D A R  S E R V I C I O
        $nota_paquete = new NotasPaquetes;
        $nota_paquete->id_nota = $nota->id;
        $nota_paquete->id_servicio = $request->get('id_servicio');
        $nota_paquete->num = $request->get('num');
        $nota_paquete->descuento = $request->get('descuento');

        $nota_paquete->id_servicio2 = $request->get('id_servicio2');
        $nota_paquete->num2 = $request->get('num2');
        $nota_paquete->descuento2 = $request->get('descuento2');

        $nota_paquete->id_servicio3 = $request->get('id_servicio3');
        $nota_paquete->num3 = $request->get('num3');
        $nota_paquete->descuento3 = $request->get('descuento3');

        $nota_paquete->id_servicio4 = $request->get('id_servicio4');
        $nota_paquete->num4 = $request->get('num4');
        $nota_paquete->descuento4 = $request->get('descuento4');
        $nota_paquete->save();

        // G U A R D A R  S E S I O N
        if($request->get('sesion') != NULL){
            $nota_sesion = new NotasSesion();
            $nota_sesion->id_nota = $nota->id;
            $nota_sesion->fecha = $request->get('fecha_sesion');
            $nota_sesion->sesion = $request->get('sesion');
            $nota_sesion->save();
        }

        // G U A R D A R  C O S M E S
        $id_user = $request->get('id_user');
        for ($count = 0; $count < count($id_user); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'id_user' => $id_user[$count],
            );
            $insert_data2[] = $data;
        }

        NotasCosmes::insert($insert_data2);

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){
            $pago = new Pagos;
            $pago->id_nota = $nota->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->cosmetologa = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
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
        }

        // G U A R D A R  T O T A L  S E R V I C I O
        $pago = Pagos::orderBy('id', 'desc')->first();
        $nota_one = Notas::orderBy('id', 'desc')->first();
        $nota_reciente = NotasPaquetes::where('id_nota', '=', $nota_one->id)->first();

        $total = 0;
        $mult = 0;
        $descuento = 0;
        if($request->get('id_servicio') != NULL){
            if($request->get('descuento') == 1){
                $mult = $nota_reciente->Servicios->precio * .10;
                $descuento = $nota_reciente->Servicios->precio - $mult;
                $unitario = $descuento * $nota_reciente->num;
            }else{
                $unitario = $nota_reciente->Servicios->precio * $nota_reciente->num;
            }
        }else{$unitario = 0;}
        if($request->get('id_servicio2') != NULL){
            if($request->get('descuento2') == 1){
                $mult = $nota_reciente->Servicios2->precio * .10;
                $descuento = $nota_reciente->Servicios2->precio - $mult;
                $unitario2 = $descuento * $nota_reciente->num2;
            }else{
                $unitario2 = $nota_reciente->Servicios2->precio * $nota_reciente->num2;
            }
        }else{$unitario2 = 0;}
        if($request->get('id_servicio3') != NULL){
            if($request->get('descuento3') == 1){
                $mult = $nota_reciente->Servicios3->precio * .10;
                $descuento = $nota_reciente->Servicios3->precio - $mult;
                $unitario3 = $descuento * $nota_reciente->num3;
            }else{
                $unitario3 = $nota_reciente->Servicios3->precio * $nota_reciente->num3;
            }
        }else{$unitario3 = 0;}
        if($request->get('id_servicio4') != NULL){
            if($request->get('descuento4') == 1){
                $mult = $nota_reciente->Servicios4->precio * .10;
                $descuento = $nota_reciente->Servicios4->precio - $mult;
                $unitario4 = $descuento * $nota_reciente->num4;
            }else{
                $unitario4 = $nota_reciente->Servicios4->precio * $nota_reciente->num4;
            }
        }else{$unitario4 = 0;}

        $total = $unitario + $unitario2 + $unitario3 + $unitario4;

        $restante = $total - $pago->pago;
        //  dd($pago->pago);
        $nota_pago = Notas::find($nota->id);
        $nota_pago->precio = $total;
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
        $nota->cancelado = $request->get('cancelado');
        $nota->update();

        if($request->get('pago') != NULL){
            $pago = new Pagos;
            $pago->id_nota = $nota->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->cosmetologa = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
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
        }

        if($request->get('sesion') != NULL){
            $nota_sesion = new NotasSesion;
            $nota_sesion->id_nota = $nota->id;
            $nota_sesion->fecha = $request->get('fecha_sesion');
            $nota_sesion->sesion = $request->get('sesion');
            $nota_sesion->save();
        }

        $pago = Pagos::orderBy('id', 'desc')->first();
        $restante = $nota->restante - $pago->pago;

        $nota_pago = Notas::find($nota->id);
        $nota_pago->restante = $restante;
        $nota_pago->update();

        return redirect()->route('notas.index')
        ->with('edit','Nota Servicio Actualizado.');
    }

    public function ChangeCosme(Request $request)
    {
        $pagos = Pagos::find($request->id);
        $pagos->cosmetologa = $request->cosmetologa;
        $pagos->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function ChangeServicio(Request $request)
    {
        $notas_paquetes = NotasPaquetes::find($request->id);
        $notas_paquetes->id_servicio = $request->id_servicio;
        $notas_paquetes->save();

        // G U A R D A R  T O T A L  S E R V I C I O
        $pago = Pagos::orderBy('id', 'desc')->first();
        $nota_one = Notas::orderBy('id', 'desc')->first();
        $nota_reciente = NotasPaquetes::where('id_nota', '=', $nota_one->id)->first();

        $total = 0;
        $mult = 0;
        $descuento = 0;
        if($request->get('id_servicio') != NULL){
            if($request->get('descuento') == 1){
                $mult = $nota_reciente->Servicios->precio * .10;
                $descuento = $nota_reciente->Servicios->precio - $mult;
                $unitario = $descuento * $nota_reciente->num;
            }else{
                $unitario = $nota_reciente->Servicios->precio * $nota_reciente->num;
            }
        }else{$unitario = 0;}
        if($request->get('id_servicio2') != NULL){
            if($request->get('descuento2') == 1){
                $mult = $nota_reciente->Servicios2->precio * .10;
                $descuento = $nota_reciente->Servicios2->precio - $mult;
                $unitario2 = $descuento * $nota_reciente->num2;
            }else{
                $unitario2 = $nota_reciente->Servicios2->precio * $nota_reciente->num2;
            }
        }else{$unitario2 = 0;}
        if($request->get('id_servicio3') != NULL){
            if($request->get('descuento3') == 1){
                $mult = $nota_reciente->Servicios3->precio * .10;
                $descuento = $nota_reciente->Servicios3->precio - $mult;
                $unitario3 = $descuento * $nota_reciente->num3;
            }else{
                $unitario3 = $nota_reciente->Servicios3->precio * $nota_reciente->num3;
            }
        }else{$unitario3 = 0;}
        if($request->get('id_servicio4') != NULL){
            if($request->get('descuento4') == 1){
                $mult = $nota_reciente->Servicios4->precio * .10;
                $descuento = $nota_reciente->Servicios4->precio - $mult;
                $unitario4 = $descuento * $nota_reciente->num4;
            }else{
                $unitario4 = $nota_reciente->Servicios4->precio * $nota_reciente->num4;
            }
        }else{$unitario4 = 0;}

        $total = $unitario + $unitario2 + $unitario3 + $unitario4;

        $restante = $total - $pago->pago;
        //  dd($pago->pago);
        $nota_pago = Notas::find($nota->id);
        $nota_pago->precio = $total;
        $nota_pago->restante = $restante;
        $nota_pago->update();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
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
