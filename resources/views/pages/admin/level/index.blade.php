@extends('layouts.admin')

@section('title', 'Pelanggan PLN')

@section('content')
<div class="container mb-3">
  <div class="d-flex justify-content-between mb-4"> 
    <h3>Level</h3>
    <a href="{{route('admin.level.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100"  id="levels">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Level</th>
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