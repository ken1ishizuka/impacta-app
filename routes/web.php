<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/agendamentos');

Route::livewire('/login', 'pages::login')->name('login');

Route::livewire('/clientes', 'pages::clientes')
  ->name('clientes')
  ->middleware('auth');

Route::livewire('/servicos', 'pages::servicos')
  ->name('servicos')
  ->middleware('auth');

Route::livewire('/agendamentos', 'pages::agendamentos')
  ->name('agendamentos')
  ->middleware('auth');

Route::livewire('/usuarios', 'pages::usuarios')
  ->name('usuarios')
  ->middleware('auth');

Route::post('/logout', function () {
  auth()->logout();

  return redirect()->route('login');
})->name('logout');
