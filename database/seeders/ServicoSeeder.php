<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    public function run(): void
    {
        $servicos = [
            ['descricao' => 'Martelinho de ouro - pequeno amassado', 'valor' => 150.00],
            ['descricao' => 'Martelinho de ouro - médio amassado', 'valor' => 300.00],
            ['descricao' => 'Martelinho de ouro - grande amassado', 'valor' => 500.00],

            ['descricao' => 'Reparo de para-choque dianteiro', 'valor' => 450.00],
            ['descricao' => 'Reparo de para-choque traseiro', 'valor' => 450.00],

            ['descricao' => 'Pintura de para-lama', 'valor' => 350.00],
            ['descricao' => 'Pintura de porta', 'valor' => 400.00],
            ['descricao' => 'Pintura de capô', 'valor' => 700.00],
            ['descricao' => 'Pintura de teto', 'valor' => 800.00],
            ['descricao' => 'Pintura de tampa traseira', 'valor' => 450.00],

            ['descricao' => 'Funilaria em porta', 'valor' => 600.00],
            ['descricao' => 'Funilaria em para-lama', 'valor' => 550.00],
            ['descricao' => 'Funilaria em capô', 'valor' => 850.00],
            ['descricao' => 'Funilaria em lateral completa', 'valor' => 1500.00],

            ['descricao' => 'Polimento técnico', 'valor' => 300.00],
            ['descricao' => 'Cristalização de pintura', 'valor' => 450.00],
            ['descricao' => 'Espelhamento de pintura', 'valor' => 600.00],

            ['descricao' => 'Retoque de pintura', 'valor' => 200.00],
            ['descricao' => 'Recuperação de risco profundo', 'valor' => 250.00],

            ['descricao' => 'Pintura completa do veículo', 'valor' => 4500.00],
        ];

        foreach ($servicos as $servico) {
            Servico::create($servico);
        }
    }
}
