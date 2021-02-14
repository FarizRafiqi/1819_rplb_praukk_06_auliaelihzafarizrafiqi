@extends('layouts.admin')

@section('title', 'Penggunaan')

@section('content')
<div class="container mb-3">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Perhatian!</strong> data yang digunakan dibawah ini adalah data bohongan semua. Dan kemungkinan besar data-datanya tidak saling berhubungan sama sekali, karena dibuat secara acak.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="d-flex justify-content-between mb-4">
    <h3>Penggunaan Listrik</h3>
    <a href="{{route('admin.usage.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100"  id="usages">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Pelanggan</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Meter Awal</th>
          <th>Meter Akhir</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script>
    $('#usages').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'id_pelanggan_pln'},
            {data: 'bulan'},
            {data: 'tahun'},
            {data: 'meter_awal'},
            {data: 'meter_akhir'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush