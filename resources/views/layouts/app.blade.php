<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
    @livewireStyles
    <link id="TW_LINK" href="https://css.twik.io/605639f172642.css" onload="TWIK_SB()" rel="stylesheet"/>
    <script>!function(){window.TWIK_ID="605639f172642",localStorage.tw_init=1;var t=document.documentElement;if(window.TWIK_SB=function(){t.style.visibility="",t.style.opacity=""},window.TWIK_RS=function(){var t=document.getElementById("TW_LINK");t&&t.parentElement&&t.parentElement.removeChild(t)},setTimeout(TWIK_RS,localStorage.tw_init?2e3:6e3),setTimeout(TWIK_SB,localStorage.tw_init?250:1e3),document.body)return TWIK_RS();t.style.visibility="hidden",t.style.opacity=0}();</script>
    <script id="TW_SCRIPT" onload="window.TWIK_SB && window.TWIK_SB()" src="https://cdn.twik.io/tcs.js"></script>
  </head>
  <body>
    @include('includes.navbar')
    @yield('content')
    @include('includes.footer')
    
    @stack('prepend-script')
    @include('includes.script')
    @include('sweetalert::alert')
    @livewireScripts
    @stack('addon-script')
  </body>
</html>
