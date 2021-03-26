@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<div class="container mb-3">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Perhatian!</strong> jika ingin mengaktifkan fitur log ini jangan lupa untuk menambahkan trigger yang sudah saya buat di dokumen analisa UKK ke DBMS. <br> <strong>Sebenarnya</strong> itu tidak wajib dilakukan, karena saya <strong>sudah menggunakan Laravel Observer</strong> untuk menangani <strong>event</strong> model (sama persis dengan trigger di SQL)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
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
          <th>Diubah Pada</th>
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
            {data: 'tabel_referensi',
              render: function(data){
                return data.charAt(0).toUpperCase() + data.slice(1);
              }, 
              defaultContent: '-'
            },
            {data: 'id_referensi', defaultContent: '-'},
            {data: 'deskripsi'},
            {data: 'created_at'},
            {data: 'updated_at'}
        ]
    });
  </script>
@endpush