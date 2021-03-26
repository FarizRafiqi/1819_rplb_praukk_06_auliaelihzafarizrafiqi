<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Riwayat Transaksi</title>
  @include('includes.style')
  <!-- fontawesome -->
  <script src="{{asset('assets/plugin/fontawesome/all.js')}}"></script>
  @livewireStyles
</head>
<body>
  @include('includes.navbar')
  <div class="container pt-5">
    <h3 class="mb-4">Riwayat Transaksi</h3>
    @livewire('transaction-history.transaction-history')
  </div>
  @include('includes.script')
  @livewireScripts
  @include('sweetalert::alert')
  @stack('addon-script')
  <script>
    $(".dropdown-item").on("click", function(e){
      e.stopPropagation();
    });
  </script>
</body>
</html>