<?php

namespace App\Http\Livewire\Admin\PaymentMethod;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;
    public $nama;
    public $deskripsi;
    public $gambar;
    public $gambarTmp;
    public $slug;
    public $paymentMethod;

    protected $rules = [
        'nama' => 'required|string',
        'gambar' => 'image|max:2048'
    ];

    protected $messages = [
        'nama.required' => 'Nama metode pembayaran tidak boleh kosong',
        'nama.string' => 'Nama metode pembayaran harus berupa karakter',
        'gambar.image' => 'File harus berupa gambar',
        'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB'
    ];

    public function mount($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        $this->nama = $paymentMethod->nama;
        $this->slug = $paymentMethod->slug;
        $this->gambar = Storage::url($paymentMethod->gambar);
        $this->deskripsi = $paymentMethod->deskripsi;
    }
    
    public function updatingGambar($value)
    {
        $extension = pathinfo($value->getFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif'])) {
            $this->reset('gambar');
        }
        $this->gambarTmp = $value;
    }

    public function updatedGambar($value)
    {
        $this->gambar = $value->temporaryUrl();
    }

    public function render()
    {
        return view('livewire.admin.payment-method.edit', [
            'gambar' => $this->gambar
        ]);
    }

    public function updated()
    {
        $this->validateOnly('nama');
    }

    public function update()
    {
        $this->paymentMethod->update([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama),
            'deskripsi' => $this->deskripsi,
        ]);
        if($this->gambarTmp){
            $this->paymentMethod->gambar = $this->gambarTmp->storeAs('img/payment-method', $this->gambarTmp->getClientOriginalName(), 'public');
        }
        $this->emit('alertSuccess');
    }
}
