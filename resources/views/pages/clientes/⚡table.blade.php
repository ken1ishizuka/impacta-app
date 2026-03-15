<?php

use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Livewire\TableComponent;
use App\Models\Cliente;

new class extends TableComponent {
    public array $thColumns = [
        ['label' => 'Nome', 'sortable' => 'nome'],
        ['label' => 'Sobrenome', 'sortable' => 'sobrenome'],
        ['label' => 'CPF', 'sortable' => false],
        ['label' => 'Telefone', 'sortable' => false]
    ];
    public array $tdColumns = [
        ['name' => 'nome'],
        ['name' => 'sobrenome'],
        ['name' => 'cpf'],
        ['name' => 'telefone']
    ];

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
                    $q->orWhere('nome', 'ilike', "%{$this->search}%")
                        ->orWhere('sobrenome', 'ilike', "%{$this->search}%");
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->paginate);
    }
};
?>

<x-table :$thColumns :$tdColumns :records="$this->records" />

{{-- @dd($this->records) --}}
{{-- <x-slot:th>
        <tr>
            <th>
                <x-table.ordering field="nome">Nome</x-table.ordering>
            </th>
            <th>CPF</th>
            <th>Telefone</th>
        </tr>
    </x-slot:th> --}}

{{-- <x-slot:td>
    @foreach ($this->records as $records)
      <tr wire:key="{{ $records->id }}">
<td>{{ $records->nome }}</td>
<td>{{ $records->cpf }}</td>
<td>{{ $records->telefone }}</td>
</tr>
@endforeach
</x-slot:td> --}}
{{-- </x-table> --}}