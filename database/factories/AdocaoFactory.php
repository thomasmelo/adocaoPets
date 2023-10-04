<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adocao>
 */
class AdocaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_status' =>fake()->numberBetween(1, 5),
            'id_pet' => fake()->numberBetween(1, 150),
            'id_cliente' => fake()->numberBetween(1, 250),
            'dt_inicio' => fake()->dateTimeBetween('-10 week', now()),
            'descricao' => fake()->word(),
        ];
    }
}
