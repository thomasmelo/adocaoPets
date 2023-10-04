<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteHistorico>
 */
class ClienteHistoricoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_cliente' => fake()->numberBetween(1, 250),
            'id_user' => fake()->numberBetween(1, 10),
            'historico' => fake()->word(),
        ];
    }
}
