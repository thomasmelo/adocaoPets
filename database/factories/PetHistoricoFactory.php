<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetHistorico>
 */
class PetHistoricoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pet' => fake()->numberBetween(1, 150),
            'id_user' => fake()->numberBetween(1, 10),
            'historico' => fake()->sentences(),
        ];
    }
}
