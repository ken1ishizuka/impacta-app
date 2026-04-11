<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteVeiculo extends Model
{
    protected $table = 'clientes_veiculos';

    protected $fillable = [
        'cliente_id',
        'marca',
        'modelo',
        'placa',
        'cor',
        'observacoes'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
