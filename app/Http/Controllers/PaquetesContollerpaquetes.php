<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;
use App\Models\Paquetes;
use Session;

class PaquetesContollerpaquetes extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquetes = Paquetes::orderBy('id','DESC')->get();

        return view('paquetes_servicios.index', compact('paquetes'));
    }

    public function create_uno()
    {
        $client = Client::orderBy('name','ASC')->get();
        $user = User::get();

        return view('paquetes_servicios.paqute_1',compact('client', 'user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notas $nota
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){

    }

}