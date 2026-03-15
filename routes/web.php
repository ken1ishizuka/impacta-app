<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/clientes', 'pages::clientes')->name('clientes');
Route::livewire('/veiculos', 'pages::veiculos')->name('veiculos');

Route::livewire('/servicos', 'pages::servicos')->name('servicos');
Route::livewire('/agendamentos', 'pages::agendamentos')->name('agendamentos');
