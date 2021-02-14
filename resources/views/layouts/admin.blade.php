<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')
  <!-- fontawesome -->
  <script src="{{asset('assets/plugin/fontawesome/all.js')}}"></script>
</head>
<body class="d-flex flex-column h-100">
  @include('includes.admin.navbar')
  <!-- @include('includes.admin.sidebar') -->
  <div class="container-dashboard mt-5">
    @yield('content')
  </div>
  @include('includes.admin.footer')

  @stack('prepend-script')
  @include('includes.admin.script')
  @include('sweetalert::alert')
  @stack('addon-script')
</body>
</html>