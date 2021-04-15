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
                <img src="{{ $gambar }}" class="img-fluid img-thumbnail" id="imagePreview" width="200px">
            </div>
            @endif
            <div class="form-group col-md-12">
                <label for="gambar">Gambar</label>
                <div wire:loading wire:target="gambar">
                    <span class="spinner-border spinner-border-sm mb-1"></span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar" name="gambar" wire:model="gambar">
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
                    x-init="
                        ClassicEditor
                        .create($refs.ckEditor).then(editor => {
                            editor.model.document.on('change:data', function(e){
                                $dispatch('input', editor.getData());
                            });
                        }) 
                        .catch( error => {
                            console.error( error );
                        } );
                    " 
                    wire:key="ckEditor" 
                    x-ref="ckEditor" 
                    wire:model.debounce.9999ms="deskripsi"
                >
                {!!$deskripsi!!}
                </textarea>
            </div>
        </div>
        <a href="{{route('admin.payment-methods.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@push('addon-script')
    {{-- <script src="{{asset('assets/plugin/filepond-master/dist/filepond.min.js')}}"></script> --}}
    <script>
        Livewire.on('alertSuccess', () => {
            Swal.fire({
                title: 'Metode pembayaran berhasil diubah',
                icon: 'success'
            }).then(function(){
                window.location.href = "{{route('admin.payment-methods.index')}}";
            });
        });
    </script>
@endpush
