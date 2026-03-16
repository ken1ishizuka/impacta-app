<?php

use App\Livewire\FormComponent;
use App\Models\Cliente;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

new class extends FormComponent {
    public ?Cliente $cliente = null;

    public string $nome;
    public string $sobrenome;
    public ?string $cpf = null;
    public string $telefone;

    #[On('set-form')]
    public function setForm($id)
    {
        $this->cliente = Cliente::findOrFail($id);

        $this->fill([
            'nome' => $this->cliente->nome,
            'sobrenome' => $this->cliente->sobrenome,
            'cpf' => $this->cliente->cpf,
            'telefone' => $this->cliente->telefone,
        ]);
    }

    protected function rules()
    {
        return [
            'nome' => 'required',
            'sobrenome' => 'required',
            'cpf' => ['nullable', Rule::unique('clientes')->ignore($this->cliente)],
            'telefone' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'nome.required' => 'Campo obrigatório.',
            'sobrenome.required' => 'Campo obrigatório.',
            'cpf.unique' => 'CPF já cadastrado.',
            'telefone.required' => 'Campo obrigatório.',
        ];
    }

    public function updateOrCreate()
    {
        Cliente::updateOrCreate(['id' => $this->cliente?->id], $this->only(['nome', 'sobrenome', 'cpf', 'telefone']));

        session()->flash('feedback', 'Cliente salvo com sucesso!');
    }
};
?>

<div>
    <x-form :$showForm>
        <x-label label="Nome" name="nome">
            <input type="text" placeholder="João" wire:model="nome">
        </x-label>

        <x-label label="Sobrenome" name="sobrenome">
            <input type="text" placeholder="Pereira" wire:model="sobrenome">
        </x-label>

        <x-label label="CPF" name="cpf">
            <input type="text" placeholder="123.324.324-41" wire:model="cpf" x-mask="999.999.999-99">
        </x-label>

        <x-label label="Telefone" name="telefone">
            <input type="text" placeholder="(11) 92423-3434" wire:model="telefone"
                x-mask:dynamic="
      $input.replace(/\D/g, '').length > 10
          ? '(99) 99999-9999'
          : '(99) 9999-9999'
  ">
        </x-label>
    </x-form>
</div>