<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Riwayat Transaksi</title>
  @include('includes.style')
  <!-- fontawesome -->
  <script src="{{ asset('assets/plugin/fontawesome/all.js') }}"></script>
  @livewireStyles
</head>
<body>
  @include('includes.navbar')
  <div class="container py-5">
    <h3 class="mb-4">Riwayat Transaksi</h3>
    @livewire('transaction-history.transaction-history')
  </div>
  @include('includes.footer')
  @include('includes.script')
  @livewireScripts
  @include('sweetalert::alert')
  @stack('addon-script')
  <script>
    $(".dropdown-item").on("click", function(e){
      e.stopPropagation();
    });
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/605652d7067c2605c0ba9926/1f18j77cp';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
</body>
</html>