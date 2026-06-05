@if ($paginator->hasPages())
  <div class="flex items-center justify-between text-xs">
    <button class="px-3 pt-1.5 pb-1 rounded-md border border-gray-200 bg-white font-medium" wire:click="previousPage"
      @disabled($paginator->onFirstPage())>
      Anterior
    </button>

    <span>
      Página {{ $paginator->currentPage() }}
      de {{ $paginator->lastPage() }}
    </span>

    <button class="px-3 pt-1.5 pb-1 rounded-md border border-gray-200 bg-white font-medium" wire:click="nextPage"
      @disabled(!$paginator->hasMorePages())>
      Próxima
    </button>
  </div>
@endif
