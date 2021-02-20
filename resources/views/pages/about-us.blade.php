@extends('layouts.app')

@section('title', 'About Us')

@section('content')
  <div class="container pt-5">
    <h1 class="text-center font-weight-bold">Tentang Kami</h1>
    <p class="text-center lead">
      Aplikasi Mega Mendung adalah sebuah aplikasi pembayaran listrik pascabayar yang berbasis web <br>
      dimana siapapun dapat mengecek info tagihan listrik dan membayar tagihan listrik secara mudah dan efisien.
    </p>
    <section class="mt-5">
      <div class="card mx-auto" style="width: 18rem;">
        <img src="{{asset('assets/img/avatar-of-me.svg')}}" class="card-img-top" alt="Avatar">
        <div class="card-body">
          <h5 class="mb-1">Administrator</h5>
          <h5 class="font-weight-bold card-title">Aulia El Ihza Fariz Rafiqi</h5>
          <p class="card-text">
            Saya adalah orang yang ambisius. Saya suka dengan ketenangan, dan saya orang yang simpel.
          </p>
        </div>
      </div>
    </section>
  </div>
@endsection