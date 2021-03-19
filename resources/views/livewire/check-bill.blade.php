<div>
	<form action="{{route('payment.create')}}" method="POST" id="formTagihan">
		@csrf
		<div class="form-row">
				<div class="col-9 col-lg-10">
					<input class="form-control form-control-lg @error('nomor_meter') is-invalid @enderror" name="nomor_meter" id="nomorMeter" type="text" placeholder="ID Pelanggan" autocomplete="off" autofocus wire:model.debounce.400ms="nomor_meter">
					@error('nomor_meter')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="col-3 col-lg-2 col-btn">
				<button class="btn btn-lg w-100 btn-secondary-custom" type="submit" id="btnPay" {{$usages ? '' : 'disabled'}}>
						<span class="spinner-border spinner-border-sm mb-1" wire:loading wire:target="nomor_meter"></span>
						Bayar
				</button>
			</div>
			<div class="col-12 col-alert-info">
				<div class="alert alert-info alert-dismissible fade show mt-3 mb-0">
					<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
					</button>
					<h5 class="alert-heading">Keterangan</h5>
					<p class="mb-0">
						<ol>
								<li>
								Transaksi Tagihan Listrik yang dilakukan pukul 23:30-00.59 WIB akan mulai diproses pada pukul 01.00 WIB sesuai kebijakan pihak PLN.
								</li>
								<li>Jatuh tempo pembayaran tagihan listrik adalah <strong>tanggal 20 di setiap bulannya</strong>.</li>
								<li>Proses verifikasi pembayaran maksimum <strong>2x24 jam hari kerja</strong>.</li>
						</ol>
					</p>
				</div>
			</div>
		</div>
	</form>
	@if(!empty($usages))
		<table class="table text-center table-bordered table-stripped w-100 mt-3" id="billTable">
			<thead>
				<tr>
					<th>Nama Lengkap</th>
					<th>Jumlah Periode</th>
					<th>Periode</th>
					<th>Biaya Admin</th>
					@if ($this->fine > 0)
						<th>Denda</th>
					@endif
					<th>Tagihan</th>
					<th>Total Tagihan</th>
				</tr>
			</thead>
			<tbody>
					<tr>
						<td>{{$usages->first()->plnCustomer->nama_pelanggan}}</td>
						<td>{{$usages->count()}}</td>
						<td>
							@if ($usages->count() > 1)
								{{$usages->first()->bulan . '-' . $usages->last()->bulan. ' ' . $usages->first()->tahun}}
							@else
								{{$usages->first()->bulan . ' ' . $usages->first()->tahun}}
							@endif
						</td>
						<td>@rupiah(config('const.biaya_admin'))</td>
						@if ($this->fine > 0)
							<td>@rupiah($this->fine)</td>
						@endif
						<td>@rupiah($bills)</td>
						<td class="font-weight-bold">@rupiah($total)</td>
					</tr>
			</tbody>
		</table>
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
