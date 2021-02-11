@extends('layouts.app')

@section('title', 'MegaMendung')

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
<div class="container d-flex justify-content-center">
  <!-- Input ID Pelanggan -->
  <div class="card card-input-no-meteran p-2">
    <div class="card-body">
    <label for="#inputIDPelanggan" class="mb-3">Cek Tagihan Listrik PLN Pascabayar</label>
      <form action="" method="get">
        <div class="form-row">
          <div class="col col-lg-10">
            <input class="form-control form-control-lg" id="inputIDPelanggan" type="text" placeholder="ID Pelanggan">
          </div>
          <div class="col col-lg-2">
            <button class="btn btn-lg btn-secondary-custom" type="submit">Cek Tagihan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End of Input ID Pelanggan -->
  <section class="postpaid-instruction">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="..." class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </section>
  <section class="megamendung-benefit">

  </section>
</div>

<!-- End of Main Content -->
@endsection