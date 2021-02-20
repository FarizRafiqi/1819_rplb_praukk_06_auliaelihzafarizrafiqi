<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <title>Login</title>
</head>
<style>
  body{
    background-color: #28b7ca;
  }
</style>  
<body>
  @include('includes.navbar-alternate')
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
                @enderror" placeholder="Email">
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
                <a href="#" class="text-decoration-none">Lupa Password?</a>
              </div>
              <button class="btn btn-primary-custom btn-block" type="submit">Masuk</button>
            </div>
            <div class="col-md-6 text-center d-none d-md-inline-block">
              <img src="{{ asset('assets/img/illustrasi/illustration-login@2x.png') }}" class="img-fluid" width="240" alt="illustrasi login">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @include('sweetalert::alert')
</body>
</html>