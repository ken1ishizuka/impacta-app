<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nome' => 'João',
            'sobrenome' => 'Silva',
            'cpf' => '12345678901',
            'telefone' => '11999999999',
        ]);

        Cliente::create([
            'nome' => 'Maria',
            'sobrenome' => 'Oliveira',
            'cpf' => '98765432100',
            'telefone' => '11988888888',
        ]);

        Cliente::create([
            'nome' => 'Carlos',
            'sobrenome' => 'Souza',
            'cpf' => '11122233344',
            'telefone' => '11977777777',
        ]);
    }
}
