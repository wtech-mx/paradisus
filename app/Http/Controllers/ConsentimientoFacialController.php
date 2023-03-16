<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ConcentimientoFacial;
use App\Models\ConsentimientoFirmasFacial;
use App\Models\ConsentimientoCorporal;
use App\Models\ConsentimientoFirmasCorporal;
use Session;

class ConsentimientoFacialController extends Controller
{
    public function store(Request $request)
    {
        $fechaActual = date('Y-m-d');

        $ConcentimientoFacial = new ConcentimientoFacial;
        $ConcentimientoFacial->id_client = $request->get('id_client');
        $ConcentimientoFacial->fecha = $fechaActual;
        $ConcentimientoFacial->save();

        $i = 0;
        for($i=0; $i<=$request->get('num_personas'); $i++){
            $ConcentimientoFacialFirma = new ConsentimientoFirmasFacial;
            $ConcentimientoFacialFirma->id_consentimiento = $ConcentimientoFacial->id;
            $ConcentimientoFacialFirma->save();
        }

        $ConcentimientoCorporal = new ConsentimientoCorporal;
        $ConcentimientoCorporal->id_client = $request->get('id_client');
        $ConcentimientoCorporal->fecha = $fechaActual;
        $ConcentimientoCorporal->save();

        $e = 0;
        for($e=0; $e<=$request->get('num_personas'); $e++){
            $ConcentimientoCorporalFirma = new ConsentimientoFirmasCorporal;
            $ConcentimientoCorporalFirma->id_consentimiento = $ConcentimientoCorporal->id;
            $ConcentimientoCorporalFirma->save();
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('success', 'caja created successfully.');
    }

    public function user_show(Request $request, $id){
        $ConsentimientoCorporal = ConsentimientoCorporal::find($id);
        $ConsentimientoFirmasCorporal = ConsentimientoFirmasCorporal::where('id_consentimiento', '=', $id)->count();

        $ConcentimientoFacial = ConcentimientoFacial::find($id);

        return view('consentimiento.create', compact('ConsentimientoCorporal', 'ConsentimientoFirmasCorporal'));
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



        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()
        ->with('edit','Consentimiento Guardado con exito.');
    }
}
