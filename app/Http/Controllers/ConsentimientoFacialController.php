<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ConcentimientoFacial;
use App\Models\ConsentimeintoFirmasJacuzzi;
use App\Models\ConsentimeintoJacuzzi;
use App\Models\ConsentimientoFirmasFacial;
use App\Models\ConsentimientoCorporal;
use App\Models\ConsentimientoFirmasCorporal;
use App\Models\LashLifting;
use App\Models\LashLiftingFirma;
use Session;

class ConsentimientoFacialController extends Controller
{
    public function store(Request $request)
    {
        $fechaActual = date('Y-m-d');
        if($request->get('id_client') == NULL){
            if (Client::where('phone', $request->get('phone'))->exists()) {
                $client = Client::where('phone', $request->get('phone'))->first();
                $payer2 = $client->id;
            } else {
                $client = new Client();
                $client->name = $request->get('name');
                $client->last_name = $request->get('last_name');
                $client->phone = $request->get('phone');
                $client->save();
                $client2 = Client::where('phone', '=', $request->get('phone'))->first();
                $payer2 = $client2->id;
            }
        }else{
            $payer2 = $request->get('id_client');
        }

        if($request->get('consentimiento') == '1'){
            $ConcentimientoFacial = new ConcentimientoFacial;
            $ConcentimientoFacial->id_client = $payer2;
            
            $ConcentimientoFacial->fecha = $fechaActual;
            $ConcentimientoFacial->save();

            $i = 0;
            for($i=0; $i<=$request->get('num_personas'); $i++){
                $ConcentimientoFacialFirma = new ConsentimientoFirmasCorporal;
                $ConcentimientoFacialFirma->id_consentimiento = $ConcentimientoFacial->id;
                $ConcentimientoFacialFirma->save();
            }

            Session::flash('success', 'Se ha guardado sus datos con exito');
            return redirect()->route('clients_facial.index')
                ->with('success', 'caja created successfully.');
        }

        if($request->get('consentimiento') == '2'){
            $ConcentimientoCorporal = new ConsentimientoCorporal;
            $ConcentimientoCorporal->id_client = $payer2;
            $ConcentimientoCorporal->fecha = $fechaActual;
            $ConcentimientoCorporal->save();

            $e = 0;
            for($e=0; $e<=$request->get('num_personas'); $e++){
                $ConcentimientoCorporalFirma = new ConsentimientoFirmasFacial;
                $ConcentimientoCorporalFirma->id_consentimiento = $ConcentimientoCorporal->id;
                $ConcentimientoCorporalFirma->save();
            }

            Session::flash('success', 'Se ha guardado sus datos con exito');
            return redirect()->route('clients_show_brow.index')
                ->with('success', 'caja created successfully.');
        }

        if($request->get('consentimiento') == '3'){
            $LashLifting = new LashLifting;
            $LashLifting->id_client = $payer2;
            $LashLifting->fecha = $fechaActual;
            $LashLifting->save();

            $e = 0;
            for($e=0; $e<=$request->get('num_personas'); $e++){
                $LashLiftingFirma = new LashLiftingFirma;
                $LashLiftingFirma->id_consentimiento = $LashLifting->id;
                $LashLiftingFirma->save();
            }

            Session::flash('success', 'Se ha guardado sus datos con exito');
            return redirect()->route('clients_lash.index')
                ->with('success', 'caja created successfully.');
        }

        if($request->get('consentimiento') == '4'){
            $Jacuzzi = new ConsentimeintoJacuzzi;
            $Jacuzzi->id_client = $payer2;
            $Jacuzzi->fecha = $fechaActual;
            $Jacuzzi->save();

            $e = 0;
            for($e=0; $e<=$request->get('num_personas'); $e++){
                $JacuzziFirma = new ConsentimeintoFirmasJacuzzi;
                $JacuzziFirma->id_consentimiento = $Jacuzzi->id;
                $JacuzziFirma->save();
            }

            Session::flash('success', 'Se ha guardado sus datos con exito');
            return redirect()->route('clients_jacuzzi.index')
                ->with('success', 'caja created successfully.');
        }

    }

