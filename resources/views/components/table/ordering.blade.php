@props(['field' => ''])

<button class="flex gap-2 items-center" wire:click="$set('sortField', '{{ $field }}')">
  {{ $slot }}

  <x-icon.arrow_upward class="fill-black h-3 w-3" wire:show="sortDirection === 'asc'" />
  <x-icon.arrow_downward class="fill-black h-3 w-3" wire:show="sortDirection === 'desc'" />
</button>
