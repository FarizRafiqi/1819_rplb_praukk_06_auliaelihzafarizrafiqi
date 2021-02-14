@extends('layouts.admin')

@section('title', 'Tambah User')
@push('addon-style')
  <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-select-1.13.9/css/bootstrap-select.min.css')}}">
@endpush
@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah User</h3>
    <div class="card">
      <div class="card-body">
      <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Masukkan nama">
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username">
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password"></input>
        </div>
        <div class="form-group">
          <label for="passwordConfirm">Konfirmasi Password</label>
          <input type="passwordConfirm" name="password" class="form-control" id="password" placeholder="Konfirmasi password"></input>
        </div>
        <div class="form-group">
          <label for="selectGolonganTarif">Level</label>
          <select name="tariff_id" class="form-control" id="selectGolonganTarif">
            <option selected>Pilih Level</option>
            <option value=""></option>
          </select>
        </div>
        <a href="{{route('admin.users.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
  <script src="{{asset('assets/plugin/bootstrap-select-1.13.9/js/bootstrap-select.min.js')}}"></script>
@endpush