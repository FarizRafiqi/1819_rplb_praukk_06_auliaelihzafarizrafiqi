<?php

namespace App\Http\Livewire\Admin\Tax\TaxType;

use App\Models\TaxType;
use Livewire\Component;

class Edit extends Component
{
    public $taxType;
    public $name, $description;

    public $rules = [
        'name' => 'required|string',
        'description' => 'string|nullable'
    ];
    protected $listeners = ['edit'];

    public $messages = [
        'name.required' => 'Nama tipe pajak tidak boleh kosong',
        'name.string' => 'Nama tipe pajak harus berupa karakter',
        'description.string' => 'Deskripsi tipe pajak harus berupa karakter',
    ];

    public function updated($field)
    {   
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.admin.tax.tax-type.edit');
    }

    public function edit($id)
    {
        $this->taxType = TaxType::find($id);
        $this->name = $this->taxType->name;
        $this->description = $this->taxType->description;
    }

    public function update()
    {
        $this->validate();
        $this->taxType->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->emit('updateTaxType');
        $this->reset(['name', 'description']);
    }
}
