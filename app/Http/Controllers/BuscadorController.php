<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Client;
use App\Models\ConcentimientoFacial;
use App\Models\ConsentimeintoFirmasJacuzzi;
use App\Models\ConsentimeintoJacuzzi;
use App\Models\ConsentimientoCorporal;
use App\Models\ConsentimientoFirmasCorporal;
use App\Models\ConsentimientoFirmasFacial;
use App\Models\LashLifting;
use App\Models\LashLiftingFirma;
use App\Models\Notas;
use App\Models\NotasPedidos;
use App\Models\Paquetes;
use App\Models\Reporte;
use Illuminate\Http\Request;
use App\Models\NotasLacer;
use DB;
Use Alert;

class BuscadorController extends Controller
{
    public function index() {

        $clients = Client::all();

        return view('buscador.index', compact('clients'));
    }

    public function advance(Request $request) {

        $request->validate([
            'id_client' => 'required_without_all:phone',
            'phone' => 'required_without_all:id_client',
        ]);

        $id_client = $request->id_client;
        $phone = $request->phone;

        $nota = [];
        $paquetes = [];

        if ($id_client !== 'null' && $id_client !== null) {
            $nota = Notas::where('id_client', $id_client)->get();
            $paquetes = Paquetes::where('id_client', $id_client)->get();
            $nota_lacer = NotasLacer::where('id_client',$id_client)->get();

        } elseif ($phone !== 'null' && $phone !== null) {
            $nota = Notas::where('id_client', $phone)->get();
            $paquetes = Paquetes::where('id_client', $phone)->get();
            $nota_lacer = NotasLacer::where('id_client',$id_client)->get();
        }

        //Alert::success('Encontrado con exito ');

        return view('buscador.index', compact('nota', 'paquetes','nota_lacer'));
    }

    public function update_paquete(Request $request, $id)
    {

        $paquete = Paquetes::find($id);
        if ($request->get('id_paquete') == 1){
            $paquete->id_servicio = 151;
        }elseif ($request->get('id_paquete') == 2){
            $paquete->id_servicio = 156;
        }elseif ($request->get('id_paquete') == 3){
            $paquete->id_servicio = 153;
        }elseif ($request->get('id_paquete') == 4){
            $paquete->id_servicio = 154;
        }elseif ($request->get('id_paquete') == 5){
            $paquete->id_servicio = 155;
        }elseif ($request->get('id_paquete') == 6){
            $paquete->id_servicio = 276;
        }

        if($request->get('descuento_5') == 1){
            $descuento_5 = $request->get('precio_paquete') * .05;
            $descuento_5_total = $request->get('precio_paquete') - $descuento_5;
            $paquete->monto = $descuento_5_total;
        }else{
            $paquete->monto = $request->get('precio_paquete');
        }

        $paquete->num_paquete = $request->get('id_paquete');
        $paquete->restante = $request->get('pago_restante');
        $paquete->update();

        Alert::success('Se ha cambiado de paquete con exito');
        return redirect()->back();
    }


}
