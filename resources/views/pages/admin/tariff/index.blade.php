@extends('layouts.admin')

@section('title', 'Tarif')

@section('content')
<div class="{{Cookie::get('enable_sidebar') ? 'container-fluid' : 'container'}} mb-3">
  <div class="d-flex justify-content-between mb-4"> 
    <h3>Tarif</h3>
    <a href="{{route('admin.tariffs.create')}}" class="btn btn-primary-custom">
      <i class="fas fa-plus"></i>
      Tambah
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100" id="tariffs">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Golongan Tarif</th>
            <th>Daya</th>
            <th>Tarif Per Kwh</th>
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
    $('#tariffs').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'golongan_tarif'},
            {data: 'daya',
              render: $.fn.dataTable.render.number('.', ',', 0, '', ' VA')
            },
            {data: 'tarif_per_kwh', 
              render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
            },
            {data: 'action', searchable: false, orderable: false},
        ]
    });

    $("#tariffs").on("click.dt", ".btn-delete", function(e){
      /*cek apakah yang diklik adalah tombol delete, 
      jika true maka tampilkan alert konfirmasi*/
      e.preventDefault();
      Swal.fire({
        title: 'Apakah kamu yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((result) => {
        if (result.isConfirmed) {
          $(e.target).parent().submit();
        }
      })
    });
  </script>
@endpush