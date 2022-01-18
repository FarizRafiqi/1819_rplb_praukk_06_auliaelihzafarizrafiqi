<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadReceiptOfPayment extends Component
{
    use WithFileUploads;
    public $gambar;
    public $payment;

    protected $rules = [
        'gambar' => 'required|image|max:2048'
    ];

    protected $messages = [
        'gambar.required' => 'Gambar tidak boleh kosong!',
        'gambar.image' => 'File harus berupa gambar!'
    ];

    public function mount($payment)
    {
        $this->payment = $payment;
    }

    public function render()
    {
        return view('livewire.upload-receipt-of-payment');
    }

    public function updatedGambar()
    {
        $this->validateOnly("gambar");
    }

    public function update()
    {
        $this->validate();
        $ext = pathinfo($this->gambar->getFilename(), PATHINFO_EXTENSION);
        $filename = $this->gambar->storeAs('img/bukti-bayar/' . auth()->user()->id, 'struk_bayar_listrik_' . date('YmdHis') . '.' . $ext, 'public');
        $this->payment->update(['bukti_bayar' => $filename]);
        $this->emit('alertSuccess');
    }
}
