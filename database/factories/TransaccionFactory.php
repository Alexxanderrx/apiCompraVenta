<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaccion>
 */
class TransaccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_cliente' => Cliente::all()->random(),
            'id_trabajador' => Trabajador::all()->random(),
            'fecha' => fake()->date(),
            'tipo_comprobante' => fake()->randomElement($array = array('Factura', 'Boleta de Venta', 'Ticket')),
            'serie' => fake()->randomNumber($nbDigits = 8, $strict = false),
            'igv' => fake()->randomFloat($nbMaxDecimals  = 2, $min = 0, $max = 1),
            'tipo' => fake()->randomElement($array = array('venta', 'compra')),
            'state' => 1,
        ];
    }
}
