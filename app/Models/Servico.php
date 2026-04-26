<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = [
        'descricao',
        'valor'
    ];

    public function setValorAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['valor'] = null;
            return;
        }

        if (is_string($value)) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }

        $this->attributes['valor'] = $value;
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
