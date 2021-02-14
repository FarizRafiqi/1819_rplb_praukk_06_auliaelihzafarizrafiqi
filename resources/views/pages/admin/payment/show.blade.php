@extends('layouts.admin')

@section('title', "Detail Pembayaran $payment->id")

@section('content')
  <div class="container container-detail mb-3">
    <div class="row">
      <div class="col-12 col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-title">
              Detail Pembayaran 
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-md-4">ID Pembayaran</dt>
              <dd class="col-md-8">{{$payment->id}}</dd>

              <dt class="col-md-4">ID Tagihan</dt>
              <dd class="col-md-8">{{$payment->bill->id}}</dd>

              <dt class="col-md-4">Nama Customer</dt>
              <dd class="col-md-8">{{$payment->user->nama}}</dd>

              <dt class="col-md-4">Nama Pelanggan PLN</dt>
              <dd class="col-md-8">{{$payment->plnCustomer->nama_pelanggan}}</dd>

              <dt class="col-md-4">BL/TH</dt>
              <dd class="col-md-8">{{$payment->bill->bulan . "/" . $payment->bill->tahun}}</dd>

              <dt class="col-md-4">Tanggal Bayar</dt>
              <dd class="col-md-8">{{$payment->tanggal_bayar}}</dd>

              <dt class="col-md-4">Stand Meter</dt>
              <dd class="col-md-8">{{$payment->bill->usage->meter_akhir . "-" . $payment->bill->usage->meter_awal}}</dd>

              <dt class="col-md-4">Biaya Admin</dt>
              <dd class="col-md-8">{{$payment->formatted_biaya_admin}}</dd>

              <dt class="col-md-4">Denda</dt>
              <dd class="col-md-8">{{$payment->formatted_denda}}</dd>

              <dt class="col-md-4">Total Bayar</dt>
              <dd class="col-md-8">Rp {{$totalBayar}}</dd>

              <dt class="col-md-4">Metode Pembayaran</dt>
              <dd class="col-md-8">-</dd>

              <dt class="col-md-4">Status</dt>
              <dd class="col-md-8">
                <span class="badge pill-badge badge-success p-1">{{$payment->status}}</span>
              </dd>
            </dl>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Tagihan
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-md-4">ID Tagihan</dt>
              <dd class="col-md-8">{{$payment->bill->id}}</dd>

              <dt class="col-md-4">ID Penggunaan</dt>
              <dd class="col-md-8">{{$payment->bill->id}}</dd>

              <dt class="col-md-4">Bulan</dt>
              <dd class="col-md-8">{{$payment->bill->bulan}}</dd>

              <dt class="col-md-4">Tahun</dt>
              <dd class="col-md-8">{{$payment->bill->tahun}}</dd>

              <dt class="col-md-4">Jumlah KwH</dt>
              <dd class="col-md-8">{{$payment->bill->jumlah_kwh}}</dd>

              <dt class="col-md-4">Status</dt>
              <dd class="col-md-8">{{$payment->bill->status}}</dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-title">
              Detail Pelanggan PLN
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-md-4">ID Pelanggan</dt>
              <dd class="col-md-8">{{$payment->plnCustomer->id}}</dd>

              <dt class="col-md-4">Nama</dt>
              <dd class="col-md-8">{{$payment->plnCustomer->nama_pelanggan}}</dd>

              <dt class="col-md-4">No. Meter</dt>
              <dd class="col-md-8">{{$payment->plnCustomer->nomor_meter}}</dd>

              <dt class="col-md-4">Alamat</dt>
              <dd class="col-md-8">{{$payment->plnCustomer->alamat}}</dd>

              <dt class="col-md-4">Tarif/Daya</dt>
              <dd class="col-md-8">
                {{$payment->plnCustomer->tariff->golongan_tarif}} / 
                {{$payment->plnCustomer->tariff->formatted_daya}}
              </dd>
            </dl>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Penggunaan
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-md-4">ID Penggunaan</dt>
              <dd class="col-md-8">{{$payment->bill->usage->id}}</dd>

              <dt class="col-md-4">ID Pelanggan PLN</dt>
              <dd class="col-md-8">{{$payment->bill->usage->id_pelanggan_pln}}</dd>

              <dt class="col-md-4">Bulan</dt>
              <dd class="col-md-8">{{$payment->bill->usage->bulan}}</dd>

              <dt class="col-md-4">Tahun</dt>
              <dd class="col-md-8">{{$payment->bill->usage->tahun}}</dd>

              <dt class="col-md-4">Meter Awal</dt>
              <dd class="col-md-8">{{$payment->bill->usage->meter_awal}}</dd>

              <dt class="col-md-4">Meter Akhir</dt>
              <dd class="col-md-8">{{$payment->bill->usage->meter_akhir}}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
@endpush