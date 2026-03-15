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

    #[On('open-form')]
    public function openForm()
    {
        $this->showForm = true;
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

    public function create()
    {
        Cliente::create($this->only(['nome', 'cpf', 'telefone']));
    }
};
?>

<x-form :$showForm>
  <x-label.input label="Nome" name="nome" placeholder="João" />
  <x-label.input label="Sobrenome" name="sobrenome" placeholder="Silva" />
  <x-label.input label="CPF" name="cpf" placeholder="123.324.324-41" />
  <x-label.input label="Telefone" name="telefone" placeholder="(11) 92423-3434" />
</x-form>
