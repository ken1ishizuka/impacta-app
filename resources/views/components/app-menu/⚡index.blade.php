<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<section class="bg-amber-950 h-full w-fit p-4">
  <header class="flex items-center justify-between">
    <span>Logo</span>
    <button type="button">collapse</button>
  </header>

  <nav>
    <ul>
      <li>
        <x-app-menu.link href="{{ route('agendamentos') }}">Agendamentos</x-app-menu.link>
      </li>

      <li>
        <x-app-menu.link href="{{ route('clientes') }}">Clientes</x-app-menu.link>
      </li>

      <li>
        <x-app-menu.link href="{{ route('veiculos') }}">Veículos</x-app-menu.link>
        <a href="{{ route('veiculos') }}">Veículos</a>
      </li>


    </ul>
  </nav>
</section>
