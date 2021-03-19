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
        @livewire('payment-methods.edit', ['paymentMethod' => $paymentMethod])
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
    <script src="{{asset('assets/plugin/filepond-master/dist/filepond.min.js')}}"></script>
    <script src="{{asset('assets/plugin/ckeditor5-build-classic/ckeditor.js')}}"></script>
    <script>
        Livewire.on('initializeCkEditor', function(e){
            ClassicEditor
            .create( document.querySelector( '#deskripsi' ) ).then(editor => { thisEditor = editor }) 
            .catch( error => {
                console.error( error );
            } );
        });
        // const inputElement = document.querySelector('input[type="file"]');
        // const pond = FilePond.create( inputElement );
        // FilePond.setOptions({
        //     server: {
        //       url: "{{route('upload.store')}}",
        //       headers: {
        //         "X-CSRF-TOKEN": "{{csrf_token()}}"
        //       }
        //     }
        // });
    </script>
@endpush