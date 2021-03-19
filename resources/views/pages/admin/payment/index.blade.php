@extends('layouts.admin')

@section('title', 'Pembayaran')

@section('content')
<div class="container-fluid mb-3">
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Fitur Pembayaran:</strong>
    <ol>
      <li><strong>Status pembayaran otomatis berubah menjadi success</strong> ketika pelanggan telah berhasil melakukan pembayaran</li>
    </ol>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <h3 class="mb-4">Pembayaran</h3>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-bordered w-100" id="payments">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Customer</th>
            <th>Nama Customer PLN</th>
            <th>Tanggal Bayar</th>
            <th>Biaya Admin</th>
            <th>Total Bayar</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
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
    $('#payments').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'customer.nama', defaultContent: '-'},
            {data: 'pln_customer.nama_pelanggan', defaultContent: '-'},
            {data: 'tanggal_bayar'},
            {data: 'biaya_admin',
             render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
            },
            {data: 'total_bayar',
             render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
            },
            {data: 'payment_method.nama', defaultContent: '-'},
            {data: 'status',
              render: function(data, type, row){
                let state;
                if(data == 'success'){
                  state = 'success';
                }else if(data == 'pending'){
                  state = 'warning';
                }else{
                  state = 'danger';
                }
                return `<span class='badge badge-pill 
                        badge-${state}'>${data}</span>`;
              }
            },
            {data: 'action', searchable: false, orderable: false},
        ]
    });
  </script>
@endpush