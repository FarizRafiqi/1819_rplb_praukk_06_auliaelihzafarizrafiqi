<?php

namespace App\Http\Livewire\Admin\Tax\TaxType;

use App\Models\TaxType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public $name = '', 
           $description = '';

    public $rules = [
        'name' => 'required|string',
        'description' => 'string|nullable',
    ];

    public $messages = [
        'name.required' => 'Nama tipe pajak tidak boleh kosong',
        'name.string' => 'Nama tipe pajak harus berupa karakter',
        'description.string' => 'Deskripsi harus berupa karakter',
    ];

    public function render()
    {
        return view('livewire.admin.tax.tax-type.create');
    }

    public function udpated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->validate();
        TaxType::create($this->validate());

        $this->emit('storeTaxType');
        $this->reset(['name', 'description']);
    }
}
