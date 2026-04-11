@props(['label' => 'Registro'])

<div x-data="{ show: @entangle('feedbackMessage') }" x-effect="if (show) setTimeout(() => show = false, 3000)" x-show="show" x-transition
  class="fixed bottom-6 left-1/2 -translate-x-1/2 p-2 rounded-lg bg-green-100 border border-green-500 text-green-500 shadow-lg flex items-center gap-2 z-50">
  <x-icon.check class="fill-green-500" />
  <span>{{ $label }} salvo com sucesso!</span>
</div>
