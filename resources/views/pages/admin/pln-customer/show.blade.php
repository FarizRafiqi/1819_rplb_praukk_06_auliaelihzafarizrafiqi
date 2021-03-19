@extends('layouts.admin')

@section('title', "Detail Pelanggan $plnCustomer->nama_pelanggan")

@section('content')
  <div class="container">
    <h4 class="mb-4">{{$plnCustomer->nama_pelanggan}}</h4>
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Pelanggan
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-3">Nama</dt>
              <dd class="col-sm-9">{{$plnCustomer->nama_pelanggan}}</dd>

              <dt class="col-sm-3">Nomor Meter</dt>
              <dd class="col-sm-9">{{$plnCustomer->nomor_meter}}</dd>

              <dt class="col-sm-3">Alamat</dt>
              <dd class="col-sm-9">{{$plnCustomer->alamat}}</dd>

              <dt class="col-sm-3">Kota</dt>
              <dd class="col-sm-9">{{$plnCustomer->city->name}}</dd>

              <dt class="col-sm-3">Tarif / Daya</dt>
              <dd class="col-sm-9">{{$plnCustomer->tariff->golongan_tarif . '/' . $plnCustomer->tariff->daya . ' VA'}}</dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 mt-3 mt-md-0">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Golongan Tarif
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-3">Gol. Tarif</dt>
              <dd class="col-sm-9">{{$plnCustomer->tariff->golongan_tarif}}</dd>

              <dt class="col-sm-3">Daya</dt>
              <dd class="col-sm-9">{{$plnCustomer->tariff->daya . ' VA'}}</dd>

              <dt class="col-sm-3">Tarif Per KwH</dt>
              <dd class="col-sm-9">{{$plnCustomer->tariff->formatted_tarif_per_kwh}}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
@endpush