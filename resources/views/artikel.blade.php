@extends('layouts.index-menu')

@section('title', 'Ecozyne | Artikel')

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

              {{-- Artikel 1 --}}
              <div class="col-12">
                <article>
                  <div class="post-img">
                    <img src="{{ asset('assets2/img/blog/artikel1.jpg') }}" alt="Artikel 1" class="img-fluid">
                  </div>
                  <h2 class="title">
                    <a href="#">Rehabilitasi Hutan oleh KLHK dan Relawan Lingkungan</a>
                  </h2>
                  <div class="meta-top">
                    <ul>
                      <li><i class="bi bi-person"></i> <a href="#">Admin</a></li>
                      <li><i class="bi bi-clock"></i> <a href="#"><time datetime="2025-05-07">07 Mei 2025 : 14.52</time></a></li>
                    </ul>
                  </div>
                  <div class="content">
                    <p>
                      Kegiatan ini bertujuan untuk memulihkan fungsi ekologis lahan, mengurangi risiko bencana seperti banjir dan longsor, serta meningkatkan cadangan karbon. Bibit pohon lokal ditanam agar dapat tumbuh optimal dan memberi manfaat jangka panjang bagi lingkungan.
                    </p>
                  </div>
                </article>
              </div>

              {{-- Artikel 2 --}}
              <div class="col-12">
                <article>
                  <div class="post-img">
                    <img src="{{ asset('assets2/img/blog/artikel4.jpeg') }}" alt="Artikel 2" class="img-fluid">
                  </div>
                  <h2 class="title">
                    <a href="#">Aksi Simbolis Penuangan Eco Enzyme untuk Pemulihan Ekosistem Air</a>
                  </h2>
                  <div class="meta-top">
                    <ul>
                      <li><i class="bi bi-person"></i> <a href="#">Admin</a></li>
                      <li><i class="bi bi-clock"></i> <a href="#"><time datetime="2022-01-01">01 Jan 2022</time></a></li>
                    </ul>
                  </div>
                  <div class="content">
                    <p>
                      Incidunt voluptate sit temporibus aperiam. Quia vitae aut sint ullam quis illum voluptatum et. Tempora nam odit omnis eum corrupti qui aliquid excepturi molestiae.
                    </p>
                    <div class="read-more">
                      <a href="#">Baca Selengkapnya</a>
                    </div>
                  </div>
                </article>
              </div>

              {{-- Artikel 3 --}}
              <div class="col-12">
                <article>
                  <div class="post-img">
                    <img src="{{ asset('assets2/img/blog/artikel3.jpeg') }}" alt="Artikel 3" class="img-fluid">
                  </div>
                  <h2 class="title">
                    <a href="#">Gotong Royong Tanam Pohon untuk Lingkungan Lebih Hijau</a>
                  </h2>
                  <div class="meta-top">
                    <ul>
                      <li><i class="bi bi-person"></i> <a href="#">Admin</a></li>
                      <li><i class="bi bi-clock"></i> <a href="#"><time datetime="2022-01-01">01 Jan 2022</time></a></li>
                    </ul>
                  </div>
                  <div class="content">
                    <p>
                      Aut iste neque ut illum qui perspiciatis. Eum temporibus fugiat voluptate enim tenetur sunt omnis.
                    </p>
                    <div class="read-more">
                      <a href="#">Baca Selengkapnya</a>
                    </div>
                  </div>
                </article>
              </div>

              {{-- Artikel 4 --}}
              <div class="col-12">
                <article>
                  <div class="post-img">
                    <img src="{{ asset('assets2/img/blog/artikel2.jpeg') }}" alt="Artikel 4" class="img-fluid">
                  </div>
                  <h2 class="title">
                    <a href="#">Aksi Nyata Pelestarian Alam Lewat Penanaman Pohon</a>
                  </h2>
                  <div class="meta-top">
                    <ul>
                      <li><i class="bi bi-person"></i> <a href="#">Admin</a></li>
                      <li><i class="bi bi-clock"></i> <a href="#"><time datetime="2022-01-01">01 Jan 2022</time></a></li>
                    </ul>
                  </div>
                  <div class="content">
                    <p>
                      Gotong Royong Tanam Pohon untuk Lingkungan Lebih Hijau.
                    </p>
                    <div class="read-more">
                      <a href="#">Baca Selengkapnya</a>
                    </div>
                  </div>
                </article>
              </div>

            </div>
          </div>
        </section>

        <!-- Blog Pagination -->
        <section id="blog-pagination" class="blog-pagination section">
          <div class="container">
            <div class="d-flex justify-content-center">
              <ul>
                <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                <li><a href="#" class="active">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li>...</li>
                <li><a href="#">10</a></li>
                <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
              </ul>
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
            <form action="#" method="GET">
              <input type="text" name="search" placeholder="Cari...">
              <button type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <!-- Recent Posts Widget -->
          <div class="recent-posts-widget widget-item">
            <h3 class="widget-title">Lainnya</h3>

            <div class="post-item d-flex">
              <img src="{{ asset('assets2/img/blog/artikel2.jpeg') }}" alt="Post" class="flex-shrink-0 me-3">
              <div>
                <h4><a href="#">Kampanye Eco Enzyme di Lingkungan Kampus</a></h4>
                <time datetime="2025-05-06">06 Mei 2025 : 08.33</time>
              </div>
            </div>

            <div class="post-item d-flex">
              <img src="{{ asset('assets2/img/blog/artikel3.jpeg') }}" alt="Post" class="flex-shrink-0 me-3">
              <div>
                <h4><a href="#">Aksi Simbolis Eco Enzyme untuk Pemulihan Air</a></h4>
                <time datetime="2025-05-05">05 Mei 2025 : 13.10</time>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
