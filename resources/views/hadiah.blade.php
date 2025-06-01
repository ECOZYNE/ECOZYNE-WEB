@extends('layouts.index-menu')

@push('style')
    <link href="assets2/css/custom-index.css" rel="stylesheet">
@endpush

@section('title', 'Ecozyne | Hadiah')

@section('content')
    <!-- Page Title -->
    <div class="page-title mt-5">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <i class="fas fa-gift fa-3x text-success mb-3"></i>
                        <h1>Tukarkan Poin Anda Dengan Hadiah Menarik</h1>

                        </p>
                    </div>
                    <!-- Search Widget -->
                    <div class="search-widget widget-item mt-6">
                        <form action="">
                            <input type="text" placeholder="Cari di katalog.....">
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
                    <li class="current">Hadiah</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <!-- Pricing Section -->
                <section id="pricing" class="pricing section">

                    <!-- Pricing Section -->
                    <section id="pricing" class="pricing section-bg">
                        <div class="container" data-aos="fade-up">
                            <div class="section-title">
                                <h2>Katalog Produk</h2>
                                <p>Produk yang ditawarkan merupakan hasil olahan eco-enzim / Organik.</p>
                            </div>

                            <div class="row gy-4 justify-content-center">

                                <!-- Card 1 -->
                                <div class="col-lg-3 col-md-6">
                                    <a href="/produk/eco-enzim-5-liter" class="text-decoration-none text-dark">
                                        <div class="card shadow-sm">
                                            <img src="assets2/img/hadiah/produk1.jpeg" class="card-img-top" alt="Product 3">
                                            <div class="card-body">
                                                <h5 class="card-title two-line-title">Eco Enzim 5 Liters</h5>
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> Kec. Batu Aji</p>
                                                <p>100+ terjual</p>
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
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> Kec. Nongsa</p>
                                                100+ terjual</p>
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
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> Kec. Batam Kota</p>
                                                100+ terjual</p>
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
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> Kec. Lubuk Baja</p>
                                                100+ terjual</p>
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
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> Kec. Bengkong</p>
                                                100+ terjual</p>
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
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> kec. bengkong</p>
                                                100+ terjual</p>
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
                                                    pupuk organik eco enzyme </h5>
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> kec. sei beduk</p>
                                                100+ terjual</p>
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
                                                <p class="card-text text-danger fs-5 mb-1">Rp165.600
                                                <p class="mb-1"><i class="bi bi-geo-alt"></i> kec. sagulung</p>
                                                100+ terjual</p>
                                                <span class="badge bg-success">
                                                    <i class="bi bi-truck"></i>
                                                    1-4 Hari
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Blog Pagination Section -->
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