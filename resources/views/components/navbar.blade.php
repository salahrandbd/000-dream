@vite('resources/js/app.js')

<header class="page-topbar" id="page-topbar">
  <div class="navbar-header container-fluid">
    <div class="navbar-left-wrapper d-flex">
      <div class="navbar-brand-box px-0 text-start">
        <a class="logo text-decoration-none">
          <x-logo mode="light"/>
        </a>
      </div>
      {{-- <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
        <i class="bi bi-list"></i>
      </button> --}}
    </div>

    <div class="navbar-right-wrapper d-flex">
      @guest()
        <div class="auth-btns">
          <a href="/login" class="login-btn btn btn-primary text-white">Login</a>
        </div>
      @endguest

      @auth
        <div class="dropdown d-inline-block user-dropdown">
          <button type="button" class="btn header-item waves-effect border-0 bg-transparent" id="page-header-user-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle" width="32" src="{{ asset('storage/images/'. auth()->user()->pseudoName->gender .'.png') }}" alt="Header Avatar">
            <span class="d-none d-md-inline-block mx-1">{{ auth()->user()->pseudoName->name }}</span>
            <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#">
              <i class="bi bi-person-circle text-primary"></i>
              <span class="ms-1">Edit Profile</span>
            </a>
            <a class="dropdown-item" href="/logout">
              <i class="bi bi-power text-primary"></i>
              <span class="ms-1">Logout</span>
            </a>
          </div>
        </div>
      @endauth
    </div>
  </div>
</header>
