@extends('layouts.auth')
@section('title', 'Login')
@push('styles')
  <style>
    body{
      background-color: #28b7ca;
    }
  </style>
@endpush
@section('content')
<div class="wrapper-auth-form d-flex justify-content-center align-items-center">
  <div class="auth-form container d-flex justify-content-center align-items-center">
    <div div class="card p-3">
      <div class="card-body">
        <form action="{{route('auth.login')}}" method="POST" class="form-row" >
          @csrf
          <div class="col-12 col-md-6">
            <h1>Masuk</h1>
            <strong>Pengguna Baru?</strong> <a href="{{route('register')}}" class="text-decoration-none">buat akun.</a>
            <div class="form-group mt-4 mb-3">
              <input type="email" name="email" class="form-control @error('email')
                is-invalid    
              @enderror" value="{{old('email')}}" placeholder="Email">
              @error('email')
                <span class="invalid-feedback">{{$message}}</span>    
              @enderror
            </div>
            <div class="form-group mb-3">
              <input type="password" name="password" class="form-control @error('password')
                is-invalid    
              @enderror" placeholder="Password">
              @error('password')
                <span class="invalid-feedback">{{$message}}</span>    
              @enderror
            </div>
            <div class="custom-control custom-checkbox mr-sm-2 mb-3">
              <input type="checkbox" name="remember_me" class="custom-control-input" id="customControlAutosizing">
              <label class="custom-control-label" for="customControlAutosizing">Keep me signed in</label>
            </div>
            <div class="form-group">
              <a href="{{route('password.request')}}" class="text-decoration-none">Lupa Password?</a>
            </div>
            <button class="btn btn-primary-custom btn-block" type="submit">Masuk</button>
            <div class="text-center my-2">
              <span>Atau</span>
            </div>
            <a href="{{route('auth.google')}}" class="btn btn-primary btn-block">
              Login dengan Google
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
              </svg>
            </a>
          </div>
          <div class="col-md-6 text-center d-none d-md-inline-block">
            <img src="{{ asset('assets/img/ilustrasi/ilustrasi-log-in.png') }}" class="img-fluid"/>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection