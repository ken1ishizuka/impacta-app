<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'cliente_id',
        'cliente_veiculo_id',
        'servico_id',
        'data',
        'horario'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(ClienteVeiculo::class, 'cliente_veiculo_id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
