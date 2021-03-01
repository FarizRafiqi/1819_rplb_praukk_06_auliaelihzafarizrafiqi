@extends('layouts.admin')

@section('title', 'Tagihan')

@section('content')
<div class="container mb-3">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Perhatian!</strong> data yang digunakan dibawah ini adalah data bohongan semua. Dan kemungkinan besar data-datanya tidak saling berhubungan sama sekali, karena dibuat secara acak.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <h3 class="mb-4">Tagihan Listrik</h3>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100"  id="bills">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID Penggunaan</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Jumlah Kwh</th>
          <th>Status</th>
        </tr>
      </thead>
    </table>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script>
    $('#bills').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'id_penggunaan'},
            {data: 'bulan'},
            {data: 'tahun'},
            {data: 'jumlah_kwh'},
            {data: 'status',
              render: function(data, type, row){
                return `<span class='badge badge-pill 
                        badge-${(data == 'BELUM LUNAS') ? 'danger' : 'success'}'>${data}</span>`;
            }}
        ]
    });
  </script>
@endpush