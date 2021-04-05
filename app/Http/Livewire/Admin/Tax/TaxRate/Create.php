<?php

namespace App\Http\Livewire\Admin\Tax\TaxRate;

use App\Models\IndonesiaCity;
use App\Models\TaxRate;
use App\Models\TaxType;
use Livewire\Component;

class Create extends Component
{
    public $taxTypes, $cities,
           $tax_type, $city,
           $rate;
    public $rules = [
        'tax_type' => 'required|exists:tax_types,id',
        'city' => 'required|exists:indonesia_cities,id',
        'rate' => 'required|numeric|gt:0'
    ];

    public $messages = [
        'tax_type.required' => 'Tipe pajak tidak boleh kosong',
        'tax_type.exists' => 'Tipe pajak tidak ditemukan',
        'city.required' => 'Kota tidak boleh kosong',
        'city.exists' => 'Kota tidak ditemukan',
        'rate.required' => 'Presentase pajak tidak boleh kosong',
        'rate.numeric' => 'Presentase pajak harus berupa angka',
        'rate.gt' => 'Presentase pajak harus lebih besar dari :value',
    ];

    public function mount()
    {
        $this->taxTypes = TaxType::all();
        $this->cities = IndonesiaCity::all();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }
    
    public function render()
    {
        return view('livewire.admin.tax.tax-rate.create');
    }

    public function store()
    {
        $this->validate();
        $taxRate = TaxRate::create([
                        'tax_type_id' => $this->tax_type, 
                        'indonesia_city_id' => $this->city,
                        'rate' => $this->rate,
                   ]);
        $this->emit('storeTaxRate');
    }
}
