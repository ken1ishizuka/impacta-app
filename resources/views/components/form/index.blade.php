@teleport('body')
  <div
    class="bg-black/50 fixed top-0 right-0 w-full h-full flex items-center justify-center shadow-lg backdrop-blur-xs z-20"
    x-show="showForm" x-cloak @close-form.window="showForm = false">
    <form
      class="flex flex-col gap-4 bg-white md:rounded-lg w-full min-h-full md:w-120 md:min-h-80 p-6 md:max-h-[60%] lg:max-h-[80%] overflow-y-auto"
      wire:submit="save">
      <header>
        <h2 class="text-lg">Cadastrar</h2>
      </header>

      <main class="space-y-4 flex-1">
        {{ $slot }}
      </main>

      <footer class="flex justify-end gap-2">
        <x-button x-on:click="showForm = false; $wire.cleanValidation()" secondary>Cancelar</x-button>
        <x-button type="submit">Salvar</x-button>
      </footer>
    </form>
  </div>
@endteleport
