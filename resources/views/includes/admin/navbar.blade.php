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
			@can('payment_access')
				<li class="nav-item {{Route::is('admin.payments.*') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('admin.payments.index')}}">Pembayaran</a>
				</li>
			@endcan
			@can('usage_access')
				<li class="nav-item {{Route::is('admin.usages.*') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('admin.usages.index')}}">Penggunaan</a>
				</li>
			@endcan
			@can('bill_access')
				<li class="nav-item {{Route::is('admin.bills.*') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('admin.bills.index')}}">Tagihan</a>
				</li>
			@endcan
			@can('user_management_access')
				<li class="nav-item dropdown {{Route::is('admin.users.*') || Route::is('admin.levels.*') || Route::is('admin.activity-logs.*') || Route::is('admin.permissions.*') ? 'active' : ''}}">
					<a class="nav-link dropdown-toggle" href="{{ route('admin.users.index') }}" id="navbarDropdown" data-toggle="dropdown">
						Manajemen User
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item {{Route::is('admin.users.*') ? 'active' : ''}}" href="{{route('admin.users.index')}}">User</a>
						<a class="dropdown-item {{Route::is('admin.permissions.*') ? 'active' : ''}}" href="{{route('admin.permissions.index')}}">Hak Akses</a>
						<a class="dropdown-item {{Route::is('admin.levels.*') ? 'active' : ''}}" href="{{route('admin.levels.index')}}">Level</a>
						<a class="dropdown-item {{Route::is('admin.activity-logs.*') ? 'active' : ''}}" href="{{route('admin.activity-logs.index')}}">Log Aktivitas</a>
					</div>
				</li>
			@endcan
			@can('pln_customer_access')
				<li class="nav-item {{Route::is('admin.pln-customers.*') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('admin.pln-customers.index')}}">Pelanggan</a>
				</li>
			@endcan
			@can('tariff_access')
				<li class="nav-item {{Route::is('admin.tariffs.*') ? 'active' : ''}}">
					<a class="nav-link" href="{{route('admin.tariffs.index')}}">Tarif</a>
				</li>
			@endcan
			<li class="nav-item {{Route::is('admin.reports') ? 'active' : ''}}">
				<a class="nav-link" href="{{route('admin.reports')}}">Laporan</a>
			</li>
		</ul>

		<div class="dropdown">
			<a class="dropdown-toggle text-decoration-none text-dark ml-1" href="#" id="navbarScrollingDropdown" data-toggle="dropdown">
				{{ucwords(\Auth::user()->username)}}
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="{{route('admin.profile.index')}}">Profile</a></li>
				<li><a class="dropdown-item" href="{{route('admin.settings')}}">Setting</a></li>
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