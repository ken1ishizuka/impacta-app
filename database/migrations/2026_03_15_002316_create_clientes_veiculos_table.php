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
        Schema::create('clientes_veiculos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('veiculo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('cor')->nullable();
            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_veiculos');
    }
};
