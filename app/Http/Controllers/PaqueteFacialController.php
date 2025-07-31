<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\PaqueteFacialNota;
use App\Models\PaqueteFacialPago;
use App\Models\PaqueteFacialRegistro;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Http\Request;

class PaqueteFacialController extends Controller
{
     public function index(){
        $paquetes = PaqueteFacialNota::orderBy('id','DESC')->get();

        return view('paquetes_faciales.index', compact('paquetes'));
    }

    public function create(){
        $paquetes_faciales = Servicios::where('categoria', 'Facial New')->orderBy('id','DESC')->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Recepcionista')->get();
        $cosme = User::where('puesto', '=', 'Cosme')->get();

        return view('paquetes_faciales.crear', compact('paquetes_faciales', 'client', 'user', 'cosme'));
    }

    public function store(Request $request){

        // N U E V O  U S U A R I O
        $fechaActual = date('Y-m-d');
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota = new PaqueteFacialNota;
        if($request->get('name') != NULL){
            $nota->id_client = $client->id;
        }else{
            $nota->id_client = $request->get('id_client');
        }
        $nota->fecha = $fechaActual;
        $nota->id_servicio = $request->get('id_paquete');
        $nota->id_user = $request->get('id_user');
        $nota->id_cosme_comision = $request->get('id_cosme');
        $nota->monto = $request->get('total-pagar');
        $nota->restante = $request->get('restante');
        $nota->save();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I |
        // if($request->get('cambio') > '0'){
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $caja = new CajaDia;
            $caja->egresos = $request->get('cambio');
            $caja->motivo = 'Retiro';
            $caja->concepto = 'Cambio nota servicio: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){

            $pago = new PaqueteFacialPago;
            $pago->id_nota = $nota->id;
            $pago->fecha = $fechaActual;
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->cambio = $request->get('cambio');
            $pago->nota = $request->get('nota');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_servicios';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();
        }
        // Devuelve los datos en formato JSON
       // return response()->json(['success' => true, 'recibo' => $recibo]);

        return redirect()->route('paquetes_faciales.index');
    }

    public function edit($id){
        $nota = PaqueteFacialNota::find($id);
        $pagos = PaqueteFacialPago::where('id_nota', $id)->get();
        $registros = PaqueteFacialRegistro::where('id_nota', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Recepcionista')->get();
        $cosme = User::where('puesto', '=', 'Cosme')->get();

        $search_servicio = Servicios::find($nota->id_servicio);
        $total_sesiones_registradas = $registros->count();
        $total_sesiones_servicio = $search_servicio->num_sesiones;

        if ($search_servicio->diseno == '1' || $search_servicio->diseno == '3' || $search_servicio->diseno == '6') {
            return view('paquetes_faciales.edit_1', compact(
                'nota', 'pagos', 'registros', 'client', 'user', 'cosme',
                'total_sesiones_registradas', 'total_sesiones_servicio', 'search_servicio'
            ));
        } elseif ($search_servicio->diseno == '2') {
            return view('paquetes_faciales.edit_2', compact(
                'nota', 'pagos', 'registros', 'client', 'user', 'cosme',
                'total_sesiones_registradas', 'total_sesiones_servicio', 'search_servicio'
            ));
        } elseif ($search_servicio->diseno == '4') {
            return view('paquetes_faciales.edit_4', compact(
                'nota', 'pagos', 'registros', 'client', 'user', 'cosme',
                'total_sesiones_registradas', 'total_sesiones_servicio', 'search_servicio'
            ));
        } elseif ($search_servicio->diseno == '5') {
            return view('paquetes_faciales.edit_5', compact(
                'nota', 'pagos', 'registros', 'client', 'user', 'cosme',
                'total_sesiones_registradas', 'total_sesiones_servicio', 'search_servicio'
            ));
        }
    }

    public function update(Request $request, $id){

        // N U E V O  U S U A R I O
        $fechaActual = date('Y-m-d');

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota = PaqueteFacialNota::find($id);
        $nota->id_client = $request->get('id_client');
        $nota->fecha = $fechaActual;
        $nota->id_user = $request->get('id_user');
        $nota->id_cosme_comision = $request->get('id_cosme');
        $nota->restante = $request->get('restante_paquetes');
        $nota->save();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I O
        // if($request->get('cambio') > '0'){
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $caja = new CajaDia;
            $caja->egresos = $request->get('cambio');
            $caja->motivo = 'Retiro';
            $caja->concepto = 'Cambio nota servicio: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){

            $pago = new PaqueteFacialPago;
            $pago->id_nota = $nota->id;
            $pago->fecha = $fechaActual;
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->cambio = $request->get('cambio');
            $pago->nota = $request->get('nota');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_servicios';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();
        }

        $search_servicio = Servicios::find($nota->id_servicio);
        $servicio_ultimo = PaqueteFacialRegistro::where('id_nota', $id)->orderBy('id','DESC')->first();
        if($servicio_ultimo == NULL){
            $sesiones = $search_servicio->num_sesiones;
            $num_sesion = 0;
        }else{
            $sesiones = $servicio_ultimo->sesiones_restantes;
            $num_sesion = $servicio_ultimo->num_sesion;
        }
        if($request->get('id_cosme') != NULL){
            $servicio = new PaqueteFacialRegistro;
            $servicio->id_nota = $nota->id;
            $servicio->sesiones_restantes = $sesiones - 1;
            $servicio->num_sesion = $num_sesion + 1;
            $servicio->id_cosme = $request->get('id_cosme_form');
            $servicio->masaje = $request->get('masaje');
            $servicio->facial = $request->get('faciales');
            $servicio->fecha = $request->get('fecha');
            $servicio->observaciones = $request->get('observaciones');
            $servicio->productos_usados = $request->get('productos_usados');

            $servicio->talla_antes = $request->get('talla_antes');
            $servicio->talla_despues = $request->get('talla_despues');
            $servicio->abdomen_antes = $request->get('abdomen_antes');
            $servicio->abdomen_despues = $request->get('abdomen_despues');
            $servicio->cintura_antes = $request->get('cintura_antes');
            $servicio->cintura_despues = $request->get('cintura_despues');
            $servicio->cadera_antes = $request->get('cadera_antes');
            $servicio->cadera_despues = $request->get('cadera_despues');
            $servicio->gluteos_antes = $request->get('gluteos_antes');
            $servicio->gluteos_despues = $request->get('gluteos_despues');
            $servicio->celulitis_antes = $request->get('celulitis_antes');
            $servicio->celulitis_despues = $request->get('celulitis_despues');
            $servicio->textura_antes = $request->get('textura_antes');
            $servicio->textura_despues = $request->get('textura_despues');
            $servicio->save();
        }
        return redirect()->back();
    }
}
