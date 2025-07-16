@extends('layouts.index-menu')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-bank-sampah.css') }}" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin="" />
@endpush

@push('style')
    <style>
        .product-img-fixed {
            width: 100%;
            height: 200px;
            /* Set a consistent height for all product images */
            object-fit: cover;
            /* Ensures the image covers the area while maintaining aspect ratio */
            object-position: center;
            /* Centers the image within its container */
        }

        /* Style for the image inside the modal */
        #modalFoto {
            height: 300px;
            /* Larger height for the modal image */
            width: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Additional style for the card title to limit to two lines */
        .two-line-title {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
            min-height: 3em;
            /* Approximate height for two lines of text */
        }

        /* Leaflet map styling */
        #map {
            height: 450px;
            width: 100%;
            z-index: 1;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 8px;
        }

        .leaflet-popup-content {
            margin: 8px 12px;
            line-height: 1.4;
        }

        .map-info-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 10px;
        }
    </style>
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

        {{-- Peta Leaflet --}}
        <section id="mapSection" class="section">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white"><i class="bi bi-geo-alt me-2"></i>Detail Lokasi Bank Sampah</h4>
                </div>
                <div class="card-body p-0">
                    <!-- Leaflet Map Container -->
                    <div id="map"></div>

                    <div class="p-3">
                        <p class="card-text text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            Lokasi di atas diambil dari koordinat bank sampah. Klik marker untuk melihat detail.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <button id="toggleSatellite" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="bi bi-globe me-1"></i> Tampilan Satelit
                                </button>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $bankSampah->pengajuanBankSampah->latitude ?? '-6.1753929' }},{{ $bankSampah->pengajuanBankSampah->longitude ?? '106.8271528' }}"
                                   target="_blank" class="btn btn-sm btn-outline-success mt-2">
                                    <i class="bi bi-directions me-1"></i> Buka Rute di Google Maps
                                </a>
                            </div>
                        </div>
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
                    {{-- Tambahkan di bagian loop produk, ganti bagian tombol "Pesan Sekarang" --}}
                    @forelse ($bankSampah->produks->sortByDesc('created_at') as $product)
                        <div class="col-lg-3 col-md-6">
                            <div class="card shadow-sm h-100 {{ $product->stok <= 0 ? 'opacity-75' : '' }}">
                                <div class="position-relative">
                                    <img src="{{ Storage::url('produk/' . $product->foto) }}"
                                        class="card-img-top product-img-fixed" alt="{{ $product->nama_produk }}">

                                    {{-- Out of Stock Badge --}}
                                    @if ($product->stok <= 0)
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <span class="badge bg-danger">Stok Habis</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title two-line-title">{{ $product->nama_produk }}</h5>
                                    <p class="card-text text-danger fs-5 mb-1">
                                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                                    </p>

                                    {{-- Stock Display with Color Coding --}}
                                    <p class="card-text mb-2">
                                        Stok :
                                        <span
                                            class="{{ $product->stok <= 0 ? 'text-danger fw-bold' : ($product->stok <= 5 ? 'text-warning fw-bold' : 'text-success') }}">
                                            {{ number_format($product->stok) }}
                                            @if ($product->stok <= 0)
                                                (Habis)
                                            @elseif($product->stok <= 5)
                                                (Terbatas)
                                            @endif
                                        </span>
                                    </p>

                                    <p class="card-text small text-muted mb-2">
                                        {{ Str::limit($product->deskripsi, 100) }}
                                    </p>

                                    {{-- Buy Button with Stock and Self-Purchase Validation --}}
                                    @php
                                        $isOwnProduct = false;
                                        if (Auth::check() && Auth::user()->komunitas) {
                                            $bankSampahPemilik = $product->bankSampah->pengajuanBankSampah->komunitas ?? null;
                                            $isOwnProduct = $bankSampahPemilik && $bankSampahPemilik->id_komunitas === Auth::user()->komunitas->id_komunitas;
                                        }
                                    @endphp

                                    @if ($product->stok <= 0)
                                        <button class="btn btn-secondary btn-sm w-100" disabled>
                                            <i class="bi bi-x-circle"></i> Stok Habis
                                        </button>
                                    @elseif ($isOwnProduct)
                                        <button class="btn btn-warning btn-sm w-100" disabled
                                            title="Tidak dapat membeli produk sendiri">
                                            <i class="bi bi-exclamation-circle"></i> Produk Anda Sendiri
                                        </button>
                                    @else
                                        <button class="btn btn-success btn-sm w-100" onclick="openBuyModal(
                                                                    '{{ $product->id_produk }}',
                                                                    '{{ $product->nama_produk }}',
                                                                    {{ $product->harga }},
                                                                    {{ $product->stok }},
                                                                    '{{ addslashes($product->deskripsi) }}',
                                                                    '{{ Storage::url('produk/' . $product->foto) }}'
                                                                )">
                                            <i class="bi bi-cart-plus"></i> Pesan Sekarang (COD)
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Belum ada produk yang tersedia untuk Bank Sampah ini.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-6">
                                    <img id="modalFoto" src="" class="img-fluid rounded" alt="Foto Produk">
                                </div>
                                <div class="col-md-6">
                                    <h5 id="modalNama"></h5>
                                    <p class="small text-muted" id="modalDeskripsi"></p>
                                    <p>Harga: <span class="fw-bold text-danger" id="modalHarga"></span></p>
                                    <p>Stok: <span id="modalStok"></span></p>

                                    <div class="alert alert-info mb-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Sistem COD (Cash on Delivery)</strong><br>
                                        <small>Pembayaran dilakukan saat pengambilan produk</small>
                                    </div>

                                    <label>Jumlah Pesan:</label>
                                    <div class="input-group mb-3" style="max-width: 200px;">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="adjustQty(-1)">-</button>
                                        <input type="text" class="form-control text-center" id="modalQty" value="1"
                                            readonly>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="adjustQty(1)">+</button>
                                    </div>

                                    <button class="btn btn-primary w-100" onclick="confirmPurchase()">
                                        <i class="bi bi-cart-check me-2"></i>Pesan Sekarang (COD)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Initialize Leaflet Map
        let map;
        let marker;
        let currentLayer = 'street';
        
        // Koordinat bank sampah
        const bankSampahLat = {{ $bankSampah->pengajuanBankSampah->latitude ?? '-6.1753929' }};
        const bankSampahLng = {{ $bankSampah->pengajuanBankSampah->longitude ?? '106.8271528' }};
        const bankSampahNama = "{{ $bankSampah->pengajuanBankSampah->nama_bank_sampah ?? 'Bank Sampah' }}";
        const bankSampahAlamat = "{{ $bankSampah->pengajuanBankSampah->lokasi_bank_sampah ?? 'Alamat tidak tersedia' }}";
        const bankSampahTelepon = "{{ $bankSampah->pengajuanBankSampah->komunitas->no_telp ?? 'Telepon tidak tersedia' }}";

        function initMap() {
            // Initialize map
            map = L.map('map').setView([bankSampahLat, bankSampahLng], 15);

            // Add default tile layer (OpenStreetMap)
            const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Satellite layer (using Esri World Imagery)
            const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            });

            // Create custom icon for marker
            const customIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // Add marker
            marker = L.marker([bankSampahLat, bankSampahLng], {icon: customIcon}).addTo(map);

            // Create popup content
            const popupContent = `
                <div style="min-width: 200px;">
                    <h6 style="margin-bottom: 8px; color: #0d6efd;"><i class="bi bi-bank2"></i> ${bankSampahNama}</h6>
                    <p style="margin-bottom: 5px; font-size: 0.9em;"><i class="bi bi-geo-alt-fill text-danger"></i> ${bankSampahAlamat}</p>
                    <p style="margin-bottom: 5px; font-size: 0.9em;"><i class="bi bi-telephone-fill text-success"></i> ${bankSampahTelepon}</p>
                    <hr style="margin: 8px 0;">
                    <small class="text-muted">Klik marker untuk melihat detail lengkap</small>
                </div>
            `;

            marker.bindPopup(popupContent);

            // Toggle satellite view
            document.getElementById('toggleSatellite').addEventListener('click', function() {
                if (currentLayer === 'street') {
                    map.removeLayer(streetLayer);
                    map.addLayer(satelliteLayer);
                    currentLayer = 'satellite';
                    this.innerHTML = '<i class="bi bi-map me-1"></i> Tampilan Jalan';
                } else {
                    map.removeLayer(satelliteLayer);
                    map.addLayer(streetLayer);
                    currentLayer = 'street';
                    this.innerHTML = '<i class="bi bi-globe me-1"></i> Tampilan Satelit';
                }
            });

            // Add map controls
            const zoomControl = L.control.zoom({
                position: 'topright'
            }).addTo(map);

            // Add scale control
            L.control.scale({
                position: 'bottomleft'
            }).addTo(map);
        }

        // Initialize map when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });

        // Product modal functions (unchanged)
        let currentProductId = null;
        let currentStok = 0;
        let currentHarga = 0;

        function openBuyModal(id, nama, harga, stok, deskripsi, foto) {
            currentProductId = id;
            currentStok = parseInt(stok);
            currentHarga = parseInt(harga);

            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalDeskripsi').innerText = deskripsi;
            document.getElementById('modalStok').innerText = stok;
            document.getElementById('modalFoto').src = foto;
            document.getElementById('modalQty').value = 1;

            if (currentStok <= 0) {
                const confirmButton = document.querySelector('#buyModal .btn-primary');
                confirmButton.disabled = true;
                confirmButton.innerText = 'Stok Habis';
                confirmButton.classList.remove('btn-primary');
                confirmButton.classList.add('btn-secondary');

                document.querySelectorAll('#buyModal .btn-outline-secondary').forEach(btn => {
                    btn.disabled = true;
                });
                document.getElementById('modalQty').value = 0;
                document.getElementById('modalHarga').innerText = 'Rp0';

                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Habis',
                    text: 'Maaf, produk ini sudah habis stoknya.',
                    confirmButtonText: 'Oke'
                });
            } else {
                const confirmButton = document.querySelector('#buyModal .btn-primary');
                confirmButton.classList.remove('btn-secondary', 'btn-warning');
                confirmButton.classList.add('btn-primary');
                confirmButton.disabled = false;
                confirmButton.innerText = '<i class="bi bi-cart-check me-2"></i>Pesan Sekarang (COD)';

                document.querySelectorAll('#buyModal .btn-outline-secondary').forEach(btn => {
                    btn.disabled = false;
                });
                updateTotalHarga();
            }

            new bootstrap.Modal(document.getElementById('buyModal')).show();
        }

        function adjustQty(change) {
            if (currentStok <= 0) {
                return;
            }

            const qtyInput = document.getElementById('modalQty');
            let qty = parseInt(qtyInput.value);
            qty += change;

            if (qty < 1) qty = 1;
            if (qty > currentStok) {
                qty = currentStok;
                Swal.fire({
                    icon: 'warning',
                    title: 'Batas Stok',
                    text: `Maksimal pembelian ${currentStok} unit sesuai stok yang tersedia.`,
                    confirmButtonText: 'Oke'
                });
            }

            qtyInput.value = qty;
            updateTotalHarga();
        }

        function updateTotalHarga() {
            const qty = parseInt(document.getElementById('modalQty').value);
            const totalHarga = currentHarga * qty;
            document.getElementById('modalHarga').innerText = 'Rp' + totalHarga.toLocaleString('id-ID');

            const confirmButton = document.querySelector('#buyModal .btn-primary');

            if (currentStok <= 0) {
                confirmButton.disabled = true;
                confirmButton.innerText = 'Stok Habis';
                confirmButton.classList.remove('btn-primary');
                confirmButton.classList.add('btn-secondary');
                return;
            }

            confirmButton.disabled = false;
            confirmButton.innerText = 'Pesan Sekarang (COD)';
            confirmButton.classList.remove('btn-warning', 'btn-secondary');
            confirmButton.classList.add('btn-primary');
        }

        function confirmPurchase() {
            const qty = parseInt(document.getElementById('modalQty').value);
            const productName = document.getElementById('modalNama').innerText;
            const totalPrice = currentHarga * qty;

            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'info',
                    title: 'Perlu Login',
                    text: 'Anda harus login untuk melakukan pemesanan.',
                    showCancelButton: true,
                    confirmButtonText: 'Login Sekarang',
                    cancelButtonText: 'Nanti'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
                return;
            }

            if (currentStok <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pemesanan Gagal',
                    text: 'Produk sudah habis stoknya.',
                    confirmButtonText: 'Oke'
                });
                return;
            }

            if (qty <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pemesanan Gagal',
                    text: 'Jumlah pemesanan harus lebih dari 0.',
                    confirmButtonText: 'Oke'
                });
                return;
            }

            if (qty > currentStok) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pemesanan Gagal',
                    text: 'Jumlah pemesanan melebihi stok yang tersedia.',
                    confirmButtonText: 'Oke'
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Pemesanan',
                html: `Anda yakin ingin memesan <strong>${qty} unit</strong> produk "<strong>${productName}</strong>" seharga <strong>Rp${totalPrice.toLocaleString('id-ID')}</strong>?<br><br>Pembayaran akan dilakukan saat pengambilan (COD).`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Pesan Sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const confirmButton = document.querySelector('#buyModal .btn-primary');
                    const originalText = confirmButton.innerHTML;
                    confirmButton.disabled = true;
                    confirmButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('{{ route('product.purchase') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: currentProductId,
                            quantity: qty
                        })
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw new Error(errorData.message ||
                                        'Terjadi kesalahan saat memproses permintaan Anda.');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pemesanan Berhasil!',
                                    text: data.message,
                                    confirmButtonText: 'Oke'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Pemesanan Gagal',
                                    text: 'Pemesanan gagal: ' + data.message,
                                    confirmButtonText: 'Oke'
                                });
                            }
                            bootstrap.Modal.getInstance(document.getElementById('buyModal')).hide();
                        })
                        .catch(error => {
                            console.error('Error during purchase:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Terjadi kesalahan: ' + error.message,
                                confirmButtonText: 'Oke'
                            });

                            confirmButton.disabled = false;
                            confirmButton.innerHTML = originalText;
                        });
                }
            });
        }
    </script>
@endpush