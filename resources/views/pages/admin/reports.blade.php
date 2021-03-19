@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
  <div class="container container-report">
    <div class="card">
      <div class="card-body">
        <div class="mb-2 mb-md-4 font-weight-bold" style="font-size: 1.5rem;">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
            <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
          </svg>
          Laporan Pembayaran
        </div>
        <form action="{{route('admin.reports.payment')}}" class="form-row" method="POST">
          @csrf
          <h4 class="mb-2">Cetak Data Per Tanggal</h4>
          <div class="col-12 col-md-10 mb-2 mb-md-4">
            <div class="input-daterange input-group" id="datepicker">
              <input type="text" class="form-control" name="print_per_date[tanggal_awal]" autocomplete="off"/>
              <span class="input-group-addon">sampai</span>
              <input type="text" class="form-control" name="print_per_date[tanggal_akhir]" autocomplete="off"/>
            </div>
            <div class="row">
              @error('print_per_date.tanggal_awal')
                  <div class="col-md-6">
                    <span class="text-danger">{{$message}}</span>
                  </div>
              @enderror
              @error('print_per_date.tanggal_akhir')
                  <div class="col-md-6 pl-5">
                    <span class="text-danger">{{$message}}</span>
                  </div>
              @enderror
            </div>
          </div>
          <div class="col-12 col-md-2 mb-2 mb-md-4">
            <button class="btn btn-primary btn-block" name="action" value="print_per_date">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-printer-fill mr-1" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              </svg>
              Cetak
            </button>
          </div>
          <div class="col-12 col-md-10 mb-2 mb-md-4">
            <h4>Hari ini</h4>
          </div>
          <div class="col-12 col-md-2 mb-2 mb-md-4">
            <button class="btn btn-primary btn-block" name="action" value="today_report">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-printer-fill mr-1" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              </svg>
              Cetak
            </button>
          </div>

          <div class="col-12 col-md-10 mb-2 mb-md-4">
            <h4>Bulan ini</h4>
          </div>
          <div class="col-12 col-md-2 mb-2 mb-md-4">
            <button class="btn btn-primary btn-block" name="action" value="this_month_report">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-printer-fill mr-1" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              </svg>
              Cetak
            </button>
          </div>

          <div class="col-12 col-md-10 mb-2 mb-md-4">
            <h4>Bulan lalu</h4>
          </div>
          <div class="col-12 col-md-2 mb-2 mb-md-4">
            <button class="btn btn-primary btn-block" name="action" value="last_month_report">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-printer-fill mr-1" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              </svg>
              Cetak
            </button>
          </div>
          <div class="col-md-3 form-group">
            <label for="selectPaymentStatus">Status Pembayaran</label>
            <select name="status" class="form-control selectpicker @error('payment_status')
                is-invalid
            @enderror" id="selectPaymentStatus">
              <option value="*" selected>semua</option>
              @foreach(config('enum.payment_status') as $status)
                <option value="{{$status}}" {{old('payment_status') == $status ? 'selected' : ''}}>
                  {{$status}}
                </option>
              @endforeach
            </select>
            @error('payment_status')
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
  <!-- Datepicker Bahasa Indonesia -->
  <script src="{{ asset('assets/plugin/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
  <script>
    $("#datepicker").datepicker({
      language: "id",
      todayHighlight: true,
      autoclose: true,
      clearBtn: true,
      format: "dd-mm-yyyy"
    });
  </script>
@endpush