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
        $custom = CustomTerms::get();

        return view('sueldo_cosmes.terminos_index',compact('user','custom'));
    }

    public function store(Request $request)
    {
        $custom = new CustomTerms();
        $custom ->id_user = $request->get('id_user');
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
        return $pdf->download('Terminos '.$user->name.'-'.$fecha.'.pdf');
    }
}
