@extends('layouts.admin')

@section('title', 'Edit Metode Pembayaran')
@push('addon-style')
    {{-- <link rel="stylesheet" href="{{asset('assets/plugin/filepond-master/dist/filepond.min.css')}}"> --}}
@endpush
@section('content')
  <div class="container">
    <h3 class="mb-4">Edit Metode Pembayaran</h3>
    <div class="card">
      <div class="card-body">
        @livewire('admin.payment-method.edit', ['paymentMethod' => $paymentMethod])
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
    {{-- <script src="{{asset('assets/plugin/filepond-master/dist/filepond.min.js')}}"></script> --}}
    <script src="{{asset('assets/plugin/ckeditor5-build-classic/ckeditor.js')}}"></script>
@endpush