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

  public function updatedSortField($value)
  {
    if ($this->sortField === $value) {
      $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
      $this->sortField = $value;
      $this->sortDirection = 'asc';
    }
  }

  public function search()
  {
    $this->resetPage();
  }
}
