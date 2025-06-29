@extends('layouts.index-menu')

@section('title', 'Ecozyne | Artikel Detail')

@section('content')
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
      <li class="current">{{ $artikel->judul ?? 'Detail' }}</li>
      </ol>
    </div>
    </nav>
  </div>
  <div class="container my-5">
    <div class="row">

    <div class="col-lg-8">
      <section id="blog-posts" class="blog-posts section">
      <div class="row gy-5">

        {{-- Display the single article details --}}
        <div class="col-12">
        <article>
          <div class="post-img">
          <img src="{{ asset('storage/artikel/' . $artikel->foto) }}" alt="{{ $artikel->judul }}"
            class="img-fluid rounded">
          </div>

          <h2 class="title mt-3">
          {{ $artikel->judul }}
          </h2>

          <div class="meta-top">
          <ul>
            <li><i class="bi bi-person"></i> Admin</li>
            <li><i class="bi bi-clock"></i> <time
              datetime="{{ $artikel->created_at->toW3cString() }}">{{ $artikel->created_at->format('d F Y, H:i') }}</time>
            </li>
          </ul>
          </div>

          <div class="content">
          {!! $artikel->isi !!} {{-- Use {!! !!} to render HTML content from the 'isi' field --}}
          </div>
        </article>
        </div>
        {{-- End of single article details --}}

      </div>

      </section>
    </div>
    <div class="col-lg-4 sidebar">
      <div class="widgets-container">

      <div class="recent-posts-widget widget-item">
        <h3 class="widget-title">Artikel Terbaru</h3>
        <hr>
        @forelse ($recentPosts as $post)
      <div class="post-item d-flex">
      <img src="{{ asset('storage/artikel/' . $post->foto) }}" alt="{{ $post->judul }}" class="flex-shrink-0 me-3"
        style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
      <div>
        <h4><a href="{{ route('artikelpublic.show', $post->id_artikel) }}">{{ Str::limit($post->judul, 55) }}</a>
        </h4>
        <time datetime="{{ $post->created_at->toW3cString() }}">{{ $post->created_at->format('d M Y') }}</time>
      </div>
      </div>
      @empty
      <p>Tidak ada artikel terbaru.</p>
      @endforelse

      </div>



      </div>
    </div>
    </div>
  </div>
@endsection