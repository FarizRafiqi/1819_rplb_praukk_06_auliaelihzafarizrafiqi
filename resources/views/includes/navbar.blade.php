<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light {{Route::is(['about-us', 'transaction-history']) ? 'border-bottom' : ''}}">
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
			</div>
		@else
			@guest
				<a href="{{route('register')}}" class="btn btn-primary-custom mx-2 my-2 my-sm-0">
					Register
				</a>
				<a href="{{route('login')}}" class="btn my-2 my-sm-0">
					Login
				</a>
			@endguest

			@auth
				@if (auth()->user()->isAdmin() || auth()->user()->isBank())
					<form action="{{route('admin.dashboard')}}" class="form-inline my-2 my-sm-0">
						<button type="submit" class="btn my-2">
							Dashboard
						</button>
					</form>
				@endif
				<form action="{{route('logout')}}" class="form-inline my-2 my-sm-0 ml-2">
					<button type="submit" class="btn btn-primary-custom my-2">
						Logout
					</button>
				</form>
			@endauth
		@endif
	</div>
</nav>
<!-- End of Navbar -->