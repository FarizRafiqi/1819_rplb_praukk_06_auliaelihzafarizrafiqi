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
