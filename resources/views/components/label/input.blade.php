@props(['name' => '', 'label' => ''])

<x-label :$name :$label>
  <input type="text" {{ $attributes }} wire:model="{{ $name }}">
</x-label>
