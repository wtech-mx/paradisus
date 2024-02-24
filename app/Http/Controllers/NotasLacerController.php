<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.crear',compact('client', 'user'));
    }
}
