<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light {{Route::is(['about-us', 'riwayat-transaksi']) ? 'border-bottom' : ''}}">
    <a class="navbar-brand" href="">
      <img src="{{asset('assets/img/megamendung-logo.png')}}" width="120" height="63.6" class="d-inline-block align-top" alt="">
    </a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item {{Route::is('home') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a
					>
				</li>
				<li class="nav-item {{Route::is('about-us') ? 'active' : ''}}">
						<a class="nav-link" href="{{route('about-us')}}">Tentang Kami</a>
				</li>
				<li class="nav-item {{Route::is('riwayat-transaksi') ? 'active' : ''}}">
						<a class="nav-link" href="{{route('riwayat-transaksi')}}">Riwayat Transaksi</a>
				</li>
			</ul>
			@if (\Agent::isMobile())
				<div class="my-1 my-lg-0">
					@guest
						<a href="{{route('register')}}" class="btn btn-primary-custom mx-2 my-2 my-sm-0">
							Register
						</a>
						<a href="{{route('login')}}" class="btn my-2 my-sm-0">
							Login
						</a>
					@endguest
						
					@if(\Auth::user()->id_level === 1)
						<a href="{{route('admin.dashboard')}}" class="btn my-2 my-sm-0">
							Dashboard
						</a>
					@endif

					@auth
						<a href="{{route('logout')}}" class="btn btn-primary-custom my-2 my-sm-0">
							Logout
						</a>
					@endauth
				</div>
			@else
				<div class="ml-2 my-2 my-lg-0">
					@guest
						<a href="{{route('register')}}" class="btn btn-primary-custom mx-2 my-2 my-sm-0">
							Register
						</a>
						<a href="{{route('login')}}" class="btn my-2 my-sm-0">
							Login
						</a>
					@endguest
					
					@if(\Auth::user()->id_level === 1)
						<a href="{{route('admin.dashboard')}}" class="btn pl-0 my-2 my-sm-0">
							Dashboard
						</a>
					@endif

					@auth
						<a href="{{route('logout')}}" class="btn btn-primary-custom my-2 my-sm-0">
							Logout
						</a>
					@endauth
				</div>
			@endif
    </div>
</nav>
<!-- End of Navbar -->