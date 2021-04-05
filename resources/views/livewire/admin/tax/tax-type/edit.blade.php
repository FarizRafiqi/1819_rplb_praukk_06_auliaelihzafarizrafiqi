<div class="modal fade" id="modalEditTaxType" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTaxTypeLabel">
                    Edit Tipe Pajak
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST" wire:submit.prevent="update">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                placeholder="Masukkan nama"
                                value="{{ $name }}"
                                wire:model="name"
                        >
                
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                rows="3"
                                placeholder="Masukkan deskripsi"
                                value="{{ $description }}"
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
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('addon-script')
    <script>
        Livewire.on("updateTaxType", () => {
            $("#modalEditTaxType").modal('hide');
            Swal.fire({
                title: 'Data tipe pajak berhasil diupdate',
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
