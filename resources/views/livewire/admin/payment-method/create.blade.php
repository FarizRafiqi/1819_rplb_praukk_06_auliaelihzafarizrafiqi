<div>
  <form method="POST" wire:submit.prevent="create">
    @csrf

    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="inputNamaMetodePembayaran">Nama <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
          id="inputNamaMetodePembayaran" value="{{ old('nama') }}" placeholder="Masukkan nama metode"
          wire:model="nama" autofocus>
        @error('nama')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group col-md-12">
        @if ($gambar)
          <div class="mb-2">
            <label for="imagePreview">Image Preview:</label> <br>
            <img src="{{ $gambar->temporaryUrl() }}" class="img-fluid img-thumbnail" id="imagePreview" width="200px"
              height="200px">
          </div>
        @endif

        <label for="gambar">Gambar <span class="text-danger">*</span></label> <br>
        <div wire:loading wire:target="gambar"><span class="spinner-border spinner-border-sm mb-1"></span></div>
        <div class="custom-file">
          <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar" name="gambar"
            wire:model="gambar" accept="image/*">
          <label class="custom-file-label" for="gambar">Pilih Gambar</label>
          @error('gambar') <span class="invalid-feedback"> {{ $message }} </span> @enderror
        </div>
      </div>

      <div class="form-group col-md-12" wire:ignore>
        <label for="deskripsi">Deskripsi</label>
        <textarea 
            name="deskripsi" 
            class="form-control" 
            id="deskripsi"
            placeholder="Masukkan deskripsi. Contohnya Anda bisa memasukkan cara pembayaran" 
            x-data 
            x-init="ClassicEditor
                    .create($refs.ckEditor).then( editor => {
                        editor.model.document.on('change:data', () => {
                            $dispatch('input', editor.getData());
                        });
                    }) 
                    .catch( error => {
                        console.error( error );
                    });
                    " 
            wire:key="ckEditor" 
            x-ref="ckEditor" 
            wire:model.debounce.9999999ms="deskripsi"
        >
        </textarea>
      </div>
    </div>

    <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-danger">Batal</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
