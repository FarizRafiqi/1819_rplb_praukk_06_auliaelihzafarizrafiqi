@extends('layouts.admin')

@section('title', 'Metode Pembayaran')

@section('content')
  <div class="{{Cookie::get('enable_sidebar') ? 'container-fluid' : 'container'}} mb-3">
    <div class="row mb-4">
      <div class="col-12 col-md-6">
        <h3>Metode Pembayaran</h3>
      </div>
      <div class="col-12 col-md-6 text-md-right">
        <a href="{{route('admin.payment-methods.create')}}" class="btn btn-primary-custom">
          <i class="fas fa-plus"></i>
          Tambah
        </a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-bordered w-100" id="paymentMethods">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Metode</th>
              <th>Gambar</th>
              <th>Slug</th>
              <th>Deskripsi</th>
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
    $('#paymentMethods').DataTable({
      responsive: true,
      serverSide: true,
      ajax: "",
      columns: [
          {data: 'id'},
          {data: 'nama'},
          {data: 'gambar'},
          {data: 'slug'},
          {data: 'deskripsi',
            render: function ( data, type, row ) {
            return data.length > 30 ?
              data.substr( 0, 30 ) +'…' :
              data;
          }},
          {data: 'action', searchable: false, orderable: false},  
      ],
    });

    $("#paymentMethods").on("click.dt", ".btn-delete", function(e){
      /*cek apakah yang diklik adalah tombol delete, 
      jika true maka tampilkan alert konfirmasi*/
      e.preventDefault();
      Swal.fire({
        title: 'Apakah kamu yakin ingin menghapusnya?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ya!',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          $(e.target).parent().submit();
        }
      })
    });
  </script>
@endpush