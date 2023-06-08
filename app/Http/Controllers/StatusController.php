<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Alertas;
use Session;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $estatus = new Status();
        $estatus -> estatus = $request->get('estatus');
        $estatus -> color = $request->get('color');
        $estatus->save();

        Session::flash('create', 'Se ha creado sus datos con exito');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */

    public function update_estatus(Request $request,$id)
    {
        $estatus = Status::find($id);
        $estatus -> estatus = $request->get('estatus');
        $estatus -> color = $request->get('color');
        $estatus->update();

        $alerta = Alertas::where('id_status',$id)->where('color', '!=', $estatus -> color)->get()->count();
        for($i=1; $i<=$alerta; $i++){
            $alert = Alertas::where('id_status', $id)
                             ->where('color', '!=', $estatus -> color)
                             ->first();
            $alert->color =$request->get('color');
            $alert->update();
        }

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->back();
    }


}
