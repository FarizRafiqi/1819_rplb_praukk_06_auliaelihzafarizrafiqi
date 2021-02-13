@extends('layouts.app')

@section('title', 'MegaMendung - Semua serba bisa')

@section('content')
    
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row">
      <div class="col col-lg-6 left-side">
        <img src="{{ asset('assets/img/illustrasi/mobile-payment-illustration@2x.png') }}" class="ilustrasi-mobile-payment" alt="mobile-payment-illustration" width="300px">
      </div>
      <div class="col col-lg-6 right-side">
        <h1 class="display-5">Penuhi Kebutuhan Listrik Kamu</h1>
        <p class="lead">
        Kini cek dan bayar tagihan listrik PLN tidak perlu keluar <br>
        rumah. Kamu bisa melakukan itu dengan mudah di <br>
        website MegaMendung.
        </p>
        <img src="{{ asset('assets/img/icopln.png') }}" alt="ICON PLN" width="43" height="63">
      </div>
    </div>
  </div>
</div>
<!-- End of Jumbotron -->

<!-- Main Content -->
<div class="container">
  <!-- Input ID Pelanggan -->
  <div class="d-flex justify-content-center">
    <div class="card card-input-no-meteran p-2">
      <div class="card-body">
        <label for="#inputIDPelanggan" class="mb-3">Cek Tagihan Listrik PLN Pascabayar</label>
        <form action="" method="get">
          <div class="form-row">
            <div class="col col-10">
              <input class="form-control form-control-lg" id="inputIDPelanggan" type="text" placeholder="ID Pelanggan" name="idPelanggan">
            </div>
            <div class="col col-2">
              <button class="btn btn-lg btn-secondary-custom" type="submit">Cek Tagihan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Input ID Pelanggan -->

  <section class="postpaid-instruction">
    <h3 class="title text-center">Bagaimana Cara Bayar Tagihan Listrik di Mega Mendung</h3>
    <div id="carouselExampleControls" class="carousel slide d-flex" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item step step-one active">
          <div class="row">
            <div class="col col-8">
              <p class="step-one-text">
                1. Siapkan Nomor Meter atau <br>
                  ID Pelanggan Anda.
              </p>
            </div>
            <div class="col col-4">
              <img src="{{ asset('assets/img/illustrasi/ilustrasi-meteran-listrik@2x.png') }}" class="d-block ilustrasi-meteran-listrik text-right" alt="Ilustrasi Meteran Listrik">
            </div>
          </div>
        </div>
        <div class="carousel-item step step-two">
          <div class="row">
            <div class="col col-8">
              <p class="step-one-text">
                2. Buka website Mega Mendung <br>
                melalui desktop atau mobile.
              </p>
            </div>
            <div class="col col-4">
              <img src="{{ asset('assets/img/illustrasi/search-illustration@2x.png') }}" class="d-block search-illustration text-right" alt="Ilustrasi Mencari Website">
            </div>
          </div>
        </div>
        <div class="carousel-item step step-three">
          <div class="row">
            <div class="col col-8">
              <p class="step-one-text">
              3. Kemudian masukkan nomor meter <br>
                atau ID Pelanggan.
              </p>
            </div>
            <div class="col col-4">
              <img src="{{ asset('assets/img/illustrasi/ilustrasi-input-id-pelanggan@2x.png') }}" class="d-block ilustrasi-input-id-pelanggan text-right" alt="Ilustrasi Memasukkan ID Pelanggan">
            </div>
          </div>
        </div>
        <div class="carousel-item step step-four">
          <div class="row">
            <div class="col col-8">
              <p class="step-one-text">
                4. Klik tombol <strong>Cek Tagihan</strong>.
              </p>
            </div>
            <div class="col col-4">
              <img src="{{ asset('assets/img/illustrasi/ilustrasi-klik-tombol-cek-tagihan@2x.png') }}" class="d-block ilustrasi-klik-tombol-cek-tagihan text-right" alt="Ilustrasi Memasukkan ID Pelanggan">
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon p-4"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon p-4"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <section class="megamendung-benefit">
    <h3 class="title text-center">
      Kenapa Lebih Baik Pakai Mega Mendung
    </h3>
    <div class="row px-5">
      <div class="col col-4 benefit-item first-benefit text-center">
        <img src="{{asset('assets/img/mm-icon/auto-payment-icon@2x.png')}}" alt="Auto Payment Icon" class="mx-auto" width="63" height="63">
        <p class="desc">
          Terdapat fitur pembayaran <br>
          tagihan otomatis
        </p>
      </div>
      <div class="col col-4 benefit-item second-benefit text-center">
        <img src="{{asset('assets/img/mm-icon/money-icon@2x.png')}}" alt="Money Icon" class="mx-auto" width="80" height="56.3">
        <p class="desc">
          Dapatkan cashback/bonus <br>
          tiap transaksi
        </p>
      </div>
      <div class="col col-4 benefit-item third-benefit text-center">
        <img src="{{asset('assets/img/mm-icon/wallet-icon@2x.png')}}" alt="Wallet Icon" class="mx-auto" width="61" height="53">
        <p class="desc">
          Tersedia berbagai metode <br>
          pembayaran
        </p>
      </div>
    </div>
  </section>
</div>

<!-- End of Main Content -->
@endsection