@extends('layouts.admin')

@section('title', "Detail Pembayaran $payment->id")

@section('content')
  <div class="container container-detail mb-3">
    <div class="row">
      <div class="col-12 col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-title">
              Pembayaran 
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-md-4">ID</dt>
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
              <dd class="col-md-8">{{$payment->paymentMethod->nama ?? '-'}}</dd>

              <dt class="col-md-4">Status</dt>
              <dd class="col-md-8">
                @switch($payment->status)
                    @case('success')
                        <span class="badge pill-badge badge-success p-1">{{$payment->status}}</span>
                        @break
                    @case('pending')
                        <span class="badge pill-badge badge-warning p-1">{{$payment->status}}</span>
                        @break
                    @case('failed')
                        <span class="badge pill-badge badge-danger p-1">{{$payment->status}}</span>
                        @break
                    @default
                        
                @endswitch
              </dd>
              <dt class="col-md-4">Staff Bank</dt>
              <dd class="col-md-8">{{$payment->bank->nama ?? '-'}}</dd>
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
              <dt class="col-md-4">ID</dt>
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
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Pembayaran 
            </h5>
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered table-hover w-100" id="paymentDetails">
              <thead>
                <tr>
                  <td>ID</td>
                  <td>ID Pembayaran</td>
                  <td>ID Tagihan</td>
                  <td>Denda</td>
                  <td>PPN</td>
                  <td>PPJ</td>
                  <td>Total Tagihan</td>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script>
  $('#paymentDetails').DataTable({
      responsive: true,
      serverSide: true,
      ajax: "",
      columns: [
          {data: 'id'},
          {data: 'id_pembayaran'},
          {data: 'id_tagihan'},
          {data: 'denda',
           render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
          },
          {data: 'ppn',
           render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
          },
          {data: 'ppj',
           render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
          },
          {data: 'total_tagihan',
           render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
          },
      ]
  });
</script>
@endpush