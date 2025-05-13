<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Ecozyne</title>

  <!-- Link ke stylesheet eksternal -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css">

  <!-- Meta Tags untuk SEO -->
  <meta name="description" content="Ecozyne - Sistem Pengelolaan Sampah dan Komunitas Berkelanjutan">
  <meta name="keywords" content="ecozyne, pengelolaan sampah, komunitas berkelanjutan, e-commerce">
  <meta name="author" content="Ecozyne Team">
</head>
<body>


<style>
  .profile-dropdown {
    display: flex;
    align-items: center;
    margin-left: 30px;
  }

  .profile-dropdown img {
    cursor: pointer;
  }

  @media (max-width: 1114px) {
  .logout-button {
    display: block;
  }
}

@media (min-width: 1115px) {
  .logout-button {
    display: none;
  }
}

.profile-dropdown img {
  cursor: pointer;
  transition: all 0.3s ease; 
}

.profile-dropdown img:hover {
  transform: scale(1.05); 
  box-shadow: 0 0 5px rgba(127, 201, 127, 0.5); 
}

.profile-dropdown img[aria-expanded="true"] {
  box-shadow: 0 0 15px rgba(127, 201, 127, 0.8); 
  transform: scale(1.05);
  border: 2px solid #7FC97F; 
}

/* Efek glow/bersinar */
@keyframes glow {
  0% {
    box-shadow: 0 0 5px #7FC97F;
  }
  50% {
    box-shadow: 0 0 20px #115511;
  }
  100% {
    box-shadow: 0 0 5px #7FC97F;
  }
}

.profile-dropdown img[aria-expanded="true"] {
  animation: glow 2s infinite; 
}

</style>

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <!-- Logo -->
    <a href="index.html" class="logo d-flex align-items-center me-auto">
      <img src="assets2/img/ecozyne.png" alt="Ecozyne Logo">
      <h1 class="sitename">Ecozyne</h1>
    </a>

    <!-- Navigation Menu -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="#about">Tentang Kami</a></li>
        <li><a href="#services">Kegiatan</a></li>
        <li><a href="{{ url('artikel') }}" class="{{ request()->is('artikel') ? 'active' : '' }}">Artikel</a></li>
        <li><a href="{{ url('bank_sampah') }}" class="{{ request()->is('bank_sampah') ? 'active' : '' }}">Bank Sampah</a></li>
        <li><a href="#ervices">Kontak</a></li>

        <!-- Logout Button (Mobile & Tablet) -->
        <li class="d-block d-md-block d-lg-none">
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger mx-3 mt-2 d-block w-30">
              Logout
            </button>
          </form>
        </li>

      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @php
    $user = Auth::user();
    @endphp

@if ($user && $user->id_user)
    @if ($user->role !== 'komunitas')
        <a class="btn-getstarted flex-md-shrink-0" href="/login">Gabung Kami!</a>
      @else
        <div class="profile-dropdown d-none d-xl-flex">
          <a href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/images/profile/users.png') }}" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">
         
              <a href="{{ session('role') === 'admin' ? url('admin/index') : url('dashboard/index') }}"
                 class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3">Akun Saya</p>
              </a>

              <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger mx-3 mt-3 d-block">Logout</button>
              </form>
            </div>
          </div>
        </div>
      @endif
    @else
      <a class="btn-getstarted flex-md-shrink-0" href="/login">Gabung Kami!</a>
    @endif

  </div>
</header>


</body>
</html>