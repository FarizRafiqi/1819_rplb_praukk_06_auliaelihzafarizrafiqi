@extends('layouts.admin')

@section('title', 'Edit Pelanggan')

@section('content')
  <div class="container">
    <h3 class="mb-4">Edit Pelanggan</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.pln-customers.update', $plnCustomer->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control" id="inputNama" placeholder="Masukkan nama" value="{{$plnCustomer->nama_pelanggan}}">
          </div>
          <div class="form-group col-md-6">
            <label for="inputNoMeter">No. Meter / ID Pelanggan</label>
            <input type="text" name="nomor_meter" class="form-control" id="inputNoMeter" placeholder="Contoh: 537320018426" value="{{$plnCustomer->nomor_meter}}">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlamat">Alamat</label>
          <textarea name="alamat" class="form-control" id="inputAlamat" placeholder="Masukkan alamat">{{$plnCustomer->alamat}}</textarea>
        </div>
        <div class="form-group">
          <label for="selectGolonganTarif">Golongan Tarif</label>
          <select name="tariff_id" class="form-control" id="selectGolonganTarif">
            <option selected>Pilih Golongan Tarif</option>
            @foreach($tariffs as $tariff)
              <option value="{{$tariff->id}}" {{$tariff->id == $plnCustomer->id_tarif ? 'selected' : ''}}>{{$tariff->golongan_tarif}}</option>
            @endforeach
          </select>
        </div>
        <a href="{{route('admin.pln-customers.index')}}" class="btn btn-danger">Batal</a>
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