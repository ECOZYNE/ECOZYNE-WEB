<!-- Header -->
<header class="app-header shadow">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{ asset('assets/images/profile/users.png') }}" alt="" width="35" height="35"
              class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">

              <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-home fs-6"></i>
                <p class="mb-0 fs-3">Beranda</p>
              </a>


              <a href="{{ Auth::user()->role === 'admin' ? url('admin/my-profile') : url('dashboard/my-profile') }}"
                class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3">Profil Saya</p>
              </a>

              <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger mx-3 mt-3 d-block">Logout</button>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>