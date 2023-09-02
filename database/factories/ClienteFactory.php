<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'sexo' => fake()->randomElement($array = array('male', 'female')),
            'fecha_nacimiento' => fake()->date(),
            'tipo_documento' => fake()->randomElement($array = array('DNI', 'Pasaporte', 'Licencia de conducir')),
            'num_documento' => fake()->randomNumber($nbDigits = 9, $strict = false),
            'direccion' => fake()->address(),
            'telefono' => fake()->phoneNumber(),
            'state' => 1,
        ];
    }
}
