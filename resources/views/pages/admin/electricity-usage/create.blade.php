@extends('layouts.admin')

@section('title', 'Tambah Penggunaan')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Tambah Penggunaan</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.usage.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="selectPlnCustomer">ID Pelanggan</label>
          <select name="pln_customer_id" class="form-control selectpicker" data-live-search="true" id="selectPlnCustomer">
            <option selected>Pilih Pelanggan PLN</option>
            @foreach($customers as $customer)
              <option value="{{$customer->id}}">{{$customer->id . '. ' . $customer->nama_pelanggan}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="inputMeterAwal">Meter Awal</label>
          <input type="text" name="meter_awal" class="form-control" id="inputMeterAwal" placeholder="Masukkan meter awal"></input>
        </div>
        <div class="form-group">
          <label for="inputMeterAkhir">Meter Awal</label>
          <input type="text" name="meter_akhir" class="form-control" id="inputMeterAkhir" placeholder="Masukkan meter akhir"></input>
        </div>
        
        <div class="form-group">
          <label for="inputBulan">Bulan</label>
          <input type="text" class="form-control" id="inputBulan" value="{{now()->locale('id')->monthName}}">
        </div>

        <div class="form-group">
          <label for="inputTahun">Tahun</label>
          <input type="text" class="form-control" id="inputTahun" value="{{date('Y')}}">
        </div>
        
        <a href="{{route('admin.tariff.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<!-- Datepicker Bahasa Indonesia -->
<script src="{{ asset('assets/plugin/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
<script>
  $('#inputBulan').datepicker({
    language: "id",
    format: "MM",
    startView: 1,
    minViewMode: 1,
    maxViewMode: 1
  });

  $('#inputTahun').datepicker({
    language: "id",
    format: "yyyy",
    startView: 2,
    minViewMode: 2,
    maxViewMode: 2
  });
</script>
@endpush