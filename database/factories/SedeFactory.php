<?php

namespace Database\Factories;

use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SedeFactory extends Factory
{
    protected $model = Sede::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'direccion' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
