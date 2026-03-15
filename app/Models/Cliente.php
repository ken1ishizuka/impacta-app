<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'sobrenome',
        'cpf',
        'telefone',
    ];

    public function veiculos()
    {
        return $this->hasMany(ClienteVeiculo::class);
    }
}
