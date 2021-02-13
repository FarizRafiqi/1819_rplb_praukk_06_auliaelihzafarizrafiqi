@extends('layouts.admin')

@section('title', 'Pelanggan PLN')

@push('addon-style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container">
  <table class="table table-striped table-bordered" style="width:100%" id="users">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>ID Level</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@push('addon-script')
  <script>
    $('#users').DataTable({
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'nama'},
            {data: 'username'},
            {data: 'password'},
            {data: 'email'},
            {data: 'level.level'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush