@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- Revenue Overview -->
    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 m-lg-0">
      <div class="card card-overview">
        <div class="card-body">
          <div class="row align-items-center h-100">
            <div class="col-3">
              <img src="{{ asset('assets/img/mm-icon/revenue-icon@2x.png') }}" alt="Payment Icon" width="65" height="65">
            </div>
            <div class="col-9">
              <h4 class="font-weight-bold">{{$totalPendapatan}}</h4>
              Pendapatan
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Revenue Overview -->

    <!-- Total Payment Overview -->
    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 m-lg-0">
      <div class="card card-overview">
        <div class="card-body">
          <div class="row align-items-center h-100">
            <div class="col-3">
              <img src="{{ asset('assets/img/mm-icon/payment-icon@2x.png') }}" alt="Payment Icon" width="65" height="65">
            </div>
            <div class="col-9">
              <h4 class="font-weight-bold">{{$payments->count()}}</h4>
              Total pembayaran
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Total Payment Overview -->

    <!-- Bill Paid Off Overview -->
    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 m-lg-0">
      <div class="card card-overview">
        <div class="card-body">
          <div class="row align-items-center h-100">
            <div class="col-3">
              <img src="{{ asset('assets/img/mm-icon/bill-paid-off-icon@2x.png') }}" alt="Payment Icon" width="65" height="65">
            </div>
            <div class="col-9">
              <h4 class="font-weight-bold">{{$bills->where('status', 'LUNAS')->count()}}</h4>
              Tagihan listrik lunas
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Bill Paid Off Overview -->

    <!-- Bill Not Paid Off Overview -->
    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 m-lg-0">
      <div class="card card-overview">
        <div class="card-body">
          <div class="row align-items-center h-100">
            <div class="col-3">
              <img src="{{ asset('assets/img/mm-icon/bill-not-paid-off-icon@2x.png') }}" alt="Payment Icon" width="65" height="65">
            </div>
            <div class="col-9">
              <h4 class="font-weight-bold">{{$bills->where('status', 'BELUM LUNAS')->count()}}</h4>
              Tagihan listrik belum lunas
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Bill Not Paid Off Overview -->
  </div>
</div>
@endsection