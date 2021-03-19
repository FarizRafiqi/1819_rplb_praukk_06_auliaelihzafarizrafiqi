<div class="row">
	<div class="col-12 col-md-6">
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
								<input type="checkbox" class="custom-control-input" id="allStatus">
								<label class="custom-control-label" for="allStatus">semua</label>
						</div>
						@foreach (config('enum.payment_status') as $id => $status)
							<div class="dropdown-item custom-control custom-checkbox px-5">
								<input type="checkbox" class="custom-control-input" id="{{$status}}" wire:click="filterStatus('{{$status}}')" {{(in_array($status, $selectedStatuses)) ? 'checked' : ''}}>
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
					<li class="list-group-item d-flex justify-content-between align-items-center" style="cursor:pointer;" wire:click="transactionDetail({{$payment->id}})">
						<i class="bi bi-lightning-fill mr-1" style="font-size: 20px"></i> Pembayaran Tagihan {{\Str::limit($payment->tanggal_bayar->monthName,3,'')}} {{$payment->tanggal_bayar->year}}
							<span class="badge
							@switch($payment->status)
									@case('success')
											badge-success
											@break
									@case('failed')
											badge-danger
											@break
									@case('pending')
											badge-warning
										@break
									@case('pending')
										badge-dark
										@break
									@default
							@endswitch badge-pill ml-auto"
							>{{$payment->status}}</span>
					</li>
				@empty
					<li class="list-group-item">Tidak ada riwayat tagihan</li>
				@endforelse
			</ul>
		</div>
	</div>
	<div class="col-12 mt-4 mt-md-0 col-md-6">
		@if ($payment)
			<div class="d-flex align-items-center justify-content-center">
				<div wire:loading wire:target="transactionDetail({{$payment->id}})">Loading...</div>
			</div>
		@endif
		@if ($transaction && $transactionDetail)
		{{-- Card Detail --}}
			<div class="card" wire:loading.remove>
				<div class="card-body">
					{{-- Detail Pembayaran --}}
					<div class="card">
						<div class="card-header">Detail Pembayaran</div>
						<div class="card-body">
							<dl class="row">
								<dt class="col-md-4">Virtual Account</dt>
								<dd class="col-md-8">
									{{$transactionDetail->va_numbers[0]->va_number}}
								</dd>
				
								<dt class="col-md-4">Nama Customer</dt>
								<dd class="col-md-8">{{$transaction->customer->nama}}</dd>
				
								<dt class="col-md-4">Nama Pelanggan PLN</dt>
								<dd class="col-md-8">{{$transaction->plnCustomer->nama_pelanggan}}</dd>
				
								<dt class="col-md-4">ID Pelanggan</dt>
								<dd class="col-md-8">{{$transaction->plnCustomer->nomor_meter}}</dd>
				
								<dt class="col-md-4">Tanggal Bayar</dt>
								<dd class="col-md-8">{{$transaction->tanggal_bayar}}</dd>
				
								<dt class="col-md-4">Tarif / Daya</dt>
								<dd class="col-md-8">{{$transaction->plnCustomer->tariff->golongan_tarif . " / " . $transaction->plnCustomer->tariff->daya . " VA"}}</dd>
				
								<dt class="col-md-4">Biaya Admin</dt>
								<dd class="col-md-8">@rupiah($transaction->biaya_admin)</dd>
				
								<dt class="col-md-4">Total Bayar</dt>
								<dd class="col-md-8">@rupiah($transaction->total_bayar)</dd>
				
								<dt class="col-md-4">Metode Pembayaran</dt>
								<dd class="col-md-8">{{$transaction->paymentMethod->nama ?? "-"}}</dd>
				
								<dt class="col-md-4">Status</dt>
								<dd class="col-md-8">
									@switch($transaction->status)
											@case('success')
													<span class="badge pill-badge badge-success p-1">{{$payment->status}}</span>
													@break
											@case('pending')
													<span class="badge pill-badge badge-warning p-1">Menunggu Pembayaran</span>
													@break
											@case('failed')
													<span class="badge pill-badge badge-danger p-1">{{$transaction->status}}</span>
													@break
											@default
													
									@endswitch
								</dd>
							</dl>
						</div>
					</div>

					{{-- Detail Tagihan --}}
					@foreach ($transaction->details as $detail)
						<div class="accordion mt-4" id="accordionDetailTagihan">
							<div class="card my-3">
								<div class="card-header" data-toggle="collapse" data-target="#detail-{{$detail->id}}" style="cursor: pointer">
									Detail Tagihan {{$detail->bill->bulan . ' ' . $detail->bill->tahun}}
								</div>

								<div class="collapse" id="detail-{{$detail->id}}" data-parent="#accordionDetailTagihan">
									<div class="card-body">
										<dl class="row">
											<dt class="col-md-4">Jumlah KwH</dt>
											<dd class="col-md-8">
												{{$detail->bill->jumlah_kwh}}
											</dd>
											<dt class="col-md-4">PPJ</dt>
											<dd class="col-md-8">
												@rupiah($detail->ppj)
											</dd>
											<dt class="col-md-4">PPN</dt>
											<dd class="col-md-8">
												@rupiah($detail->ppn)
											</dd>
											<dt class="col-md-4">Denda</dt>
											<dd class="col-md-8">
												@rupiah($detail->denda)
											</dd>

											<dt class="col-md-4">Total Tagihan</dt>
											<dd class="col-md-8">
												@rupiah($detail->total_tagihan)
											</dd>
										</dl>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</div>
</div>
