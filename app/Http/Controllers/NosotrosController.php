<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NosotrosController extends Controller
{
    public function __construct(){
    }

    public function index()
    {
        return view('acercanosotros.nosotros');
    }
}
