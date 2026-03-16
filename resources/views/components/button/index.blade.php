@props(['type' => 'button', 'secondary' => false])

<button type="{{ $type }}"
  {{ $attributes->class(['px-4 h-8 rounded-md min-w-28', 'bg-brand-primary' => !$secondary, 'bg-white' => $secondary]) }}>
  <span @class([
      'font-medium',
      'text-white' => !$secondary,
      'text-black' => $secondary,
  ])>{{ $slot }}</span>
</button>
