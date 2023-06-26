<?php

namespace App\Http\Controllers;

use App\Models\CabinaInvetario;
use App\Models\Productos;
use Illuminate\Http\Request;

class CabinaInvetarioController extends Controller
{
    public function index1()
    {
        $cabinas = CabinaInvetario::get();
        $productos = Productos::orderBy('nombre','ASC')->get();

        return view('cabina_inventario.cabina1',compact('cabinas','productos'));
    }

    public function index2()
    {
        return view('cabina_inventario.cabina2');
    }

    public function index3()
    {
        return view('cabina_inventario.cabina3');
    }

    public function index4()
    {
        return view('cabina_inventario.cabina4');
    }

    public function index5()
    {
        return view('cabina_inventario.cabina5');
    }


}
