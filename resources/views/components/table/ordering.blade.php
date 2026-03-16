 @props(['field' => ''])

 <button class="flex gap-2 items-center" wire:click="sortBy('{{ $field }}')">
   {{ $slot }}

   {{-- coluna não ordenada --}}
   <x-icon.expand_all class="fill-black h-3 w-3" wire:show="sortField !== '{{ $field }}'" />

   {{-- coluna ordenada asc --}}
   <x-icon.arrow_upward class="fill-black h-3 w-3"
     wire:show="sortField === '{{ $field }}' && sortDirection === 'asc'" />

   {{-- coluna ordenada desc --}}
   <x-icon.arrow_downward class="fill-black h-3 w-3"
     wire:show="sortField === '{{ $field }}' && sortDirection === 'desc'" />
 </button>
