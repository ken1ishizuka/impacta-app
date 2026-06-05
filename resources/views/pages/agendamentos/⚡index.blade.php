<?php

use App\Models\Agendamento;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Livewire\TableComponent;

new #[Title('Agendamentos')] class extends TableComponent {
  public $filter = '';

  public function mount()
  {
    $this->sortField = 'agendado_em';
    $this->filter = now()->format('Y-m');
  }

  #[On('update-table')]
  #[Computed]
  public function records()
  {
    $query = Agendamento::query()
      ->with(['veiculo.cliente', 'servico'])
      ->when($this->search, function ($query) {
        $search = "%{$this->search}%";

        $query->where(function ($query) use ($search) {
          $query
            ->whereHas('veiculo.cliente', function ($query) use ($search) {
              $query->where('nome', 'ilike', $search)
                ->orWhere('sobrenome', 'ilike', $search);
            })
            ->orWhereHas('veiculo', function ($query) use ($search) {
              $query->where('marca', 'ilike', $search)
                ->orWhere('modelo', 'ilike', $search);
            })
            ->orWhereHas('servico', function ($query) use ($search) {
              $query->where('descricao', 'ilike', $search);
            });
        });
      })
      ->when($this->filter, function ($query) {
        $query->whereYear('agendado_em', substr($this->filter, 0, 4))
          ->whereMonth('agendado_em', substr($this->filter, 5, 2));
      });

    if ($this->sortField === 'cliente') {
      $query->join('clientes_veiculos', 'clientes_veiculos.id', '=', 'agendamentos.cliente_veiculo_id')
        ->join('clientes', 'clientes.id', '=', 'clientes_veiculos.cliente_id')
        ->select('agendamentos.*')
        ->orderBy('clientes.nome', $this->sortDirection)
        ->orderBy('clientes.sobrenome', $this->sortDirection);
    } else {
      $query->orderBy($this->sortField, $this->sortDirection);
    }

    return $query->paginate($this->paginate);
  }

  public function deleteRecord($id)
  {
    Agendamento::find($id)->delete();
  }
};
?>


<div>
  <livewire:pages::agendamentos.form />

  @if ($feedbackMessage)
  <x-feedback label="Agendamento" />
  @endif

  <x-table>
    <x-slot:filter>
      <input type="month" wire:model.live="filter">
    </x-slot:filter>

    <x-slot:thead>
      <th><x-table.ordering field="cliente">Cliente</x-table.ordering></th>
      <th>Veículo</th>
      <th>Serviço</th>
      <th><x-table.ordering field="agendado_em">Data</x-table.ordering></th>
      <th></th>
      </x-slot>

      <x-slot:tbody>
        @forelse ($this->records as $record)
        <tr wire:key="{{ $record->id }}">
          <td>{{ $record->veiculo->cliente->nome . ' ' . $record->veiculo->cliente->sobrenome }}</td>
          <td>{{ $record->veiculo->marca . ' ' . $record->veiculo->modelo }}</td>
          <td>{{ $record->servico->descricao }}</td>
          <td>{{ $record->agendado_em->format('d/m/Y H:i') }}</td>
          <td class="px-1.5 py-1.5">
            <div class="flex gap-1 justify-end">
              <button type="button" class="p-2 rounded-md hover:bg-gray-200"
                x-on:click="$wire.dispatch('set-form-servicos', { id: {{ $record->id }} }); showForm = true">
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