@extends('layouts.index-menu')

@push('style')
    <link href="assets2/css/custom-index.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com" rel="preconnect">
            <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
                <link
                    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
                    rel="stylesheet">
@endpush

@section('title', 'Ecozyne | Kegiatan')

@section('content')
    <!-- Page Title -->
    <div class="page-title mt-5">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Kegiatan</h1>
                        <p class="mb-3">Ayo jadi begerak bersama kami wujudkan aksi nyata terhadap kepedulian lingkungan
                            sekitar!
                        </p>
                    </div>
                    <!-- Search Widget -->
                    <div class="search-widget widget-item mt-6">
                        <form action="">
                            <input type="text" placeholder="Cari di Kegiatan....">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Beranda</a></li>
                    <li class="current">Kegiatan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <!-- Services Section -->
                <section id="services" class="services section">

                    <!-- Section Title -->
                    <div class="container section-title" data-aos="fade-up">
                        <h2>Kegiatan</h2>
                        <p>Jadwal kegiatan Ecozyne aksi nyata<br></p>
                    </div><!-- End Section Title -->

                    <div class="container">

                        <div class="row gy-4">

                            @foreach($semuaKegiatan as $kegiatan)
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}">
                                    <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                        <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}"
                                            class="card-img-top catalog-img" alt="{{ $kegiatan->judul }}">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-capitalize">{{ $kegiatan->judul }}</h5>
                                            <p class="card-text clamp-kegiatan">
                                                {{ Str::limit(strip_tags($kegiatan->isi), 100) }}
                                            </p>

                                            <div class="mb-2">
                                                <span class="badge bg-info badge-kegiatan me-1">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d-m-Y') }}
                                                </span>
                                                <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                    {{ $kegiatan->lokasi }}
                                                </span>
                                            </div>

                                            <div class="mb-3">
                                                <span class="badge bg-info text-white badge-kegiatan">
                                                    <i class="bi bi-people-fill"></i> Kuota: {{ $kegiatan->kouta }} peserta
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
                        </div>
                    </div>

                </section><!-- /Services Section -->
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush