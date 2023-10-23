<?php

namespace App\Http\Controllers;

use App\Models\Encuestas;
use App\Models\User;
Use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncuestasController extends Controller
{
    public function index() {

        return view('encuestas.vista_admin.index');
    }

    public function advance(Request $request) {

        $fecha1 = $request->fecha;
        $fecha2 = $request->fecha2;

        // Formatea las fechas al formato deseado "d/m/y".
        $fecha1 = date("d/m/y", strtotime($fecha1));
        $fecha2 = date("d/m/y", strtotime($fecha2));

        // Concatena las fechas en el formato deseado.
        $rango_fechas = "Fecha elegida del: <br><br> " . $fecha1 . " al " . $fecha2;

        if ($request->fecha != NULL && $request->fecha2 != NULL) {
            $reportesfacial = Encuestas::where('fecha', '>=', $request->fecha)
                ->where(function ($query) {
                    $query->where('tipo', 'Facial')
                        ->orWhere('tipo', 'Faciales & Corporal');
                })
                ->where('fecha', '<=', $request->fecha2)
                ->get();

            $reportescorporal = Encuestas::where('fecha', '>=', $request->fecha)
                ->where('tipo', 'Corporal')
                ->where('fecha', '<=', $request->fecha2)
                ->get();

            $reportesfyc = Encuestas::where('fecha', '>=', $request->fecha)
                ->where('tipo', 'Facial')
                ->where('tipo', 'Corporal')
                ->where('fecha', '<=', $request->fecha2)
                ->get();
        }

        $reportes = $reportesfacial->concat($reportescorporal)->concat($reportesfyc);


        if( $request->fecha != NULL && $request->fecha2 != NULL){
            $reportes_brow = Encuestas::where('fecha', '>=', $request->fecha)
                                ->where('tipo', '=', 'Brow Bar & Lash Lifting')
                                ->where('fecha', '<=', $request->fecha2);
        }

        $reportes_brow = $reportes_brow->get();

        if( $request->fecha != NULL && $request->fecha2 != NULL){
            $reportes_exp_ja = Encuestas::where('fecha', '>=', $request->fecha)
                                ->where('tipo', '=', 'Experiencia + Jacuzzi')
                                ->where('fecha', '<=', $request->fecha2);
        }

        $reportes_exp_ja = $reportes_exp_ja->get();

        if( $request->fecha != NULL && $request->fecha2 != NULL){
            $reportes_exp = Encuestas::where('fecha', '>=', $request->fecha)
                                ->where('tipo', '=', 'Experiencias')
                                ->where('fecha', '<=', $request->fecha2);
        }

        $reportes_exp = $reportes_exp->get();


        return view('encuestas.vista_admin.index', compact('reportes','rango_fechas','reportes_brow','reportes_exp_ja','reportes_exp'));
    }

    public function index_faciales(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.faciales', compact('cosme'));
    }

    public function index_facorpo(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.facial_corporal', compact('cosme'));
    }

    public function index_corporal(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.corporales', compact('cosme'));
    }

    public function index_experiencias(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.experiencias', compact('cosme'));
    }

    public function index_jacuzzi_experiencia(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.jacuzzi_experiencia', compact('cosme'));
    }

    public function index_jacuzzi(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.jacuzzi', compact('cosme'));
    }

    public function index_brow(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.brow_bar', compact('cosme'));
    }

    public function index_nailbar(){
        $cosme = User::where('id', '!=', 1)->Orderby('name','ASC')->get();

        return view('encuestas.nailbar', compact('cosme'));
    }

    public function create_faciales(Request $request)
    {
        $fechaActual = date('Y-m-d');
        $paquete = new Encuestas;
        $paquete->id_user = $request->get('id_user');
        $paquete->fecha = $fechaActual;
        $paquete->tipo = $request->get('tipo');
        $paquete->p1 = $request->get('p1');
        $paquete->p2 = $request->get('p2');
        $paquete->p3 = $request->get('p3');
        $paquete->p4 = $request->get('p4');
        $paquete->p5 = $request->get('p5');
        $paquete->p6 = $request->get('p6');
        $paquete->p7 = $request->get('p7');
        $paquete->p8 = $request->get('p8');
        $paquete->p9 = $request->get('p9');
        $paquete->p10 = $request->get('p10');
        $paquete->p11 = $request->get('p11');
        $paquete->p12 = $request->get('p12');
        $paquete->p13 = $request->get('p13');
        $paquete->p14 = $request->get('p14');
        $paquete->p15 = $request->get('p15');
        $paquete->p16 = $request->get('p16');
        $paquete->p17 = $request->get('p17');
        $paquete->comentario = $request->get('comentario');
        $paquete->nombre = $request->get('nombre');
        $paquete->telefono = $request->get('telefono');

        $paquete->save();

        Alert::success('¡Apreciamos tu opinión y esperamos verte de nuevo pronto!');
        return redirect()->back();
    }
}
