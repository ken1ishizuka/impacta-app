<?php

use Livewire\Component;

new class extends Component {
    public $title = 'Título da página';
};
?>

<header class="flex items-center justify-between px-6 py-3 border-b border-gray-200 shadow-md">
  <h1>{{ $title }}</h1>

  <x-button wire:click="$dispatch('open-form')">Novo</x-button>
</header>
