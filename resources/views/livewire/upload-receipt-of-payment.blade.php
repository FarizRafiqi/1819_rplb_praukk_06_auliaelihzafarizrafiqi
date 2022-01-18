<div>
  <form method="POST" wire:submit.prevent="update">
    @csrf
    @method("PUT")
    <div class="row align-items-center justify-content-center">
      <div class="col-12 col-md-6 text-center mb-4">
        @if ($gambar)
          <img src="{{ $gambar->temporaryUrl() }}" class="img-fluid img-thumbnail" id="imagePreview" width="400px"
            height="400px">
        @elseif($payment->bukti_bayar)
          <img src="{{ Storage::url($this->payment->bukti_bayar) }}" class="img-fluid img-thumbnail" id="imagePreview"
            width="400px" height="400px">
        @else
          No Image
        @endif
      </div>
      <div class="col-12 col-md-6">
        <div class="form-group">
          @if ($payment->bukti_bayar)
            <div class="text-center">
              @livewire('export-button', ['text' => 'Unduh Struk', 'payment' => $payment])
            </div>
          @else
            <label for="gambar">Gambar <span class="text-danger">*</span></label> <br>
            <div wire:loading wire:target="gambar"><span class="spinner-border spinner-border-sm mb-1"></span>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar"
                name="gambar" wire:model="gambar">
              <label class="custom-file-label" for="gambar">Pilih Gambar</label>
              @error('gambar') <span class="invalid-feedback"> {{ $message }} </span> @enderror
            </div>
          @endif
        </div>
      </div>
      <div class="col-12">
        <a href="{{ route('transaction-history') }}" class="btn btn-danger">Batal</a>
        @if (!$payment->bukti_bayar)
          <button type="submit" class="btn btn-primary" {{ $gambar ? '' : 'disabled' }}>Submit</button>
        @endif
      </div>
    </div>
  </form>
</div>
