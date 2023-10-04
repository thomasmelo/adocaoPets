<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->word(),
            'id_raca' => fake()->numberBetween(1, 100),
            'id_sexo' => fake()->numberBetween(1, 3),
            'nascimento' => fake()->dateTimeBetween(),
            'descricao' => fake()->sentences(),
        ];
    }
}
