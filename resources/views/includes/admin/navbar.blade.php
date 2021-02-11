<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
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
        <ul class="navbar-nav mx-auto">
            <li class="nav-item {{Route::is('admin.dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.dashboard')}}"
                    >Dashboard <span class="sr-only">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pembayaran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Penggunaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tagihan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pelanggan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tarif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Level</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Laporan</a>
            </li>
        </ul>
    </div>
</nav>
<!-- End of Navbar -->