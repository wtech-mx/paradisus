<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Servicios;
use App\Models\Alertas;
use App\Models\AlertasCosmes;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = Client::orderBy('name', 'asc')->get();
        $cosme = User::get();
        $alert = Alertas::get();
        $cosmes_alerts = AlertasCosmes::get();

        $servicios = Servicios::get();
        return view('dashboard', compact('client', 'servicios', 'cosme', 'alert', 'cosmes_alerts'));
    }
}
