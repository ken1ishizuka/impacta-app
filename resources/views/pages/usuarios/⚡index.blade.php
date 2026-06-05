<?php

use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

use App\Livewire\TableComponent;
use App\Models\User;

new #[Title('Usuários')] class extends TableComponent {
    public function mount()
    {
        $this->sortField = 'name';
    }

    #[On('update-table')]
    #[Computed]
    public function records()
    {
        return User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'ilike', "%{$this->search}%");
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->paginate);
    }

    public function deleteRecord($id)
    {
        User::find($id)->delete();
    }
};
?>

<div>
  <livewire:pages::usuarios.form />

  @if ($feedbackMessage)
    <x-feedback label="User" />
  @endif

  <x-table>
    <x-slot:thead>
      <th><x-table.ordering field="name">Nome</x-table.ordering></th>
      <th>E-mail</th>
      <th></th>
    </x-slot>

    <x-slot:tbody>
      @forelse ($this->records as $record)
        <tr wire:key="{{ $record->id }}">
          <td>{{ $record->name }}</td>
          <td>{{ $record->email }}</td>

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
