<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;

abstract class TableComponent extends Component
{
  use WithPagination;

  public ?string $search = '';
  public ?string $sortField = '';
  public $sortDirection = 'asc';
  public $paginate = 10;

  public function sortBy($field)
  {
    if ($this->sortField !== $field) {
      $this->sortField = $field;
      $this->sortDirection = 'asc';
      return;
    }

    $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
  }

  public function search()
  {
    $this->resetPage();
  }
}
