<div class="row">
	<h3 class="text-info col-12" wire:offline>
		Oops koneksi anda terputus..
	</h3>
	<div class="col-12 col-md-6" wire:offline.class="d-none">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<div>{{$day}} Hari Terakhir</div>
				<div class="dropdown">
					<button class="btn btn-primary-custom" data-toggle="dropdown" data-display="static">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
								<path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
						</svg>
						Filter
					</button>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
						<h6 class="dropdown-header">Status</h6>
						<div class="dropdown-item custom-control custom-checkbox pl-5">
								<input type="checkbox" class="custom-control-input" id="selectAllStatus" wire:model="selectAllStatus">
								<label class="custom-control-label" for="selectAllStatus">semua</label>
						</div>
						@foreach (config('enum.payment_status') as $id => $status)
							<div class="dropdown-item custom-control custom-checkbox px-5">
								<input type="checkbox" class="custom-control-input" id="{{$status}}" wire:click="filterStatus('{{$status}}')" {{(in_array($status, $selectedStatuses)) ? 'checked' : ''}} {{$selectAllStatus ? 'disabled' : ''}}>
								<label class="custom-control-label" for="{{$status}}">{{$status}}</label>
							</div>
						@endforeach
						<h6 class="dropdown-header">Waktu Transaksi</h6>
						<div class="dropdown-item custom-control custom-radio px-5">
							<input type="radio" id="lastThirtyDays" name="day" class="custom-control-input" value="30" wire:model="day">
							<label class="custom-control-label" for="lastThirtyDays">30 hari terakhir</label>
						</div>
						<div class="dropdown-item custom-control custom-radio px-5">
							<input type="radio" id="lastSixtyDays" name="day" class="custom-control-input" value="60" wire:model="day">
							<label class="custom-control-label" for="lastSixtyDays">60 hari terakhir</label>
						</div>
						<div class="dropdown-item custom-control custom-radio px-5">
							<input type="radio" id="lastNinetyDays" name="day" class="custom-control-input" value="90" wire:model="day">
							<label class="custom-control-label" for="lastNinetyDays">90 hari terakhir</label>
						</div>
						<h6 class="dropdown-header">Metode Pembayaran</h6>
						@foreach ($paymentMethods as $paymentMethod)
							<div class="dropdown-item custom-control custom-checkbox px-5">
								<input type="checkbox" class="custom-control-input" id="{{$paymentMethod->slug}}" wire:click="filterPaymentMethod('{{$paymentMethod->id}}')" {{(in_array($paymentMethod->id, $selectedPaymentMethod)) ? 'checked' : ''}}>
								<label class="custom-control-label" for="{{$paymentMethod->slug}}">{{$paymentMethod->nama}}</label>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<ul class="list-group list-group-flush">
				@forelse ($userPayments as $payment)
					<li class="list-group-item d-flex justify-content-between align-items-center" style="cursor:pointer;" wire:click="transactionDetail({{json_encode($payment->id)}})">
						<i class="bi bi-lightning-fill mr-1 pacific-blue" style="font-size: 20px"></i> Pembayaran Tagihan {{\Str::limit($payment->tanggal_bayar->monthName,3,'')}} {{ $payment->tanggal_bayar->year }}
							<span class="badge
							@switch($payment->status)
									@case('success')
										badge-success
										@break
									@case('pending')
										badge-warning
										@break
									@case('failed' || 'cancel')
										badge-danger
										@break
									@case('expire')
										badge-dark
										@break
									@default
							@endswitch badge-pill ml-auto"
							>{{ $payment->status }}</span>
					</li>
				@empty
					<li class="list-group-item">Tidak ada riwayat tagihan</li>
				@endforelse
			</ul>
		</div>
	</div>
	<div class="col-12 mt-4 mt-md-0 col-md-6" wire:offline.class="d-none">
		<div class="d-flex align-items-center justify-content-center">
			<div wire:loading>Loading...</div>
		</div>
		@if ($this->payment && $transactionDetail)
		{{-- Card Detail --}}
			<div class="card" wire:loading.remove>
				<div class="card-body">
					{{-- Detail Pembayaran --}}
					<div class="card">
						<div class="card-header">Detail Pembayaran</div>
						<div class="card-body">
							<dl class="row">
								<dt class="col-md-5">Virtual Account</dt>
								<dd class="col-md-7">
									{{$transactionDetail->va_numbers[0]->va_number ?? $transactionDetail->bill_key}}
								</dd>
				
								<dt class="col-md-5">Nama Customer</dt>
								<dd class="col-md-7">{{$this->payment->customer->nama}}</dd>
				
								<dt class="col-md-5">Nama Pelanggan PLN</dt>
								<dd class="col-md-7">{{$this->payment->plnCustomer->nama_pelanggan}}</dd>
				
								<dt class="col-md-5">ID Pelanggan</dt>
								<dd class="col-md-7">{{$this->payment->plnCustomer->nomor_meter}}</dd>
				
								<dt class="col-md-5">Tanggal Bayar</dt>
								<dd class="col-md-7">{{$this->payment->tanggal_bayar}}</dd>
				
								<dt class="col-md-5">Tarif / Daya</dt>
								<dd class="col-md-7">{{$this->payment->plnCustomer->tariff->golongan_tarif . " / " . $this->payment->plnCustomer->tariff->daya . " VA"}}</dd>
				
								<dt class="col-md-5">Biaya Admin</dt>
								<dd class="col-md-7">@rupiah($this->payment->biaya_admin)</dd>
				
								<dt class="col-md-5">Total Bayar</dt>
								<dd class="col-md-7">@rupiah($this->payment->total_bayar)</dd>
				
								<dt class="col-md-5">Metode Pembayaran</dt>
								<dd class="col-md-7">
									<div class="row justify-content-between align-items-center">
										<div class="col">
											{{$this->payment->paymentMethod->nama ?? "-"}}
										</div>
										@if ($this->payment->status == 'pending')
											<div class="col text-right">
												<button class="btn usafa-blue" id="btnChangePaymentMethod" wire:click.prevent="$emit('changePaymentMethodRequest')"><strong>ubah</strong></button>
											</div>
										@endif
									</div>
								</dd>
				
								<dt class="col-md-5">Status</dt>
								<dd class="col-md-7">
									@switch($this->payment->status)
											@case('success')
													<span class="badge pill-badge badge-success p-1">{{ $payment->status }}</span>
													@break
											@case('pending')
													<span class="badge pill-badge badge-warning p-1">Menunggu Pembayaran</span>
													<div class="mt-1">
														<a href="{{ route('payment.confirm', ['payment_method' => $payment->paymentMethod->slug, 'payment' => $payment->id]) }}">Lanjutkan pembayaran</a>
													</div>
													@break
											@case('failed' || 'cancel')
													<span class="badge pill-badge badge-danger p-1">{{ $this->payment->status }}</span>
													@break
											@default
									@endswitch
								</dd>
							</dl>
						</div>
					</div>

					{{-- Detail Tagihan --}}
					@foreach ($this->payment->details as $detail)
						@livewire('transaction-history.bill-detail', ["detail" => $detail], key($detail->id))
					@endforeach
				</div>
			</div>
		@endif
	</div>
</div>
@push('addon-script')
	<script>
		Livewire.on('paymentNotCompleteYet', (paymentId) => {
				Swal.fire({
					title: 'Metode pembayaran belum dipilih',
					text: 'lanjutkan memilih metode pembayaran?',
					icon: 'info',
					showConfirmButton: true,
					showCancelButton: true,
				}).then((result) => {
					if(result.isConfirmed){
						let url = "{{route('payment.index', ':id')}}";
						url = url.replace(':id', paymentId);
						window.location.href = url;
					}
				});
		});

		Livewire.on("changePaymentMethodRequest", function() {
			let payment = @json($payment);
			Swal.fire({
				title: 'Ubah metode pembayaran?',
				text : 'Pembayaranmu yang sebelumnya akan dibatalkan.',
				icon: 'warning',
				showConfirmButton: true,
				showCancelButton: true,
			}).then( (result) => {
				if(result.isConfirmed){
					Livewire.emit('changePaymentMethod', payment);
				}
			});
		});
	</script>
@endpush
