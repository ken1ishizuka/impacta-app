<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'sobrenome',
        'cpf',
        'telefone',
    ];

    protected function telefone(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                $numero = preg_replace('/\D/', '', $value);

                if (strlen($numero) === 11) {
                    return preg_replace(
                        '/(\d{2})(\d{5})(\d{4})/',
                        '($1) $2-$3',
                        $numero
                    );
                }

                if (strlen($numero) === 10) {
                    return preg_replace(
                        '/(\d{2})(\d{4})(\d{4})/',
                        '($1) $2-$3',
                        $numero
                    );
                }

                return $value;
            },

            set: fn($value) => preg_replace('/\D/', '', $value)
        );
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                $numero = preg_replace('/\D/', '', $value);

                if (strlen($numero) === 11) {
                    return preg_replace(
                        '/(\d{3})(\d{3})(\d{3})(\d{2})/',
                        '$1.$2.$3-$4',
                        $numero
                    );
                }

                return $value;
            },

            set: fn($value) => preg_replace('/\D/', '', $value)
        );
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function veiculos()
    {
        return $this->hasMany(ClienteVeiculo::class);
    }
}
