@extends('layouts.admin')

@section('title', "Detail $paymentMethod->nama")

@section('content')
  <div class="container">
    <h4 class="mb-4">{{$paymentMethod->nama}}</h4>
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Metode Pembayaran
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-12 col-md-3">Nama</dt>
              <dd class="col-12 col-md-9">{{$paymentMethod->nama}}</dd>

              <dt class="col-12 col-md-3">Gambar</dt>
              <dd class="col-12 col-md-9"><img src="{{Storage::url($paymentMethod->gambar)}}" alt="Logo {{$paymentMethod->nama}}" class="img-fluid img-thumbnail" width="120"></dd>

              <dt class="col-12 col-md-3">Slug</dt>
              <dd class="col-12 col-md-9">{{$paymentMethod->slug}}</dd>

              <dt class="col-12 col-md-3">Deskripsi</dt>
              <dd class="col-12 col-md-9">{!!$paymentMethod->deskripsi!!}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
@endpush