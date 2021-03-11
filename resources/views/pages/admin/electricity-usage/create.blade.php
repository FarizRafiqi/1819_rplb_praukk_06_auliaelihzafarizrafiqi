@extends('layouts.admin')

@section('title', 'Tambah Penggunaan')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Tambah Penggunaan</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.usages.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="selectPlnCustomer">ID Pelanggan</label>
          <select name="id_pelanggan_pln" class="form-control selectpicker @error('id_pelanggan_pln')
              is-invalid
          @enderror" data-live-search="true" id="selectPlnCustomer">
            <option selected disabled>Pilih Pelanggan PLN</option>
            @foreach($customers as $customer)
              <option value="{{$customer->id}}" {{old('id_pelanggan_pln') == $customer->id ? 'selected' : ''}}>
                {{$customer->id . '. ' . $customer->nama_pelanggan}}
              </option>
            @endforeach
          </select>
          @error('id_pelanggan_pln')
              <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputMeterAwal">Meter Awal</label>
          <input type="text" name="meter_awal" class="form-control @error('meter_awal')
              is-invalid
          @enderror" id="inputMeterAwal" value="{{old('meter_awal')}}" placeholder="Masukkan meter awal">
          @error('meter_awal')
            <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputMeterAkhir">Meter Akhir</label>
          <input type="text" name="meter_akhir" class="form-control @error('meter_akhir')
              
          @enderror" id="inputMeterAkhir" value="{{old('meter_akhir')}}" placeholder="Masukkan meter akhir">
          @error('meter_akhir')
            <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputBulan">Bulan</label>
          <input type="text" name="bulan" class="form-control @error('bulan')
              is-invalid
          @enderror" id="inputBulan" value="{{now()->locale('id')->monthName}}">
          @error('bulan')
            <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTahun">Tahun</label>
          <input type="text" name="tahun" class="form-control @error('tahun')
              is-invalid
          @enderror" id="inputTahun" value="{{now()->year}}">
          @error('tahun')
            <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </div>
        
        <a href="{{route('admin.usages.index')}}" class="btn btn-danger">Batal</a>
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

  $("#selectPlnCustomer").on("change", function(){
    let idPelanggan = $(this).val();
    $.ajax({
      url: "",
      data: {id_pelanggan: idPelanggan},
      dataType: "json",
      success: function(data){
        $("#inputMeterAwal").val(data);
      },
      error: function(xhr){
        console.log(xhr.responseJSON);
      }
    });
  });
</script>
@endpush