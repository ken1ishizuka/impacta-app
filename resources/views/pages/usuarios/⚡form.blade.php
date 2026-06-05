<?php

use App\Livewire\FormComponent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

new class extends FormComponent {
  public ?User $usuario = null;

  public ?string $name;
  public ?string $email;
  public ?string $password = '';

  #[On('set-form-clientes')]
  public function setForm($id)
  {
    $this->usuario = User::findOrFail($id);

    $this->fill([
      'name' => $this->usuario->name,
      'email' => $this->usuario->email,
    ]);
  }

  public function rules()
  {
    return [
      'name' => ['required', Rule::unique('users', 'name')->ignore($this->usuario?->id)],

      'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->usuario?->id)],

      'password' => [$this->usuario ? 'nullable' : 'required'],
    ];
  }

  protected function messages()
  {
    return [
      'name.required' => 'Campo obrigatório.',
      'name.unique' => 'Usuário já cadastrado.',
      'email.required' => 'Campo obrigatório.',
      'email.unique' => 'E-mail já cadastrado.',
      'password.required' => 'Campo obrigatório.',
    ];
  }

  public function updateOrCreate()
  {
    $data = [
      'name' => $this->name,
      'email' => $this->email,
    ];

    if ($this->password) {
      $data['password'] = Hash::make($this->password);
    }

    User::updateOrCreate(['id' => $this->usuario?->id], $data);
  }
};
?>

<div>
  <x-form>
    <x-label label="Usuário" name="name">
      <input type="text" placeholder="João Silva" wire:model="name">
    </x-label>

    <x-label label="E-mail" name="email">
      <input type="email" placeholder="seuemail@email.com" wire:model="email">
    </x-label>

    <x-label label="Senha" name="password">
      <div class="relative" x-data="{ show: false }">
        <input :type="show ? 'text' : 'password'" class="w-full" placeholder="******" wire:model="password">

        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
          x-on:click="show = !show">
          <span x-show="!show">
            <x-icon.visibility class="size-4 fill-gray-500" />
          </span>

          <span x-show="show">
            <x-icon.visibility_off class="size-4 fill-gray-500" />
          </span>
        </button>
      </div>
    </x-label>
  </x-form>
</div>