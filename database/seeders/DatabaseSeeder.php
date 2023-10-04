<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Raca::factory(50)->create();
        \App\Models\Pet::factory(150)->create();
        \App\Models\PetHistorico::factory(1050)->create();
        \App\Models\Cliente::factory(250)->create();
        \App\Models\ClienteHistorico::factory(1550)->create();
        \App\Models\Adocao::factory(50)->create();
        \App\Models\AdocaoHistorico::factory(550)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
