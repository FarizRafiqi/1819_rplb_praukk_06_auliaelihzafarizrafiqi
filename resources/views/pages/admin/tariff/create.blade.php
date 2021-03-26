@extends('layouts.admin')

@section('title', 'Tambah Tarif')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Tambah Tarif</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.tariffs.store')}}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="golonganTarif">Golongan Tarif <span class="text-danger">*</span></label>
            <input type="text" name="golongan_tarif" class="form-control @error('golongan_tarif') is-invalid @enderror" id="golonganTarif" placeholder="Masukkan golongan tarif">
            @error('golongan_tarif')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="inputDaya">Daya <span class="text-danger">*</span></label>
            <input type="number" step="50" name="daya" class="form-control @error('daya') is-invalid @enderror" id="inputDaya" placeholder="Masukkan daya">
            @error('daya')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="inputTarifPerKwh">Tarif Per KwH <span class="text-danger">*</span></label>
          <input type="number" step="any" name="tarif_per_kwh" class="form-control @error('tarif_per_kwh') is-invalid @enderror" id="inputTarifPerKwh" placeholder="Masukkan tarif">
          @error('tarif_per_kwh')
              <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <a href="{{route('admin.tariffs.index')}}" class="btn btn-danger mr-1">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection