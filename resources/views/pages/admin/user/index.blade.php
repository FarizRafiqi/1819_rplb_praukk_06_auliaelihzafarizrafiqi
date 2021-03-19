@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="{{Cookie::get('enable_sidebar') ? 'container-fluid' : 'container'}} mb-3">
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Fitur User:</strong>
    <ol>
      <li><strong>Akun siap digunakan</strong> untuk testing, lihat detail akun di <a href="">Cara Menggunakan Aplikasi Mega Mendung</a></li>
      <li>User <strong>sudah diberi hak akses</strong> sesuai dengan levelnya</li>
      <li>Akun Admin <strong>hanya bisa diinput sekali</strong>. Karena admin itu hanya bisa satu kan?</li>
    </ol>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="d-flex justify-content-between mb-4"> 
    <h3>Users</h3>
    <a href="{{route('admin.users.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100" id="users">
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

    $("#users").on("click.dt", function(e){
      /*cek apakah yang diklik adalah tombol delete, 
      jika true maka tampilkan alert konfirmasi*/
      if($(e.target).hasClass('btn-delete')){
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data user ini akan dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus itu!'
        }).then((result) => {
          if (result.isConfirmed) {
            $(e.target).parent().submit();
          }
        })
      }
    });
  </script>
@endpush