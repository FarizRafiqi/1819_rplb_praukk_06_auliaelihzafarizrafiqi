@extends('layouts.admin')

@section('title', 'Tambah Tarif')

@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah Tarif</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.tariff.store')}}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="golonganTarif">Golongan Tarif</label>
            <input type="text" name="golongan_tarif" class="form-control" id="golonganTarif" placeholder="Masukkan golongan tarif">
          </div>
          <div class="form-group col-md-6">
            <label for="inputDaya">Daya</label>
            <input type="number" name="daya" class="form-control" id="inputDaya" placeholder="Masukkan daya">
          </div>
        </div>
        <div class="form-group">
          <label for="inputTarifPerKwh">Tarif Per KwH</label>
          <input type="text" name="tarif_per_kwh" class="form-control" id="inputTarifPerKwh" placeholder="Masukkan tarif"></input>
        </div>
        <a href="{{route('admin.tariff.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script>

</script>
@endpush