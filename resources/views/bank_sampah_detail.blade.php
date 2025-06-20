@extends('layouts.index-menu')



@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-bank-sampah.css') }}" />
@endpush

@section('content')
    <div class="page-title mt-5">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Bank Sampah: {{ $bankSampah->pengajuanBankSampah->nama_bank_sampah ?? 'N/A' }}</h1>
                        <p class="mb-0">Informasi lengkap mengenai
                            {{ $bankSampah->pengajuanBankSampah->nama_bank_sampah ?? 'bank sampah ini' }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/bank-sampah') }}">Bank Sampah</a></li>
                    <li class="current">{{ $bankSampah->pengajuanBankSampah->nama_bank_sampah ?? 'Detail' }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mb-5 shadow-sm position-relative card-bg-bank">
                    <div class="overlay-dark"></div>

                    <div class="card-header bg-primary text-white content-layer">
                        <h4 class="mb-0 text-white"><i class="bi bi-info-circle me-2"></i>Tentang Bank Sampah Ini</h4>
                    </div>

                    <div class="card-body content-layer">
                        <div class="row">
                            <div class="col-md-7">
                                <ul class="list-group list-group-flush mb-5 card-info-box">
                                    <li class="list-group-item bg-transparent">
                                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                                        <strong>Alamat:</strong>
                                        {{ $bankSampah->pengajuanBankSampah->lokasi_bank_sampah ?? 'N/A' }}
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="bi bi-phone-fill me-2 text-success"></i>
                                        <strong>Telepon:</strong>
                                        {{ $bankSampah->pengajuanBankSampah->komunitas->no_telp ?? 'N/A' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        {{-- Peta --}}
        <section id="mapSection" class="section mt-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white"><i class="bi bi-geo-alt me-2"></i>Detail Lokasi Bank Sampah</h4>
                </div>
                <div class="card-body p-0" style="min-height: 400px;">
                    <iframe width="100%" height="450" style="border:0;" loading="lazy" allowfullscreen
                        src="https://www.google.com/maps?q={{ $bankSampah->pengajuanBankSampah->latitude ?? '-6.1753929' }},{{ $bankSampah->pengajuanBankSampah->longitude ?? '106.8271528' }}&hl=id&z=15&output=embed">
                    </iframe>

                    <div class="p-3">
                        <p class="card-text text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            Lokasi di atas diambil dari koordinat bank sampah.
                        </p>
                        <a href="https://www.google.com/maps?q={{ $bankSampah->pengajuanBankSampah->latitude ?? '-6.1753929' }},{{ $bankSampah->pengajuanBankSampah->longitude ?? '106.8271528' }}"
                            target="_blank" class="btn btn-sm btn-outline-secondary mt-2">
                            <i class="bi bi-directions me-1"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <hr>

        {{-- Produk --}}
        <section id="produk" class="pricing section-bg mt-5">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Katalog Produk</h2>
                    <p>Produk yang ditawarkan merupakan hasil olahan eco-enzim / Organik.</p>
                </div>

                <div class="row gy-4 justify-content-center">
                    @forelse ($bankSampah->produks as $product)
                        <div class="col-lg-3 col-md-6">
                            {{-- Removed the <a> tag wrapping the card --}}
                                <div class="card shadow-sm h-100">
                                    <img src="{{ Storage::url('produk/' . $product->foto) }}" class="card-img-top"
                                        alt="{{ $product->nama_produk }}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title two-line-title">{{ $product->nama_produk }}</h5>
                                        <p class="card-text text-danger fs-5 mb-1">
                                            Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                                        <p class="card-text mb-2">Stok : {{ number_format($product->stok) }}</p>
                                        <p class="card-text small text-muted mb-2">{{ Str::limit($product->deskripsi, 100) }}
                                        </p>

                                        {{-- Quantity Counter --}}
                                        <div class="input-group input-group-sm mb-3 mt-auto mx-auto" style="max-width: 100%;">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="changeQuantity({{ $product->id }}, -1)">-</button>
                                            <input type="text" class="form-control text-center" value="1"
                                                id="quantity_{{ $product->id }}" readonly>
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="changeQuantity({{ $product->id }}, 1, {{ $product->stok }})">+</button>
                                        </div>

                                        <button class="btn btn-success btn-sm w-100"
                                            onclick="openBuyModal('{{ $product->id }}', '{{ $product->nama_produk }}', {{ $product->harga }}, {{ $product->stok }}, '{{ $product->deskripsi }}', '{{ Storage::url('produk/' . $product->foto) }}', {{ Auth::check() ? Auth::user()->saldo : 0 }})">
                                            <i class="bi bi-cart-plus"></i> Beli Sekarang
                                        </button>
                                    </div>
                                </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Belum ada produk yang tersedia untuk Bank Sampah ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- JavaScript for Quantity Counter and Beli Sekarang --}}
                <script>
                    function changeQuantity(productId, change, maxStock) {
                        const quantityInput = document.getElementById(`quantity_${productId}`);
                        let currentQuantity = parseInt(quantityInput.value);
                        let newQuantity = currentQuantity + change;

                        // Ensure quantity doesn't go below 1
                        if (newQuantity < 1) {
                            newQuantity = 1;
                        }

                        // Ensure quantity doesn't exceed stock
                        if (newQuantity > maxStock) {
                            newQuantity = maxStock;
                        }

                        quantityInput.value = newQuantity;
                    }

                    function beliSekarang(productName, productId) {
                        const quantityInput = document.getElementById(`quantity_${productId}`);
                        const quantity = parseInt(quantityInput.value);

                        // Here you would typically send an AJAX request to your backend
                        // to add the product with the specified quantity to the cart or process the order.
                        // For demonstration, we'll just log it to the console and show an alert.

                        console.log(`Beli ${quantity} unit ${productName} (ID: ${productId})`);
                        alert(`Anda akan membeli ${quantity} unit ${productName}.`);

                // Example of an AJAX call (using fetch API) - uncomment and adapt as needed
                /*
                fetch('/api/add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // If you're using Laravel's CSRF protection
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Produk berhasil ditambahkan ke keranjang!');
                            } else {
                                alert('Gagal menambahkan produk ke keranjang: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menambahkan produk ke keranjang.');
                        });
                */
            }
                </script>
            </div>
        </section>

        <section id="blog-pagination" class="blog-pagination section mt-4">
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
@endsection