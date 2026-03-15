<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

abstract class FormComponent extends Component
{
  public ?bool $showForm = false;

  public function save()
  {
    $this->validate();

    DB::transaction(function () {
      $this->create();
    });

    $this->reset();
    $this->dispatch('update-table');
  }
}
