@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
  <div class="container pt-5">
    <div class="accordion mt-4" id="accordionDetailTagihan">
      <div class="card my-3">
        <div class="card-header" data-toggle="collapse" data-target="#infoTransaksi" style="cursor: pointer">
          Informasi Transaksi
        </div>
        <div class="collapse" id="infoTransaksi" data-parent="#accordionDetailTagihan">
          <div class="card-body">
            <dl class="row">
              {{-- <dt class="col-md-5">Virtual Account</dt>
              <dd class="col-md-7">
                {{$transactionDetail->va_numbers[0]->va_number ?? $transactionDetail->bill_key}}
              </dd> --}}
      
              <dt class="col-md-12">ID Pelanggan</dt>
              <dd class="col-md-12">{{$payment->plnCustomer->nomor_meter}}</dd>
  
              <dt class="col-md-12">Nama Lengkap</dt>
              <dd class="col-md-12">{{$payment->plnCustomer->nama_pelanggan}}</dd>
      
              <dt class="col-md-12">Tarif / Daya</dt>
              <dd class="col-md-12">{{$payment->plnCustomer->tariff->golongan_tarif . " / " . $payment->plnCustomer->tariff->daya . " VA"}}</dd>

              <dt class="col-md-12">Jumlah Tagihan</dt>
              <dd class="col-md-12">{{$payment->details->count()}}</dd>

              <dt class="col-md-12">Jumlah Tagihan</dt>
              <dd class="col-md-12">{{$payment->details->count()}}</dd>

              {{-- @if ($usages->count() > 1)
									{{ optional($usages->first())->month_name . '-' . optional($usages->last())->month_name. ' ' . optional($usages->first())->tahun}}
								@else
									{{ optional($usages->first())->month_name . ' ' . optional($usages->first())->tahun }}
								@endif --}}
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection