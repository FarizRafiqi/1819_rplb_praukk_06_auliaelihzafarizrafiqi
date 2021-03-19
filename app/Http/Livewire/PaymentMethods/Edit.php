<?php

namespace App\Http\Livewire\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;
    public $nama;
    public $deskripsi = "-";
    public $gambar;

    protected $rules = [
        'nama' => 'required|string',
        'gambar' => 'image|max:2048'
    ];

    protected $messages = [
        'nama.required' => 'Nama metode pembayaran tidak boleh kosong',
        'nama.string' => 'Nama metode pembayaran harus berupa karakter',
    ];

    public function mount($paymentMethod)
    {
        $this->nama = $paymentMethod->nama;
        $this->deskripsi = $paymentMethod->deskripsi;
        // $this->gambar = $paymentMethod->gambar;
    }
    
    public function render()
    {
        return view('livewire.payment-methods.edit');
    }

    public function updatedGambar($value)
    {
        $extension = pathinfo($value->getFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif'])) {
            $this->reset('gambar');
        }

        $this->validate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validatedData = $this->validate();
        $validatedData["slug"] = Str::slug($validatedData["nama"]);
        $validatedData["gambar"] = $this->gambar->storeAs('img/payment-method', $this->gambar->getClientOriginalName(), 'public');

        PaymentMethod::create($validatedData+["deskripsi" => $this->deskripsi]);
    }

    public function dehydrate()
    {
        $this->emit('initializeCkEditor');
    }
}
