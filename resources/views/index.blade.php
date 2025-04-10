<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ecozyne | Eco Enzyme</title>
  <meta name="description" content="Ecoenzyme">
  <meta name="keywords" content="Ecoenzyme">

  <!-- Favicons -->
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets2/css/main.css" rel="stylesheet">
  <link href="assets2/css/custom-index.css" rel="stylesheet">

</head>

<body class="index-page">

  @include('components.loader') <!-- Panggil Loader -->


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets2/img/ecozyne.png" alt="">
        <h1 class="sitename">Ecozyne</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda<br></a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#services">Kegiatan</a></li>
          <li><a href="blog">Artikel</a></li>
          <li><a href="blog">Produk</a></li>
          <li><a href="blog">Hadiah</a></li>
          <li><a href="#footer">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="login">Gabung Kami !</a>

    </div>
  </header>

  <main class="main">

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
              <a href="https://youtu.be/WIS_wPLPMQU?si=6nRg1whJsHRXl8eo"
                class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i
                  class="bi bi-play-circle"></i><span>Tonton Video</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets2/img/hand-plant.svg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

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
            </div>
          </div>
        </div>
      </div>

    </section><!-- End About Section -->

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
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Bank Sampah</p>
              </div>
            </div>
          </div><!-- End Stats Item -->



          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-journal-richtext color-orange flex-shrink-0" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Artikel</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-calendar-event color-green flex-shrink-0" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                  class="purecounter"></span>
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

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kegiatan</h2>
        <p>Jadwal kegiatan Ecozyne aksi nyata<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card catalog-item shadow-sm">
              <img src="assets2/img/kegiatan/kegiatan1.jpeg" class="card-img-top catalog-img" alt="Hadiah 1">
              <div class="card-body">
                <h5 class="card-title">Berita 1</h5>
                <p class="card-text clamp-kegiatan">Deskripsi singkat berita 1 yang menonjolkan keunggulannya.</p>
                <span class="badge bg-success badge-kegiatan">
                  <i class="bi bi-calendar"></i>
                  waktu: 14-3-2025
                </span>
                <div class="mt-auto pt-3">
                  <a href="#" class="btn btn-primary w-100">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Catalog Item 2 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card catalog-item shadow-sm">
              <img src="assets2/img/kegiatan/kegiatan2.jpeg" class="card-img-top catalog-img" alt="Hadiah 2">
              <div class="card-body">
                <h5 class="card-title">Berita 2</h5>
                <p class="card-text clamp-kegiatan">Deskripsi singkat berita 2 yang menonjolkan keunggulannya.</p>
                <span class="badge bg-success badge-kegiatan">
                  <i class="bi bi-calendar"></i>
                  waktu: 14-3-2025
                </span>
                <div class="mt-auto pt-3">
                  <a href="#" class="btn btn-primary w-100">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Catalog Item 3 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
              <img src="assets2/img/kegiatan/kegiatan3.jpeg" class="card-img-top catalog-img" alt="Hadiah 3">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Berita 3</h5>
                <p class="card-text clamp-kegiatan">Deskripsi singkat berita 3 yang menonjolkan keunggulannya.</p>
                <span class="badge bg-success badge-kegiatan">
                  <i class="bi bi-calendar"></i>
                  waktu: 14-3-2025
                </span>
                <div class="mt-auto pt-3">
                  <a href="#" class="btn btn-primary w-100">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card catalog-item shadow-sm">
              <img src="assets2/img/kegiatan/kegiatan4.jpg" class="card-img-top catalog-img" alt="Hadiah 1">
              <div class="card-body">
                <h5 class="card-title">Berita 4</h5>
                <p class="card-text clamp-kegiatan">Deskripsi singkat berita 4 yang menonjolkan keunggulannya.</p>
                <span class="badge bg-success badge-kegiatan">
                  <i class="bi bi-calendar"></i>
                  waktu: 14-3-2025
                </span>
                <div class="mt-auto pt-3">
                  <a href="#" class="btn btn-primary w-100">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Catalog Item 2 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card catalog-item shadow-sm">
              <img src="assets2/img/kegiatan/kegiatan5.jpg" class="card-img-top catalog-img" alt="Hadiah 2">
              <div class="card-body">
                <h5 class="card-title">Berita 5</h5>
                <p class="card-text clamp-kegiatan">Deskripsi singkat berita 5 yang menonjolkan keunggulannya.</p>
                <span class="badge bg-success badge-kegiatan">
                  <i class="bi bi-calendar"></i>
                  waktu: 14-3-2025
                </span>
                <div class="mt-auto pt-3">
                  <a href="#" class="btn btn-primary w-100">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Catalog Item 3 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
              <img src="assets2/img/kegiatan/kegiatan6.jpeg" class="card-img-top catalog-img" alt="Hadiah 3">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Berita 6</h5>
                <p class="card-text clamp-kegiatan">Deskripsi singkat berita 6 yang menonjolkan keunggulannya.</p>
                <span class="badge bg-success badge-kegiatan">
                  <i class="bi bi-calendar"></i>
                  waktu: 14-3-2025
                </span>
                <div class="mt-auto pt-3">
                  <a href="#" class="btn btn-primary w-100">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Services Section -->

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
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
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
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
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
                      Duzi Pure Susu Kuda Liar alam sumbawa nusa tenggara timur indonesia
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
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
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
                    </span>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6">
              <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm">
                  <img src="assets2/img/hadiah/produk4.jpg" class="card-img-top" alt="Product 3">
                  <div class="card-body">
                    <h5 class="card-title two-line-title">
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
                    </span>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6">
              <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm">
                  <img src="assets2/img/hadiah/produk4.jpg" class="card-img-top" alt="Product 3">
                  <div class="card-body">
                    <h5 class="card-title two-line-title">
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
                    </span>
                  </div>
                </div>
              </a>
            </div>


            <div class="col-lg-3 col-md-6">
              <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm">
                  <img src="assets2/img/hadiah/produk4.jpg" class="card-img-top" alt="Product 3">
                  <div class="card-body">
                    <h5 class="card-title two-line-title">
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
                    </span>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6">
              <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm">
                  <img src="assets2/img/hadiah/produk4.jpg" class="card-img-top" alt="Product 3">
                  <div class="card-body">
                    <h5 class="card-title two-line-title">
                      Duzi Pure Susu Kuda Liar
                    </h5>
                    <p class="card-text text-danger mb-1">Rp165.600 <del class="text-muted fs-6">Rp184.000</del></p>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Kab. Tulungagung</p>
                    <p class="mb-2"><i class="bi bi-star-fill text-warning"></i> 5.0 | 100+ terjual</p>
                    <span class="badge bg-success">
                      <i class="bi bi-truck"></i>
                      1-2 Hari
                    </span>
                  </div>
                </div>
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



      <!-- Recent Posts Section -->
      <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Artikel</h2>
          <p>Postingan Artikel terbaru</p>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row gy-5">

            <div class="col-xl-4 col-md-6">
              <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                <div class="post-img position-relative overflow-hidden">
                  <img src="assets2/img/blog/blog-1.jpg" class="img-fluid" alt="">
                  <span class="post-date">December 12</span>
                </div>

                <div class="post-content d-flex flex-column">

                  <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                    </div>
                  </div>

                  <hr>

                  <a href="blog-details" class="readmore stretched-link"><span>Read More</span><i
                      class="bi bi-arrow-right"></i></a>

                </div>

              </div>
            </div><!-- End post item -->

            <div class="col-xl-4 col-md-6">
              <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

                <div class="post-img position-relative overflow-hidden">
                  <img src="assets2/img/blog/blog-2.jpg" class="img-fluid" alt="">
                  <span class="post-date">July 17</span>
                </div>

                <div class="post-content d-flex flex-column">

                  <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i> <span class="ps-2">Mario Douglas</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-folder2"></i> <span class="ps-2">Sports</span>
                    </div>
                  </div>

                  <hr>

                  <a href="blog-details" class="readmore stretched-link"><span>Read More</span><i
                      class="bi bi-arrow-right"></i></a>

                </div>

              </div>
            </div><!-- End post item -->

            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="post-item position-relative h-100">

                <div class="post-img position-relative overflow-hidden">
                  <img src="assets2/img/blog/blog-3.jpg" class="img-fluid" alt="">
                  <span class="post-date">September 05</span>
                </div>

                <div class="post-content d-flex flex-column">

                  <h3 class="post-title">Quia assumenda est et veritati tirana ploder</h3>

                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i> <span class="ps-2">Lisa Hunter</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-folder2"></i> <span class="ps-2">Economics</span>
                    </div>
                  </div>

                  <hr>

                  <a href="blog-details" class="readmore stretched-link"><span>Read More</span><i
                      class="bi bi-arrow-right"></i></a>

                </div>

              </div>
            </div><!-- End post item -->

          </div>

        </div>

      </section><!-- /Recent Posts Section -->

      <!-- Team Section -->
      <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Tim Pengembang</h2>
          <p>Tim Hebat Kami</p>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row gy-4">

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team1.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Alena Uperiati, S.T., M.Cs</h4>
                  <span>Project Manager</span>
                  <p>"Memimpin tim dengan visi dan strategi yang tepat."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team2.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Muhammad Nabil Aditya</h4>
                  <span>Leader Team, Analyst</span>
                  <p>"Membangun solusi teknologi yang inovatif, mengintegrasikan visi strategis dengan keahlian teknis
                    yang mendalam."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team3.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Ivander Justine Savero</h4>
                  <span>Frontend Developer</span>
                  <p>"Menciptakan desain yang memudahkan pengguna."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team4.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Sitiacika Mustamin</h4>
                  <span>Frontend Developer</span>
                  <p>"Merancang antarmuka yang intuitif dan responsive."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team5.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Aditiya Arsandi Sulaeman</h4>
                  <span>Backend Developer</span>
                  <p>"Menjamin kualitas dan kehandalan sistem."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team6.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Imel Valentina Parapat</h4>
                  <span>Backend Developer</span>
                  <p>"Mengoptimalkan performa dan keamanan data."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
              <div class="team-member">
                <div class="member-img">
                  <img src="assets2/img/team/team7.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Muhammad Zidane Gensopa</h4>
                  <span>Quality Assurance</span>
                  <p>"Menjamin Kualitas dan Dokumentasi Sistem."</p>
                </div>
              </div>
            </div><!-- End Team Member -->

          </div>

        </div>

      </section><!-- /Team Section -->
  </main>

  <footer id="footer" class="footer" style="box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <img src="assets2/img/ecozyne.png" alt="Ecozyne Logo" style="height: 40px; margin-right: 10px;">
            <span class="sitename">Ecozyne</span>
          </a>

          <div class="footer-contact pt-3">
            <p>Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota</p>
            <p>Kota Batam, Kepulauan Riau 29461</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 878-4203-3231</span></p>
            <p><strong>Email:</strong> <span>ecozyne@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
          </ul>
        </div>

        <div class="col-lg-6 col-md-12">
          <div class="map-container">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3038.540186967666!2d104.04639665762097!3d1.1186615015316728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e1!3m2!1sid!2sid!4v1735045068555!5m2!1sid!2sid"
              width="100%" height="180" style="border: 0; display: block;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Ecozyne</strong> <span>All Rights Reserved</span>
      </p>
      <div class="credits">
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets2/vendor/php-email-form/validate.js"></script>
  <script src="assets2/vendor/aos/aos.js"></script>
  <script src="assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets2/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets2/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets2/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets2/js/main.js"></script>

</body>

</html>