<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <title>Register</title>
</head>
<style>
  body{
    background-color: #28b7ca;
  }
</style>
<body class="h-100">
  @include('includes.navbar-alternate')
  
  <div class="auth-form container h-100 d-flex justify-content-center align-items-center">
    <div div class="card p-3">
      <div class="card-body">
        <form action="{{route('auth.register')}}" method="POST" class="form-row align-items-center">
          @csrf
          <div class="col-12 col-md-6">
            <h1>Buat Akun</h1>
            <strong>Sudah menjadi pengguna?</strong> <a href="{{route('login')}}" class="text-decoration-none">Masuk</a>
            <div class="form-group mt-4 mb-3">
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Lengkap">
              @error('nama')
                <span class="invalid-feedback text-danger">{{$message}}</span>    
              @enderror
            </div>
            <div class="form-group mb-3">
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username">
              @error('username')
                <span class="invalid-feedback text-danger">{{$message}}</span>    
              @enderror
            </div>
            <div class="form-group mb-3">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
              @error('email')
                <span class="invalid-feedback text-danger">{{$message}}</span>    
              @enderror
            </div>
            <div class="form-group mb-3">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
              @error('password')
                <span class="invalid-feedback text-danger">{{$message}}</span>    
              @enderror
            </div>
            <div class="form-group mb-3">
              <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder="Konfirmasi Password">
              @error('password_confirmation')
                <span class="invalid-feedback text-danger">{{$message}}</span>    
              @enderror
            </div>
            <button class="btn btn-primary-custom btn-block" type="submit">Daftar</button>
          </div>
          <div class="col-md-6 text-center d-none d-md-flex">
            <img src="{{ asset('assets/img/illustrasi/illustration-register@2x.png') }}" width="420" height="380" alt="illustrasi register">
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('sweetalert::alert')
</body>
</html>