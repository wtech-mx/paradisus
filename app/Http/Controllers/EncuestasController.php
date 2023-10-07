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
        $reportes = DB::table('encuestas');

        if( $request->fecha != NULL && $request->fecha2 != NULL){
            $reportes = $reportes->where('fecha', '>=', $request->fecha)
                                ->where('fecha', '<=', $request->fecha2);
        }
        if( $request->tipo){
            $reportes = $reportes->where('tipo', 'LIKE', "%" . $request->tipo . "%");
        }
        $reportes = $reportes->get();

        $p1 = ["Probable", "Neutral", "Algo poco probable", "Bastante probable", "Poco probable"];
        $conteoPorTipo = [];
        foreach ($p1 as $tipo) {
            $query = DB::table('encuestas')
                ->where('fecha', '>=', $request->fecha)
                ->where('fecha', '<=', $request->fecha2)
                ->where('tipo',  $request->tipo)
                ->where('p1',  $tipo);

            $conteo = $query->count();

            $conteoPorTipo[$tipo] = $conteo;
        }

        $p7 = ["Muy mala", "Mala", "Neutral", "Buena", "Muy buena"];
        $conteoPorTipoP7 = [];
        foreach ($p7 as $tipo) {
            $query = DB::table('encuestas')
                ->where('fecha', '>=', $request->fecha)
                ->where('fecha', '<=', $request->fecha2)
                ->where('tipo',  $request->tipo)
                ->where('p7',  $tipo);

            $conteo = $query->count();

            $conteoPorTipoP4[$tipo] = $conteo;
        }

        $data = DB::table('encuestas')
        ->select('p5', 'p6', 'p10', 'p11', 'p12', 'p13')
        ->where('fecha', '>=', $request->fecha)
        ->where('fecha', '<=', $request->fecha2)
        ->where('tipo', $request->tipo)
        ->get();

        $categories = ['p5', 'p6', 'p10', 'p11', 'p12', 'p13'];
        $siCounts = [];
        $noCounts = [];

        foreach ($categories as $category) {
            $siCount = $data->where($category, 'si')->count();
            $noCount = $data->where($category, 'no')->count();

            $siCounts[] = $siCount;
            $noCounts[] = $noCount;
        }

    

        $conteoCalificaciones = [
            'Muy mala' => 0,
            'Mala' => 0,
            'Neutral' => 0,
            'Buena' => 0,
            'Muy buena' => 0,
        ];
        $redes = DB::table('encuestas')
            ->select('p3')
            ->where('fecha', '>=', $request->fecha)
            ->where('fecha', '<=', $request->fecha2)
            ->where('tipo', 'LIKE', "%" . $request->tipo . "%")
            ->get();
        foreach ($redes as $red) {
            $conteoCalificaciones[$red->p3]++;
        }

        $conteoSiNo = [
            'si' => 0,
            'no' => 0,
        ];
        $dudas = DB::table('encuestas')
        ->select('p4')
        ->where('fecha', '>=', $request->fecha)
        ->where('fecha', '<=', $request->fecha2)
        ->where('tipo', 'LIKE', "%" . $request->tipo . "%")
        ->get();
        foreach ($dudas as $duda) {
            $conteoSiNo[$duda->p4]++;
        }

        $conteoAtencion = [
            'Muy mala' => 0,
            'Mala' => 0,
            'Neutral' => 0,
            'Buena' => 0,
            'Muy buena' => 0,
        ];
        $atenciones = DB::table('encuestas')
            ->select('p2')
            ->where('fecha', '>=', $request->fecha)
            ->where('fecha', '<=', $request->fecha2)
            ->where('tipo', 'LIKE', "%" . $request->tipo . "%")
            ->get();
        foreach ($atenciones as $atencion) {
            $conteoAtencion[$atencion->p2]++;
        }

        return view('encuestas.vista_admin.index',['conteoCalificaciones' => $conteoCalificaciones, 'conteoSiNo' => $conteoSiNo, 'conteoAtencion' => $conteoAtencion], compact('reportes', 'conteoPorTipo', 'conteoPorTipoP4', 'siCounts', 'noCounts'));
    }

    public function index_faciales(){
        $cosme = User::where('id', '!=', 1)->get();

        return view('encuestas.faciales', compact('cosme'));
    }

    public function index_corporal(){
        $cosme = User::where('id', '!=', 1)->get();

        return view('encuestas.corporales', compact('cosme'));
    }

    public function index_experiencias(){
        $cosme = User::where('id', '!=', 1)->get();

        return view('encuestas.experiencias', compact('cosme'));
    }

    public function index_jacuzzi_experiencia(){
        $cosme = User::where('id', '!=', 1)->get();

        return view('encuestas.jacuzzi_experiencia', compact('cosme'));
    }

    public function index_jacuzzi(){
        $cosme = User::where('id', '!=', 1)->get();

        return view('encuestas.jacuzzi', compact('cosme'));
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
        $paquete->save();

        Alert::success('¡Apreciamos tu opinión y esperamos verte de nuevo pronto!');
        return redirect()->back();
    }
}
