<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Riwayat Transaksi</title>
  @include('includes.style')
  <!-- fontawesome -->
  <script src="{{asset('assets/plugin/fontawesome/all.js')}}"></script>
</head>
<body>
  @include('includes.navbar')
  <div class="container pt-5">
    <h1 class="mb-5">Riwayat Transaksi</h1>
    <div class="card w-50">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div>30 Hari Terakhir</div>
        <div>
          <button class="btn btn-primary-custom">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
              <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
            </svg>
            Filter
          </button>
        </div>
      </div>
      <ul class="list-group list-group-flush">
        @forelse ($userPayments as $payment)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <i class="bi bi-lightning-fill mr-1" style="font-size: 20px"></i> Pembayaran Tagihan {{$payment->bill->bulan}} {{$payment->bill->tahun}}
            <span class="badge badge-{{($payment->bill->status == 'success') ? 'success' : 'danger'}} badge-pill ml-auto">{{$payment->bill->status}}</span>
          </li>
        @empty
          <li class="list-group-item">Tidak ada riwayat tagihan</li>
        @endforelse
      </ul>
    </div>
  </div>
  @include('includes.script')
</body>
</html>