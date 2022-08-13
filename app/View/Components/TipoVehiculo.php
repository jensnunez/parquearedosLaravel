<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\TipoVehiculo as TVehiculo;


class TipoVehiculo extends Component
{
    public $name;

    public $options;

    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }


    public function render()
    {
        $TipoVehiculo =  TVehiculo::all();
        return view('components.tipo-vehiculo', compact('TipoVehiculo'));
    }
}
