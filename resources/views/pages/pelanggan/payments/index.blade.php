@extends('layouts.app')

@section('title', 'MegaMendung - Semua serba bisa')

@section('content')
  <div class="container container-payment">
    <h3 class="my-4">Pilih Metode Pembayaran</h3>
    <div class="row">
      <div class="col-12 col-md-7 col-lg-8 order-2 order-md-1 mt-3 mt-md-0">
        <div class="card card-details">
          <div class="card-body">
            <ul class="list-group list-payment-method">
              <h5>Virtual Account</h5>
              @foreach ($paymentMethods as $paymentMethod)
                <li class="list-group-item">
                  <form action="{{ route('payment.process', ['payment_method' => $paymentMethod->slug,'payment' => $payment->id]) }}" method="POST" class="d-flex align-items-center text-dark">
                    @csrf
                    {{$paymentMethod->nama}}
                    <img src="{{Storage::url($paymentMethod->gambar)}}" class="img-fluid ml-auto" alt="logo-bank" width="40px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right ml-2" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                  </form>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-5 col-lg-4 order-1 order-md-2">
        <div class="card">
          <div class="card-header bg-pacific-blue">
            <h5>Informasi Pelanggan</h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-12">Nama Lengkap</dt>
              <dd class="col-12">{{$payment->plnCustomer->nama_pelanggan}}</dd>
            
              <dt class="col-12">No. Meter / ID Pelanggan</dt>
              <dd class="col-12">
                {{$payment->plnCustomer->nomor_meter}}
              </dd>
            
              <dt class="col-12">Tarif / Daya</dt>
              <dd class="col-12">{{$payment->plnCustomer->tariff->golongan_tarif . ' / ' . $payment->plnCustomer->tariff->daya . ' VA'}}</dd>
            
              <dt class="col-12">Jumlah Tagihan</dt>
              <dd class="col-12">{{$payment->details->count()}}</dd>
            </dl>
          </div>
        </div>

        <div class="card mt-3">
          <div class="card-header bg-pacific-blue">
            <h5>Informasi Tagihan</h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-12">Periode</dt>
              <dd class="col-12">
                @if ($payment->details->count() > 1)
                  {{$payment->details->first()->bill->month_name . '-' . $payment->details->last()->bill->month_name . ' ' .$payment->details->first()->bill->tahun}}
                @else
                  {{$payment->details->first()->bill->month_name . ' ' .$payment->details->first()->bill->tahun}}
                @endif
              </dd>

              <dt class="col-12">Total Tagihan</dt>
              <dd class="col-12">
                @rupiah($payment->details->sum('total_tagihan'))
              </dd>

              <dt class="col-12">Biaya Admin</dt>
              <dd class="col-12">
                @rupiah($payment->biaya_admin)
              </dd>

              <dt class="col-12">Total Bayar</dt>
              <dd class="col-12">
                <span class="pacific-blue font-weight-bold">@rupiah($payment->total_bayar)</span>
              </dd>
              <a class="text-decoration-none col-12" data-toggle="collapse" href="#detail">detail</a>
            </dl>

            <div class="card collapse mt-2" id="detail">
              <div class="card-body">
                @foreach ($payment->details as $index => $detail)
                  <h5>Tagihan {{$detail->bill->month_name . ' ' . $detail->bill->tahun}}</h5>
                  <div class="row">
                    <dt class="col-md-5">Jumlah KwH</dt>
                    <dd class="col-md-7">
                        {{$detail->bill->jumlah_kwh}}
                    </dd>
                    <dt class="col-md-5">PPJ</dt>
                    <dd class="col-md-7">
                        @rupiah($detail->ppj)
                    </dd>
                    <dt class="col-md-5">PPN</dt>
                    <dd class="col-md-7">
                        @rupiah($detail->ppn)
                    </dd>
                    <dt class="col-md-5">Denda</dt>
                    <dd class="col-md-7">
                        @rupiah($detail->denda)
                    </dd>

                    <dt class="col-md-5">Total Tagihan</dt>
                    <dd class="col-md-7">
                        @rupiah($detail->total_tagihan)
                    </dd>
                  </div>
                  @if($loop->odd && $loop->iteration > 1)
                      <hr>
                  @endif
                @endforeach
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
@push('addon-script')
    <script>
      $(".list-group-item").on("click", function(){
        $(this).find("form").submit();
      })
    </script>
@endpush