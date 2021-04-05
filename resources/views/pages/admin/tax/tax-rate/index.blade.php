@extends('layouts.admin')
@section('title', 'Presentase Pajak')
@section('content')
<div class="container mb-3">
    <div class="d-flex justify-content-between mb-4"> 
        <h3>Presentase Pajak</h3>
        <button class="btn btn-primary-custom" data-toggle="modal" data-target="#modalAddTaxRate">
          <i class="fas fa-plus"></i>
          Tambah
        </button>
    </div>
    <div class="card">
        <div class="card-body table-responsive-sm">
            {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
        </div>
    </div>
</div>

<!-- Modal -->
@livewire('admin.tax.tax-rate.create')
@livewire('admin.tax.tax-rate.edit')

@endsection
@push('addon-script')
  {{ $dataTable->scripts() }}
  <script>
    $(function(){
      let taxRateTable = window.LaravelDataTables['taxrate-table'];

      $("#taxrate-table").on("click.dt", "#dataTablesCheckbox", function(){
        if($(this).is(':checked')){
          taxRateTable.rows().select();
        }else{
          taxRateTable.rows().deselect();
        }
      });

      taxRateTable.on("deselect", function(e, dt, type, index){
        if(type === 'row') {
          let rowSelected = dt.rows({selected:true}).count();
          if(rowSelected === 0){
            $("#dataTablesCheckbox").prop("checked", false);
          }
        }
      })

      $("#taxrate-table").on("click.dt", ".btn-delete", function(e){
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data presentase pajak ini akan dihapus!",
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

      $("#massDeleteTaxRate").on("click", function(e){
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data presentase pajak ini akan dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then( (result) => {
          if (result.isConfirmed) {
            massDeleteTaxRate();
          }
        })
      });

      function massDeleteTaxRate() {
        let ids = $.map(taxRateTable.rows({selected: true}).data(), function(entry) {
          return entry.id;
        });

        if(ids.length === 0) {
          Swal.fire({
            title: 'Tidak ada data yang dipilih!',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
          })
          return;
        }

        $.ajax({
          headers: {"x-csrf-token": "{{ csrf_token() }}"},
          method: 'POST',
          url: "{{ route('admin.tax-rates.massDestroy') }}",
          data: {ids: ids, _method: 'DELETE'}
        }).done(function(){ 
            location.reload();
        });
      }

      $("#taxrate-table").on("click.dt", ".btn-edit", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $("#modalEditTaxRate").modal('toggle');
        Livewire.emit('edit', id);
      });

    })
  </script>
@endpush
