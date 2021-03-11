@extends('layouts.admin')

@section('title', 'Tambah Metode Pembayaran')
@push('addon-style')
    <link rel="stylesheet" href="{{asset('assets/plugin/filepond-master/dist/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/filepond-plugin-image-preview-master/dist/filepond-plugin-image-preview.min.css')}}">
@endpush
@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah Metode Pembayaran</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.payment-methods.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputNamaMetodePembayaran">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama')
            is-invalid    
            @enderror" id="inputNamaMetodePembayaran" value="{{old('nama')}}" placeholder="Masukkan nama metode">
            @error('nama')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-12">
            <label for="gambar">Gambar</label>
            <input type="file" class="filepond" id="gambar" name="gambar">
          </div>
          <div class="form-group col-md-12">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi. Contohnya Anda bisa memasukkan cara pembayaran"></textarea>
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
  <script src="{{asset('assets/plugin/filepond-plugin-image-preview-master/dist/filepond-plugin-image-preview.min.js')}}"></script>
  <script src="{{asset('assets/plugin/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script>
      ClassicEditor
        .create( document.querySelector( '#deskripsi' ) )
        .catch( error => {
            console.error( error );
        } );
      // Register the plugin
      FilePond.registerPlugin(FilePondPluginImagePreview);    
      const inputElement = document.querySelector('input[type="file"]');
      const pond = FilePond.create( inputElement );
      FilePond.setOptions({
          server: {
            headers: {
              "X-CSRF-TOKEN": "{{csrf_token()}}"
            },
            process: {
              url: "{{route('upload.store')}}",
              method: "POST",
              onerror: null,
            },
            revert: {
              url: "{{route('upload.destroy')}}",
              method: "DELETE",
              onerror: null,
            }
          }
      });
  </script>
@endpush