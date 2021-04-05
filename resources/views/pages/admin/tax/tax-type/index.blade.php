@extends('layouts.admin')
@section('title', 'Tipe Pajak')
@section('content')
<div class="container mb-3">
    <div class="d-flex justify-content-between mb-4"> 
        <h3>Tipe Pajak</h3>
        <button class="btn btn-primary-custom" data-toggle="modal" data-target="#modalAddTaxType">
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
@livewire('admin.tax.tax-type.create')
@livewire('admin.tax.tax-type.edit')

@endsection
@push('addon-script')
  {{ $dataTable->scripts() }}
  <script>
    $(function(){
      let taxTypeTable = window.LaravelDataTables['taxtype-table'];

      $("#taxtype-table").on("click.dt", "#dataTablesCheckbox", function(){
        if($(this).is(':checked')){
          taxTypeTable.rows().select();
        }else{
          taxTypeTable.rows().deselect();
        }
      });

      taxTypeTable.on("deselect", function(e, dt, type, index){
        if(type === 'row') {
          let rowSelected = dt.rows({selected:true}).count();
          if(rowSelected === 0){
            $("#dataTablesCheckbox").prop("checked", false);
          }
        }
      })

      $("#taxtype-table").on("click.dt", ".btn-delete", function(e){
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data tipe pajak ini akan dihapus!",
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

      $("#massDeleteTaxType").on("click", function(e){
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data tipe pajak ini akan dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then( (result) => {
          if (result.isConfirmed) {
            massDeleteTaxType();
          }
        })
      });

      function massDeleteTaxType() {
        let ids = $.map(taxTypeTable.rows({selected: true}).data(), function(entry) {
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
          url: "{{ route('admin.tax-types.massDestroy') }}",
          data: {ids: ids, _method: 'DELETE'}
        }).done(function(){ 
          location.reload(); 
        });
      }

      $("#taxtype-table").on("click.dt", ".btn-edit", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $("#modalEditTaxType").modal('toggle');
        Livewire.emit('edit', id);
      });

    })
  </script>
@endpush
