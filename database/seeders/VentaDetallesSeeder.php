<?php

namespace Database\Seeders;

use App\Models\VentaDetalles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentaDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VentaDetalles::factory(10)->create();
    }
}
