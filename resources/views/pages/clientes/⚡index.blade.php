<?php

use App\Models\Cliente;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

use Livewire\Component;

new #[Title('Clientes')] class extends Component {};
?>

<div>
  <livewire:pages::clientes.form />
  <livewire:pages::clientes.table />
</div>
