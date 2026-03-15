<div class="bg-black/50 fixed top-0 right-0 w-full h-full flex items-center justify-center shadow-lg backdrop-blur-xs"
  wire:show="showForm" wire:transition wire:cloak>
  <form class="flex flex-col gap-4 bg-white rounded-lg w-120 min-h-80 p-6" wire:submit="save">
    <header>
      <h2 class="text-lg">Cadastrar</h2>
    </header>

    <main class="space-y-4 flex-1">
      {{ $slot }}
    </main>

    <footer class="flex justify-end gap-2">
      <button type="button" wire:click="$set('showForm', false)">Cancelar</button>
      <button type="submit">Salvar</button>
    </footer>
  </form>
</div>
