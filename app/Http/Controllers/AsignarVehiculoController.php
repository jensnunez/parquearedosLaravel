<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsignarVehiculoController extends Controller
{
    public function index($placa){

        return view('asignar.index', compact('placa'));
    }
}
