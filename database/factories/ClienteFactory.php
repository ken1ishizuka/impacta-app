<?php

namespace Database\Factories;

use App\Models\ClienteVeiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake('pt_BR')->firstName(),
            'sobrenome' => fake('pt_BR')->lastName(),
            'cpf' => fake()->unique()->numerify('###########'),
            'telefone' => fake()->numerify('119########'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($cliente) {
            ClienteVeiculo::factory()
                ->count(rand(1, 2))
                ->create([
                    'cliente_id' => $cliente->id,
                ]);
        });
    }
}
