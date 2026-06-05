<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\On;

abstract class TableComponent extends Component
{
  use WithPagination;

  public ?string $search = '';
  public ?string $sortField = '';
  public $sortDirection = 'asc';
  public $paginate = 20;

  public $feedbackMessage = false;

  #[On('update-table')]
  public function sendFeedback()
  {
    $this->feedbackMessage = true;
  }

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
