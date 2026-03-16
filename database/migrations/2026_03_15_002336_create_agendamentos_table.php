<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_veiculo_id')
                ->constrained('clientes_veiculos')
                ->cascadeOnDelete();

            $table->foreignId('servico_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('data');
            $table->time('horario');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
