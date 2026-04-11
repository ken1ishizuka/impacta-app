<section>
  <header class="flex items-center p-6 pb-0">
    <form id="search" class="ml-auto relative flex items-center w-full md:w-64 lg:w-72">
      <x-icon.search class="fill-gray-500 w-5 h-5 absolute left-2.5" />
      <input type="text" class="flex-1 pl-9! pr-8 bg-white" placeholder="Localizar..." wire:model.live="search">
      <button type="button" class="absolute right-0 p-2.5" wire:click="$set('search', '')" wire:show="search">
        <x-icon.close class="fill-brand-primary w-4 h-4" />
      </button>
    </form>
  </header>

  <main class="overflow-x-auto scrollbar-hide max-w-full p-6">
    <div class="bg-gray-100 rounded-lg overflow-hidden shadow-lg min-w-fit">
      <table class="min-w-full text-left">
        <thead>
          <tr class="border-b border-black">
            {{ $thead }}
          </tr>
        </thead>
        <tbody>
          {{ $tbody }}

          {{-- <td class="px-1.5 py-1.5">
            <div class="flex gap-1 justify-end">
              <button type="button" class="p-2 rounded-md hover:bg-gray-200"
                x-on:click="$dispatch('set-form', { id: {{ $record->id }} }); showForm = true">
                <x-icon.edit_square class="fill-gray-500 w-4 h-4" />
              </button>

              <button type="button" class="p-2 rounded-md hover:bg-red-100"
                wire:confirm="Tem certeza que deseja deletar o registro?">
                <x-icon.delete class="fill-red-500 w-4 h-4" />
              </button>
            </div>
          </td> --}}
        </tbody>
      </table>
    </div>
  </main>
</section>
