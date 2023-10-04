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
            'nome' => fake()->name(),
            'cpf' => fake()->cpf(false),
            'id_sexo' => fake()->numberBetween(1,3),
            'nascimento' => fake()->dateTimeBetween(),
            'ddd' => fake()->areaCode(),
            'celular' => fake()->cellphone(false),
            'email' => fake()->unique()->safeEmail(),
            'cep' => fake()->postcode(),
            'endereco' => fake()->streetName(),
            'numero' => fake()->buildingNumber(),
            'bairro' => fake()->citySuffix(),
            'cidade' => fake()->city(),
            'uf' => fake()->regionAbbr(),
        ];
    }
}
