@props(['name' => '', 'label' => 'Label'])

<label class="flex flex-col gap-1">
  <span class="text-xs font-medium">{{ $label }}</span>

  {{ $slot }}

  @error($name)
    <span class="text-xs font-medium text-red-500">{{ $message }}</span>
  @enderror
</label>
