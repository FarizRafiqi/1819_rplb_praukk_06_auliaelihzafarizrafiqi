<!-- Navbar -->
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white mx-0 px-5 navbar-dashboard">
		<a class="navbar-brand" href="">
		<img src="{{asset('assets/img/megamendung-logo.png')}}" width="120" height="63.6" class="d-inline-block align-top" alt="Logo Mega Mendung">
		</a>
		<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarDashboard"
		>
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarDashboard">
		<ul class="navbar-nav mx-auto">
			<li class="nav-item {{Route::is('admin.dashboard') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.dashboard')}}">
					Dashboard <span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item {{Route::is('admin.payment.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.payment.index')}}">Pembayaran</a>
			</li>
			<li class="nav-item {{Route::is('admin.usage.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.usage.index')}}">Penggunaan</a>
			</li>
			<li class="nav-item {{Route::is('admin.bill.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.bill.index')}}">Tagihan</a>
			</li>
			<li class="nav-item {{Route::is('admin.users.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
			</li>
			<li class="nav-item {{Route::is('admin.pln-customers.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.pln-customers.index')}}">Pelanggan</a>
			</li>
			<li class="nav-item {{Route::is('admin.tariff.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.tariff.index')}}">Tarif</a>
			</li>
			<li class="nav-item {{Route::is('admin.level.*') ? 'active' : ''}}">
				<a class="nav-link" href="{{ route('admin.level.index') }}">Level</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{route('admin.reports')}}">Laporan</a>
			</li>
		</ul>

		<div class="dropdown">
			<a class="dropdown-toggle text-decoration-none text-dark ml-1" href="#" id="navbarScrollingDropdown" data-toggle="dropdown">
				{{ucwords(\Auth::user()->username)}}
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="{{route('admin.profile.index')}}">Profile</a></li>
				<li><hr class="dropdown-divider"></li>
				<li>
					<a href="{{route('logout')}}" class="dropdown-item">Logout</a>
				</li>
			</ul>
			<img src="{{asset('assets/img/avatar-frame.png')}}" class="rounded-circle d-lg-inline-block d-none ml-3" alt="Avatar">
		</div>
		</div>
	</nav>
</header>
<!-- End of Navbar -->