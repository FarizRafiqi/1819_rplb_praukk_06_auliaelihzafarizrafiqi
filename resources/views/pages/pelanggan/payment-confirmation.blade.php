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
              <dt class="col-md-12">ID Pelanggan</dt>
              <dd class="col-md-12">{{ $payment->plnCustomer->nomor_meter }}</dd>

              <dt class="col-md-12">Nama Lengkap</dt>
              <dd class="col-md-12">{{ $payment->plnCustomer->nama_pelanggan }}</dd>

              <dt class="col-md-12">Tarif / Daya</dt>
              <dd class="col-md-12">
                {{ $payment->plnCustomer->tariff->golongan_tarif . ' / ' . $payment->plnCustomer->tariff->daya . ' VA' }}
              </dd>

              <dt class="col-md-12">Virtual Account</dt>
              <dd class="col-md-12">
                {{ $transaction->va_numbers[0]->va_number ?? $transaction->bill_key }}
              </dd>

              <dt class="col-md-12">Metode Pembayaran</dt>
              <dd class="col-md-12">
                {{ $payment->paymentMethod->nama ?? '-' }}
              </dd>

              <dt class="col-md-12">Jumlah Tagihan</dt>
              <dd class="col-md-12">{{ $payment->details->count() }}</dd>

              <dt class="col-md-12">Periode</dt>
              <dd class="col-md-12">
                @if ($payment->details->count() > 1)
                  {{ optional($payment->details->first()->bill->usage)->month_name . '-' . optional($payment->details->last()->bill->usage)->month_name . ' ' . optional($payment->details->last()->bill->usage)->tahun }}
                @else
                  {{ optional($payment->details->first()->bill->usage)->month_name . ' ' . optional($payment->details->first()->bill->usage)->tahun }}
                @endif
              </dd>

              <dt class="col-md-12">Total Bayar</dt>
              <dd class="col-md-12">@rupiah($payment->total_bayar)</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        {{ $payment->bukti_bayar ? 'Bukti Pembayaran' : 'Upload Bukti Pembayaran' }}
      </div>
      <div class="card-body">
        @livewire('upload-receipt-of-payment', ['payment' => $payment, 'transaction' => $transaction])
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
  <script>
    Livewire.on('alertSuccess', () => {
      Swal.fire({
        title: 'Bukti Bayar berhasil diunggah',
        icon: 'success',
      }).then(function() {
        window.location.href = "{{ route('transaction-history') }}";
      });
    })
  </script>
@endpush
