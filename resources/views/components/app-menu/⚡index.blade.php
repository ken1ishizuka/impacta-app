<?php

use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
  #[Computed]
  public function routes()
  {
    return [
      ['href' => 'agendamentos', 'label' => 'Agendamentos', 'icon' => 'calendar_add_on'],
      ['href' => 'clientes', 'label' => 'Clientes', 'icon' => 'person'],
      ['href' => 'servicos', 'label' => 'Serviços', 'icon' => 'car_tag'],
      ['href' => 'usuarios', 'label' => 'Usuários', 'icon' => 'person']
    ];
  }

  public function logout()
  {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
  }
};
?>

<section x-data="{ fullMenu: window.innerWidth >= 1024 ? true : false, }" @resize.window="fullMenu = window.innerWidth >= 1024 ? true : false"
  :class="{
      'flex flex-col gap-10 h-full border-r border-gray-300 bg-gray-900 shadow-sm': true,
      'min-w-50 p-4': fullMenu,
      'w-fit px-2 py-4': !fullMenu
  }">
  <header
    :class="{
        'flex items-center h-6': true,
        'justify-between': fullMenu,
        'justify-center': !fullMenu
    }">
    <img src="{{ asset('img/Motorlux_logo.svg') }}" alt="Logo" :class="{ 'w-28': true, 'hidden': !fullMenu }">

    <button type="button" @click="fullMenu = !fullMenu">
      <template x-if="fullMenu">
        <x-icon.dock_to_right class="h-4 w-4 fill-white" />
      </template>
      <template x-if="!fullMenu">
        <x-icon.dock_to_left class="h-4 w-4 fill-white" />
      </template>
    </button>
  </header>

  <nav class="flex-1">
    <ul class="space-y-2">
      @foreach ($this->routes as $route)
      <li>
        <a href="{{ $route['href'] }}"
          :class="{
                'flex items-center gap-2 h-8 px-2.5 rounded-sm hover:bg-brand-primary': true,
                'justify-center': !fullMenu,
            }"
          wire:navigate wire:current="bg-white/20 border border-gray-400 pointer-events-none">
          <x-dynamic-component :component="'icon.' . $route['icon']" class="h-4 w-4 fill-white" />
          <span :class="{ 'text-white': true, 'hidden': !fullMenu }">
            {{ $route['label'] }}
          </span>
        </a>
      </li>
      @endforeach
    </ul>
  </nav>

  <footer>
    <button type="button"
      :class="{
          'flex items-center gap-2 h-8 px-2.5 rounded-sm hover:bg-white/20 w-full': true,
          'justify-center': !fullMenu,
      }"
      wire:click="logout" wire:confirm="Tem certeza que deseja deslogar?">
      <x-icon.logout class="fill-white h-4 w-4" />
      <span :class="{ 'text-white': true, 'hidden': !fullMenu }">Logout</span>
    </button>
  </footer>
</section>