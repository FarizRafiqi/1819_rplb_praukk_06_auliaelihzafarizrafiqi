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
  @livewireStyles
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
</head>
<body class="d-flex flex-column h-100">
  {{-- @if((bool)Cookie::get('enable_sidebar') == false) --}}
    {{-- @include('includes.admin.navbar') --}}
  {{-- @elseif(Cookie::get('enable_sidebar')) --}}
    @include('includes.admin.sidebar')
    @include('includes.admin.navbar-admin-alternate')
  {{-- @endif --}}
  <main class="flex-shrink-0" id="main">
    <div class="container-dashboard mt-5">
      @yield('content')
    </div>
  </main>
  @include('includes.admin.footer')

  @stack('prepend-script')
  @include('includes.admin.script')
  @include('sweetalert::alert')
  @livewireScripts
  @stack('addon-script')
  <script>
    // let statusEnableSidebar = @json(Cookie::get('enable_sidebar'));
    $("#switchNavbar").on("click", function(){
        $(this).parent().parent().submit();
    });
    
    //tutup sidebar, ketika user mengklik tombol silang
    $(".closebtn").on("click", function(){
      $("#sidebar").css('width', '0');
      $("main").css('margin-left', '0px');
      $(".navbar-toggler").css('display', 'inline-block');
    });

    $(".navbar-toggler").on("click", function(){
      $("#sidebar").css('width', '260px');
      if(!navigator.userAgent.toLowerCase().match('mobile')){
        $("main").css('margin-left', '260px');
      }
    });

    $('#collapseManajemenUser').on('show.bs.collapse', function () {
      $(".bi-chevron-right").css('transform', 'rotate(90deg)');
    })

    $('#collapseManajemenUser').on('hide.bs.collapse', function () {
      $(".bi-chevron-right").css('transform', 'rotate(0deg)');
    })
  </script>
</body>
</html>