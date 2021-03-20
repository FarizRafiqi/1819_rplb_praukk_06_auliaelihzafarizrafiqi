<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Exception;
use Midtrans\Config;
use Midtrans\Transaction as MidtransTransaction;

class TransactionHistory extends Component
{
    public $selectedStatuses = [];
    public $selectedPaymentMethod = [];
    public $payment;
    public $day = 30;
    protected $paymentDetail;
    public $paymentMethods;
    
    public function mount()
    {
        $this->paymentMethods = PaymentMethod::all();
    }
    
    public function render()
    {
        //tampilkan history transaksi pelanggan 30 hari terakhir
        $userPayments = auth()->user()
                              ->payments()
                              ->with('details')
                              ->where(function($query){
                                $query->when(!empty($this->selectedStatuses), function($query){
                                    $query->whereIn('status', $this->selectedStatuses);
                                })->when(!empty($this->selectedPaymentMethod), function($query){
                                    $query->whereIn('id_metode_pembayaran', $this->selectedPaymentMethod);
                                });
                              })
                              ->where("created_at", ">=", now()->subDays((int)$this->day))
                              ->get();
        return view("livewire.transaction-history", [
            "userPayments" => $userPayments,
            "transactionDetail" => $this->paymentDetail,
            "selectedStatuses" => $this->selectedStatuses,
            "paymentMethods" => $this->paymentMethods,
        ]);
    }

    public function transactionDetail($id)
    {
        $this->payment = Payment::find($id);
        //Konfigurasi Midtrans
        Config::$serverKey = config("midtrans.serverKey");
        Config::$isProduction = config("midtrans.isProduction");
        Config::$isSanitized = config("midtrans.isSanitized");
        Config::$is3ds = config("midtrans.is3ds");
    
        try{
            $this->paymentDetail = MidtransTransaction::status("PLN-".$id);
        }catch(Exception $ex){
            if($ex->getCode() === 404 && $this->payment->status == "pending"){
                $this->emit('paymentNotCompleteYet', $this->payment->id);return;
            }
            echo $ex->getMessage();
            exit;
        }
    }

    public function filterStatus($status)
    {
        if(($key = array_search($status, $this->selectedStatuses)) !== false) {
            unset($this->selectedStatuses[$key]);
        } else {
            $this->selectedStatuses[] = $status;
        }
    }

    public function filterPaymentMethod($id)
    {
        if(($key = array_search($id, $this->selectedPaymentMethod)) !== false) {
            unset($this->selectedPaymentMethod[$key]);
        } else {
            $this->selectedPaymentMethod[] = $id;
        }
    }
}
