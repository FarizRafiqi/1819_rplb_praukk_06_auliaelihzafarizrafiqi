<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link" href="{{route('home')}}"
                    >Home <span class="sr-only">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Riwayat Transaksi</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="{{route('register')}}" class="btn btn-primary-custom mx-2 my-2 my-sm-0" type="submit">
                Register
            </a>
            <a href="{{route('login')}}" class="btn my-2 my-sm-0" type="submit">
                Login
            </a>
        </form>
    </div>
</nav>
<!-- End of Navbar -->