<?php

use App\Models\Cliente;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

use Livewire\Component;

new #[Title('Clientes')] class extends Component {};
?>

<div>
  {{-- @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded">
      {{ session('success') }}
    </div>
  @endif --}}
  <livewire:pages::clientes.form />
  <livewire:pages::clientes.table />
</div>
