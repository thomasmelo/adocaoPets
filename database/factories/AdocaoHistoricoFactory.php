<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdocaoHistorico>
 */
class AdocaoHistoricoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_adocao' => fake()->numberBetween(1, 50),
            'id_user' => fake()->numberBetween(1, 10),
            'historico' => fake()->sentences(),
        ];
    }
}
