<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\Paquete2;
use App\Models\Paquete3;
use App\Models\Paquetes;
use App\Models\PaquetesPago;
use App\Models\Reporte;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client as GuzzleClient;


class PaquetesController extends Controller
{
    public function index()
    {
        $paquetes = Paquetes::orderBy('id','DESC')->get();

        return view('paquetes_servicios.index', compact('paquetes'));
    }

    public function index_pendientes()
    {
        $paquetes = Paquetes::where('restante', '>', 0)->orderBy('id','DESC')->get();

        return view('paquetes_servicios.index_pendientes', compact('paquetes'));
    }

    public function index_pagados()
    {
        $paquetes = Paquetes::where('restante', '<=', 0)->orderBy('id','DESC')->get();

        return view('paquetes_servicios.index_pagados', compact('paquetes'));
    }

    public function create_uno()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(151);

        return view('paquetes_servicios.paquete_1.paqute_1',compact('client', 'user', 'servicio'));
    }

    public function edit_uno($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_1.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_uno($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_1.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_paquete_1_'.$id.'.pdf');
    }

    public function firma_uno($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_1.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function firma_dos($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_2.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function firma_tres($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_3.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }


    public function firma_cuatro($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_4.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function firma_cinco($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_5.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function firma_seis($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_6.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function firma_siete($id){

        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_7.firma_1',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function create_dos()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(156);

        return view('paquetes_servicios.paquete_2.create',compact('client', 'user', 'servicio'));
    }

    public function edit_dos($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_2.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_dos($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_2.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_'.$id.'.pdf');
    }

    public function create_tres()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(153);

        return view('paquetes_servicios.paquete_3.create',compact('client', 'user', 'servicio'));
    }

    public function edit_tres($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_3.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_tres($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_3.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_'.$id.'.pdf');
    }

    public function create_cuatro()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(154);

        return view('paquetes_servicios.paquete_4.create',compact('client', 'user', 'servicio'));
    }

    public function edit_cuatro($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_4.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_cuatro($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_4.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_paquete_4'.$id.'.pdf');
    }

    public function create_cinco()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(155);

        return view('paquetes_servicios.paquete_5.create',compact('client', 'user', 'servicio'));
    }

    public function edit_cinco($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_5.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_cinco($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_5.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_paquete_5'.$id.'.pdf');
    }

    public function create_seis()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(276);

        return view('paquetes_servicios.paquete_6.create',compact('client', 'user', 'servicio'));
    }

    public function edit_seis($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_6.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_seis($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_6.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_paquete_6'.$id.'.pdf');
    }

    public function create_siete()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $servicio = Servicios::find(154);

        return view('paquetes_servicios.paquete_7.create',compact('client', 'user', 'servicio'));
    }

    public function edit_siete($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        return view('paquetes_servicios.paquete_7.edit',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));
    }

    public function print_siete($id)
    {
        $paquete = Paquetes::find($id);
        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $pago = PaquetesPago::where('id_paquete', '=', $id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();

        $pdf = PDF::loadView('paquetes_servicios.paquete_7.recibo_pdf_print',compact('paquete', 'paquete2', 'paquete3', 'client', 'user', 'pago'));

        $pdf->setPaper([0, 0, 165, 500], 'portrait');

        return $pdf->download('Recibo_paquete_7'.$id.'.pdf');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_client'         => 'required|exists:clients,id',
            'id_cosme'          => 'required|exists:users,id',
            'id_user1'          => 'required|exists:users,id',
        ], [
            'required' => 'Es requerido',
            'exists'   => 'La selección no es válida',
        ], [
            'id_client'     => 'Cliente de la sesión',
            'id_cosme'      => 'Comisión de la Cosme',
            'fecha_inicial' => 'Fecha de la sesión',
            'id_user1'      => 'Cosmetóloga de la primera sesión',
        ]);


        if ($validator->fails()) {
            // Mapea los campos a sus nombres personalizados
            $customNames = [
                'id_client'     => 'Cliente de la sesión',
                'id_cosme'      => 'Comisión de la Cosme',
                'fecha_inicial' => 'Fecha de la sesión',
                'id_user1'      => 'Cosmetóloga de la primera sesión',
            ];

            $errors = [];

            foreach ($validator->errors()->messages() as $field => $messages) {
                $fieldName = $customNames[$field] ?? $field;
                $errors[$fieldName] = $messages;
            }

            return response()->json(['errors' => $errors], 422);
        }

        $paquete = new Paquetes;
        $paquete->id_client = $request->get('id_client');
        $paquete->id_cosme = $request->get('id_cosme');
        $paquete->num_paquete = $request->get('num_paquete');
        $paquete->id_servicio = $request->get('id_servicio');
        $paquete->fecha_inicial = $request->get('fecha_inicial');
        $paquete->descuento_5 = $request->get('es-contado');
        $paquete->monto = $request->get('total-suma');
        $paquete->restante = $request->get('restante');

        if($request->signed_ini != NULL){
            $folderPath = public_path('condiciones_paquetes/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $paquete->firma = $signature;
        }

        $paquete->fecha1 = $request->get('fecha1');
        $paquete->notas1 = $request->get('notas1');
        $paquete->id_user1 = $request->get('id_user1');
        $paquete->talla1_a = $request->get('talla1_a');
        $paquete->talla1_d = $request->get('talla1_d');
        $paquete->abdomen1_a = $request->get('abdomen1_a');
        $paquete->abdomen1_d = $request->get('abdomen1_d');
        $paquete->cintura1_a = $request->get('cintura1_a');
        $paquete->cintura1_d = $request->get('cintura1_d');
        $paquete->cadera1_a = $request->get('cadera1_a');
        $paquete->cadera1_d = $request->get('cadera1_d');
        $paquete->gluteo1_a = $request->get('gluteo1_a');
        $paquete->gluteo1_d = $request->get('gluteo1_d');
        $paquete->firma1 = $request->get('firma1');

        if($request->get('id_user2') != NULL){
            $paquete->fecha2 = $request->get('fecha2');
            $paquete->notas2 = $request->get('notas2');
            $paquete->id_user2 = $request->get('id_user2');
            $paquete->talla2_a = $request->get('talla2_a');
            $paquete->talla2_d = $request->get('talla2_d');
            $paquete->abdomen2_a = $request->get('abdomen2_a');
            $paquete->abdomen2_d = $request->get('abdomen2_d');
            $paquete->cintura2_a = $request->get('cintura2_a');
            $paquete->cintura2_d = $request->get('cintura2_d');
            $paquete->cadera2_a = $request->get('cadera2_a');
            $paquete->cadera2_d = $request->get('cadera2_d');
            $paquete->gluteo2_a = $request->get('gluteo2_a');
            $paquete->gluteo2_d = $request->get('gluteo2_d');
            $paquete->firma2 = $request->get('firma2');
        }

        if($request->get('id_user3') != NULL){
            $paquete->fecha3 = $request->get('fecha3');
            $paquete->notas3 = $request->get('notas3');
            $paquete->id_user3 = $request->get('id_user3');
            $paquete->talla3_a = $request->get('talla3_a');
            $paquete->talla3_d = $request->get('talla3_d');
            $paquete->abdomen3_a = $request->get('abdomen3_a');
            $paquete->abdomen3_d = $request->get('abdomen3_d');
            $paquete->cintura3_a = $request->get('cintura3_a');
            $paquete->cintura3_d = $request->get('cintura3_d');
            $paquete->cadera3_a = $request->get('cadera3_a');
            $paquete->cadera3_d = $request->get('cadera3_d');
            $paquete->gluteo3_a = $request->get('gluteo3_a');
            $paquete->gluteo3_d = $request->get('gluteo3_d');
            $paquete->firma3 = $request->get('firma3');
        }

        if($request->get('id_user4') != NULL){
            $paquete->fecha4 = $request->get('fecha4');
            $paquete->notas4 = $request->get('notas4');
            $paquete->id_user4 = $request->get('id_user4');
            $paquete->talla4_a = $request->get('talla4_a');
            $paquete->talla4_d = $request->get('talla4_d');
            $paquete->abdomen4_a = $request->get('abdomen4_a');
            $paquete->abdomen4_d = $request->get('abdomen4_d');
            $paquete->cintura4_a = $request->get('cintura4_a');
            $paquete->cintura4_d = $request->get('cintura4_d');
            $paquete->cadera4_a = $request->get('cadera4_a');
            $paquete->cadera4_d = $request->get('cadera4_d');
            $paquete->gluteo4_a = $request->get('gluteo4_a');
            $paquete->gluteo4_d = $request->get('gluteo4_d');
            $paquete->firma4 = $request->get('firma4');
        }

        $paquete->save();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I O
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $request->get('cambio');
            $caja->concepto = 'Cambio nota paquete: ' . $paquete->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        $paquete2 = new Paquete2;
        $paquete2->id_paquete = $paquete->id;
        if($request->get('id_user5') != NULL){
            $paquete2->fecha5 = $request->get('fecha5');
            $paquete2->notas5 = $request->get('notas5');
            $paquete2->id_user5 = $request->get('id_user5');
            $paquete2->talla5_a = $request->get('talla5_a');
            $paquete2->talla5_d = $request->get('talla5_d');
            $paquete2->abdomen5_a = $request->get('abdomen5_a');
            $paquete2->abdomen5_d = $request->get('abdomen5_d');
            $paquete2->cintura5_a = $request->get('cintura5_a');
            $paquete2->cintura5_d = $request->get('cintura5_d');
            $paquete2->cadera5_a = $request->get('cadera5_a');
            $paquete2->cadera5_d = $request->get('cadera5_d');
            $paquete2->gluteo5_a = $request->get('gluteo5_a');
            $paquete2->gluteo5_d = $request->get('gluteo5_d');
            $paquete2->firma5 = $request->get('firma5');
        }

        if($request->get('id_user6') != NULL){
            $paquete2->fecha6 = $request->get('fecha6');
            $paquete2->notas6 = $request->get('notas6');
            $paquete2->id_user6 = $request->get('id_user6');
            $paquete2->talla6_a = $request->get('talla6_a');
            $paquete2->talla6_d = $request->get('talla6_d');
            $paquete2->abdomen6_a = $request->get('abdomen6_a');
            $paquete2->abdomen6_d = $request->get('abdomen6_d');
            $paquete2->cintura6_a = $request->get('cintura6_a');
            $paquete2->cintura6_d = $request->get('cintura6_d');
            $paquete2->cadera6_a = $request->get('cadera6_a');
            $paquete2->cadera6_d = $request->get('cadera6_d');
            $paquete2->gluteo6_a = $request->get('gluteo6_a');
            $paquete2->gluteo6_d = $request->get('gluteo6_d');
            $paquete2->firma6 = $request->get('firma6');
        }

        if($request->get('id_user7') != NULL){
            $paquete2->fecha7 = $request->get('fecha7');
            $paquete2->notas7 = $request->get('notas7');
            $paquete2->id_user7 = $request->get('id_user7');
            $paquete2->talla7_a = $request->get('talla7_a');
            $paquete2->talla7_d = $request->get('talla7_d');
            $paquete2->abdomen7_a = $request->get('abdomen7_a');
            $paquete2->abdomen7_d = $request->get('abdomen7_d');
            $paquete2->cintura7_a = $request->get('cintura7_a');
            $paquete2->cintura7_d = $request->get('cintura7_d');
            $paquete2->cadera7_a = $request->get('cadera7_a');
            $paquete2->cadera7_d = $request->get('cadera7_d');
            $paquete2->gluteo7_a = $request->get('gluteo7_a');
            $paquete2->gluteo7_d = $request->get('gluteo7_d');
            $paquete2->firma7 = $request->get('firma7');
        }

        if($request->get('id_user8') != NULL){
            $paquete2->fecha8 = $request->get('fecha8');
            $paquete2->notas8 = $request->get('notas8');
            $paquete2->id_user8 = $request->get('id_user8');
            $paquete2->talla8_a = $request->get('talla8_a');
            $paquete2->talla8_d = $request->get('talla8_d');
            $paquete2->abdomen8_a = $request->get('abdomen8_a');
            $paquete2->abdomen8_d = $request->get('abdomen8_d');
            $paquete2->cintura8_a = $request->get('cintura8_a');
            $paquete2->cintura8_d = $request->get('cintura8_d');
            $paquete2->cadera8_a = $request->get('cadera8_a');
            $paquete2->cadera8_d = $request->get('cadera8_d');
            $paquete2->gluteo8_a = $request->get('gluteo8_a');
            $paquete2->gluteo8_d = $request->get('gluteo8_d');
            $paquete2->firma8 = $request->get('firma8');
        }
        $paquete2->save();

        $paquete3 = new Paquete3();
        $paquete3->id_paquete = $paquete->id;
        if($request->get('id_user9') != NULL){
            $paquete3->fecha9 = $request->get('fecha9');
            $paquete3->notas9 = $request->get('notas9');
            $paquete3->id_user9 = $request->get('id_user9');
            $paquete3->talla9_a = $request->get('talla9_a');
            $paquete3->talla9_d = $request->get('talla9_d');
            $paquete3->abdomen9_a = $request->get('abdomen9_a');
            $paquete3->abdomen9_d = $request->get('abdomen9_d');
            $paquete3->cintura9_a = $request->get('cintura9_a');
            $paquete3->cintura9_d = $request->get('cintura9_d');
            $paquete3->cadera9_a = $request->get('cadera9_a');
            $paquete3->cadera9_d = $request->get('cadera9_d');
            $paquete3->gluteo9_a = $request->get('gluteo9_a');
            $paquete3->gluteo9_d = $request->get('gluteo9_d');
            $paquete3->firma9 = $request->get('firma9');
        }

        if($request->get('id_user10') != NULL){
            $paquete3->fecha10 = $request->get('fecha10');
            $paquete3->notas10 = $request->get('notas10');
            $paquete3->id_user10 = $request->get('id_user10');
            $paquete3->talla10_a = $request->get('talla10_a');
            $paquete3->talla10_d = $request->get('talla10_d');
            $paquete3->abdomen10_a = $request->get('abdomen10_a');
            $paquete3->abdomen10_d = $request->get('abdomen10_d');
            $paquete3->cintura10_a = $request->get('cintura10_a');
            $paquete3->cintura10_d = $request->get('cintura10_d');
            $paquete3->cadera10_a = $request->get('cadera10_a');
            $paquete3->cadera10_d = $request->get('cadera10_d');
            $paquete3->gluteo10_a = $request->get('gluteo10_a');
            $paquete3->gluteo10_d = $request->get('gluteo10_d');
            $paquete3->firma10 = $request->get('firma10');
        }
        $paquete3->save();

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){
            $pago = new PaquetesPago;
            $pago->id_paquete = $paquete->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->id_user = $request->get('id_user');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota_pago');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_paquetes';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }

            if($request->signed_pago != NULL){
                $folderPath = public_path('firma_pago/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed_pago);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;

                file_put_contents($file, $image_base64);
                $pago->firma = $signature;
            }

            $pago->save();

            // if($request->get('forma_pago') == 'Tarjeta'){

            //     // Define las credenciales de la API
            //     $apiKey = '23bb7433-1bae-4f0d-92f9-dc96990a8efb';
            //     $clave = 'd9a61a7b-2658-41d2-96b8-f6d235dfb5e9';

            //     // Genera el token de autorización
            //     $token = base64_encode($apiKey . ':' . $clave);

            //     if($request->get('name') != NULL){
            //        $nombre_cliente = $request->get('name');
            //     }else{
            //         $client =  Client::find($request->get('id_client'));
            //         $nombre_cliente = $client->name;
            //     }

            //     $cajera_id =  User::find($request->get('id_cosme'));
            //     $cajera = $cajera_id->name;


            //     $amount = $request->get('pago');
            //     $assigned_user = 'ventas@paradisus.com.mx';
            //     $reference = $paquete->id;
            //     $message = 'Paquete :#'.$paquete->id.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

            //     // Realiza la solicitud GET a la API de Clip
            //     $client_gz = new GuzzleClient();

            //     // Formatear los datos como JSON
            //     $data_items = [
            //         'amount' => (int)$amount,
            //         'assigned_user' => $assigned_user,
            //         'reference' => $reference,
            //         'message' => $message
            //     ];
            //     $jsonData = json_encode($data_items);

            //     $response = $client_gz->request('POST', 'https://api-gw.payclip.com/paymentrequest', [
            //         'body' => $jsonData,
            //         'headers' => [
            //             'accept' => 'application/vnd.com.payclip.v1+json',
            //             'content-type' => 'application/json; charset=UTF-8',
            //             'x-api-key' => 'Basic ' . $token,
            //           ],

            //     ]);

            //     $body = $response->getBody()->getContents();

            //     // Decodificar el cuerpo si es JSON
            //     $data = json_decode($body, true);

            // }
        }


        // G U A R D A R  R E P O R T E
        $reporte = new Reporte;
        $reporte->id_paquete = $paquete->id;
        $reporte->fecha = $pago->fecha;
        $reporte->tipo = 'NOTA PAQUETE';
        $reporte->id_client = $paquete->id_client;
        $reporte->metodo_pago = $pago->forma_pago;
        $reporte->monto = $paquete->monto;
        $reporte->pago = $pago->pago;
        $reporte->restante = $paquete->restante;
        $reporte->save();

        $recibo = [
            "nombreImpresora" => "ZJ-58",
            "id" => $paquete->id,
            "Fecha" => $paquete->fecha_inicial,
            "Cliente" => $paquete->Client->name,
            "Paquete" => $paquete->num_paquete,
            "Pago" => $request->get('pago'),
            "Dinero_recibido" => $request->get('dinero_recibido'),
            "Cambio" => $request->get('cambio'),
            "Forma_pago" => $request->get('forma_pago'),
        ];

        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('paquetes_servicios.index')
            ->with('success', 'Paquete created successfully.');
    }

    public function store_firma(Request $request, $id){

        if($request->signed != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquetes::where('id', '=', $id)->first();
            $firma->firma1 = $signature;
            $firma->update();
        }elseif($request->signed2 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquetes::where('id', '=', $id)->first();
            $firma->firma2 = $signature;
            $firma->update();
        }elseif($request->signed3 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquetes::where('id', '=', $id)->first();
            $firma->firma3 = $signature;
            $firma->update();
        }elseif($request->signed4 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed4);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquetes::where('id', '=', $id)->first();
            $firma->firma4 = $signature;
            $firma->update();
        }elseif($request->signed5 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed5);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquete2::where('id_paquete', '=', $id)->first();
            $firma->firma5 = $signature;
            $firma->update();
        }elseif($request->signed6 != NULL){

            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed6);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquete2::where('id_paquete', '=', $id)->first();
            $firma->firma6 = $signature;
            $firma->update();
        }elseif($request->signed7 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed7);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquete2::where('id_paquete', '=', $id)->first();
            $firma->firma7 = $signature;
            $firma->update();
        }elseif($request->signed8 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed8);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquete2::where('id_paquete', '=', $id)->first();
            $firma->firma8 = $signature;
            $firma->update();
        }elseif($request->signed9 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed9);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquete3::where('id_paquete', '=', $id)->first();
            $firma->firma9 = $signature;
            $firma->update();
        }elseif($request->signed10 != NULL){
            $folderPath = public_path('signatures/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed10);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = Paquete3::where('id_paquete', '=', $id)->first();
            $firma->firma10 = $signature;
            $firma->update();
        }

        return back()->with('success', 'Successfully saved the signature');
    }

    public function update(Request $request, $id)
    {
        $paquete = Paquetes::find($id);
        $paquete->id_client = $request->get('id_client');
        $paquete->fecha_inicial = $request->get('fecha_inicial');
        $paquete->restante = $request->get('restante_paquetes');
        $paquete->cambio = $request->get('cambio');

        if($request->signed_ini != NULL){
            $folderPath = public_path('condiciones_paquetes/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $paquete->firma = $signature;
        }

        if($request->signed_ini2 != NULL){
            $folderPath = public_path('condiciones_paquetes/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $paquete->firma = $signature;
        }

        if($request->signed_ini3 != NULL){
            $folderPath = public_path('condiciones_paquetes/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $paquete->firma = $signature;
        }

        if($request->signed_ini4 != NULL){
            $folderPath = public_path('condiciones_paquetes/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini4);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $paquete->firma = $signature;
        }

        if($request->signed_ini5 != NULL){
            $folderPath = public_path('condiciones_paquetes/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_ini5);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $paquete->firma = $signature;
        }

        $paquete->fecha1 = $request->get('fecha1');
        $paquete->notas1 = $request->get('notas1');
        $paquete->id_user1 = $request->get('id_user1');
        $paquete->talla1_a = $request->get('talla1_a');
        $paquete->talla1_d = $request->get('talla1_d');
        $paquete->abdomen1_a = $request->get('abdomen1_a');
        $paquete->abdomen1_d = $request->get('abdomen1_d');
        $paquete->cintura1_a = $request->get('cintura1_a');
        $paquete->cintura1_d = $request->get('cintura1_d');
        $paquete->cadera1_a = $request->get('cadera1_a');
        $paquete->cadera1_d = $request->get('cadera1_d');
        $paquete->gluteo1_a = $request->get('gluteo1_a');
        $paquete->gluteo1_d = $request->get('gluteo1_d');

        if($request->get('id_user2') != NULL){
            $paquete->fecha2 = $request->get('fecha2');
            $paquete->notas2 = $request->get('notas2');
            $paquete->id_user2 = $request->get('id_user2');
            $paquete->talla2_a = $request->get('talla2_a');
            $paquete->talla2_d = $request->get('talla2_d');
            $paquete->abdomen2_a = $request->get('abdomen2_a');
            $paquete->abdomen2_d = $request->get('abdomen2_d');
            $paquete->cintura2_a = $request->get('cintura2_a');
            $paquete->cintura2_d = $request->get('cintura2_d');
            $paquete->cadera2_a = $request->get('cadera2_a');
            $paquete->cadera2_d = $request->get('cadera2_d');
            $paquete->gluteo2_a = $request->get('gluteo2_a');
            $paquete->gluteo2_d = $request->get('gluteo2_d');
        }

        if($request->get('id_user3') != NULL){
            $paquete->fecha3 = $request->get('fecha3');
            $paquete->notas3 = $request->get('notas3');
            $paquete->id_user3 = $request->get('id_user3');
            $paquete->talla3_a = $request->get('talla3_a');
            $paquete->talla3_d = $request->get('talla3_d');
            $paquete->abdomen3_a = $request->get('abdomen3_a');
            $paquete->abdomen3_d = $request->get('abdomen3_d');
            $paquete->cintura3_a = $request->get('cintura3_a');
            $paquete->cintura3_d = $request->get('cintura3_d');
            $paquete->cadera3_a = $request->get('cadera3_a');
            $paquete->cadera3_d = $request->get('cadera3_d');
            $paquete->gluteo3_a = $request->get('gluteo3_a');
        }

        if($request->get('id_user4') != NULL){
            $paquete->fecha4 = $request->get('fecha4');
            $paquete->notas4 = $request->get('notas4');
            $paquete->id_user4 = $request->get('id_user4');
            $paquete->talla4_a = $request->get('talla4_a');
            $paquete->talla4_d = $request->get('talla4_d');
            $paquete->abdomen4_a = $request->get('abdomen4_a');
            $paquete->abdomen4_d = $request->get('abdomen4_d');
            $paquete->cintura4_a = $request->get('cintura4_a');
            $paquete->cintura4_d = $request->get('cintura4_d');
            $paquete->cadera4_a = $request->get('cadera4_a');
            $paquete->cadera4_d = $request->get('cadera4_d');
            $paquete->gluteo4_a = $request->get('gluteo4_a');
            $paquete->gluteo4_d = $request->get('gluteo4_d');
        }
        $paquete->update();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I O
        if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $request->get('cambio');
            $caja->concepto = 'Cambio nota paquete: ' . $paquete->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        $paquete2 = Paquete2::where('id_paquete', '=', $id)->first();
        $paquete2->id_paquete = $paquete->id;
        if($request->get('id_user5') != NULL){
            $paquete2->fecha5 = $request->get('fecha5');
            $paquete2->notas5 = $request->get('notas5');
            $paquete2->id_user5 = $request->get('id_user5');
            $paquete2->talla5_a = $request->get('talla5_a');
            $paquete2->talla5_d = $request->get('talla5_d');
            $paquete2->abdomen5_a = $request->get('abdomen5_a');
            $paquete2->abdomen5_d = $request->get('abdomen5_d');
            $paquete2->cintura5_a = $request->get('cintura5_a');
            $paquete2->cintura5_d = $request->get('cintura5_d');
            $paquete2->cadera5_a = $request->get('cadera5_a');
            $paquete2->cadera5_d = $request->get('cadera5_d');
            $paquete2->gluteo5_a = $request->get('gluteo5_a');
            $paquete2->gluteo5_d = $request->get('gluteo5_d');
        }

        if($request->get('id_user6') != NULL){
            $paquete2->fecha6 = $request->get('fecha6');
            $paquete2->notas6 = $request->get('notas6');
            $paquete2->id_user6 = $request->get('id_user6');
            $paquete2->talla6_a = $request->get('talla6_a');
            $paquete2->talla6_d = $request->get('talla6_d');
            $paquete2->abdomen6_a = $request->get('abdomen6_a');
            $paquete2->abdomen6_d = $request->get('abdomen6_d');
            $paquete2->cintura6_a = $request->get('cintura6_a');
            $paquete2->cintura6_d = $request->get('cintura6_d');
            $paquete2->cadera6_a = $request->get('cadera6_a');
            $paquete2->cadera6_d = $request->get('cadera6_d');
            $paquete2->gluteo6_a = $request->get('gluteo6_a');
            $paquete2->gluteo6_d = $request->get('gluteo6_d');
        }

        if($request->get('id_user7') != NULL){
            $paquete2->fecha7 = $request->get('fecha7');
            $paquete2->notas7 = $request->get('notas7');
            $paquete2->id_user7 = $request->get('id_user7');
            $paquete2->talla7_a = $request->get('talla7_a');
            $paquete2->talla7_d = $request->get('talla7_d');
            $paquete2->abdomen7_a = $request->get('abdomen7_a');
            $paquete2->abdomen7_d = $request->get('abdomen7_d');
            $paquete2->cintura7_a = $request->get('cintura7_a');
            $paquete2->cintura7_d = $request->get('cintura7_d');
            $paquete2->cadera7_a = $request->get('cadera7_a');
            $paquete2->cadera7_d = $request->get('cadera7_d');
            $paquete2->gluteo7_a = $request->get('gluteo7_a');
            $paquete2->gluteo7_d = $request->get('gluteo7_d');
        }

        if($request->get('id_user8') != NULL){
            $paquete2->fecha8 = $request->get('fecha8');
            $paquete2->notas8 = $request->get('notas8');
            $paquete2->id_user8 = $request->get('id_user8');
            $paquete2->talla8_a = $request->get('talla8_a');
            $paquete2->talla8_d = $request->get('talla8_d');
            $paquete2->abdomen8_a = $request->get('abdomen8_a');
            $paquete2->abdomen8_d = $request->get('abdomen8_d');
            $paquete2->cintura8_a = $request->get('cintura8_a');
            $paquete2->cintura8_d = $request->get('cintura8_d');
            $paquete2->cadera8_a = $request->get('cadera8_a');
            $paquete2->cadera8_d = $request->get('cadera8_d');
            $paquete2->gluteo8_a = $request->get('gluteo8_a');
            $paquete2->gluteo8_d = $request->get('gluteo8_d');
        }
        $paquete2->update();

        $paquete3 = Paquete3::where('id_paquete', '=', $id)->first();
        $paquete3->id_paquete = $paquete->id;
        if($request->get('id_user9') != NULL){
            $paquete3->fecha9 = $request->get('fecha9');
            $paquete3->notas9 = $request->get('notas9');
            $paquete3->id_user9 = $request->get('id_user9');
            $paquete3->talla9_a = $request->get('talla9_a');
            $paquete3->talla9_d = $request->get('talla9_d');
            $paquete3->abdomen9_a = $request->get('abdomen9_a');
            $paquete3->abdomen9_d = $request->get('abdomen9_d');
            $paquete3->cintura9_a = $request->get('cintura9_a');
            $paquete3->cintura9_d = $request->get('cintura9_d');
            $paquete3->cadera9_a = $request->get('cadera9_a');
            $paquete3->cadera9_d = $request->get('cadera9_d');
            $paquete3->gluteo9_a = $request->get('gluteo9_a');
            $paquete3->gluteo9_d = $request->get('gluteo9_d');
        }

        if($request->get('id_user10') != NULL){
            $paquete3->fecha10 = $request->get('fecha10');
            $paquete3->notas10 = $request->get('notas10');
            $paquete3->id_user10 = $request->get('id_user10');
            $paquete3->talla10_a = $request->get('talla10_a');
            $paquete3->talla10_d = $request->get('talla10_d');
            $paquete3->abdomen10_a = $request->get('abdomen10_a');
            $paquete3->abdomen10_d = $request->get('abdomen10_d');
            $paquete3->cintura10_a = $request->get('cintura10_a');
            $paquete3->cintura10_d = $request->get('cintura10_d');
            $paquete3->cadera10_a = $request->get('cadera10_a');
            $paquete3->cadera10_d = $request->get('cadera10_d');
            $paquete3->gluteo10_a = $request->get('gluteo10_a');
            $paquete3->gluteo10_d = $request->get('gluteo10_d');
        }
        $paquete3->update();

        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){
            $pago = new PaquetesPago;
            $pago->id_paquete = $paquete->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->id_user = $request->get('id_user');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota_pago');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_paquetes';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }

            if($request->signed_pago != NULL){
                $folderPath = public_path('firma_pago/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed_pago);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;

                file_put_contents($file, $image_base64);
                $pago->firma = $signature;
            }

            if($request->signed_pago2 != NULL){
                $folderPath = public_path('firma_pago/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed_pago2);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;

                file_put_contents($file, $image_base64);
                $pago->firma = $signature;
            }

            if($request->signed_pago3 != NULL){
                $folderPath = public_path('firma_pago/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed_pago3);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;

                file_put_contents($file, $image_base64);
                $pago->firma = $signature;
            }

            if($request->signed_pago4 != NULL){
                $folderPath = public_path('firma_pago/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed_pago4);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;

                file_put_contents($file, $image_base64);
                $pago->firma = $signature;
            }

            if($request->signed_pago5 != NULL){
                $folderPath = public_path('firma_pago/'); // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed_pago5);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;

                file_put_contents($file, $image_base64);
                $pago->firma = $signature;
            }
            $pago->save();
        }

        $pago_reciente = PaquetesPago::where('id_paquete', '=', $id)->orderBy('id','DESC')->first();
        // G U A R D A R  R E P O R T E
        $reporte = new Reporte;
        $reporte->id_paquete = $paquete->id;
        $reporte->fecha = $pago_reciente->fecha;
        $reporte->tipo = 'NOTA PAQUETE';
        $reporte->id_client = $paquete->id_client;
        $reporte->metodo_pago = $pago_reciente->forma_pago;
        $reporte->monto = $paquete->monto;
        $reporte->restante = $paquete->restante;
        $reporte->pago = $pago_reciente->pago;
        $reporte->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'Paquete created successfully.');
    }
}
