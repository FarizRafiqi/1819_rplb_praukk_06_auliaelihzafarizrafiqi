<div>
    <form method="POST" wire:submit.prevent="update">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputNamaMetodePembayaran">Nama</label>
                <input type="text" name="nama" class="form-control @error('nama')
                    is-invalid    
                @enderror" id="inputNamaMetodePembayaran" value="{{old('nama')}}" placeholder="Masukkan nama metode" wire:model="nama" autofocus="true">
                @error('nama')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            @if ($gambar)
            <div class="form-group col-md-12">
                <label for="imagePreview">Image Preview:</label> <br>
                <img src="{{ $gambar->temporaryUrl() }}" class="img-fluid" id="imagePreview" width="200px">
            </div>
            @endif
            <div class="form-group col-md-12">
                <label for="gambar">Gambar</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar" name="gambar" wire:model="gambar">
                    <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                    @error('gambar') <span class="invalid-feedback"> {{ $message }} </span> @enderror
                </div>
                <div wire:loading wire:target="gambar"><span class="spinner-border spinner-border-sm mb-1"></span></div>
            </div>
            <div class="form-group col-md-12">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi. Contohnya Anda bisa memasukkan cara pembayaran" wire:model="deskripsi"></textarea>
            </div>
        </div>
        <a href="{{route('admin.payment-methods.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        document.addEventListener('livewire:load', function(){
            ClassicEditor
            .create( document.querySelector( '#deskripsi' ) ).then(editor => { thisEditor = editor }) 
            .catch( error => {
                console.error( error );
            } );
        })
    </script>
</div>
