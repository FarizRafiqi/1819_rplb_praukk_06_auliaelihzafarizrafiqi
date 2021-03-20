<?php

namespace App\Http\Livewire\TransactionHistory;

use Livewire\Component;

class BillDetail extends Component
{
    public $detail;
    public function render()
    {
        return view('livewire.transaction-history.bill-detail');
    }
}
