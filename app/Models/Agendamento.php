<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'cliente_veiculo_id',
        'servico_id',
        'agendado_em',
    ];

    protected $casts = [
        'agendado_em' => 'datetime'
    ];

    public function veiculo()
    {
        return $this->belongsTo(ClienteVeiculo::class, 'cliente_veiculo_id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
