<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Laser;
use App\Models\NotasLacer;
use App\Models\User;
use App\Models\ZonasLaser;
use App\Models\PagosLaser;

use Illuminate\Http\Request;

class NotasLacerController extends Controller
{
    public function index(){
        $nota_lacer = NotasLacer::orderBy('id','DESC')->get();

        return view('notas_lacer.index', compact('nota_lacer'));
    }

    public function getZonasByTipoZona($tipoZona){
        try {
            $data = Laser::where('tipo_zona', $tipoZona)->get(['zona', 'costo_paquete']);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    public function crear(){
        $zonas = Laser::get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.crear',compact('client', 'user', 'zonas'));
    }

    public function index_sesiones(){


        return view('notas_lacer.index_laser');

    }


    public function index_consentimiento(){


        return view('notas_lacer.index_consentimiento');

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'tipo_servicio' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator);
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fechaActual = date('Y-m-d');

        // N U E V O  U S U A R I O
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           //$client->email = $request->get('email');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota_laser = new NotasLacer;

        $nota_laser->id_user = auth()->user()->id;

        if($request->get('name') != NULL){
            $nota_laser->id_client = $client->id;
        }else{
            $nota_laser->id_client = $request->get('id_client');
        }

        $nota_laser->total =  $request->get('total_suma');
        $nota_laser->restante = $request->get('restante');
        $nota_laser->tipo = $request->get('tipo_servicio');
        $nota_laser->nota2 = $request->get('nota2');
        $nota_laser->fecha = $fechaActual;
        $nota_laser->save();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I |
            if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
                $fechaActual = date('Y-m-d');
                $caja = new CajaDia;
                $caja->egresos = $request->get('cambio');
                $caja->motivo = 'Retiro';
                $caja->concepto = 'Cambio nota servicio: ' . $nota->id;
                $caja->fecha = $fechaActual;
                $caja->save();
            }

        // G U A R D A R  S E R V I C I O
        $zona_laser = new ZonasLaser;

        if($request->get('tipo_servicio') == 'sesion'){

            $zona_laser->id_nota = $nota_laser->id;
            $zona_laser->zona_sesiones_1 = $request->get('zona_sesiones_1');
            $zona_laser->zona_sesiones_2 = $request->get('zona_sesiones_2');
            $zona_laser->zona_sesiones_3 = $request->get('zona_sesiones_3');
            $zona_laser->zona_sesiones_4 = $request->get('zona_sesiones_4');

            $zona_laser->cantidad_1 = $request->get('cantidad_1');
            $zona_laser->cantidad_2 = $request->get('cantidad_2');
            $zona_laser->cantidad_3 = $request->get('cantidad_3');
            $zona_laser->cantidad_4 = $request->get('cantidad_4');

        }else{

        }

        $zona_laser->save();


        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){

            $pago = new PagosLaser;
            $pago->id_nota = $nota_laser->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->cosmetologa = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_servicios';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();
        }

        $recibo = [
            "id" => $nota->id,
            "Cliente" => $nota->Client->name,
            "Total" => $nota->precio,
            "Restante" => $nota->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => [$pago],
            'cosmetologa' => $cadena,
            'notas_paquetes' => $servicio,
            // Agrega cualquier otro dato necesario para el recibo
        ];

        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);


    }

}
