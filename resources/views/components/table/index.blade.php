@props(['thColumns' => [], 'tdColumns' => [], 'records'])

<section>
  <header class="p-6 pb-0">
    <input type="text" placeholder="Localizar..." wire:model.live="search">
  </header>

  <main class="overflow-x-auto w-full p-6">
    <table class="bg-gray-100 w-full text-left">
      <thead>
        <tr class="border-b border-black">
          @foreach ($thColumns as $th)
            <th class="px-4 py-3">
              @if ($th['sortable'])
                <x-table.ordering field="{{ $th['sortable'] }}"> {{ $th['label'] }}</x-table.ordering>
              @else
                {{ $th['label'] }}
              @endif
            </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse ($records as $record)
          <tr class="border-b border-gray-200" wire:key="{{ $record->id }}">
            @foreach ($tdColumns as $td)
              <td class="px-4 py-3">{{ $record->{$td['name']} }}</td>
            @endforeach
          </tr>
        @empty
          <tr>
            <td class="px-4 py-3">Nenhum registro.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </main>
</section>
