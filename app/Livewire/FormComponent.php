<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

abstract class FormComponent extends Component
{
  public ?bool $showForm = false;

  public function updatedshowForm($value)
  {
    if ($value === false) {
      $this->reset();
      $this->resetErrorBag();
    }
  }

  public function save()
  {
    $this->validate();

    DB::transaction(function () {
      $this->updateOrCreate();
    });

    $this->reset();
    $this->dispatch('update-table');
  }

  #[On('open-form')]
  public function openForm()
  {
    $this->showForm = true;
  }
}
