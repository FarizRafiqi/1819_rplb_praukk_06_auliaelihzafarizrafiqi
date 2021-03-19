<?php

namespace App\Http\Livewire;

use App\Models\PlnCustomer;
use App\Models\Usage;
use App\Models\TaxRate;
use Livewire\Component;

class CheckBill extends Component
{
    public $nomor_meter;
    public $usages = [], $bills, 
           $total, $fine = 0.0;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, 
            [
                'nomor_meter' => 'nullable|numeric|exists:pln_customers|min:12'
            ],
            [
                'nomor_meter.numeric' => 'ID Pelanggan harus berupa angka',
                'nomor_meter.digits' => 'ID Pelanggan harus terdiri dari 12 angka',
                'nomor_meter.exists' => 'ID Pelanggan tidak terdaftar',
            ]
        );

        $this->reset(['bills', 'total', 'fine']);
        
        $plnCustomer = PlnCustomer::where("nomor_meter", $this->nomor_meter)->first();
        if($plnCustomer){
            $usages = $plnCustomer->usages()
                                  ->whereYear("created_at", now())
                                  ->whereMonth("created_at", '<=', now())
                                  ->get();
            //Cek PPJ berdasarkan daerah pelanggan
            $ppj = TaxRate::where('tax_type_id', 1)                             //tipe tax dengan id 1 adalah ppj
                          ->where('indonesia_city_id', $plnCustomer->city->id)
                          ->first()->rate;
            
            foreach ($usages as $usage) {
                if($usage->bill->status == "BELUM LUNAS"){
                    $bill = ($usage->bill->jumlah_kwh * $usage->plnCustomer->tariff->tarif_per_kwh);
                    $this->bills += $bill + ($ppj/100 * $bill);
                    //Kalau batas daya listrik pelanggan lebih dari 2200 watt maka kenakan pajak 10%
                    $ppn = 0.0;
                    if($plnCustomer->tariff->daya > 2200){
                        $ppn = (10/100 * $bill);
                        $this->bills += $ppn;
                    }
                    //Kalau pelanggan bayarnya telat dari tanggal 20 tiap bulannya, maka kenakan denda
                    $this->bills += $this->checkFine($usage, $plnCustomer, $bill);
                } else {
                    $this->emit('alertAlreadyPayBill');
                    return;
                }
            }
            $this->total = $this->bills + config('const.biaya_admin');
            $this->usages = $usages;
        } else {
            $this->reset('usages');
        }
    }

    public function render()
    {
        return view('livewire.check-bill', [
            'usages' => $this->usages,
            'nomor_meter' => $this->nomor_meter,
            'bills' => $this->bills,
            'totals' => $this->total,
        ]);
    }

    public function checkFine(Usage $usage, PlnCustomer $customer, $bill)
    {
        $fine = 0.0;
        if(now() > $usage->bill->created_at->addDays(20)){
            $daya = $customer->tariff->daya;
            switch ($daya) {
                case 450 || 900:
                    $fine = 3000;
                    break;
                case 1300:
                    $fine = 5000;
                    break;
                case 2200:
                    $fine = 10000;
                    break;
                case ($daya >= 3500 && $daya <= 5500):
                    $fine = 50000;
                    break;
                case ($daya >= 6600 && $daya <= 14000):
                    $fine = 3/100 * $bill;
                    $fine = ($fine < 75000) ? 
                                    $fine + (75000 - $fine) : 
                                    $fine;
                    break;
                case ($daya > 14000):
                    $fine = 3/100 * $bill;
                    $fine = ($fine < 100000) ? 
                                    $fine + (100000 - $fine) : 
                                    $fine;
                    break;
            }
        }

        return $fine;
    }

}
