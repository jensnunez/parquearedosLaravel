<?php

namespace Database\Factories;

use App\Models\TipoReporte;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoReporteFactory extends Factory
{
    protected $model = TipoReporte::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
        ];
    }
}
