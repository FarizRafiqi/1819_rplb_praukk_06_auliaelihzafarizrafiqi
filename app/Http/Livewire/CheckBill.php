<?php

namespace App\Http\Livewire;

use App\Models\PlnCustomer;
use App\Models\Usage;
use App\Models\TaxRate;
use Illuminate\Database\Eloquent\Builder;
use Jenssegers\Agent\Facades\Agent;
use Livewire\Component;

/**
 * Komponen untuk mengecek tagihan pelanggan secara live,
 * Di komponen ini juga terdapat perhitungan denda 
 * serta ppj dan ppn
 */
class CheckBill extends Component
{
    public $usages, $data = [],
           $total, $plnCustomer,
           $nomor_meter, $isDisabled = true;

    public function updated($input)
    {
        $this->reset(['total', 'usages', 'plnCustomer', 'data']);
        $this->validateOnly($input, 
            [
                'nomor_meter' => 'nullable|numeric|exists:pln_customers|min:12'
            ],
            [
                'nomor_meter.numeric' => 'ID Pelanggan harus berupa angka',
                'nomor_meter.min' => 'ID Pelanggan harus terdiri dari 12 angka',
                'nomor_meter.exists' => 'ID Pelanggan tidak terdaftar',
            ]
        );
        
        if(empty($this->nomor_meter)) return;

        $this->plnCustomer = PlnCustomer::with('usages')
                                        ->has('usages')
                                        ->firstWhere("nomor_meter", $this->nomor_meter);
                                        
        if(!empty($this->plnCustomer)) {
            $this->usages = $this->plnCustomer
                                 ->usages()
                                 ->whereHas('bill', function(Builder $query){
                                    $query->where('status', 'BELUM LUNAS')
                                          ->whereDoesntHave('paymentDetail.payment', function(Builder $query){
                                            $query->where('status', 'success');
                                          });
                                  })
                                 ->where("tahun", now()->year)
                                 ->where("bulan", "<=", now()->month)
                                 ->get();

            if($this->usages->isEmpty()){
                $this->emit('alertAlreadyPayBill');
                $this->reset('usages');
                return;
            }

            $this->isDisabled = false;                     
            //Cek PPJ berdasarkan daerah pelanggan
            $ppj = TaxRate::where('tax_type_id', 1)                             //tipe tax dengan id 1 adalah ppj
                          ->where('indonesia_city_id', $this->plnCustomer->city->id)
                          ->first()->rate;

            foreach ($this->usages as $index => $usage) {
                $this->checkBill($index, $usage, $ppj);
            }

            $this->total = collect($this->data)->sum('total_tagihan') + config('const.biaya_admin');
        }
    }

    public function render()
    {
        if(Agent::isMobile()){
            return view('livewire.check-bill-mobile', [
                'usages' => $this->usages,
                'nomor_meter' => $this->nomor_meter,
                'totals' => $this->total,
                'plnCustomer' => $this->plnCustomer,
            ]);
        }
        
        return view('livewire.check-bill', [
            'usages' => $this->usages,
            'nomor_meter' => $this->nomor_meter,
            'totals' => $this->total,
        ]);
    }

    public function checkBill($index, $usage, $ppj)
    {   
        $this->data[$index]['biaya_listrik'] = ($usage->bill->jumlah_kwh * $usage->plnCustomer->tariff->tarif_per_kwh);
        $this->data[$index]['ppj']  = ($ppj/100 * $this->data[$index]['biaya_listrik']);
        $this->data[$index]['total_tagihan'] = $this->data[$index]['biaya_listrik'] + $this->data[$index]['ppj'];

        //Kalau batas daya listrik pelanggan lebih dari 2200 watt maka kenakan pajak 10%
        $this->data[$index]['ppn'] = 0.0;
        if($this->plnCustomer->tariff->daya > 2200){
            $this->data[$index]['ppn'] = (10/100 * $this->data[$index]['biaya_listrik']);
            $this->data[$index]['total_tagihan'] += $this->data[$index]['ppn'];
        }

        //Cek denda
        $this->data[$index]['denda'] = $this->checkFine($usage, $this->plnCustomer, $this->data[$index]['biaya_listrik']);
        $this->data[$index]['total_tagihan'] += $this->data[$index]['denda'];
    }

    public function checkFine(Usage $usage, PlnCustomer $customer, $bill)
    {
        $fine = 0;
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
