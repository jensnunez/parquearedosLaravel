<?php

namespace Database\Factories;

use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehiculoFactory extends Factory
{
    protected $model = Vehiculo::class;

    public function definition()
    {
        return [
			'placa' => $this->faker->name,
			'tipo_vehiculo_id' => $this->faker->name,
			'observacion' => $this->faker->name,
        ];
    }
}
