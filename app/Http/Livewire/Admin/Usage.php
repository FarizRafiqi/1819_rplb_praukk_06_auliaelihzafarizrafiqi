<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Usage extends Component
{
    public $selectAll = false;
    public $selectedUsages = [];

    public function render()
    {
        return view('livewire.admin.usage');
    }
}
