<?php

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

new #[Layout('layouts::login')] class extends Component {
    public string $email = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'E-mail não cadastrado.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Senha incorreta.');
            return;
        }

        Auth::login($user);
        session()->regenerate();

        return redirect()->route('agendamentos');
    }

    protected function messages()
    {
        return [
            'email.required' => 'Campo obrigatório.',
            'password.required' => 'Campo obrigatório.',
        ];
    }
};
?>

<div class="min-h-screen flex items-center justify-center bg-gray-900 p-4">
  <div class="w-full max-w-md space-y-8">
    <img src="{{ asset('img/Motorlux_logo.svg') }}" alt="Motorlux" class="w-44 mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-6">
      <h1 class="text-2xl font-bold text-center mb-6">
        Login
      </h1>

      <form wire:submit.prevent="login" class="space-y-4">
        <x-label label="E-mail" name="email">
          <input type="email" placeholder="seu@email.com" wire:model="email">
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

        <button type="submit" class="w-full bg-brand-primary text-white py-2 rounded-lg hover:bg-gray-800">
          Entrar
        </button>
      </form>
    </div>
  </div>
</div>
