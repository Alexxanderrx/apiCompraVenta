<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => fake()->randomNumber($nbDigits = 9, $strict = false),
            'nombre' => fake()->randomElement($array = array('papel', 'bolígrafos', 'carpetas', 'grapadora', 'tijeras', 'calculadora', 'archivadores', 'notas adhesivas', 'marcadores', 'corrector', 'pizarra blanca', 'pilas', 'clip', 'cinta adhesiva', 'regla', 'calendario', 'agenda', 'sellos', 'gomas de borrar', 'lápices')),

            'descripcion' => fake()->paragraph($nbSentences = 4, $variableNbSentences = true),
            'stock_inicial' => fake()->randomNumber($nbDigits = 4, $strict = false),
            'stock_actual' => fake()->randomNumber($nbDigits = 2, $strict = false),
            'fecha_produccion' => fake()->date(),
            'fecha_vencimiento' => fake()->date(),
            'state' => 1,
        ];
    }
}
