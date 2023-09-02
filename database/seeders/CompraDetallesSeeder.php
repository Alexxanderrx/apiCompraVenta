<?php

namespace Database\Seeders;

use App\Models\CompraDetalles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompraDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompraDetalles::factory(10)->create();
    }
}
