@extends('layouts.index-menu')

@push('style')
  <link rel="stylesheet" href="{{ asset('assets/css/styles-tentang-bank-sampah.css') }}" />
@endpush

@section('title', 'Ecozyne | Tentang Eco Enzyme')

@section('content')
  <div class="page-title mt-5">
    <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
      <div class="col-lg-8">
        <h1>Tentang Eco Enzim</h1>
        <p class="mb-0">Eco Enzim adalah cairan serbaguna yang dihasilkan dari fermentasi limbah organik seperti kulit
        buah dan sayur...</p>
      </div>
      </div>
    </div>
    </div>
    <nav class="breadcrumbs">
    <div class="container">
      <ol>
      <li><a href="{{ url('/') }}">Beranda</a></li>
      <li class="current">Tentang Eco Enzim</li>
      </ol>
    </div>
    </nav>
  </div>

  <section id="starter-section" class="starter-section section">
    <div class="container section-title" data-aos="fade-up">
    <h2>Apa itu Eco Enzim</h2>
    <p>Mengenal lebih jauh tentang eco enzim</p>
    </div>

    <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-md-6 mb-4">
      <video controls class="w-100 rounded shadow-sm" poster="{{ asset('assets2/img/thumb1.png') }}">
        <source src="{{ asset('assets2/vid/eco_enzyme1.mp4') }}" type="video/mp4">
      </video>
      </div>
      <div class="col-md-6 mb-4">
      <video controls class="w-100 rounded shadow-sm" poster="{{ asset('assets2/img/thumb2.png') }}">
        <source src="{{ asset('assets2/vid/eco_enzyme2.mp4') }}" type="video/mp4">
      </video>
      </div>
    </div>
    </div>
  </section>

  <section class="starter-section section">
    <div class="container section-title" data-aos="fade-up">
    <h2>Eco Enzim</h2>
    <p>Manfaat Eco Enzim</p>
    </div>

    <div class="container" data-aos="fade-up">
    <div class="row align-items-start">
      <div class="col-md-8">
      <h4 class="text-primary fw-bold">Kenapa Harus Menggunakan Eco Enzim</h4>
      <p>
        Karena kandungannya, eco Enzyme memiliki banyak cara untuk membantu siklus alam seperti memudahkan
        pertumbuhan tanaman (sebagai fertilizer), mengobati tanah dan juga membersihkan air yang tercemar.
        Selain itu bisa juga ditambahkan ke produk pembersih rumah tangga seperti shampoo, pencuci piring,
        deterjen, dll.
      </p>
      <p>
        Pembersih enzim ini 100% natural dan bebas dari bahan kimia, mudah terurai dan lembut di tangan dan
        lingkungan. Cairan ini juga penolak serangga alami yang membuat semut, serangga dll menjauh. Saking
        alaminya, setelah digunakan untuk pel, cairan ini juga bisa dipakai untuk menyiram tanaman. Eco Enzyme
        juga dapat digunakan untuk merangsang hormon tanaman untuk meningkatkan kualitas buah dan sayuran dan
        untuk meningkatkan hasil panen.
      </p>
      </div>
      <div class="col-md-4">
      <img src="{{ asset('assets2/img/eco-enzim.jpg') }}" alt="Eco Enzyme" class="img-fluid rounded shadow-sm">
      </div>
    </div>
    </div>
  </section>

  <section id="membuat-section" class="membuat-section section">
    <div class="container section-title" data-aos="fade-up">
    <h2>Panduan Membuat Eco Enzim</h2>
    <p>Cara Membuat Eco Enzim</p>
    </div>

    <img src="{{ asset('assets2/img/cara-membuat-eco-enzim.png') }}" alt="Eco Enzyme"
    class="img-fluid rounded shadow-sm mx-auto d-block img-responsive-custom" data-bs-toggle="modal"
    data-bs-target="#imageModal" style="cursor: pointer;">

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      <div class="modal-body text-center">
        <img src="{{ asset('assets2/img/cara-membuat-eco-enzim.png') }}" alt="Eco Enzyme Full"
        class="img-fluid rounded mb-3">
        <a href="{{ asset('assets2/img/cara-membuat-eco-enzim.png') }}" download class="btn btn-success">Download
        Gambar</a>
      </div>
      </div>
    </div>
    </div>
  </section>
@endsection