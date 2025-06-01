@extends('layouts.index-menu')

@push('style')
    <link href="assets2/css/custom-index.css" rel="stylesheet">
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
                        <p class="mb-3">Ayo jadi begerak bersama kami wujudkan aksi nyata terhadap kepedulian lingkungan sekitar!
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

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                    <img src="assets2/img/kegiatan/kegiatan1.jpeg" class="card-img-top catalog-img"
                                        alt="Kegiatan 1">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-capitalize">Kegiatan 1</h5>
                                        <p class="card-text clamp-kegiatan">
                                            Deskripsi singkat berita 1 yang menonjolkan keunggulannya.
                                        </p>

                                        <div class="mb-2">
                                            <span class="badge bg-info badge-kegiatan me-1">
                                                <i class="bi bi-calendar"></i> 14-03-2025
                                            </span>
                                            <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                Polres Lubuk Baja
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white badge-kegiatan">
                                                <i class="bi bi-people-fill"></i> Kuota: 50 peserta
                                            </span>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <a href="#" class="btn btn-primary w-100">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                    <img src="assets2/img/kegiatan/kegiatan2.jpeg" class="card-img-top catalog-img"
                                        alt="Kegiatan 2">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-capitalize">Kegiatan 2</h5>
                                        <p class="card-text clamp-kegiatan">
                                            Deskripsi singkat berita 2 yang menonjolkan keunggulannya.
                                        </p>

                                        <div class="mb-2">
                                            <span class="badge bg-info badge-kegiatan me-1">
                                                <i class="bi bi-calendar"></i> 14-03-2025
                                            </span>
                                            <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                Bukit Snimba
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white badge-kegiatan">
                                                <i class="bi bi-people-fill"></i> Kuota: 80 peserta
                                            </span>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <a href="#" class="btn btn-primary w-100">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                    <img src="assets2/img/kegiatan/kegiatan3.jpeg" class="card-img-top catalog-img"
                                        alt="Kegiatan 2">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-capitalize">Kegiatan 3</h5>
                                        <p class="card-text clamp-kegiatan">
                                            Deskripsi singkat berita 3 yang menonjolkan keunggulannya.
                                        </p>

                                        <div class="mb-2">
                                            <span class="badge bg-info badge-kegiatan me-1">
                                                <i class="bi bi-calendar"></i> 14-03-2025
                                            </span>
                                            <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                Kodim 0316 Rider
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white badge-kegiatan">
                                                <i class="bi bi-people-fill"></i> Kuota: 80 peserta
                                            </span>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <a href="#" class="btn btn-primary w-100">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                    <img src="assets2/img/kegiatan/kegiatan4.jpg" class="card-img-top catalog-img"
                                        alt="Kegiatan 2">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-capitalize">Kegiatan 4</h5>
                                        <p class="card-text clamp-kegiatan">
                                            Deskripsi singkat berita 4 yang menonjolkan keunggulannya.
                                        </p>

                                        <div class="mb-2">
                                            <span class="badge bg-info badge-kegiatan me-1">
                                                <i class="bi bi-calendar"></i> 14-03-2025
                                            </span>
                                            <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                Nuvasa Bay Batam
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white badge-kegiatan">
                                                <i class="bi bi-people-fill"></i> Kuota: 80 peserta
                                            </span>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <a href="#" class="btn btn-primary w-100">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                    <img src="assets2/img/kegiatan/kegiatan5.jpg" class="card-img-top catalog-img"
                                        alt="Kegiatan 2">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-capitalize">Kegiatan 5</h5>
                                        <p class="card-text clamp-kegiatan">
                                            Deskripsi singkat berita 5 yang menonjolkan keunggulannya.
                                        </p>

                                        <div class="mb-2">
                                            <span class="badge bg-info badge-kegiatan me-1">
                                                <i class="bi bi-calendar"></i> 14-03-2025
                                            </span>
                                            <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                Kantor DLHK Batam
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white badge-kegiatan">
                                                <i class="bi bi-people-fill"></i> Kuota: 100 peserta
                                            </span>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <a href="#" class="btn btn-primary w-100">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="card catalog-item shadow-sm h-100 d-flex flex-column">
                                    <img src="assets2/img/kegiatan/kegiatan6.jpeg" class="card-img-top catalog-img"
                                        alt="Kegiatan 2">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-capitalize">Kegiatan 6</h5>
                                        <p class="card-text clamp-kegiatan">
                                            Deskripsi singkat berita 6 yang menonjolkan keunggulannya.
                                        </p>

                                        <div class="mb-2">
                                            <span class="badge bg-info badge-kegiatan me-1">
                                                <i class="bi bi-calendar"></i> 14-03-2025
                                            </span>
                                            <span class="badge bg-light text-danger border border-danger badge-kegiatan">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                TPA, Punggur
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white badge-kegiatan">
                                                <i class="bi bi-people-fill"></i> Kuota: 200 peserta
                                            </span>
                                        </div>

                                        <div class="mt-auto pt-2">
                                            <a href="#" class="btn btn-primary w-100">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- More Button -->
                            <div class="container text-center" data-aos="fade-up" style="margin-top: 50px;">
                                <a href="/kegiatan" class="btn btn-outline-primary btn-lg px-4">
                                    Lihat Semua Kegiatan
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>



                        </div>

                    </div>

                </section><!-- /Services Section -->
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        <link href="https://fonts.googleapis.com" rel="preconnect">
            <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
                <link
                    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
                    rel="stylesheet">
    </script>
@endpush