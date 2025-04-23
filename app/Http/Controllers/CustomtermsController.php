<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\CustomTerms;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Session;

class CustomtermsController extends Controller
{
    public function index(Request $request)
    {
        $user = User::orderBy('name','asc')->get();
        $custom = CustomTerms::orderBy('id','desc')->get();

        return view('sueldo_cosmes.terminos_index',compact('user','custom'));
    }

    public function store(Request $request)
    {
        $custom = new CustomTerms();

        if($request->get('cosme_manual') == 'si'){
            $custom ->cosmemanual = $request->get('cosmemanual');
            $custom ->cosmemanual_tel = $request->get('cosmemanual_tel');

        }else{
            $custom ->id_user = $request->get('id_user');
        }

        $custom ->titulo = $request->get('titulo');
        $custom ->descripcion = $request->get('descripcion');
        $custom ->monto = $request->get('monto');
        $custom ->fecha = $request->get('fecha');
        $custom->save();

        Session::flash('create', 'Se ha creado sus datos con exito');
        return redirect()->back();
    }

    public function edit(Request $request,$id){

        $cosme = CustomTerms::find($id);

        $user = User::find($cosme->id_user);

        return view('sueldo_cosmes.terminos_firma', compact('cosme','user'));

    }


    public function destroy($id)
    {
        $custom = CustomTerms::find($id);

        if ($custom) {
            $custom->delete();
            Session::flash('success', 'El registro se ha eliminado con éxito.');
        } else {
            Session::flash('error', 'El registro no existe.');
        }

        return redirect()->back();
    }

    public function firma(Request $request, $id){

        if($request->signed != NULL){
            $folderPath = public_path('firmaCosme/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("firmaCosme/", $image_parts[0]);
            $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : null;

            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.png' ;
            $file = $folderPath . $signature;
            file_put_contents($file, $image_base64);

            // Save in your data in database here.
            $firma = CustomTerms::where('id', '=', $id)->first();
            $firma->firma = $signature;
            $firma->update();
        }

        return back()->with('success', 'Firma guardada con exito');
    }

    public function pdf($id){
        $cosme = CustomTerms::find($id);

        $user = User::find($cosme->id_user);
        $fecha = date('Y-m-d');

        $pdf = \PDF::loadView('sueldo_cosmes.terminos_pdf',compact('cosme','user'));
        // return $pdf->stream();

        if(!isset($user->name)){
            $nombrepdf = $cosme->cosmemanual;
        }else{
            $nombrepdf = $user->name;
        }

        return $pdf->download('Terminos '.$nombrepdf.'-'.$fecha.'.pdf');
    }
}
