@extends('layouts.admin')

@section('title', 'Pelanggan PLN')

@push('addon-style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container">
  <table class="table table-striped table-bordered" style="width:100%" id="levels">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Level</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@push('addon-script')
  <script>
    $('#levels').DataTable({
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'level'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush