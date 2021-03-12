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
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="card">
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
              @foreach ($payment->details as $detail)
                <li class="list-group-item">
                  <a href="{{route("transaction-history.details", ["payment" => $payment->id])}}" class="d-flex justify-content-between align-items-center text-decoration-none text-dark">
                    <i class="bi bi-lightning-fill mr-1" style="font-size: 20px"></i> Pembayaran Tagihan {{$detail->bill->bulan}} {{$detail->bill->tahun}}
                    <span class="badge badge-{{($detail->bill->status == 'success') ? 'success' : 'danger'}} badge-pill ml-auto">{{$detail->bill->status}}</span>
                  </a>
                </li>
              @endforeach
            @empty
              <li class="list-group-item">Tidak ada riwayat tagihan</li>
            @endforelse
          </ul>
        </div>
      </div>
      <div class="col-12 mt-4 mt-md-0 col-md-6">
        @if(request()->payment)
          <div class="card">
            <div class="card-header">Detail Pembayaran {{request()->payment}}</div>
            <div class="card-body">
              <dl class="row">
                <dt class="col-md-4">ID Pembayaran</dt>
                <dd class="col-md-8">{{$payment->id}}</dd>
  
                <dt class="col-md-4">Nama Customer</dt>
                <dd class="col-md-8">{{$payment->customer->nama}}</dd>
  
                <dt class="col-md-4">Nama Pelanggan PLN</dt>
                <dd class="col-md-8">{{$payment->plnCustomer->nama_pelanggan}}</dd>
  
                <dt class="col-md-4">Tanggal Bayar</dt>
                <dd class="col-md-8">{{$payment->tanggal_bayar}}</dd>
  
                <dt class="col-md-4">Biaya Admin</dt>
                <dd class="col-md-8">@rupiah($payment->biaya_admin)</dd>
  
                <dt class="col-md-4">Total Bayar</dt>
                <dd class="col-md-8">@rupiah($payment->total_bayar)</dd>
  
                <dt class="col-md-4">Metode Pembayaran</dt>
                <dd class="col-md-8">{{$payment->paymentMethod->nama ?? "-"}}</dd>
  
                <dt class="col-md-4">Status</dt>
                <dd class="col-md-8">
                  @switch($payment->status)
                      @case('success')
                          <span class="badge pill-badge badge-success p-1">{{$payment->status}}</span>
                          @break
                      @case('pending')
                          <span class="badge pill-badge badge-warning p-1">Menunggu Pembayaran</span>
                          @break
                      @case('failed')
                          <span class="badge pill-badge badge-danger p-1">{{$payment->status}}</span>
                          @break
                      @default
                          
                  @endswitch
                </dd>
              </dl>
            </div>
          </div>
        @else
            
        @endif
      </div>
    </div>
  </div>
  @include('includes.script')
</body>
</html>