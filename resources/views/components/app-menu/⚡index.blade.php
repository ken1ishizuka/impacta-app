<?php

use Jenssegers\Agent\Agent;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public bool $fullMenu = false;

    public function mount(Agent $agent)
    {
        if ($agent->isMobile()) {
            $this->fullMenu = false;
        }

        if ($agent->isTablet()) {
            $this->fullMenu = true;
        }

        if ($agent->isDesktop()) {
            $this->fullMenu = true;
        }
    }

    #[Computed]
    public function routes()
    {
        return [['href' => 'agendamentos', 'label' => 'Agendamentos', 'icon' => 'calendar_add_on'], ['href' => 'clientes', 'label' => 'Clientes', 'icon' => 'person'], ['href' => 'veiculos', 'label' => 'Veículos', 'icon' => 'directions_car'], ['href' => 'servicos', 'label' => 'Serviços', 'icon' => 'car_tag']];
    }
};
?>

@persist('navigation')
  <section @class([
      'flex flex-col gap-10 h-full border-r border-gray-300 bg-gray-900 shadow-sm',
      'min-w-50 fixed md:static p-4' => $fullMenu,
      'w-fit px-2 py-4' => !$fullMenu,
  ])>
    <header @class([
        'flex items-center h-6',
        'justify-between' => $fullMenu,
        'justify-center' => !$fullMenu,
    ])>
      <img src="{{ asset('img/Motorlux_logo.svg') }}" alt="Logo" @class(['w-28', 'hidden' => !$fullMenu])>

      <button type="button" wire:click="$toggle('fullMenu')">
        <x-dynamic-component :component="'icon.' . ($fullMenu ? 'dock_to_right' : 'dock_to_left')" class="h-4 w-4 fill-white" />
      </button>
    </header>

    <nav class="flex-1">
      <ul class="space-y-2">
        @foreach ($this->routes as $route)
          <li>
            <a href="{{ $route['href'] }}" @class([
                'flex items-center gap-2 h-8 px-2.5 rounded-sm hover:bg-brand-primary',
                'justify-center' => !$fullMenu,
            ]) wire:navigate
              wire:current.exact="bg-white/20 border border-gray-400 pointer-events-none">
              <x-dynamic-component :component="'icon.' . $route['icon']" class="h-4 w-4 fill-white" />
              <span @class(['text-white', 'hidden' => !$fullMenu])>{{ $route['label'] }}</span>
            </a>
          </li>
        @endforeach
      </ul>
    </nav>

    <footer>
      <button type="button" @class([
          'flex items-center gap-2 h-8 px-2.5 rounded-sm hover:bg-white/20 w-full',
          'justify-center' => !$fullMenu,
      ])>
        <x-icon.logout class="fill-white h-4 w-4" />
        <span @class(['text-white', 'hidden' => !$fullMenu])>Logout</span>
      </button>
    </footer>
  </section>
@endpersist
