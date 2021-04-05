<div class="modal fade" id="modalAddTaxType" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTaxTypeLabel">
                    Tambah Tipe Pajak
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST" wire:submit.prevent="save">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newName">Nama</label>
                        <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="newName" 
                                placeholder="Masukkan nama"
                                wire:model="name"
                        >
                
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="newDescription">Deskripsi</label>
                        <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="newDescription" 
                                rows="3"
                                placeholder="Masukkan deskripsi"
                                wire:model="description"
                        ></textarea>
                
                        @error('description')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="store">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('addon-script')
    <script>
        Livewire.on("storeTaxType", () => {
            $("#modalAddTaxType").modal('hide');
            Swal.fire({
                title: 'Data tipe pajak berhasil ditambahkan',
                icon: 'success',
                showConfirmButton: true,
            }).then((result) => {
                if(result.isConfirmed){
                    location.reload();
                }
            })
            
        });
    </script>
@endpush