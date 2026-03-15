<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servico;

class ServicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servico::create([
            'descricao' => 'Troca de óleo',
            'valor' => 120
        ]);

        Servico::create([
            'descricao' => 'Alinhamento',
            'valor' => 80
        ]);

        Servico::create([
            'descricao' => 'Balanceamento',
            'valor' => 60
        ]);
    }
}
