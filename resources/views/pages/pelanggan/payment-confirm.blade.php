@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran '.$paymentMethod->nama)

@section('content')
    <div class="container container-transaction my-4">
      <div class="row">
        <div class="col-md-8 py-3 col-payment-method bg-white border order-2 order-md-1">
          <div class="font-weight-bold bank-account-information-title mb-3">Silakan Transfer Ke</div>
          <div class="card bank-account-information">
            <div class="card-body">
              <div class="bank-wrapper border-bottom">
                <p class="title">Virtual Account</p>
                <div class="d-flex align-items-center justify-content-between">
                  <span class="font-weight-bold va-{{strtolower($paymentMethod->nama)}}">{{$paymentMethod->nama}}</span>
                  <span>
                    <img src="{{Storage::url('img/payment-method/'. $paymentMethod->gambar)}}" alt="{{$paymentMethod->gambar}}" class="img-fluid" width="80">
                  </span>
                </div>
              </div>
              <div class="number-wrapper border-bottom">
                <p class="title">
                  @if ($paymentMethod->nama == 'VA Mandiri')
                    Kode Pembayaran
                  @elseif($paymentMethod->nama == 'VA BCA')
                    Nomor Rekening
                  @else
                    Nomor Virtual Account
                  @endif
                </p>
                <div class="va-number-number d-flex align-items-center justify-content-between">
                  <p class="font-weight-bold m-0">{{$response->bill_key}}</p>
                  <span class="clipboard-copy" data-clipboard-text="{{$response->bill_key}}" data-copy-message="Nomor Virtual Account sudah tersalin." >SALIN</span>
                </div>
              </div>
              <div class="total-payment font-weight-bold">
                <p>Total Pembayaran</p>
                <span>@rupiah($response->gross_amount)</span>
              </div>
            </div>
          </div>
          <div class="font-weight-bold instruction-heading-title my-3">Cara Pembayaran</div>
          <div class="instruction-payment" id="instructionPayment">
            {{-- Transfer ATM Instruction --}}
            <div class="card instruction-payment-item">
              <div class="card-header bg-white d-flex align-items-center">
                <a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#instructionPayment" href="#transfer">
                  Transfer Melalui ATM
                </a>
                <span class="ml-auto"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
              </div>
              <div class="step-content collapse" id="transfer">
                <div class="card-body py-2 px-2">
                  @if($paymentMethod->nama == 'VA Mandiri')
                  <ol>
                    <li>Input kartu <strong>ATM</strong> dan <strong>PIN</strong> Anda</li>
                    <li>Pilih Menu <strong>Bayar/Beli</strong></li>
                    <li>Pilih <strong>Lainnya</strong></li>
                    <li>Pilih <strong>Multi Payment</strong></li>
                    <li>Masukkan <strong>{{$response->biller_code}}</strong> (kode perusahaan Midtrans) lalu tekan <strong>Benar.</strong></li>
                    <li>Masukkan <strong>Kode Pembayaran</strong> Anda yaitu <strong>{{$response->bill_key}}</strong> lalu tekan <strong>Benar</strong></li>
                    <li>Pada halaman konfirmasi akan muncul detail pembayaran Anda. Jika informasi telah sesuai tekan <strong>Ya</strong>.</li>
                  </ol>
                  @elseif($paymentMethod->nama == 'VA BCA')
                    <ol>
                      <li>Pilih Menu <strong>Transaksi Lainnya</strong></li>
                      <li>Pilih <strong>Transfer</strong></li>
                      <li>Pilih <strong>Ke Rekening BCA Virtual Account</strong></li>
                      <li>Masukkan <strong>Nomor Rekening</strong> pembayaran yaitu <strong>{{$response->va_numbers[0]->va_number}}</strong></li>
                      <li>Pilih <strong>Benar</strong></li>
                      <li>Pilih <strong>Masukkan jumlah tagihan yang akan Anda bayar</strong></li>
                      <li>Pada halaman konfirmasi transfer akan muncul detail pembayaran Anda. Jika informasi telah sesuai tekan <strong>Ya.</strong></li>
                    </ol>
                  @else
                    <ol>
                      <li>Pada menu utama, pilih <strong>Menu Lainnya</strong></li>
                      <li>Pilih <strong>Transfer</strong></li>
                      <li>Pilih <strong>Rekening Tabungan</strong></li>
                      <li>Pilih <strong>Ke Rekening BNI</strong></li>
                      <li>Masukkan Nomor <strong>Virtual Account</strong> Anda <strong>{{$response->va_numbers[0]->va_number}}</strong> dan pilih <strong>Tekan Jika Benar</strong></li>
                      <li>Masukkan jumlah tagihan yang akan anda bayar secara lengkap. Pembayaran dengan jumlah tidak sesuai akan otomatis ditolak.</li>
                      <li>Jumlah yang dibayarkan, nomor rekening dan nama Merchant akan ditampilkan. Jika informasi telah sesuai, tekan <strong>Ya</strong>.</li>
                      <li>Transaksi Anda sudah selesai</li>
                    </ol>
                  @endif
                </div>
              </div>
            </div>
            {{-- End of Transfer Instruction --}}

            {{-- Mobile Banking Instruction --}}
            <div class="card instruction-payment-item mt-3">
              <div class="card-header bg-white d-flex align-items-center">
                <a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#instructionPayment" href="#mobileBanking">
                  Transfer Melalui Mobile Banking
                </a>
                <span class="ml-auto"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
              </div>
              <div class="step-content collapse" id="mobileBanking">
                <div class="card-body py-2 px-2">
                @if($paymentMethod->nama == 'VA BNI')
                  <ol>
                    <li>Akses <strong>BNI Mobile Banking</strong> dari handphone kemudian masukkan User ID dan password</li>
                    <li>Pilih menu<strong>Transfer</strong></li>
                    <li>Pilih menu<strong>Virtual Account Billing</strong> kemudian pilih <strong>Rekening Debet</strong></li>
                    <li>Masukkan nomor Virtual Account Anda <strong>7001 4501 0242 6284</strong> pada menu <strong>Input Baru</strong></li>
                    <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi</li>
                    <li>Konfirmasi transaksi dan masukkan Password Transaksi</li>
                    <li>Pembayaran Anda Telah Berhasil</li>
                  </ol>
                @elseif($paymentMethod->nama == 'VA BCA')
                  <ol>
                    <li>Login <strong>Mobile Banking</strong></li>
                    <li>Pilih <strong>m-Transfer</strong></li>
                    <li>Pilih <strong>BCA Virtual Account</strong></li>
                    <li>Input <strong>Nomor Virtual Account</strong>, yaitu <strong>3947 1001 1078 4374 sebagai No. Virtual Account</strong></li>
                    <li>Klik <strong>Send</strong></li>
                    <li><strong>Informasi Virtual Account</strong> akan ditampilkan</li>
                    <li>Klik <strong>OK</strong></li>
                    <li>Input <strong>PIN</strong> Mobile Banking</li>
                    <li><strong>Bukti Bayar</strong> ditampilkan</li>
                    <li>Selesai</li>
                  </ol>
                @else
                  Tidak ada instruksi pembayaran untuk metode mobile banking
                @endif
                </div>
              </div>
            </div>
            {{-- End of Mobile Banking Instruction --}}

            {{-- Internet Banking Instruction --}}
            <div class="card instruction-payment-item mt-3">
              <div class="card-header bg-white d-flex align-items-center">
                <a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#instructionPayment" href="#internetBanking">
                  Transfer Melalui Internet Banking
                </a>
                <span class="ml-auto"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
              </div>
              <div class="step-content collapse" id="internetBanking">
                <div class="card-body py-2 px-2">
                @if($paymentMethod->nama == 'VA Mandiri')
                  <ol>
                    <li>Login ke Internet Banking Mandiri (<a href="https://ibank.bankmandiri.co.id/">https://ibank.bankmandiri.co.id/</a>).</li>
                    <li>Pada menu utama, pilih <strong>Bayar</strong>, lalu pilih <strong>Multi Payment</strong>.</li>
                    <li>Pilih akun Anda di <strong>Dari Rekening</strong>, kemudian di Penyedia Jasa pilih <strong>Midtrans</strong>.</li>
                    <li>Masukkan <strong>Kode Pembayaran</strong> Anda dan klik <strong>Lanjutkan</strong>.</li>
                    <li>Konfirmasi pembayaran Anda menggunakan Mandiri Token.</li>
                  </ol>
                @elseif($paymentMethod->nama == 'VA BNI')
                  <ol>
                    <li>Ketik alamat <a href="https://ibank.bni.co.id">https://ibank.bni.co.id</a> kemudian klik <strong>Enter</strong></li>
                    <li>Masukkan <strong>User ID</strong> dan <strong>Password</strong></li>
                    <li>Klik menu <strong>Transfer</strong> kemudian pilih <strong>Tambah Rekening Favorit</strong>.</li>
                    <li>Masukkan nama, nomor rekening, dan email, lalu klik <strong>Lanjut</strong>.</li>
                    <li>Masukkan <strong>Kode Otentikasi</strong> dari token Anda dan klik <strong>Lanjut</strong>.</li>
                    <li>Kembali ke menu utama dan pilih <strong>Transfer</strong> lalu <strong>Transfer Antar Rekening BNI</strong>.</li>
                    <li>	Pilih rekening yang telah Anda favoritkan sebelumnya di <strong>Rekening Tujuan</strong> lalu lanjutkan pengisian, dan tekan <strong>Lanjut</strong>.</li>
                    <li>Pastikan detail transaksi Anda benar, lalu masukkan <strong>Kode Otentikasi</strong> dan tekan <strong>Lanjut</strong>.</li>
                  </ol>
                @else
                  <ol>
                    <li>Login <strong>Internet Banking</strong></li>
                    <li>Pilih <strong>Transfer Dana</strong></li>
                    <li>Pilih <strong>Transfer ke BCA Virtual Account</strong></li>
                    <li>Input <strong>Virtual Account Number</strong>, yaitu <strong>7001 4501 0242 6284</strong> sebagai <strong>No. Virtual Account</strong></li>
                    <li>Klik <strong>Lanjutkan</strong></li>
                    <li>Input <strong>Respon KeyBCA Appli 1</strong></li>
                    <li>Klik <strong>Kirim</strong></li>
                    <li><strong>Bukti bayar</strong> ditampilkan</li>
                    <li>Selesai</li>
                  </ol>
                @endif
                </div>
              </div>
            </div>
            {{-- End of Internet Banking Instruction --}}
            
            @if($paymentMethod->nama == 'BNI')
              {{-- SMS Banking Instruction --}}
              <div class="card instruction-payment-item mt-3">
                <div class="card-header bg-white d-flex align-items-center">
                  <h5 class="mb-0">
                    <a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#instructionPayment" href="#smsBanking">
                      Transfer Melalui SMS Banking
                    </a>
                  </h5>
                  <span class="ml-auto"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                </div>
                <div class="step-content collapse" id="smsBanking">
                  <div class="card-body py-2 px-2">
                    <ol>
                      <li>Login Aplikasi <strong>SMS Banking BNI</strong></li>
                      <li>Pilih <strong>Menu Transfer</strong></li>
                      <li>Pilih <strong>Trf Rekening BNI</strong></li>
                      <li>Masukkan <strong> Nomor Virtual Account 8319 0010 0314 8960</strong></li>
                      <li>Masukkan Jumlah Tagihan. Misal, <strong>10000</strong></li>
                      <li>Pilih <strong>Proses</strong></li>
                      <li>Pada Pop Up Message, Pilih <strong>Setuju</strong></li>
                      <li>Anda Akan Mendapatkan <strong>Pesan Konfirmasi</strong></li>
                      <li>Masukkan 2 Angka Dari <strong>PIN</strong>Anda Dengan Mengikuti Petunjuk Yang Tertera Pada Pesan</li>
                      <li><strong>Bukti Pembayaran</strong> Ditampilkan</li>
                      <li>Selesai</li>
                    </ol>
                  </div>
                </div>
              </div>
              {{-- End of SMS Banking Instruction --}}
            @endif
          </div>
          <button class="btn btn-outline-secondary btn-block rounded-pill mt-4" data-toggle="modal" data-target="#modalUbahMetodePembayaran" type="button">UBAH METODE PEMBAYARAN</button>
        </div>
        <div class="col-md-4 mb-3 col-order-detail ml-auto p-0 order-1 order-md-2">
          <div class="card">
            <div class="card-header">
              <h5>Detail Tagihan</h5>
            </div>
            <div class="card-body">
              <dl class="row">
                <dt class="col-12">Nama</dt>
                <dd class="col-12">{{$payment->plnCustomer->nama_pelanggan}}</dd>
              
                <dt class="col-12">No. Meter / ID Pelanggan</dt>
                <dd class="col-12">
                  {{$payment->plnCustomer->nomor_meter}}
                </dd>
              
                <dt class="col-12">Tarif / Daya</dt>
                <dd class="col-12">{{$payment->plnCustomer->tariff->golongan_tarif . ' / ' . $payment->plnCustomer->tariff->daya . ' VA'}}</dd>
              
                <dt class="col-12">Bulan/Tahun</dt>
                <dd class="col-12">{{$payment->details->first()->bill->bulan . ' / ' . $payment->details->first()->bill->tahun}}</dd>
              
                <dt class="col-12">Stand Meter</dt>
                <dd class="col-12">
                  {{$payment->details->first()->bill->usage->meter_akhir . '-' . 
                  $payment->details->first()->bill->usage->meter_awal}}
                </dd>
  
                <dt class="col-12">Total Tagihan</dt>
                <dd class="col-12">
                  @rupiah($payment->total_bayar)
                </dd>
  
                <dt class="col-12">Biaya Admin</dt>
                <dd class="col-12">
                  @rupiah(config('const.biaya_admin'))
                </dd>
  
                <dt class="col-12">Total Bayar</dt>
                <dd class="col-12">
                  <span class="pacific-blue font-weight-bold">@rupiah($total)</span>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal ubah metode pembayaran -->
    <div class="modal fade" id="modalUbahMetodePembayaran">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Dengan mengganti metode pembayaran, pembayaran ini akan dibatalkan. Lanjutkan?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light rounded-pill">YA</button>
            <button type="button" class="btn btn-primary btn-cta" data-dismiss="modal">TIDAK</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('addon-script')
    <script>
      $(".clipboard-copy").on("click", function(){
        let copyText = $(this).data("clipboard-text");
        let copyMessage = $(this).data("copy-message");
        let $temp = $("<input>");
        $("body").append($temp);
        $temp.val(copyText).select();
        document.execCommand("copy");
        $temp.remove();
        Swal.fire({
          toast: true,
          icon: 'success',
          position: 'top-end',
          showConfirmButton: false,
          timer:3000,
          title: copyMessage
        })
      });
    </script>
@endpush