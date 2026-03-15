<?php

use Livewire\Component;

new class extends Component {
    public $title = 'Título da página';
};
?>

<header class="flex items-center justify-between px-6 py-3">
  <h1>{{ $title }}</h1>
  <button type="button" wire:click="$dispatch('open-form')">Novo</button>
</header>
