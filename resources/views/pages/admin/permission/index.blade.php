@extends('layouts.admin')

@section('title', 'Hak Akses')

@section('content')
<div class="container w-50 mb-3">
  <div class="d-flex justify-content-between mb-4"> 
    <h3>Hak Akses</h3>
    <a href="{{route('admin.users.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100"  id="permissions">
        <thead>
          <tr>
            <th>ID</th>
            <th>Judul</th>
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
    $('#permissions').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'title'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush