<div class="modal fade" id="modalEditTaxRate" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTaxRateLabel">
                    Edit Presentase Pajak
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <div class="form-group" wire:ignore>
                        <label for="taxType">Tipe Pajak <span class="text-danger">*</span></label>
                        <select class="selectpicker form-control @error('tax_rate.tax_type_id') is-invalid @enderror" id="taxType" data-live-search="true" wire:model="tax_rate.tax_type_id">
                            <option selected disabled>Pilih Tipe Pajak</option>
                        @foreach ($this->taxTypes as $taxType)
                            <option value="{{ $taxType->id }}" {{ $taxType->id == optional($this->tax_rate)->tax_type_id ? 'selected' : '' }}>{{ $taxType->name }}</option>
                        @endforeach
                        </select>
 
                        @error('tax_rate.tax_type_id')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group" wire:ignore>
                        <label for="city">Kota <span class="text-danger">*</span></label>
                        <select class="selectpicker form-control @error('tax_rate.indonesia_city_id') is-invalid @enderror" id="city" data-live-search="true" wire:model="tax_rate.indonesia_city_id">
                            <option selected disabled>Pilih Kota</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ ($city->id == optional($this->tax_rate)->indonesia_city_id) ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                        </select>

                        @error('tax_rate.indonesia_city_id')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="rate">Presentase (%)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('tax_rate.rate') is-invalid @enderror" id="rate" value="{{ optional($this->tax_rate)->rate }}" wire:model="tax_rate.rate">
                
                        @error('tax_rate.rate')
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
        Livewire.on("updateTaxRate", () => {
            $("#modalEditTaxRate").modal('hide');
            Swal.fire({
                title: 'Data presentase pajak berhasil diubah.',
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