@extends('layouts.admin')

@section('title', 'Penggunaan')

@section('content')
<div class="container mb-3">
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Fitur Penggunaan Listrik:</strong>
    <ol>
      <li>Meter awal <strong>otomatis mengambil dari meter terakhir pelanggan</strong></li>
      <li>Admin <strong>tidak bisa</strong> memasukkan data penggunaan pelanggan tertentu di bulan dan tahun yang sama <strong>2 kali</strong></li>
    </ol>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="d-flex justify-content-between mb-4">
    <h3>Penggunaan Listrik</h3>
    <a href="{{route('admin.usages.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100" id="usages">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
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
    $('#usages').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'pln_customer.nama_pelanggan'},
            {data: 'bulan'},
            {data: 'tahun'},
            {data: 'meter_awal'},
            {data: 'meter_akhir'},
            {data: 'action', searchable: false, orderable: false},
        ]
    });

    $("#usages").on("click.dt", function(e){
      /*cek apakah yang diklik adalah tombol delete, 
      jika true maka tampilkan alert konfirmasi*/
      if($(e.target).hasClass('btn-delete')){
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          html: "Data tagihan dari penggunaan ini akan dihapus juga jika statusnya masih <span class='text-danger'>BELUM LUNAS</span>!",
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