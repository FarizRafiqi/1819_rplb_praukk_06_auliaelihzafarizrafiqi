<!DOCTYPE html>
<html lang="en">
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
<body>
  @include('includes.navbar-alternate')
  <div class="wrapper-auth-form d-flex justify-content-center align-items-center">
    <div class="auth-form container d-flex justify-content-center align-items-center">
      <div div class="card p-3">
        <div class="card-body">
          <form class="form-row">
            <div class="col col-6">
              <h1>Buat Akun</h1>
              <strong>Sudah menjadi pengguna?</strong> <a href="{{route('login')}}" class="text-decoration-none">Masuk</a>
              <div class="form-group mt-4 mb-3">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username">
              </div>
              <div class="form-group mb-3">
                <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="Email">
              </div>
              <div class="form-group mb-3">
                <input type="password" class="form-control" id="exampleFormControlInput3" placeholder="Password">
              </div>
              <button class="btn btn-primary-custom btn-block" type="submit">Sign Up</button>
            </div>
            <div class="col col-6 text-center">
              <img src="{{ asset('assets/img/illustrasi/illustration-register@2x.png') }}" class="img-fluid" width="380.84" height="361.78" alt="illustrasi register">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>