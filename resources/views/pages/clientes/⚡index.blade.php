<?php

use App\Models\Cliente;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

use App\Livewire\TableComponent;

new #[Title('Clientes')] class extends TableComponent {
  public function mount()
  {
    $this->sortField = 'nome';
  }

  #[On('update-table')]
  #[Computed]
  public function records()
  {
    return Cliente::query()
      ->with(['veiculos'])
      ->when($this->search, function ($q) {
        $q->where(function ($q) {
          $q->where('nome', 'ilike', "%{$this->search}%")
            ->orWhere('sobrenome', 'ilike', "%{$this->search}%")
            ->orWhere('cpf', 'like', "%{$this->search}%")
            ->orWhereHas('veiculos', function ($q) {
              $q->where('marca', 'ilike', "%{$this->search}%")
                ->orWhere('modelo', 'ilike', "%{$this->search}%")
                ->orWhere('placa', 'ilike', "%{$this->search}%");
            });
        });
      })
      ->orderBy($this->sortField, $this->sortDirection)
      ->paginate($this->paginate);
  }

  public function deleteRecord($id)
  {
    Cliente::find($id)->delete();
  }
};
?>

<div>
  <livewire:pages::clientes.form />

  @if ($feedbackMessage)
  <x-feedback label="Cliente" />
  @endif

  <x-table>
    <x-slot:thead>
      <th><x-table.ordering field="nome">Nome completo</x-table.ordering></th>
      <th>CPF</th>
      <th>Telefone</th>
      <th>Veículos</th>
      <th></th>
      </x-slot>

      <x-slot:tbody>
        @forelse ($this->records as $record)
        <tr wire:key="{{ $record->id }}">
          <td>{{ $record->nome . ' ' . $record->sobrenome }}</td>
          <td>{{ $record->cpf }}</td>
          <td>{{ $record->telefone }}</td>
          <td>
            @if ($record->veiculos->isNotEmpty())
            @foreach ($record->veiculos as $veiculo)
            {{ $veiculo->marca }} {{ $veiculo->modelo }} - {{ $veiculo->placa }} @if (!$loop->last)
            <br>
            @endif
            @endforeach
            @endif
          </td>
          <td class="px-1.5 py-1.5">
            <div class="flex gap-1 justify-end">
              <button type="button" class="p-2 rounded-md hover:bg-gray-200"
                x-on:click="$wire.dispatch('set-form-clientes', { id: {{ $record->id }} }); showForm = true">
                <x-icon.edit_square class="fill-gray-500 w-4 h-4" />
              </button>

              <button type="button" class="p-2 rounded-md hover:bg-red-100"
                wire:click="deleteRecord({{ $record->id }})"
                wire:confirm="Tem certeza que deseja deletar o registro?">
                <x-icon.delete class="fill-red-500 w-4 h-4" />
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="10">
            Sem registros.
          </td>
        </tr>
        @endforelse
        </x-slot>

        <x-slot:pagination>
          {{ $this->records->links('components.pagination') }}
        </x-slot:pagination>
  </x-table>
</div>