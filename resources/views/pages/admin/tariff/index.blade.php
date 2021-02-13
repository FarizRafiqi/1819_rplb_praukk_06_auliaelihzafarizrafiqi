@extends('layouts.admin')

@section('title', 'Tarif')

@push('addon-style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container">
  <div class="d-flex justify-content-between mb-4"> 
    <h3>Tarif</h3>
    <a href="{{route('admin.tariff.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered" style="width:100%" id="tariffs">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Golongan Tarif</th>
            <th>Daya</th>
            <th>Tarif Per Kwh</th>
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
    $('#tariffs').DataTable({
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'golongan_tarif'},
            {data: 'daya'},
            {data: 'tarif_per_kwh'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush