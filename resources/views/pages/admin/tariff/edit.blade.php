@extends('layouts.admin')

@section('title', 'Edit Tarif')

@section('content')
  <div class="container">
    <h3 class="mb-4">Edit Tarif</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.tariffs.update', $tariff->id)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="golonganTarif">Golongan Tarif</label>
            <input type="text" name="golongan_tarif" class="form-control @error('golongan_tarif') is-invalid @enderror" id="golonganTarif" value="{{$tariff->golongan_tarif}}" placeholder="Masukkan golongan tarif">
            @error('golongan_tarif')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="inputDaya">Daya</label>
            <input type="number" step="50" name="daya" class="form-control @error('daya') is-invalid @enderror" id="inputDaya" value="{{$tariff->daya}}" placeholder="Masukkan daya">
            @error('daya')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="inputTarifPerKwh">Tarif Per KwH</label>
          <input type="number" step="any" name="tarif_per_kwh" class="form-control @error('tarif_per_kwh') is-invalid @enderror" id="inputTarifPerKwh" value="{{$tariff->tarif_per_kwh}}" placeholder="Masukkan tarif">
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