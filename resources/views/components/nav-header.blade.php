<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets2/img/ecozyne.png" alt="">
        <h1 class="sitename">Ecozyne</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#services">Kegiatan</a></li>
            <li><a href="{{ url('blog') }}" class="{{ request()->is('blog') ? 'active' : '' }}">Artikel</a></li>
            <li><a href="{{ url('produk') }}" class="{{ request()->is('produk') ? 'active' : '' }}">Produk</a></li>
            <li><a href="{{ url('hadiah') }}" class="{{ request()->is('hadiah') ? 'active' : '' }}">Hadiah</a></li>
            <li><a href="#footer">Kontak</a></li>
            
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="login">Gabung Kami !</a>

    </div>
  </header>