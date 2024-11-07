<?php

namespace App\Http\Controllers;

use App\Models\Laser;
use App\Models\LaserKit;
use App\Models\LaserKitZonas;
use Illuminate\Http\Request;

class LaserKitController extends Controller
{
    public function index(){
        $lasers_kits = LaserKit::orderBy('id', 'DESC')->get();

        return view('laser_kit.index', compact('lasers_kits'));
    }

    public function create(Request $request) {

        $lasers_kits = LaserKit::orderBy('id','ASC')->get();
        $lasers_kits_zonas = LaserKitZonas::orderBy('id','ASC')->get();
        $zonas = Laser::orderBy('zona','ASC')->get();

        return view('laser_kit.create',compact('lasers_kits', 'lasers_kits_zonas', 'zonas'));
    }

    public function store(Request $request){

        $paquete = new LaserKit;
        $paquete->nombre = $request->get('nombre');
        $paquete->fecha_caducidad = $request->get('fecha_caducidad');
        $paquete->precio = $request->get('precio');
        $paquete->num_sesiones = $request->get('num_sesiones');
        $paquete->vencido = $request->get('vencido');
        $paquete->save();

        if ($request->has('id_laser_zona')) {
            $nuevosCampos = $request->input('id_laser_zona');

            foreach ($nuevosCampos as $index => $campo) {
                $paquete_zona = new LaserKitZonas;
                $paquete_zona->id_laser_kit = $paquete->id;
                $paquete_zona->id_laser_zona = $campo;
                $paquete_zona->save();
            }
        }

        return redirect()->back()->with('success', 'Paquete Creado con exito.');
    }

    public function edit($id){
        $lasers_kits = LaserKit::where('id','=', $id)->first();
        $lasers_kits_zonas = LaserKitZonas::where('id_laser_kit','=', $id)->get();
        $zonas = Laser::orderBy('zona','ASC')->get();

        return view('laser_kit.edit',compact('lasers_kits', 'lasers_kits_zonas', 'zonas'));
    }

    public function update(Request $request, $id){
        $lasers_kits = LaserKit::where('id','=', $id)->first();
        $lasers_kits->nombre = $request->get('nombre');
        $lasers_kits->precio = $request->get('precio');
        $lasers_kits->num_sesiones = $request->get('num_sesiones');
        $lasers_kits->vencido = $request->get('vencido');
        $lasers_kits->update();

        return redirect()->route('index_laser.kit')->with('edit', 'Actualizado');
    }
}
