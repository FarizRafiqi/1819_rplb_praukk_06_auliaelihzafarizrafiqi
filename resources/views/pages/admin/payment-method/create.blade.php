@extends('layouts.admin')

@section('title', 'Tambah Metode Pembayaran')
@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/plugin/filepond-master/dist/filepond.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugin/filepond-plugin-image-preview-master/dist/filepond-plugin-image-preview.min.css') }}">
@endpush
@section('content')
    <div class="container">
        <h3 class="mb-4">Tambah Metode Pembayaran</h3>
        <div class="card">
            <div class="card-body">
                @livewire('admin.payment-method.create')
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    {{-- <script src="{{asset('assets/plugin/filepond-master/dist/filepond.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugin/filepond-plugin-image-preview-master/dist/filepond-plugin-image-preview.min.js')}}"></script> --}}
    <script src="{{ asset('assets/plugin/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script>
        Livewire.on('alertSuccess', () => {
            Swal.fire({
                title: 'Metode pembayaran berhasil ditambahkan',
                icon: 'success',
            }).then(function() {
                window.location.href = "{{ route('admin.payment-methods.index') }}";
            });
        });

        // Register the plugin
        // FilePond.registerPlugin(FilePondPluginImagePreview);    
        // const inputElement = document.querySelector('input[type="file"]');
        // const pond = FilePond.create( inputElement );
        // FilePond.setOptions({
        //     server: {
        //       headers: {
        //         "X-CSRF-TOKEN": "{{ csrf_token() }}"
        //       },
        //       process: {
        //         url: "{{ route('upload.store') }}",
        //         method: "POST",
        //         onerror: null,
        //       },
        //       revert: {
        //         url: "{{ route('upload.destroy') }}",
        //         method: "DELETE",
        //         onerror: null,
        //       }
        //     }
        // });
    </script>
@endpush
