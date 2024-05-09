<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing.landingpage');
    }

    public function index_laser()
    {
        return view('landing.laser');
    }

    public function index_contacto()
    {
        return view('landing.contacto');
    }

    public function tratamientos_corporales(){
        return view('landing.tratamientos_corporales');
    }

    public function tratamientos_faciales(){
        return view('landing.tratamientos_faciales');
    }

    public function paquetes(){
        return view('landing.paquetes');
    }
}