    public function user_show(Request $request, $id){
        $ConsentimientoFirmasCorporal = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->count();
        $firmas = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = ConcentimientoFacial::find($id);

        return view('consentimiento.create', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }

    public function user_show_brow(Request $request, $id){
        $ConsentimientoFirmasCorporal = ConsentimientoFirmasfacial::where('id_consentimiento', '=', $id)->count();
        $firmas = ConsentimientoFirmasfacial::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = ConsentimientoCorporal::find($id);

        return view('consentimiento.create_brow', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }

    public function user_show_lash(Request $request, $id){
        $ConsentimientoFirmasCorporal = LashLiftingFirma::where('id_consentimiento', '=', $id)->count();
        $firmas = LashLiftingFirma::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = LashLifting::find($id);

        return view('consentimiento.create_lash', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }

    public function user_show_jacuzzi(Request $request, $id){
        $ConsentimientoFirmasCorporal = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->count();
        $firmas = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = ConsentimeintoJacuzzi::find($id);

        return view('consentimiento.create_jacuzzi', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }


    public function cosme_show(Request $request, $id){
        $ConsentimientoFirmasCorporal = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->count();
        $firmas = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = ConcentimientoFacial::find($id);

        return view('consentimiento.show', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }

    public function cosme_show_brow(Request $request, $id){
        $ConsentimientoFirmasCorporal = ConsentimientoFirmasfacial::where('id_consentimiento', '=', $id)->count();
        $firmas = ConsentimientoFirmasfacial::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = ConsentimientoCorporal::find($id);

        return view('consentimiento.show_brow', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }

    public function cosme_show_lash(Request $request, $id){
        $ConsentimientoFirmasCorporal = LashLiftingFirma::where('id_consentimiento', '=', $id)->count();
        $firmas = LashLiftingFirma::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = LashLifting::find($id);

        return view('consentimiento.show_lash', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }

    public function cosme_show_jacuzzi(Request $request, $id){
        $ConsentimientoFirmasCorporal = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->count();
        $firmas = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->get();
        $ConcentimientoFacial = ConsentimeintoJacuzzi::find($id);

        return view('consentimiento.show_jacuzzi', compact('ConcentimientoFacial', 'ConsentimientoFirmasCorporal', 'firmas'));
    }


    public function user_edit(Request $request, $id)
    {
        $ConcentimientoFacial = ConcentimientoFacial::find($id);
        $ConcentimientoFacial->pregunta1 = $request->get('renales') . ' ' . $request->get('digestivas') . ' ' . $request->get('circulatorias') . ' ' . $request->get('diabetes')
        . ' ' . $request->get('presion_arterial') . ' ' . $request->get('sistema_nervioso') . ' ' . $request->get('tiroides') . ' ' . $request->get('anorexia') . ' ' . $request->get('bulimia')
        . ' ' . $request->get('obesidad') . ' ' . $request->get('fobias') . ' ' . $request->get('convulsiones') . ' ' . $request->get('problemas_cardiacos') . ' ' . $request->get('problemas_oseos')
        . ' ' . $request->get('queloides') . ' ' . $request->get('cancer') . ' ' . $request->get('embarazo') . ' ' . $request->get('alcohol') . ' ' . $request->get('cigarrillo') . ' ' . $request->get('herpes')
        . ' ' . $request->get('celulitis') . ' ' . $request->get('flacidez') . ' ' . $request->get('varices');

        if($request->get('pregunta2_otro') == NULL){
            $ConcentimientoFacial->pregunta2 = $request->get('pregunta2');
        }else{
            $ConcentimientoFacial->pregunta2 = $request->get('pregunta2_otro');
        }

        $ConcentimientoFacial->pregunta3 = $request->get('dieta') . ' ' . $request->get('proteccion_piel') . ' ' . $request->get('maquillaje') . ' ' . $request->get('deporte')
        . ' ' . $request->get('corticoides') . ' ' . $request->get('antidepresivos') . ' ' . $request->get('anticonceptivos_hormonales') . ' ' . $request->get('diureticos') . ' ' . $request->get('carotenos_pigmentos')
        . ' ' . $request->get('vitamina');

        if($request->get('pregunta4_otro') == NULL){
            $ConcentimientoFacial->pregunta4 = $request->get('pregunta4');
        }else{
            $ConcentimientoFacial->pregunta4 = $request->get('pregunta4_otro');
        }

        if($request->get('pregunta5_otro') == NULL){
            $ConcentimientoFacial->pregunta5 = $request->get('pregunta5');
        }else{
            $ConcentimientoFacial->pregunta5 = $request->get('pregunta5_otro');
        }

        if($request->get('pregunta6_otro') == NULL){
            $ConcentimientoFacial->pregunta6 = $request->get('pregunta6');
        }else{
            $ConcentimientoFacial->pregunta6 = $request->get('pregunta6_otro');
        }

        if($request->get('pregunta7_otro') == NULL){
            $ConcentimientoFacial->pregunta7 = $request->get('pregunta7');
        }else{
            $ConcentimientoFacial->pregunta7 = $request->get('pregunta7_otro');
        }

        if($request->get('pregunta8_otro') == NULL){
            $ConcentimientoFacial->pregunta8 = $request->get('pregunta8');
        }else{
            $ConcentimientoFacial->pregunta8 = $request->get('pregunta8_otro');
        }

        $ConcentimientoFacial->pregunta9 = $request->get('antidepresivos') . ' ' . $request->get('somniferos') . ' ' . $request->get('drogas') . ' ' . $request->get('marcapasos')
        . ' ' . $request->get('protesis') . ' ' . $request->get('placas') . ' ' . $request->get('mesoterapia') . ' ' . $request->get('dispositivo_intrauterino') . ' ' . $request->get('dispositivo_cardiaco')
        . ' ' . $request->get('suplementos');

        if($request->get('pregunta10_otro') == NULL){
            $ConcentimientoFacial->pregunta10 = $request->get('pregunta10');
        }else{
            $ConcentimientoFacial->pregunta10 = $request->get('pregunta10_otro');
        }

        if($request->get('pregunta11_otro') == NULL){
            $ConcentimientoFacial->pregunta11 = $request->get('ninguna') . ' ' . $request->get('histerectomia') . ' ' . $request->get('cesarea') . ' ' . $request->get('tiroides_11')
            . ' ' . $request->get('bucodental') . ' ' . $request->get('botox') . ' ' . $request->get('hilos_tensores') . ' ' . $request->get('mesoterapia_11');
        }else{
            $ConcentimientoFacial->pregunta11 = $request->get('pregunta11_otro');
        }
        $ConcentimientoFacial->update();

        if($request->signed_pago1 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago1);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago2 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago3 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago4 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago4);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago5 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago5);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago6 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago6);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago7 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago7);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago8 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago8);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago9 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago9);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago10 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago10);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago11 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago11);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago12 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago12);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }

        if($request->signed_pago13 != NULL){
            $ConcentimientoCorporalFirma = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoc/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago13);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConcentimientoCorporalFirma->firma = $signature;
            $ConcentimientoCorporalFirma->update();
        }


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()
        ->with('edit','Consentimiento Guardado con exito.');
    }

    public function user_edit_brow(Request $request, $id)
    {
        $ConsentimientoCorporal = ConsentimientoCorporal::find($id);
        if($request->get('pregunta1_otro') == NULL){
            $ConsentimientoCorporal->pregunta1 = $request->get('renales') . ' ' . $request->get('digestivas') . ' ' . $request->get('circulatorias') . ' ' . $request->get('diabetes');
        }else{
            $ConsentimientoCorporal->pregunta1 = $request->get('pregunta1_otro');
        }

        $ConsentimientoCorporal->pregunta2 = $request->get('pregunta2');
        $ConsentimientoCorporal->pregunta3 = $request->get('pregunta3');
        $ConsentimientoCorporal->pregunta4 = $request->get('pregunta4');
        $ConsentimientoCorporal->pregunta5 = $request->get('pregunta5');
        $ConsentimientoCorporal->pregunta6 = $request->get('pregunta6');
        $ConsentimientoCorporal->pregunta7 = $request->get('pregunta7');
        $ConsentimientoCorporal->pregunta8 = $request->get('pregunta8');
        $ConsentimientoCorporal->pregunta9 = $request->get('pregunta9');
        $ConsentimientoCorporal->pregunta10 = $request->get('pregunta10');
        $ConsentimientoCorporal->pregunta11 = $request->get('pregunta11');
        $ConsentimientoCorporal->pregunta12 = $request->get('pregunta12');
        $ConsentimientoCorporal->pregunta13 = $request->get('pregunta13');
        $ConsentimientoCorporal->pregunta14 = $request->get('pregunta14');
        $ConsentimientoCorporal->pregunta15 = $request->get('pregunta15');
        $ConsentimientoCorporal->update();

        if($request->signed_pago1 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago1);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago2 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago3 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago4 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago4);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago5 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago5);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago6 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago6);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago7 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago7);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago8 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago8);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago9 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago9);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago10 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago10);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago11 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago11);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago12 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago12);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }

        if($request->signed_pago13 != NULL){
            $ConsentimientoFirmasFacial = ConsentimientoFirmasFacial::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientob/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago13);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $ConsentimientoFirmasFacial->firma = $signature;
            $ConsentimientoFirmasFacial->update();
        }


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()
        ->with('edit','Consentimiento Guardado con exito.');
    }

    public function user_edit_lash(Request $request, $id)
    {
        $LashLifting = LashLifting::find($id);
        if($request->get('pregunta1_otro') == NULL){
            $LashLifting->pregunta1 = $request->get('renales') . ' ' . $request->get('digestivas');
        }else{
            $LashLifting->pregunta1 = $request->get('pregunta1_otro');
        }

        $LashLifting->pregunta2 = $request->get('pregunta2');
        $LashLifting->pregunta3 = $request->get('pregunta3');
        $LashLifting->pregunta4 = $request->get('pregunta4');
        $LashLifting->pregunta5 = $request->get('pregunta5');
        $LashLifting->pregunta6 = $request->get('pregunta6');
        $LashLifting->pregunta7 = $request->get('pregunta7');
        $LashLifting->pregunta8 = $request->get('pregunta8');
        $LashLifting->pregunta9 = $request->get('pregunta9');
        $LashLifting->pregunta10 = $request->get('pregunta10');
        $LashLifting->pregunta11 = $request->get('pregunta11');
        $LashLifting->pregunta12 = $request->get('pregunta12');
        $LashLifting->pregunta13 = $request->get('pregunta13');
        $LashLifting->pregunta14 = $request->get('pregunta14');
        $LashLifting->update();

        if($request->signed_pago1 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago1);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago2 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago3 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago4 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago4);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago5 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago5);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago6 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago6);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago7 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago7);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago8 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago8);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago9 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago9);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago10 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago10);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago11 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago11);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago12 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago12);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }

        if($request->signed_pago13 != NULL){
            $LashLiftingFirma = LashLiftingFirma::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientol/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago13);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $LashLiftingFirma->firma = $signature;
            $LashLiftingFirma->update();
        }


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()
        ->with('edit','Consentimiento Guardado con exito.');
    }

    public function user_edit_jacuzzi(Request $request, $id)
    {
        $Jacuzzi = ConsentimeintoJacuzzi::find($id);
        $Jacuzzi->pregunta1 = $request->get('pregunta1');
        $Jacuzzi->pregunta2 = $request->get('pregunta2');
        $Jacuzzi->pregunta3 = $request->get('pregunta3');
        $Jacuzzi->pregunta4 = $request->get('pregunta4');
        $Jacuzzi->pregunta5 = $request->get('pregunta5');
        $Jacuzzi->pregunta6 = $request->get('pregunta6');
        $Jacuzzi->pregunta7 = $request->get('pregunta7');
        $Jacuzzi->update();

        if($request->signed_pago1 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago1);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago2 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago3 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago4 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago4);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago5 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago5);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago6 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago6);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago7 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago7);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago8 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago8);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago9 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago9);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago10 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago10);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago11 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago11);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago12 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago12);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        if($request->signed_pago13 != NULL){
            $JacuzziFirma = ConsentimeintoFirmasJacuzzi::where('id_consentimiento', '=', $id)->where('firma', '=', NULL)->first();
            $folderPath = public_path('firma_consentimientoj/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed_pago13);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);
            $JacuzziFirma->firma = $signature;
            $JacuzziFirma->update();
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()
        ->with('edit','Consentimiento Guardado con exito.');
    }
}
