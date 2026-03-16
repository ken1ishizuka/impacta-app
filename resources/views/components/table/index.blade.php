@props(['thColumns' => [], 'tdColumns' => [], 'records'])

<section>
  <header class="flex items-center p-6 pb-0">
    <form id="search" class="ml-auto relative flex items-center w-full md:w-64 lg:w-72">
      <x-icon.search class="fill-gray-500 w-5 h-5 absolute left-2.5" />
      <input type="text" class="flex-1 pl-9 pr-8 bg-white" placeholder="Localizar..." wire:model.live="search">
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
            @foreach ($thColumns as $th)
              <th class="font-medium px-4 py-2.5 bg-brand-secondary">
                @if ($th['sortable'])
                  <x-table.ordering field="{{ $th['sortable'] }}"> {{ $th['label'] }}</x-table.ordering>
                @else
                  {{ $th['label'] }}
                @endif
              </th>
            @endforeach
            <th class="bg-brand-secondary"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($records as $record)
            <tr class="border-b border-gray-200 bg-white" wire:key="{{ $record->id }}">
              @foreach ($tdColumns as $td)
                <td class="px-4 py-1.5 text-gray-600">{{ $record->{$td['name']} }}</td>
              @endforeach

              <td class="px-1.5 py-1.5">
                <div class="flex gap-1 justify-end">
                  <button type="button" class="p-2 rounded-md hover:bg-gray-200"
                    wire:click="
                  $dispatch('open-form');
                  $dispatch('set-form', { id: {{ $record->id }} });
              ">
                    <x-icon.edit_square class="fill-gray-500 w-4 h-4" />
                  </button>

                  <button type="button" class="p-2 rounded-md hover:bg-red-100"
                    wire:confirm="Tem certeza que deseja deletar o registro?">
                    <x-icon.delete class="fill-red-500 w-4 h-4" />
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td class="px-4
                    py-2.5">Sem registros.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>
</section>
