<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Colores;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Arr;
class ColoresController extends Controller
{
    public function create(Request $request)
    {
        $color = new Colores;
        $color -> servicio = $request->get('servicio');
        $color -> color = $request->get('color');

        $image  = $request->file('imagen');
        $imageName = time().'.'.$image->getClientOriginalName();

        $image->move(public_path('/img/iconos_serv'),$imageName);

        $color->imagen = $imageName;
        $color->save();

        Session::flash('create', 'Se ha creado sus datos con exito');
        return redirect()->back();
    }

    public function update_colores(Request $request,$id)
    {

        $color = Colores::find($id);
        $color -> servicio = $request->get('servicio');
        $color -> color = $request->get('color');

        $image  = $request->file('imagen');
        $imageName = time().'.'.$image->getClientOriginalName();

        $image->move(public_path('/img/iconos_serv'),$imageName);
        $color->imagen = $imageName;
        $color->update();


        // $alerta = Alertas::where('id_color',$id)->get()->count();
        // for($i=1; $i<=$alerta; $i++){
        //     $alert = Alertas::where('id_color', $id)
        //                      ->where('image', '!=', asset('img/iconos_serv/'.$color -> imagen))
        //                      ->first();
        //     $alert->image = asset('img/iconos_serv/'.$imageName);
        //     $alert->update();
        // }

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->back();
    }
}
