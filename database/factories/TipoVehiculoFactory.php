<?php

namespace Database\Factories;

use App\Models\TipoVehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoVehiculoFactory extends Factory
{
    protected $model = TipoVehiculo::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
        ];
    }
}
