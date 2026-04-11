<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

abstract class FormComponent extends Component
{
  public function cleanValidation()
  {
    $this->reset();
    $this->resetErrorBag();
  }

  public function save()
  {
    $this->validate();

    DB::transaction(function () {
      $this->updateOrCreate();
    });

    $this->reset();
    $this->dispatch('update-table');
    $this->dispatch('close-form');
  }
}
