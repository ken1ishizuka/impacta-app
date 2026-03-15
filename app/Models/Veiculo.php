<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'marca',
        'modelo',
        'ano'
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'clientes_veiculos')
            ->withPivot(['cor', 'observacoes'])
            ->withTimestamps();
    }
}
