@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<div class="container mb-3">
  <h3 class="mb-4">Log Aktivitas</h3>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100"  id="activityLogs">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID User</th>
          <th>Tabel Referensi</th>
          <th>ID Referensi</th>
          <th>Deskripsi</th>
          <th>Dibuat Pada</th>
        </tr>
      </thead>
    </table>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script>
    $('#activityLogs').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'id_user'},
            {data: 'tabel_referensi'},
            {data: 'id_referensi'},
            {data: 'deskripsi'},
            {data: 'created_at'}
        ]
    });
  </script>
@endpush