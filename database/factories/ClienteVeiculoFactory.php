<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteVeiculoFactory extends Factory
{
    public function definition(): array
    {
        $veiculos = [
            ['marca' => 'Honda', 'modelo' => 'Civic'],
            ['marca' => 'Toyota', 'modelo' => 'Corolla'],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf'],
            ['marca' => 'Chevrolet', 'modelo' => 'Onix'],
            ['marca' => 'Fiat', 'modelo' => 'Pulse'],
            ['marca' => 'Hyundai', 'modelo' => 'HB20'],
            ['marca' => 'Jeep', 'modelo' => 'Renegade'],
            ['marca' => 'Nissan', 'modelo' => 'Kicks'],
        ];

        $veiculo = fake()->randomElement($veiculos);

        return [
            'marca' => $veiculo['marca'],
            'modelo' => $veiculo['modelo'],
            'placa' => strtoupper(fake()->bothify('???#?##')),
        ];
    }
}
