@extends('layouts.admin')

@section('title', "Detail Penggunaan")

@section('content')
  <div class="container">
    <h4 class="mb-4">Detail Penggunaan {{$usage->id}}</h4>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Penggunaan
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-4">ID</dt>
              <dd class="col-sm-8">{{$usage->id}}</dd>

              <dt class="col-sm-4">ID Pelanggan PLN</dt>
              <dd class="col-sm-8">{{$usage->id_pelanggan_pln}}</dd>

              <dt class="col-sm-4">Bulan</dt>
              <dd class="col-sm-8">{{$usage->bulan}}</dd>

              <dt class="col-sm-4">Tahun</dt>
              <dd class="col-sm-8">{{$usage->tahun}}</dd>

              <dt class="col-sm-4">Meter Awal</dt>
              <dd class="col-sm-8">{{$usage->meter_awal}}</dd>

              <dt class="col-sm-4">Meter Akhir</dt>
              <dd class="col-sm-8">{{$usage->meter_akhir}}</dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Pelanggan
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-4">Nama</dt>
              <dd class="col-sm-8">{{$usage->plnCustomer->nama_pelanggan}}</dd>

              <dt class="col-sm-4">Nomor Meter</dt>
              <dd class="col-sm-8">{{$usage->plnCustomer->nomor_meter}}</dd>

              <dt class="col-sm-4">Alamat</dt>
              <dd class="col-sm-8">{{$usage->plnCustomer->alamat}}</dd>

              <dt class="col-sm-4">Tarif</dt>
              <dd class="col-sm-8">{{$usage->plnCustomer->tariff->golongan_tarif}}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
@endpush