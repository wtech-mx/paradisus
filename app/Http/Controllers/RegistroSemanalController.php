<?php

namespace App\Http\Controllers;

use App\Models\NotasCosmes;
use App\Models\RegistroSemanal;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroSemanalController extends Controller
{
    public function index(){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $registros_puntualidad = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('puntualidad', '1')->get();
        $registros_cubriendose = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('cosmetologo_cubriendo', '!=', NULL)->get();
        $registros_sueldo = RegistroSemanal::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->get();


        return view('sueldo_cosmes.index', compact('registros_cubriendose','registros_puntualidad', 'registros_sueldo'));
    }

    public function store(Request $request){
        $fecha = date('Y-m-d');
        // Ejemplo de cómo guardar un registro semanal en un controlador

        $registroSemanal = new RegistroSemanal;
        $registroSemanal->cosmetologo_id = $request->get('cosmetologo_id');
        $registroSemanal->puntualidad = $request->get('puntualidad');
        $registroSemanal->cosmetologo_cubriendo = $request->get('cosmetologo_cubriendo');
        $registroSemanal->fecha = $fecha;
        $registroSemanal->save();

        return redirect()->route('pagos.index')
        ->with('edit','Lista Agregada con exito.');
    }
}
