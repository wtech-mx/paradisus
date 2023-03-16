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
        $ConcentimientoFacial = ConcentimientoFacial::find($id);

        return view('consentimiento.create', compact('ConsentimientoCorporal', 'ConcentimientoFacial'));
    }
}
