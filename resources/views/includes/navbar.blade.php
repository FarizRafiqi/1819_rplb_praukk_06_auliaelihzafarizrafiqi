<!-- Navbar -->
<header class="bg-white {{Route::is(['about-us', 'transaction-history']) ? 'border-bottom' : ''}}">
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<a class="navbar-brand" href="{{route('home')}}">
			<img src="{{asset('assets/img/megamendung-logo.png')}}" width="120" height="63" class="d-inline-block align-top" alt="Mega Mendung Logo">
		</a>
		<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarSupportedContent"
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
				<li class="nav-item {{Route::is('transaction-history') ? 'active' : ''}}">
						<a class="nav-link" href="{{route('transaction-history')}}">Riwayat Transaksi</a>
				</li>
				@guest
					<li class="nav-item">
						<a href="{{route('register')}}" class="nav-link btn btn-primary-custom">Register</a>
					</li>
					<li class="nav-item">
						<a href="{{route('login')}}" class="nav-link">Login</a>
					</li>
				@endguest

				@auth
					@if(auth()->user()->isAdmin() || auth()->user()->isBank())
						<form action="{{route('admin.dashboard')}}">
							<button type="submit" class="btn my-0 my-md-2 px-1 px-md-2">
								Dashboard
							</button>
						</form>
					@endif
					<form action="{{route('logout')}}">
						<button type="submit" class="btn btn-primary-custom my-2 my-sm-0">
							Logout
						</button>
					</form>
				@endauth
				</ul>
		</div>
	</nav>
</header>
<!-- End of Navbar -->