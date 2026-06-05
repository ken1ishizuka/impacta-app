<?php

use App\Livewire\FormComponent;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\ClienteVeiculo;
use App\Models\Servico;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

new class extends FormComponent {
  public ?Agendamento $agendamento = null;

  public $cliente_id = null;
  public $cliente_veiculo_id = null;
  public $servico_id = null;
  public $agendado_em;

  public function mount()
  {
    $this->agendado_em = now()
      ->setHour(8)
      ->setMinutes(0)
      ->setSeconds(0)
      ->format('Y-m-d\TH:i');
  }

  #[On('set-form-servicos')]
  public function setForm($id)
  {
    $this->agendamento = Agendamento::findOrFail($id);

    $this->fill([
      'cliente_id' => $this->agendamento->veiculo->cliente->id,
      'cliente_veiculo_id' => $this->agendamento->veiculo->id,
      'servico_id' => $this->agendamento->servico->id,
      'agendado_em' => $this->agendamento->agendado_em?->format('Y-m-d\TH:i'),
    ]);
  }

  protected function rules()
  {
    return [
      'cliente_id' => 'required',
      'cliente_veiculo_id' => 'required',
      'servico_id' => 'required',
      'agendado_em' => ['required', Rule::unique('agendamentos', 'agendado_em')->ignore($this->agendamento?->id)],
    ];
  }

  protected function messages()
  {
    return [
      'cliente_id.required' => 'Campo obrigatório.',
      'cliente_veiculo_id.required' => 'Campo obrigatório.',
      'servico_id.required' => 'Campo obrigatório.',
      'agendado_em.required' => 'Campo obrigatório.',
      'agendado_em.unique' => 'Período indisponível.',
    ];
  }

  #[Computed]
  protected function clientes()
  {
    return Cliente::query()->orderBy('nome')->orderBy('sobrenome')->get()->groupBy(fn($cliente) => mb_strtoupper(mb_substr($cliente->nome, 0, 1)));
  }

  #[Computed]
  public function veiculos()
  {
    return ClienteVeiculo::where('cliente_id', (int) $this->cliente_id)->orderBy('marca')->orderBy('modelo')->get();
  }

  #[Computed]
  public function servicos()
  {
    return Servico::orderBy('descricao')->get();
  }

  public function updateOrCreate()
  {
    Agendamento::updateOrCreate(['id' => $this->agendamento?->id], $this->only(['cliente_veiculo_id', 'servico_id', 'agendado_em']));
  }
};
?>

<div>
  <x-form>
    <x-label label="Cliente" name="cliente_id">
      <select wire:model.live="cliente_id">
        <option value="">Selecione</option>
        @foreach ($this->clientes as $letra => $clientes)
        <optgroup label="{{ $letra }}">
          @foreach ($clientes as $cliente)
          <option value="{{ $cliente->id }}">
            {{ $cliente->nome }} {{ $cliente->sobrenome }}
          </option>
          @endforeach
        </optgroup>
        @endforeach
      </select>
    </x-label>

    <x-label label="Veículo" name="cliente_veiculo_id">
      <select wire:model.live="cliente_veiculo_id" wire:key="{{ $cliente_id }}" @disabled(!$cliente_id)>
        <option value="">Selecione</option>
        @foreach ($this->veiculos as $veiculo)
        <option value="{{ $veiculo->id }}">{{ $veiculo->marca . ' ' . $veiculo->modelo }}</option>
        @endforeach
      </select>
    </x-label>

    <x-label label="Serviço" name="servico_id">
      <select wire:model="servico_id">
        <option value="">Selecione</option>
        @foreach ($this->servicos as $servico)
        <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
        @endforeach
      </select>
    </x-label>

    <x-label label="Data" name="agendado_em">
      <input type="datetime-local" wire:model="agendado_em">
    </x-label>
  </x-form>
</div>