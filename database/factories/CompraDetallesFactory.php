<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\Transaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompraDetalles>
 */
class CompraDetallesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'id_transaccion' => Transaccion::all()->random(),
            // 'id_transaccion' => Transaccion::where('tipo', '=', 'compra')->random(),
            'id_transaccion' => Transaccion::all($columns = ['id', 'tipo'])->where('tipo', '=', 'compra')->random(),
            'id_articulo' => Articulo::all()->random(),
            'cantidad' => fake()->randomNumber($nbDigits = 2, $strict = false),
            'precio_compra' => fake()->randomFloat($nbMaxDecimals  = 2, $min = 0, $max = 1000),
            'descuento' => fake()->randomFloat($nbMaxDecimals  = 2, $min = 0, $max = 10),
            'state' => 1,
        ];
    }
}
