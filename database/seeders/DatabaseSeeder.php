<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(ClienteSeeder::class);
        $this->call(TrabajadorSeeder::class);
        $this->call(TransaccionSeeder::class);
        $this->call(ArticuloSeeder::class);
        $this->call(VentaDetallesSeeder::class);
        $this->call(CompraDetallesSeeder::class);
    }
}
