@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="container mb-3">
  <div class="d-flex justify-content-between mb-4"> 
    <h3>Users</h3>
    <a href="{{route('admin.users.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100"  id="users">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>ID Level</th>
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
    $('#users').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'nama'},
            {data: 'username'},
            {data: 'email'},
            {data: 'level.level'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush