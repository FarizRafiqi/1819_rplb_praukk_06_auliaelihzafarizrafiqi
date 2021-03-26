<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class ToggleButton extends Component
{
    public $isActive = false;
    protected $listeners = ['enableSidebar'];

    public function render()
    {
        return view('livewire.toggle-button');
    }

    public function enableSidebar()
    {
        
    }
}
