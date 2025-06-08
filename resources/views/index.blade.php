@extends('layouts.index')

@push('style')
  <link rel="stylesheet" href="{{ asset('assets/css/styles-index.css') }}" />
@endpush

@section('title', 'Ecozyne | Eco Enzyme Network')

@section('content')

  <!-- Hero Section -->
  <section id="hero" class="hero section">

    <div class="container">
    <div class="row gy-4">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
      <h1 data-aos="fade-up">Jaga Lingkungan, Selamatkan Masa Depan!</h1>
      <p data-aos="fade-up" data-aos-delay="100">Eco Enzyme adalah solusi alami untuk menjaga kebersihan dan
        kelestarian lingkungan. Dengan mengolah sampah organik menjadi cairan serbaguna, kita bisa mengurangi
        limbah dan menciptakan lingkungan yang lebih sehat.</p>
      <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
        <a href="#about" class="btn-get-started">Mulai Sekarang ! <i class="bi bi-arrow-right"></i></a>
        <a href="assets2/vid/eco_enzyme1.mp4"
        class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"
        data-gallery="video-gallery" data-type="video" data-poster="assets2/img/thumb1.png">
        <i class="bi bi-play-circle"></i><span>Tonton Video</span>
        </a>

        <!-- Video Kedua -->
        <a href="assets2/vid/eco_enzyme2.mp4" class="glightbox d-none" data-gallery="video-gallery" data-type="video"
        data-poster="assets2/img/thumb2.png">
        </a>
      </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
      <img src="assets2/img/hand-plant.svg" class="img-fluid animated" alt="">
      </div>
    </div>
    </div>

  </section>

  <!-- About Section -->
  <section id="about" class="about">

    <div class="container" data-aos="fade-up">
    <div class="row gx-0">
      <div class="col-lg-4 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
      <img src="../assets/images/logos/section-about.png" class="img-fluid" alt="">
      </div>
      <div class="col-lg-8 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
      <div class="content">
        <h3>Apa itu Ecozyne?</h3>
        <h2>Ecozyne merupakan platform berbasis web yang berfokus pada edukasi dan promosi pemanfaatan Eco Enzyme
        secara berkelanjutan.</h2>
        <p>
        Sistem ini dikembangkan untuk meningkatkan kesadaran masyarakat tentang pentingnya pengelolaan limbah
        organik serta pemanfaatannya menjadi Eco Enzyme yang ramah lingkungan dan bernilai guna.
        </p>
        <div class="text-center text-lg-start">
        <a href="tentang-eco-enzim"
          class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
          <span>Selengkapnya</span>
          <i class="bi bi-arrow-right"></i>
        </a>
        </div>
      </div>
      </div>
    </div>

  </section><!-- End About Section -->

  <section class="py-5" style="background-color: #f9fbff;">
    <div class="container d-flex flex-column flex-md-row-reverse align-items-center gap-5 justify-content-center">

    <!-- Kolom Kanan: Teks + Tombol -->
    <div class="text-center text-md-start" style="max-width: 500px;">
      <h2 class="fw-bold mb-3">Mulai Setor Sampah</h2>
      <p>
      Dengan <strong>Ecozyne</strong> Kamu bisa
      <strong>Jadikan sampah menjadi berkah</strong> dapet banyak
      <strong>peluang hadiah</strong>. Tukarkan sampah mu di bank sampah terdekat
      <em>Kita akan bantu kamu menumukan bank sampah terdekat!</em>
      </p>

      <!-- Tanda Panah dan Tombol -->
      <div class="cta-wrapper text-center text-md-start">
      <div class="arrow-down fs-12">↓</div>
      <a href="bank_sampah" class="btn btn-custom-green fw-bold mt-3 px-4 py-2 rounded-1">
        <i class="fas fa-search me-2"></i> Cari Bank Sampah </a>
      </div>
    </div>

    <!-- Kolom Kiri: Gambar -->
    <div class="text-center">
      <img src="{{ asset('assets2/img/flow.png') }}" alt="Alur Study Abroad" class="img-fluid rounded-4 shadow">
    </div>

    </div>
  </section>

  <!-- Values Section -->
  <section id="values" class="values section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
    <h2>Prinsip Kami</h2>
    <p>Nilai-nilai yang selalu kami pegang teguh</p>
    </div><!-- End Section Title -->

    <div class="container">

    <div class="row gy-4">

      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
      <div class="card">
        <img src="assets2/img/value-1.png" class="img-fluid" alt="">
        <h3>Edukasi Berkelanjutan</h3>
        <p>Kami berkomitmen untuk memberikan pengetahuan yang mudah diakses tentang Eco Enzyme dan pengelolaan
        limbah organik kepada seluruh lapisan masyarakat.</p>
      </div>
      </div><!-- End Card Item -->

      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">
      <div class="card">
        <img src="assets2/img/value-2.png" class="img-fluid" alt="">
        <h3>Kepedulian Lingkungan</h3>
        <p>Dengan mengolah sampah organik menjadi Eco Enzyme, kami membantu menciptakan lingkungan yang lebih
        bersih dan sehat untuk masa depan yang lebih baik.</p>
      </div>
      </div><!-- End Card Item -->

      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="300">
      <div class="card">
        <img src="assets2/img/value-3.png" class="img-fluid" alt="">
        <h3>Kolaborasi Komunitas</h3>
        <p>Kami percaya bahwa perubahan besar dimulai dari kerja sama. Bersama komunitas, kita bisa membangun
        gerakan peduli lingkungan yang berkelanjutan.</p>
      </div>
      </div>

      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="400">
      <div class="card">
        <img src="assets2/img/value-4.png" class="img-fluid" alt="">
        <h3>Aksi Nyata dan Berkelanjutan</h3>
        <p>Kami tidak hanya menyebarkan informasi, tetapi juga mendorong tindakan nyata yang berdampak positif
        melalui kegiatan, pelatihan, dan kampanye lingkungan yang konsisten.</p>
      </div>
      </div>

      <!-- End Card Item -->

    </div>

    </div>

  </section><!-- /Values Section -->

  <!-- Stats Section -->
  <section id="stats" class="stats section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
      <div class="stats-item d-flex align-items-center w-100 h-100">
        <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
        <div>
        <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahKomunitas }}"
          data-purecounter-duration="1"></span>
        <p>Komunitas</p>
        </div>
      </div>
      </div>

      <div class="col-lg-3 col-md-6">
      <div class="stats-item d-flex align-items-center w-100 h-100">
        <i class="bi bi-box color-pink flex-shrink-0" style="color: #bb0852;"></i>
        <div>
        <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahBanksampah }}"
          data-purecounter-duration="1"></span>
        <p>Bank Sampah</p>
        </div>
      </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
      <div class="stats-item d-flex align-items-center w-100 h-100">
        <i class="bi bi-journal-richtext color-orange flex-shrink-0" style="color: #ee6c20;"></i>
        <div>
        <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahArtikel }}"
          data-purecounter-duration="1"></span>
        <p>Artikel</p>
        </div>
      </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
      <div class="stats-item d-flex align-items-center w-100 h-100">
        <i class="bi bi-calendar-event color-green flex-shrink-0" style="color: #15be56;"></i>
        <div>
        <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $jumlahArtikel }}"
          data-purecounter-duration="1"></span>
        <p>Kegiatan</p>
        </div>
      </div>
      </div><!-- End Stats Item -->

    </div>

    </div>

  </section><!-- /Stats Section -->

  <!-- Features Section -->
  <section id="features" class="alt-features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
    <h2>Keunggulan Ecozyne</h2>
    <p>Solusi inovatif untuk masa depan yang lebih hijau</p>
    </div><!-- End Section Title -->

    <div class="container">
    <div class="row gy-5">
      <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">
      <div class="row align-self-center gy-5">
        <div class="col-md-6 icon-box">
        <i class="bi bi-patch-check"></i>
        <div>
          <h4>Dipercaya Komunitas</h4>
          <p>Setiap produk dan layanan kami dirancang dengan kualitas terbaik untuk menjawab kebutuhan Anda.</p>
        </div>
        </div><!-- End Feature Item -->

        <div class="col-md-6 icon-box">
        <i class="bi bi-card-checklist"></i>
        <div>
          <h4>Manajemen Terintegrasi</h4>
          <p>Mengelola data dan operasional dengan sistem yang terintegrasi demi efisiensi maksimal.</p>
        </div>
        </div><!-- End Feature Item -->

        <div class="col-md-6 icon-box">
        <i class="bi bi-dribbble"></i>
        <div>
          <h4>Desain Inovatif</h4>
          <p>Antarmuka modern yang intuitif, memudahkan penggunaan dan meningkatkan produktivitas.</p>
        </div>
        </div><!-- End Feature Item -->

        <div class="col-md-6 icon-box">
        <i class="bi bi-cart3"></i> <!-- Ikon troli belanja -->
        <div>
          <h4>Fitur Jual Beli Produk</h4>
          <p>Temukan dan beli produk-produk Eco Enzyme berkualitas dari komunitas dan bank sampah lokal.</p>
        </div>
        </div><!-- End Feature Item -->

        <div class="col-md-6 icon-box">
        <i class="bi bi-recycle"></i>
        <div>
          <h4>Pengelolaan sampah Ramah Lingkungan</h4>
          <p>Mendukung proses penyaluran sampah dari komunitas kepada bank sampah.</p>
        </div>
        </div>

        <div class="col-md-6 icon-box">
        <i class="bi bi-gift"></i> <!-- Ikon hadiah -->
        <div>
          <h4>Penukaran Poin</h4>
          <p>Dapatkan poin dari penyaluran sampah dan tukarkan dengan berbagai hadiah menarik secara langsung.
          </p>
        </div>
        </div><!-- End Feature Item -->
      </div>
      </div>

      <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up" data-aos-delay="100">
      <img src="assets2/img/alt-features.png" class="img-fluid" alt="Ecozyne Features">
      </div>
    </div>
    </div>

  </section><!-- /Alt Features Section -->

  <section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
    <h2>Kegiatan</h2>
    <p>Jadwal kegiatan Ecozyne aksi nyata<br></p>
    </div>

    <div class="container">
    <div class="row gy-4">

      @foreach($kegiatanterbaru as $kegiatan)
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}">
      <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
      <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}" class="card-img-top catalog-img"
      alt="{{ $kegiatan->judul }}">
      <div class="card-body d-flex flex-column">
      <h5 class="card-title text-capitalize">{{ $kegiatan->judul }}</h5>
      <p class="card-text clamp-kegiatan">{{ Str::limit(strip_tags($kegiatan->isi), 100) }}</p>

      <div class="mb-2">
        <span class="badge bg-info badge-kegiatan me-1">
        <i class="bi bi-calendar"></i>
        {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('l, d F Y') }}
        </span>
        <span class="badge bg-light text-danger border border-danger badge-kegiatan">
        <i class="bi bi-geo-alt-fill"></i>
        {{ $kegiatan->lokasi }}
        </span>
      </div>

      <div class="mb-3">
        <span class="badge bg-info text-white badge-kegiatan">
        <i class="bi bi-people-fill"></i> {{ $kegiatan->kouta }}
        </span>
      </div>

      {{-- Tombol Modal --}}
      @auth
      @php
      $komunitas = \App\Models\Komunitas::where('id_user', Auth::user()->id_user)->first();
      $sudahDaftar = $komunitas
      ? \App\Models\PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
      ->where('id_kegiatan', $kegiatan->id_kegiatan)
      ->exists()
      : false;
      @endphp

      @if (!$komunitas)
      <div class="alert alert-warning mt-2">
      Akun Anda belum terdaftar sebagai komunitas.
      </div>
      @elseif ($sudahDaftar)
      <button class="btn btn-success w-100" disabled
      style="background-color: grey; border-color: grey; color: white; pointer-events: none; cursor: default;">
      Anda sudah mendaftar
      </button>
      @else

      <!-- Tombol untuk buka modal -->
      <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal"
      data-bs-target="#modalDaftar{{ $kegiatan->id_kegiatan }}">
      Daftar
      </a>
      @endif
      @else
      <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
      Login untuk daftar
      </a>
      @endauth

      </div>
      </div>
      </div>
    @endforeach


      {{-- Modal ditempatkan setelah semua card selesai --}}
      @auth
      @foreach($kegiatanterbaru as $kegiatan)
      <div class="modal fade" id="modalDaftar{{ $kegiatan->id_kegiatan }}" tabindex="-1"
      aria-labelledby="modalLabel{{ $kegiatan->id_kegiatan }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="modalLabel{{ $kegiatan->id_kegiatan }}">Detail Kegiatan</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
      <h5>{{ $kegiatan->judul }}</h5>
      <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}</p>
      <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi }}</p>
      <p><strong>Kuota:</strong> {{ $kegiatan->kouta }} peserta</p>
      <p>{{ strip_tags(Str::limit($kegiatan->isi, 300)) }}</p>
      </div>
      <div class="modal-footer">
      <form action="{{ route('daftar-kegiatan.daftarKegiatan') }}" method="POST"
      onsubmit="console.log('Form submitted');">
      @csrf
      <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id_kegiatan }}">
      {{-- <input type="hidden" name="id_komunitas" value="{{ Auth::user()->id_komunitas }}"> --}}
      <button type="submit" class="btn btn-success">Daftar Sekarang</button>
      </form>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
      </div>
      </div>
      </div>
    @endforeach
    @endauth


    </div>

    <div class="container text-center" data-aos="fade-up" style="margin-top: 50px;">
      <a href="/kegiatan" class="btn btn-outline-primary btn-lg px-4">
      Lihat Semua Kegiatan
      <i class="bi bi-arrow-right ms-2"></i>
      </a>
    </div>
    </div>
  </section>


  <!-- Pricing Section -->
  <section id="pricing" class="pricing section">

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section-bg">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
      <h2>Katalog Hadiah</h2>
      <p>Tukarkan poin anda dengan hadiah menarik</p>
      </div>

      <div class="row gy-4 justify-content-center">

      <!-- Card 1 -->
      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk1.jpeg" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            Eco Enzim 5 Liters
          </h5>
          <p class="card-text text-danger fs-5 mb-1">150XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk2.jpg" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            Green Papaya Soap
          </h5>
          <p class="card-text text-danger fs-5 mb-1">100XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk3.jpg" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            Bio Shampoo
          </h5>
          <p class="card-text text-danger fs-5 mb-1">250XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk4.jpg" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            Papaya Enzyme Suplement
          </h5>
          <p class="card-text text-danger fs-5 mb-1">70XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk5.png" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            Eco Enzyme coffee Shampoo
          </h5>
          <p class="card-text text-danger fs-5 mb-1">120XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk6.png" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            Eco Enzyme pandan Shampoo
          </h5>
          <p class="card-text text-danger fs-5 mb-1">120XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>


      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk7.png" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            pupuk organik eco enzyme
          </h5>
          <p class="card-text text-danger fs-5 mb-1">300XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="#" class="text-decoration-none text-dark">
        <div class="card shadow-sm">
          <img src="assets2/img/hadiah/produk8.png" class="card-img-top" alt="Product 3">
          <div class="card-body">
          <h5 class="card-title two-line-title">
            pupuk cair eco enzyme
          </h5>
          <p class="card-text text-danger fs-5 mb-1">150XP</p>
          </i>Stok : 190</p>
          <span class="badge bg-success">
            <i class="bi bi-truck"></i>
            1-4 Hari
          </span>
          </div>
        </div>
        </a>
      </div>


      <!-- More Button -->
      <div class="container text-center" data-aos="fade-up" style="margin-top: 50px;">
        <a href="/kegiatan" class="btn btn-outline-primary btn-lg px-4">
        Lihat Semua Kegiatan
        <i class="bi bi-arrow-right ms-2"></i>
        </a>
      </div>


      <!-- Tambah card lainnya sesuai kebutuhan -->

      </div>
    </div>
    </section>


    <!-- Faq Section -->
    <section id="faq" class="faq section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Pertanyaan Umum</h2>
      <p>Pertanyaan yang Sering Diajukan</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row">

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

        <div class="faq-container">

        <div class="faq-item faq-active">
          <h3>Apa itu Eco Enzyme?</h3>
          <div class="faq-content">
          <p>Eco Enzyme adalah cairan hasil fermentasi limbah organik seperti kulit buah, gula, dan air yang
            bermanfaat untuk keperluan rumah tangga, pertanian, dan lingkungan.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3>Bagaimana cara membuat Eco Enzyme?</h3>
          <div class="faq-content">
          <p>Campurkan 3 bagian air, 1 bagian gula (gula merah/gula molase), dan 10 bagian limbah organik
            (seperti kulit buah) ke dalam wadah tertutup, lalu fermentasi selama 3 bulan.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3>Apa saja manfaat Eco Enzyme?</h3>
          <div class="faq-content">
          <p>Eco Enzyme dapat digunakan sebagai pembersih rumah, pupuk tanaman, pengusir hama alami, hingga
            pembersih saluran air dan pengurang polusi.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        </div>

      </div><!-- End Faq Column-->

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

        <div class="faq-container">

        <div class="faq-item">
          <h3>Siapa saja yang bisa menggunakan aplikasi Ecozyne?</h3>
          <div class="faq-content">
          <p> Aplikasi ini dapat digunakan oleh siapa saja, baik individu, komunitas, maupun bank sampah yang
            ingin belajar dan berkontribusi dalam gerakan Eco Enzyme,
            khususnya bagi warga Batam yang ingin turut serta menjaga lingkungan melalui pengelolaan limbah
            organik secara berkelanjutan.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3>Bagaimana cara bergabung dengan komunitas Ecozyne?</h3>
          <div class="faq-content">
          <p>Anda bisa mendaftar akun di halaman registrasi, lalu mulai mengikuti panduan dan berkontribusi
            bersama kami.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3>Apakah saya bisa menukarkan sampah dengan poin?</h3>
          <div class="faq-content">
          <p>Ya, pengguna dapat menyalurkan sampah ke bank sampah terdaftar dan mendapatkan poin yang bisa
            ditukar dengan hadiah melalui fitur reward di aplikasi.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        </div>

      </div><!-- End Faq Column-->
      </div>
    </div>

    </section><!-- /Faq Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Galeri</h2>
      <p>Galeri foto</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        @forelse ($galeri as $item)
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
      <div class="portfolio-content h-100">
        <img src="{{ asset('storage/galeri/' . $item->foto) }}" class="img-fluid" alt="">
        <div class="portfolio-info">
        <h4>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y : H.i') }}</h4>
        <p>{{ $item->deskripsi }}</p>
        <a href="{{ asset('storage/galeri/' . $item->foto) }}" title="{{ $item->deskripsi }}"
        data-gallery="portfolio-gallery-app" class="glightbox preview-link">
        <i class="bi bi-zoom-in"></i>
        </a>
        {{-- Optional link detail, bisa dihilangkan --}}
        <a href="#" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>
      </div>
      @empty
      <p>Tidak ada foto galeri tersedia.</p>
      @endforelse
      </div>
      </div>
    </div>

    </section><!-- /Portfolio Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Artikel</h2>
      <p>Postingan Artikel terbaru</p>
    </div>

    <div class="container">
      <div class="row gy-5">
      @foreach ($artikelterbaru as $artikel)
      <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
      <div class="post-item position-relative h-100">
      <div class="post-img position-relative overflow-hidden">
        <img src="{{ asset('storage/artikel/' . $artikel->foto) }}" class="img-fluid" alt="">
        <span class="post-date">{{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y : H.i') }}</span>
      </div>

      <div class="post-content d-flex flex-column">
        <h3 class="post-title">{{ Str::limit($artikel->judul, 100) }}</h3>

        {{-- Isi ringkasan artikel --}}
        <p>{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>

        <div class="meta d-flex align-items-center">
        <div class="d-flex align-items-center">
        <i class="bi bi-person"></i> <span class="ps-2">Admin</span>
        </div>
        </div>

        <hr>

        <a href="" class="readmore stretched-link">
        <span>Selengkapnya</span><i class="bi bi-arrow-right"></i>
        </a>
      </div>
      </div>
      </div>
    @endforeach
      </div>

      <!-- More Button -->
      <div class="container text-center" data-aos="fade-up" style="margin-top: 50px;">
      <a href="/artikel" class="btn btn-outline-primary btn-lg px-4">
        Lihat Semua Artikel
        <i class="bi bi-arrow-right ms-2"></i>
      </a>
      </div>
    </div>

    </section><!-- /Recent Posts Section -->

    </div>
    </div>
    </div>
  @endsection

  @push('scripts')
    <!-- JS File  -->
    <script src="{{ asset('assets2/js/main.js') }}"></script>
    <script>
    const lightbox = GLightbox({ selector: '.glightbox' });
    </script>


  @endpush