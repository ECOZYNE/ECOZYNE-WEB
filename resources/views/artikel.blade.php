@extends('layouts.index-menu')

@section('title', 'Ecozyne | Semua Artikel')

@section('content')
  <!-- Page Title -->
  <div class="page-title mt-5">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Artikel</h1>
            <p class="mb-0">
              Kumpulan artikel informatif seputar Eco Enzim. Dapatkan wawasan, tips, dan pengetahuan terbaru yang kami
              sajikan secara akurat dan mudah dipahami.
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

  <!-- Recent Posts Section -->
  <section id="recent-posts" class="recent-posts section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Artikel</h2>
      <p>Semua Artikel</p>
    </div>

    <div class="container">
      <div class="row gy-5">
        @forelse ($allartikel as $artikel)
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="post-item position-relative h-100">
              <div class="post-img position-relative overflow-hidden">
                <img src="{{ asset('storage/artikel/' . $artikel->foto) }}" class="img-fluid" alt="{{ $artikel->judul }}">
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
                <a href="{{ route('artikelpublic.show', $artikel->id_artikel) }}" class="readmore stretched-link">
                  <span>Selengkapnya</span><i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        @empty
          {{-- Pesan ini akan muncul jika tidak ada artikel sama sekali --}}
          <div class="col-12 text-center">
            <p class="lead">Belum ada artikel yang dipublikasikan.</p>
            <img src="{{ asset('assets/img/no-data.svg') }}" alt="Tidak ada data" style="width: 300px; opacity: 0.7;">
          </div>
        @endforelse
      </div>
    </div>
  </section>
  <!-- /Recent Posts Section -->
@endsection