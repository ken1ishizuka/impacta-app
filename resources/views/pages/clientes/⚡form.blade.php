<?php

use App\Livewire\FormComponent;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

new class extends FormComponent {
    public ?Cliente $cliente = null;

    public string $nome;
    public string $sobrenome;
    public ?string $cpf = null;
    public string $telefone;

    public ?array $veiculos = [];
    public string $marca;
    public string $modelo;
    public string $placa;
    public string $cor;
    public string $observacoes;

    public function mount()
    {
        $this->veiculos = [['id' => null, 'marca' => '', 'modelo' => '', 'cor' => '', 'placa' => '', 'observacoes' => '']];
    }

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

        $this->veiculos = $this->cliente->veiculos
            ->map(function ($veiculo) {
                return [
                    'id' => $veiculo->id,
                    'marca' => $veiculo->marca,
                    'modelo' => $veiculo->modelo,
                    'placa' => $veiculo->placa,
                    'cor' => $veiculo->cor,
                    'observacoes' => $veiculo->observacoes,
                ];
            })
            ->toArray();
    }

    public function rules()
    {
        $rules = [
            'nome' => 'required',
            'sobrenome' => 'required',

            'cpf' => ['nullable', 'min:14', 'max:14', Rule::unique('clientes')->ignore($this->cliente?->id)],

            'telefone' => 'required|min:14|max:16',

            'veiculos.*.marca' => 'required',
            'veiculos.*.modelo' => 'required',
            'veiculos.*.cor' => 'required',
        ];

        foreach ($this->veiculos as $index => $veiculo) {
            $rules["veiculos.$index.placa"] = [
                'required',
                'min:7',
                'max:8',
                Rule::unique('clientes_veiculos', 'placa')
                    ->where(fn($q) => $q->where('cliente_id', $this->cliente?->id))
                    ->ignore($veiculo['id'] ?? null),
            ];
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'nome.required' => 'Campo obrigatório.',
            'sobrenome.required' => 'Campo obrigatório.',
            'cpf.unique' => 'CPF já cadastrado.',
            'telefone.required' => 'Campo obrigatório.',

            'cpf.min' => 'Formato inválido.',
            'cpf.max' => 'Formato inválido.',

            'telefone.min' => 'Formato inválido.',
            'telefone.max' => 'Formato inválido.',

            'veiculos.*.marca.required' => 'Campo obrigatório.',
            'veiculos.*.modelo.required' => 'Campo obrigatório.',

            'veiculos.*.placa.required' => 'Campo obrigatório.',
            'veiculos.*.placa.min' => 'Formato inválido.',
            'veiculos.*.placa.max' => 'Formato inválido.',
            'veiculos.*.placa.unique' => 'Veículo já cadastrado.',

            'veiculos.*.cor.required' => 'Campo obrigatório.',
        ];
    }

    public function updateOrCreate()
    {
        $cliente = Cliente::updateOrCreate(['id' => $this->cliente?->id], $this->only(['nome', 'sobrenome', 'cpf', 'telefone']));

        $placasMantidas = [];

        foreach ($this->veiculos as $veiculo) {
            $model = $cliente->veiculos()->updateOrCreate(
                [
                    'placa' => $veiculo['placa'],
                ],
                [
                    'marca' => $veiculo['marca'],
                    'modelo' => $veiculo['modelo'],
                    'cor' => $veiculo['cor'],
                    'observacoes' => $veiculo['observacoes'] ?? null,
                ],
            );

            $placasMantidas[] = $model->placa;
        }

        $cliente->veiculos()->whereNotIn('placa', $placasMantidas)->delete();

        session()->flash('feedback', 'Cliente salvo com sucesso!');
    }

    public function addVeiculo()
    {
        $this->veiculos[] = ['nome' => '', 'placa' => ''];
    }

    public function removeVeiculo($index)
    {
        unset($this->veiculos[$index]);
        $this->veiculos = array_values($this->veiculos);
    }
};
?>

<div>
  <x-form>
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

    <div class="flex flex-col gap-2">
      @foreach ($veiculos as $index => $veiculo)
        <div class="flex flex-col gap-4 border border-gray-300 rounded-lg p-4 bg-gray-100"
          wire:key="veiculo-row-{{ $index }}-{{ count($veiculos) }}">

          <div class="flex flex-col md:flex-row gap-2">
            <x-label label="Marca {{ count($veiculos) > 1 ? $index + 1 : '' }}"
              name="veiculos.{{ $index }}.marca" class="w-full md:w-1/2">
              <input type="text" placeholder="Hyundai" wire:model.live="veiculos.{{ $index }}.marca"
                class="w-full">
            </x-label>

            <x-label label="Modelo {{ count($veiculos) > 1 ? $index + 1 : '' }}"
              name="veiculos.{{ $index }}.modelo" class="w-full md:w-1/2">
              <input type="text" placeholder="Creta" wire:model.live="veiculos.{{ $index }}.modelo"
                class="w-full">
            </x-label>
          </div>

          <div class="flex gap-2">
            <x-label label="Placa" name="veiculos.{{ $index }}.placa" class="w-1/2">
              <input type="text" placeholder="GBF-3166" maxlength="8"
                wire:model.live="veiculos.{{ $index }}.placa" class="w-full"
                oninput="this.value = this.value.toUpperCase();">
            </x-label>

            <x-label label="Cor" name="veiculos.{{ $index }}.cor" class="w-1/2">
              <input type="text" list="cores" placeholder="Preto"
                wire:model.live="veiculos.{{ $index }}.cor" class="w-full">

              <datalist id="cores">
                <option value="Amarelo">
                <option value="Azul">
                <option value="Bege">
                <option value="Branco">
                <option value="Cinza">
                <option value="Dourado">
                <option value="Laranja">
                <option value="Marrom">
                <option value="Preto">
                <option value="Prata">
                <option value="Verde">
                <option value="Vermelho">
              </datalist>
            </x-label>
          </div>

          <x-label label="Observações" name="veiculos.{{ $index }}.observacoes" class="w-full">
            <textarea placeholder="Riscos na traseira" wire:model.live="veiculos.{{ $index }}.observacoes" class="w-full"></textarea>
          </x-label>

          <div>
            @if (count($veiculos) > 1)
              <button type="button" wire:click="removeVeiculo({{ $index }})"
                class="flex gap-1.5 items-center -mt-2">
                <x-icon.delete class="w-4.5 h-4.5 fill-red-500" />
                <span class="text-red-500 font-medium text-xs mt-1">Excluir</span>
              </button>
            @endif
          </div>
        </div>
      @endforeach

      <button type="button" wire:click="addVeiculo" class="text-blue-600 font-medium">
        + Adicionar mais
      </button>
    </div>

    @if ($errors->any())
      <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg">
        <ul class="space-y-1">
          @foreach ($errors->getMessages() as $field => $messages)
            @foreach ($messages as $message)
              <li>
                <strong>{{ $field }}:</strong> {{ $message }}
              </li>
            @endforeach
          @endforeach
        </ul>
      </div>
    @endif
  </x-form>
</div>
