<div class="{{ !empty($usages) ? 'mb-5' : 'mb-0' }}">
  <!-- Input ID Pelanggan -->
  <div class="card card-input-no-meteran p-1">
    <form action="{{ route('payment.create') }}" method="POST" id="formTagihan">
      @csrf
      <div class="form-row">
        <div class="col-9">
          <input 
            class="form-control @error('nomor_meter') is-invalid @enderror" 
            name="nomor_meter" 
            type="number" 
            placeholder="ID Pelanggan" 
            autocomplete="off" 
            autofocus 
            wire:model.debounce.400ms="nomor_meter"
          >
          @error('nomor_meter')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
        </div>
        <div class="col-3">
          <button 
            class="btn btn-secondary-custom w-100" 
            type="submit" 
            id="btnBayar" 
            {{ $usages ? '' : 'disabled' }}
          >Bayar</button>
        </div>
      </div>
    </form>
  </div>
  
  @if (!empty($usages))
    <div 
      class="spinner-grow text-info mx-auto mb-5" 
      role="status" 
      wire:loading.flex wire:target="nomor_meter"
    >
      <span class="sr-only">Loading...</span>
    </div>
        {{-- Card Informasi Pelanggan --}}
    <div class="card mb-4 mt-n4">
      <div class="card-header">
        <strong>Informasi Pelanggan</strong>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-12">
            <label class="mb-0">Nama Lengkap</label>
            <div class="font-weight-bold">{{ $plnCustomer->nama_pelanggan }}</div>
          </div>

          <div class="form-group col-12">
            <label class="mb-0">No. Meter</label>
            <div class="font-weight-bold">{{ $plnCustomer->nomor_meter }}</div>
          </div>

          <div class="form-group col-12">
            <label class="mb-0">Tarif/Daya</label>
            <div class="font-weight-bold">
              {{ optional($plnCustomer->tariff)->golongan_tarif . '/' . optional($plnCustomer->tariff)->daya . ' VA' }}
            </div>
          </div>

          <div class="form-group col-12">
            <label class="mb-0">Jumlah Tagihan</label> 
            <div class="font-weight-bold">
              {{ $usages->count() }}
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Card Informasi Tagihan --}}
    <div class="card">
      <div class="card-header">
        <strong>Informasi Tagihan</strong>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-12">
            <label class="mb-0">Periode</label>
            <div class="font-weight-bold">
              @if ($usages->count() > 1)
                {{ optional($usages->first())->month_name . '-' . optional($usages->last())->month_name. ' ' . optional($usages->first())->tahun }}
              @else
                {{ optional($usages->first())->month_name . ' ' . optional($usages->first())->tahun }}
              @endif
            </div>
          </div>

          <div class="form-group col-12">
            <label class="mb-0">Total Denda</label>
            <div class="font-weight-bold">@rupiah( collect($data)->sum('denda') )</div>
          </div>

          <div class="form-group col-12">
            <label class="mb-0">Biaya Admin</label>
            <div class="font-weight-bold">@rupiah( config('const.biaya_admin') )</div>
          </div>

          <div class="form-group col-12">
            <label class="mb-0">Total Tagihan</label>
            <div class="font-weight-bold">@rupiah($total)</div>
            <a class="text-decoration-none" data-toggle="collapse" href="#detail">detail</a>
          </div>

          <div class="form-group col-12 collapse" id="detail">
            <div class="card">
              <div class="card-body">
                @foreach ($usages as $index => $usage)
                  <h5>Tagihan {{ optional($usage->bill)->month_name . ' ' .  optional($usage->bill)->tahun }}</h5>
                  <div class="row">
                    <dt class="col-md-4">Jumlah KwH</dt>
                    <dd class="col-md-8">
                        {{ optional($usage->bill)->jumlah_kwh}}
                    </dd>
                    <dt class="col-md-4">PPJ</dt>
                    <dd class="col-md-8">
                        @rupiah($data[$index]['ppj'])
                    </dd>
                    <dt class="col-md-4">PPN</dt>
                    <dd class="col-md-8">
                        @rupiah($data[$index]['ppn'])
                    </dd>
                    <dt class="col-md-4">Denda</dt>
                    <dd class="col-md-8">
                        @rupiah($data[$index]['denda'])
                    </dd>

                    <dt class="col-md-4">Total Tagihan</dt>
                    <dd class="col-md-8">
                        @rupiah($data[$index]['total_tagihan'])
                    </dd>
                  </div>
                  @if($loop->odd && $loop->iteration > 1)
                      <hr>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
  @endif
</div>
@push('addon-script')
	<script>
		Livewire.on('alertAlreadyPayBill', () => {
				Swal.fire({
					'title': 'Tagihan Sudah Terbayar',
					'icon': 'success',
					'showConfirmButton': true
				})
		});
	</script>
@endpush