<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-white mx-0 {{(bool)Cookie::get('enable_sidebar') ? 'px-5' : 'px-3'}} navbar-dashboard">
    <button class="navbar-toggler" type="button" data-target="#sidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="nav-item ml-auto dropdown" id="navbarNavDropdown">
      <a class="dropdown-toggle text-decoration-none text-dark ml-1 d-inline-block" href="#" id="navbarScrollingDropdown" data-toggle="dropdown">
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
      <img src="{{asset('assets/img/avatar-frame.png')}}" class="rounded-circle ml-3" alt="Avatar">
    </div>
  </nav>
</header>