<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Midtrans\Config;
use Midtrans\Transaction;
use Exception;
use PDF;

class ExportButton extends Component
{
    public $text;
    public $payment;

    public function mount($text, $payment)
    {
        //Konfigurasi Midtrans
        Config::$serverKey = config("midtrans.serverKey");
        Config::$isProduction = config("midtrans.isProduction");
        Config::$isSanitized = config("midtrans.isSanitized");
        Config::$is3ds = config("midtrans.is3ds");

        $this->text = $text;
        $this->payment = $payment;
    }

    public function render()
    {
        return view("livewire.export-button");
    }

    public function exportReceiptOfPayment()
    {
        try {
            $trx = Transaction::status("PLN-" . $this->payment->id);
            $pdf = PDF::loadView(
                "pages.pelanggan.receipt-of-payment-template",
                [
                    "payment" => $this->payment,
                    "trx" => $trx,
                    "request" => request()
                ]
            )->setPaper("a4", "portrait")->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "struk_bayar_listrik_" . date("YmdHis") . ".pdf");
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
}
