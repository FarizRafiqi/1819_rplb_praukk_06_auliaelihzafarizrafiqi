<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pembayaran Kedaluwarsa</title>
  @include('includes.style')
</head>
<body class="h-100 d-flex align-items-center" style="background: url({{asset("assets/img/expired-page.jpg")}}) no-repeat center;">
  <div class="container text-center">
    <h2 class="mb-5 font-weight-bold bg-white">Pembayaran Kedaluwarsa</h2>
    <a href="{{route("home")}}" class="btn btn-secondary-custom">Back to home</a>
  </div>
</body>
</html>