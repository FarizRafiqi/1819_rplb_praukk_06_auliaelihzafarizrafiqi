<?php

namespace App\Http\Livewire\Admin\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;
    public $nama;
    public $deskripsi = "-";
    public $gambar;

    protected $rules = [
        'nama' => 'required|string',
        'gambar' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
    ];

    protected $messages = [
        'nama.required' => 'Nama metode pembayaran tidak boleh kosong',
        'nama.string' => 'Nama metode pembayaran harus berupa karakter',
    ];

    public function render()
    {
        return view('livewire.admin.payment-method.create');
    }

    public function updatedGambar($field)
    {
        $extension = pathinfo($field->getFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif', 'jpg'])) {
            $this->reset('gambar');
        }

        $this->validate(["gambar" => "required|image|mimes:jpg,jpeg,png,svg,gif|max:2048"]);
    }

    public function updated($field)
    {
        if ($field !== "gambar") {
            $this->validateOnly($field);
        }
    }

    public function create()
    {
        $this->validate();
        $filename = $this->gambar->storeAs('img/payment-method', $this->gambar->getClientOriginalName(), 'public');

        PaymentMethod::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama),
            'gambar' => $filename,
            'deskripsi' => $this->deskripsi
        ]);

        $this->emit('alertSuccess');
    }
}
