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
}
