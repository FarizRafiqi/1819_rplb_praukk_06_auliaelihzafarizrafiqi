@extends('layouts.admin')

@section('title', 'Penggunaan')

@push('addon-style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container">
  <div class="d-flex justify-content-between mb-4">
    <h3>Penggunaan Listrik</h3>
    <a href="{{route('admin.usage.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered" style="width:100%" id="usages">
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
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'pln_customer_id'},
            {data: 'bulan'},
            {data: 'tahun'},
            {data: 'meter_awal'},
            {data: 'meter_akhir'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush