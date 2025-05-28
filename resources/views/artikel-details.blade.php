@extends('layouts.index-menu')

@section('content')
  <!-- Page Title -->
  <div class="page-title mt-5">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Artikel</h1>
            <p class="mb-0">
              Kumpulan artikel informatif seputar Eco Enzim. Dapatkan wawasan, tips, dan pengetahuan terbaru yang kami sajikan secara akurat dan mudah dipahami.
            </p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li class="current">Artikel</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->

  <div class="container">
    <div class="row">
      <!-- Artikel Utama -->
      <div class="col-lg-8">
        <section id="blog-posts" class="blog-posts section">
          <div class="container">
            <div class="row gy-4">
              <div class="col-12">
                <article>
                  <div class="post-img">
                    <img src="{{ asset('assets2/img/blog/artikel1.jpg') }}" alt="Rehabilitasi Hutan" class="img-fluid">
                  </div>

                  <h2 class="title">
                    <a href="blog-details.html">
                      Kegiatan Rehabilitasi Hutan oleh Kementerian Lingkungan Hidup dan Kehutanan (KLHK)
                    </a>
                  </h2>

                  <div class="meta-top">
                    <ul>
                      <li class="d-flex align-items-center">
                        <i class="bi bi-person"></i> 
                        <a href="#">Admin</a>
                      </li>
                      <li class="d-flex align-items-center">
                        <i class="bi bi-clock"></i> 
                        <a href="#"><time datetime="2025-05-07T14:52">07 Mei 2025 : 14.52</time></a>
                      </li>
                    </ul>
                  </div>

                  <div class="content">
                    <p>
                      Sebagai bagian dari komitmen menjaga kelestarian lingkungan hidup dan memperbaiki ekosistem yang rusak, Kementerian Lingkungan Hidup dan Kehutanan (KLHK) menggelar kegiatan penanaman bibit pohon di kawasan yang mengalami kerusakan hutan dan degradasi lahan. Acara ini diikuti oleh para pegawai KLHK bersama relawan dari komunitas pecinta lingkungan, serta melibatkan sektor swasta dalam mendukung gerakan penghijauan nasional.
                    </p>
                    <p>
                      Kegiatan ini bertujuan memulihkan fungsi ekologis lahan, mengurangi risiko bencana seperti banjir dan longsor, serta meningkatkan cadangan karbon sebagai upaya mitigasi perubahan iklim. Bibit pohon yang ditanam berasal dari jenis tanaman lokal yang sesuai dengan kondisi tanah dan iklim setempat, agar tumbuh optimal dan memberi manfaat jangka panjang bagi lingkungan dan masyarakat.
                    </p>
                  </div>
                </article>
              </div>
              <!-- End Post List Item -->
            </div>
          </div>
        </section>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4 sidebar">
        <div class="widgets-container">

          <!-- Search Widget -->
          <div class="search-widget widget-item">
            <h3 class="widget-title">Cari Artikel</h3>
            <form action="" method="GET">
              <input type="text" name="search" placeholder="Cari artikel...">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <!-- Recent Posts Widget -->
          <div class="recent-posts-widget widget-item">
            <h3 class="widget-title">Lainnya</h3>

            <div class="post-item d-flex mb-3">
              <img src="{{ asset('assets2/img/blog/artikel2.jpeg') }}" alt="Eco Enzyme Kampus" class="flex-shrink-0 me-3" width="80">
              <div>
                <h4 class="mb-1">
                  <a href="blog-details.html">Kampanye Eco Enzyme dan Penghijauan Lingkungan di Kampus</a>
                </h4>
                <time datetime="2025-05-06T08:33">06 Mei 2025 : 08.33</time>
              </div>
            </div>

            <div class="post-item d-flex">
              <img src="{{ asset('assets2/img/blog/blog-recent-2.jpg') }}" alt="Aksi Eco Enzyme" class="flex-shrink-0 me-3" width="80">
              <div>
                <h4 class="mb-1">
                  <a href="blog-details.html">Aksi Simbolis Penuangan Eco Enzyme untuk Pemulihan Ekosistem Air</a>
                </h4>
                <time datetime="2025-05-05T13:10">05 Mei 2025 : 13.10</time>
              </div>
            </div>

          </div>
          <!--/Recent Posts Widget -->

        </div>
      </div>
    </div>
  </div>
@endsection
