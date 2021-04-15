<?php

namespace App\Http\Livewire\TransactionHistory;

use App\Http\Controllers\Admin\TransactionController;
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
    public $selectAllStatus = false;
    public $payment;
    public $day = 30;
    protected $paymentDetail;
    public $paymentMethods;
    public $listeners = ['changePaymentMethod'];

    public function mount()
    {
        //Konfigurasi Midtrans
        Config::$serverKey = config("midtrans.serverKey");
        Config::$isProduction = config("midtrans.isProduction");
        Config::$isSanitized = config("midtrans.isSanitized");
        Config::$is3ds = config("midtrans.is3ds");

        $this->paymentMethods = PaymentMethod::all();
    }
    
    public function render()
    {
        //tampilkan history transaksi pelanggan 30 hari terakhir
        $userPayments = auth()->user()
                              ->payments()
                              ->with('details')
                              ->where( function($query) {
                                $query->when(!empty($this->selectedStatuses), function( $query ) {
                                    $query->whereIn('status', $this->selectedStatuses);
                                })->when(!empty($this->selectedPaymentMethod), function( $query ) {
                                    $query->whereIn('id_metode_pembayaran', $this->selectedPaymentMethod);
                                });
                              })
                              ->where("created_at", ">=", now()->subDays( (int) $this->day ))
                              ->get();
        return view("livewire.transaction-history.transaction-history", [
            "userPayments" => $userPayments,
            "transactionDetail" => $this->paymentDetail,
            "selectedStatuses" => $this->selectedStatuses,
            "paymentMethods" => $this->paymentMethods,
        ]);
    }

    /**
     * Untuk mengambil data detail pembayaran
     */
    public function transactionDetail($id)
    {
        $this->payment = Payment::find($id);
    
        try {
            $this->paymentDetail = MidtransTransaction::status("PLN-".$id);
        } catch(Exception $ex) {
            if($ex->getCode() === 404 && $this->payment->status == "pending"){
                $this->emit('paymentNotCompleteYet', $this->payment->id);return;
            }
            echo $ex->getMessage();
            exit;
        }
    }

    /**
     * Untuk menampilkan semua data pembayaran tanpa memandang status pembayaran
     */
    public function updatedSelectAllStatus($field)
    {
        if($field) {
            $this->selectedStatuses = config('enum.payment_status');
        } else {
            $this->selectedStatuses = [];
        }
    }

    /**
     * Untuk menyaring dan mengambil data pembayaran berdasarkan status pembayaran yang dipilih
     */
    public function filterStatus($status)
    {
        if(($key = array_search($status, $this->selectedStatuses)) !== false) {
            unset($this->selectedStatuses[$key]);
        } else {
            $this->selectedStatuses[] = $status;
        }
    }

    /**
     * Untuk menyaring dan mengambil data pembayaran berdasarkan metode pembayaran yang dipilih
     */
    public function filterPaymentMethod($id)
    {
        if(($key = array_search($id, $this->selectedPaymentMethod)) !== false) {
            unset($this->selectedPaymentMethod[$key]);
        } else {
            $this->selectedPaymentMethod[] = $id;
        }
    }

    public function changePaymentMethod(Payment $payment)
    {
        $transactionController = new TransactionController;
        $transactionController->changePaymentMethod($payment);
    }
}
