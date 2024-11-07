<?php

namespace App\Http\Controllers;

use App\Models\LaserKit;
use App\Models\LaserKitZonas;
use Illuminate\Http\Request;

class LaserKitController extends Controller
{
    public function index(){
        $lasers_kits = LaserKit::orderBy('id', 'DESC')->get();

        return view('laser_kit.index', compact('lasers_kits'));
    }

    public function create(Request $request) {

        $lasers_kits = LaserKit::orderBy('id','ASC')->get();
        $lasers_kits_zonas = LaserKitZonas::orderBy('id','ASC')->get();

        return view('laser_kit.create',compact('lasers_kits', 'lasers_kits_zonas'));
    }
}
