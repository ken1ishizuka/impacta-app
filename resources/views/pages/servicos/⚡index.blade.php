<?php

use App\Models\Servico;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

use App\Livewire\TableComponent;

new #[Title('Serviços')] class extends TableComponent {
    public function mount()
    {
        $this->sortField = 'descricao';
    }

    #[On('update-table')]
    #[Computed]
    public function records()
    {
        return Servico::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('descricao', 'ilike', "%{$this->search}%");
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->paginate);
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
      <th><x-table.ordering field="descricao">Descrição</x-table.ordering></th>
      <th>Valor (R$)</th>
      <th></th>
    </x-slot>

    <x-slot:tbody>
      @forelse ($this->records as $record)
        <tr wire:key="{{ $record->id }}">
          <td>{{ $record->descricao }}</td>
          <td>{{ number_format($record->valor, 2, ',', '.') }}</td>

          <td class="px-1.5 py-1.5">
            <div class="flex gap-1 justify-end">
              <button type="button" class="p-2 rounded-md hover:bg-gray-200"
                x-on:click="$dispatch('set-form', { id: {{ $record->id }} }); showForm = true">
                <x-icon.edit_square class="fill-gray-500 w-4 h-4" />
              </button>

              <button type="button" class="p-2 rounded-md hover:bg-red-100"
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

  </x-table>
</div>
