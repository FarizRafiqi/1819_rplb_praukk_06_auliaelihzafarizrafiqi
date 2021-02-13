@extends('layouts.admin')

@section('title', 'Pelanggan PLN')

@push('addon-style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container">
  <table class="table table-striped table-bordered" style="width:100%" id="payments">
    <thead>
      <tr>
        <th>ID</th>
        <th>ID Pelanggan</th>
        <th>ID Tagihan</th>
        <th>Tanggal Bayar</th>
        <th>Biaya Admin</th>
        <th>Denda</th>
        <th>Total Bayar</th>
        <th>ID Admin</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@push('addon-script')
  <script>
    $('#payments').DataTable({
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'nama_pelanggan'},
            {data: 'nomor_meter'},
            {data: 'alamat'},
            {data: 'tariff_id'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush