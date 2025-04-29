<style>
  .profile-dropdown {
    display: flex;
    align-items: center;
    margin-left: 30px;
    /* atau 20px jika ingin lebih longgar */
  }

  .profile-dropdown img {
    cursor: pointer;
  }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="index.html" class="logo d-flex align-items-center me-auto">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <img src="assets2/img/ecozyne.png" alt="">
      <h1 class="sitename">Ecozyne</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li class="d-md-none"><a href="/profile"><img src="..." class="rounded-circle" width="30"></a></li>

        <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="#about">Tentang Kami</a></li>
        <li><a href="#services">Kegiatan</a></li>
        <li><a href="{{ url('artikel') }}" class="{{ request()->is('artikel') ? 'active' : '' }}">Artikel</a></li>
        <li><a href="{{ url('produk') }}" class="{{ request()->is('produk') ? 'active' : '' }}">Produk</a></li>
        <li><a href="{{ url('hadiah') }}" class="{{ request()->is('hadiah') ? 'active' : '' }}">Hadiah</a></li>
        <li><a href="#footer">Kontak</a></li>

      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- <a class="btn-getstarted flex-md-shrink-0" href="login">Gabung Kami !</a> --}}

    @if (session('user_id'))
    @if (session('role') !== 'komunitas')
    <a class="btn-getstarted flex-md-shrink-0" href="/login">Gabung Kami!</a>
  @else
  <!-- Tampilkan Profile Picture -->
  <div class="profile-dropdown">
    <a href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
    <div class="message-body">

      <div class="dropdown-item pt-0 mb-2">
        @php
          $points = session('points', 100); // ganti 100 dgn session real kamu
          $maxPoints = 1000;
          $progress = min(100, ($points / $maxPoints) * 100);
        @endphp
      
        <div class="d-flex justify-content-between mb-1">
          <small>{{ $points }} XP</small>
          <small>{{ $maxPoints }} XP</small>
        </div>
      
        <div class="progress" style="height: 10px; background-color: #333;">
          <div class="progress-bar" 
               role="progressbar" 
               style="width: {{ $progress }}%; background-color: #7FC97F;" 
               aria-valuenow="{{ $points }}" 
               aria-valuemin="0" 
               aria-valuemax="{{ $maxPoints }}">
          </div>
        </div>
      </div>
      
    <a href="{{ session('role') === 'admin' ? url('admin/index') : url('dashboard/index') }}"
    class="d-flex align-items-center gap-2 dropdown-item">
    <i class="ti ti-user fs-6"></i>
    <p class="mb-0 fs-3">Akun Saya</p>
    </a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</button>
    </form>
    </div>
    </div>
  </div>
@endif
  @else
  <a class="btn-getstarted flex-md-shrink-0" href="/login">Gabung Kami!</a>
@endif


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css" />

  </div>
</header>