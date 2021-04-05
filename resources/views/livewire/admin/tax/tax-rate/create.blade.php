<div class="modal fade" id="modalAddTaxRate" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTaxRateLabel">
                    Tambah Presentase Pajak
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div class="form-group" wire:ignore>
                        <label for="newTaxType">Tipe Pajak <span class="text-danger">*</span></label>
                        <select class="selectpicker form-control @error('tax_type') is-invalid @enderror" id="newTaxType" data-live-search="true" title="Pilih tipe pajak" wire:model="tax_type">
                        @foreach ($taxTypes as $taxType)
                            <option value="{{ $taxType->id }}">{{ $taxType->name }}</option>
                        @endforeach
                        </select>
                
                        @error('tax_type')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group" wire:ignore>
                        <label for="newCity">Kota <span class="text-danger">*</span></label>
                        <select class="selectpicker form-control @error('newCity') is-invalid @enderror" id="newCity" data-live-search="true" title="Pilih Kota" wire:model="city">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                        </select>
                
                        @error('city')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="newRate">Presentase (%)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('rate') is-invalid @enderror" id="newRate" wire:model="rate">
                
                        @error('rate')
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
        Livewire.on("storeTaxRate", () => {
            $("#modalAddTaxRate").modal('hide');
            Swal.fire({
                title: 'Data presentase pajak berhasil ditambahkan.',
                icon: 'success',
                showConfirmButton: true,
            }).then((result) => {
                if(result.isConfirmed){
                    location.reload();
                }
            });
        });
    </script>
@endpush