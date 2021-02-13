@extends('layouts.admin')

@section('title', 'Pelanggan PLN')

@push('addon-style')
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container">
  <div class="d-flex justify-content-between mb-4">
    <h3>Pelanggan PLN</h3>
    <a href="{{route('admin.pln-customers.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered" style="width:100%" id="customers">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Nomor Meter</th>
            <th>Alamat</th>
            <th>Tarif</th>
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
    $('#customers').DataTable({
        columnDefs: [{
          targets: 3,
          render: function ( data, type, row ) {
            return data.length > 30 ?
                data.substr( 0, 30 ) +'…' :
                data;
          }
        }],
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'nama_pelanggan'},
            {data: 'nomor_meter'},
            {data: 'alamat'},
            {data: 'tariff.golongan_tarif'},
            {data: 'action', searchable: false, orderable: false},
        ],
    });
  </script>
@endpush