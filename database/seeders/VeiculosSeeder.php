<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veiculo;

class VeiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Veiculo::create([
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'ano' => 2020
        ]);

        Veiculo::create([
            'marca' => 'Honda',
            'modelo' => 'Civic',
            'ano' => 2019
        ]);

        Veiculo::create([
            'marca' => 'Ford',
            'modelo' => 'Focus',
            'ano' => 2018
        ]);
    }
}
