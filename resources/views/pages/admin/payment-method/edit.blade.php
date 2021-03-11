@extends('layouts.admin')

@section('title', 'Edit Metode Pembayaran')
@push('addon-style')
    <link rel="stylesheet" href="{{asset('assets/plugin/filepond-master/dist/filepond.min.css')}}">
@endpush
@section('content')
  <div class="container">
    <h3 class="mb-4">Edit Metode Pembayaran</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.payment-methods.update', $paymentMethod->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputNamaMetodePembayaran">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama')
            is-invalid    
            @enderror" id="inputNamaMetodePembayaran" value="{{$paymentMethod->nama}}" placeholder="Masukkan nama metode">
            @error('nama')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-12">
            <label for="gambar">Gambar</label>
            <input type="file" class="filepond" id="gambar" name="gambar" value="{{$paymentMethod->gambar}}">
          </div>
          <div class="form-group col-md-12">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi. Contohnya Anda bisa memasukkan cara pembayaran">{{$paymentMethod->deskripsi}}</textarea>
          </div>
        </div>
        <a href="{{route('admin.payment-methods.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
    <script src="{{asset('assets/plugin/filepond-master/dist/filepond.min.js')}}"></script>
    <script src="{{asset('assets/plugin/ckeditor5-build-classic/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
          .create( document.querySelector( '#deskripsi' ) )
          .catch( error => {
              console.error( error );
          } );
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create( inputElement );
        FilePond.setOptions({
            server: {
              url: "{{route('upload.store')}}",
              headers: {
                "X-CSRF-TOKEN": "{{csrf_token()}}"
              }
            }
        });
    </script>
@endpush