@extends('layouts.app')

@section('title', 'How to Pay')

@section('content')
  <div class="container mt-5">
    <h2>Bagaimana Cara Membayar Tagihan Listrik di Megamendung?</h2>
    <div class="card mt-4 shadow">
      <div class="card-body bg-primary-custom">
        Jika Anda masih bingung bagaimana cara membayar tagihan listrik disini, ikuti langkah-langkah berikut untuk panduan yang lebih jelas! <br><br>
        <ol>
          <li>Siapkan nomor meter atau ID Pelanggan Anda</li>
          <li>
            Masukkan nomor meter atau ID Pelanggan Anda
            <img src="{{ asset('assets/img/payment-instruction/step-1.png') }}" class="img-fluid img-thumbnail" width="95%">
          </li>
          <li>
            Lihat jumlah tagihan yang muncul di bawah input nomor meter
            <img src="{{ asset('assets/img/payment-instruction/step-1.2.png') }}" class="img-fluid img-thumbnail" width="95%">
          </li>
          <li>Klik tombol <strong>bayar</strong></li>
          <li>Setelah itu Anda akan diarahkan ke halaman memilih metode pembayaran, <strong>pilih</strong> metode pembayaran yang Anda inginkan</li>
          <li>Ikuti instruksi pembayaran</li>
          <li>Tekan tombol <strong>saya sudah bayar</strong></li>
          <li>Cek status pembayaran di menu <strong>Riwayat Transaksi</strong> di atas</li>
        </ol>
      </div>
    </div>
  </div>
@endsection