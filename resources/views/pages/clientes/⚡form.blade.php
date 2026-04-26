<?php

use App\Livewire\FormComponent;
use App\Models\Servico;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

new class extends FormComponent {
    public ?Servico $servico = null;

    public string $descricao;
    public string $valor;

    public function mount()
    {
        //
    }

    #[On('set-form')]
    public function setForm($id)
    {
        $this->servico = Servico::findOrFail($id);

        $this->fill([
            'descricao' => $this->servico->descricao,
            'valor' => number_format($this->servico->valor, 2, ',', '.'),
        ]);
    }

    public function rules()
    {
        return [
            'descricao' => 'required',
            'valor' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'descricao.required' => 'Campo obrigatório.',
            'valor.required' => 'Campo obrigatório.',
        ];
    }

    public function updateOrCreate()
    {
        $cliente = Servico::updateOrCreate(['id' => $this->servico?->id], $this->only(['descricao', 'valor']));

        session()->flash('feedback', 'Serviço salvo com sucesso!');
    }
};
?>

<div>
  <x-form>
    <x-label label="Descrição" name="descricao">
      <input type="text" placeholder="Martelinho de ouro" wire:model="descricao">
    </x-label>

    <x-label label="Valor (R$)" name="valor">
      <input type="text" placeholder="350,00" wire:model="valor"
        x-mask:dynamic="
      $input.replace(/\D/g, '')
            .replace(/(\d)(\d{2})$/, '$1,$2')
            .replace(/(?=(\d{3})+(\D))\B/g, '.')
  ">
    </x-label>
  </x-form>
</div>
