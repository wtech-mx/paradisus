<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Laser;
use App\Models\NotasLacer;
use App\Models\User;
use Illuminate\Http\Request;

class NotasLacerController extends Controller
{
    public function index(){
        $nota_lacer = NotasLacer::orderBy('id','DESC')->get();

        return view('notas_lacer.index', compact('nota_lacer'));
    }

    public function crear(){
        $zonas = Laser::get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.crear',compact('client', 'user', 'zonas'));
    }

    public function index_sesiones(){


        return view('notas_lacer.index_laser');

    }


    public function index_consentimiento(){


        return view('notas_lacer.index_consentimiento');

    }
}
