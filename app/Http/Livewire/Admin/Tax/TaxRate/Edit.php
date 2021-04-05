<?php

namespace App\Http\Livewire\Admin\Tax\TaxRate;

use App\Models\IndonesiaCity;
use App\Models\TaxRate;
use App\Models\TaxType;
use Livewire\Component;

class Edit extends Component
{
    public $taxTypes, $cities,
           $tax_rate;
    public $listeners = ["edit"];
    public $rules = [
        'tax_rate.tax_type_id' => 'required|exists:tax_types,id',
        'tax_rate.indonesia_city_id' => 'required|exists:indonesia_cities,id',
        'tax_rate.rate' => 'required|numeric|gt:0'
    ];

    public $messages = [
        'tax_rate.tax_type_id.required' => 'Tipe pajak tidak boleh kosong',
        'tax_rate.tax_type_id.exists' => 'Tipe pajak tidak ditemukan',
        'tax_rate.indonesia_city_id.required' => 'Kota tidak boleh kosong',
        'tax_rate.indonesia_city_id.exists' => 'Kota tidak ditemukan',
        'tax_rate.rate.required' => 'Presentase pajak tidak boleh kosong',
        'tax_rate.rate.numeric' => 'Presentase pajak harus berupa angka',
        'tax_rate.rate.gt' => 'Presentase pajak harus lebih besar dari :value',
    ];

    public function mount()
    {
        $this->reset(['tax_rate']);
        $this->taxTypes = TaxType::all();
        $this->cities = IndonesiaCity::all();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function edit($id)
    {
        $this->tax_rate = TaxRate::find($id);
    }

    public function render()
    {
        return view('livewire.admin.tax.tax-rate.edit');
    }

    public function update()
    {
        $this->validate();
        $this->tax_rate->update($this->validate());
        $this->emit('updateTaxRate');

        $this->reset(['tax_rate']);
    }
}
