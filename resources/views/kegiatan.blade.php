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
    <div class="page-title mt-5">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Kegiatan</h1>
                        <p class="mb-3">Ayo jadi bergerak bersama kami wujudkan aksi nyata terhadap kepedulian lingkungan
                            sekitar!
                        </p>
                    </div>
                    {{-- Search Widget for Kegiatan (Client-Side) --}}
                    <div class="search-widget widget-item mt-6">
                        <form id="searchKegiatanForm"> {{-- Added ID for JS access --}}
                            <input type="text" id="searchKegiatanInput" placeholder="Cari kegiatan..."
                                value="{{ request('search') }}"> {{-- Added ID for JS access --}}
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="current">Kegiatan</li>
                </ol>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section id="services" class="services section">

                    <div class="container section-title" data-aos="fade-up">
                        <h2>Kegiatan</h2>
                        <p>Jadwal kegiatan Ecozyne aksi nyata<br></p>
                    </div>

                    <div class="container">
                        {{-- Pesan Feedback (Success, Error, Validation) --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <h5>Oops! Ada beberapa masalah:</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row gy-4" id="kegiatanCatalog"> {{-- Added ID to the container --}}
                            @forelse($semuaKegiatan as $kegiatan)
                                <div class="col-lg-4 col-md-6 kegiatan-item" data-title="{{ strtolower($kegiatan->judul) }}"
                                    data-location="{{ strtolower($kegiatan->lokasi) }}"
                                    data-content="{{ strtolower(strip_tags($kegiatan->isi)) }}"> {{-- Added class and data
                                    attributes for search --}}
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

                                            {{-- Tombol Daftar atau Status Pendaftaran --}}
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
                                                    {{-- Modified: Button to open modal --}}
                                                    <button type="button" class="btn btn-primary w-100 daftar-kegiatan-btn"
                                                        data-bs-toggle="modal" data-bs-target="#kegiatanDetailModal"
                                                        data-id="{{ $kegiatan->id_kegiatan }}" data-judul="{{ $kegiatan->judul }}"
                                                        data-lokasi="{{ $kegiatan->lokasi }}"
                                                        data-tanggal="{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d-m-Y') }}"
                                                        data-kuota="{{ $kegiatan->kouta }}"
                                                        data-foto="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}"
                                                        data-isi="{{ strip_tags($kegiatan->isi) }}">
                                                        Daftar
                                                    </button>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                                                    Login untuk daftar
                                                </a>
                                            @endauth

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center" id="noKegiatanFound" style="display: block;"> {{-- Added ID and
                                    default display --}}
                                    <p class="lead">Tidak ada kegiatan yang ditemukan.</p>
                                    <img src="{{ asset('assets/img/no-data.svg') }}" alt="Tidak ada data"
                                        style="width: 300px; opacity: 0.7;">
                                </div>
                            @endforelse
                            {{-- This message will appear if no activities match the search --}}
                            <div class="col-12 text-center" id="noSearchResults" style="display: none;">
                                <p class="lead">Tidak ada kegiatan yang cocok dengan pencarian Anda.</p>
                                <img src="{{ asset('assets/img/no-data.svg') }}" alt="Tidak ada data"
                                    style="width: 300px; opacity: 0.7;">
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    {{-- Kegiatan Detail Modal --}}
    <div class="modal fade" id="kegiatanDetailModal" tabindex="-1" aria-labelledby="kegiatanDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> {{-- Removed modal-lg for a smaller size, matching the image --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kegiatanDetailModalLabel">Detail Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Gambar Kegiatan di bagian atas --}}
                    <img id="modalKegiatanFoto" src="" class="img-fluid rounded mb-3"
                        style="width: 100%; height: 200px; object-fit: cover;" alt="Foto Kegiatan">

                    {{-- Judul dan Deskripsi --}}
                    <h4 id="modalKegiatanJudul" class="text-capitalize mb-2"></h4>
                    <p id="modalKegiatanIsi" class="mb-3 text-muted"></p>

                    <hr class="my-3"> {{-- Garis pemisah --}}

                    {{-- Detail Tanggal, Lokasi, Kuota --}}
                    <p class="mb-1">
                        <span class="fw-bold">📅Tanggal Kegiatan:</span> <span id="modalKegiatanTanggal"></span>
                    </p>
                    <p class="mb-1">
                        </i> <span class="fw-bold">📍Lokasi Kegiatan:</span> <span id="modalKegiatanLokasi"></span>
                    </p>
                    <p class="mb-3">
                        </i> <span class="fw-bold">👥 Kuota Peserta:</span> <span id="modalKegiatanKuota"></span>
                    </p>
                    <div class="d-flex justify-content-end p-3 border-top mt-2">
                        {{-- Tombol Daftar Sekarang --}}
                        <form action="{{ route('daftar-kegiatan.daftarKegiatan') }}" method="POST"
                            class="d-flex justify-content-end">
                            @csrf
                            <input type="hidden" name="id_kegiatan" id="modalKegiatanId">
                            <button type="submit" class="btn btn-info"
                                style="background-color: #00e0b3; border-color: #00e0b3; color: white;">
                                Daftar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchKegiatanInput = document.getElementById('searchKegiatanInput');
            const searchKegiatanForm = document.getElementById('searchKegiatanForm');
            const kegiatanItems = document.querySelectorAll('.kegiatan-item');
            const noKegiatanFound = document.getElementById('noKegiatanFound');
            const noSearchResults = document.getElementById('noSearchResults');

            function performKegiatanSearch() {
                const searchTerm = searchKegiatanInput.value.toLowerCase().trim();
                let kegiatanFoundCount = 0;

                kegiatanItems.forEach(item => {
                    const kegiatanTitle = item.dataset.title;
                    const kegiatanLocation = item.dataset.location;
                    const kegiatanContent = item.dataset.content; // Use content for more comprehensive search

                    // Check if the search term is found in title, location, or content
                    if (kegiatanTitle.includes(searchTerm) || kegiatanLocation.includes(searchTerm) || kegiatanContent.includes(searchTerm)) {
                        item.style.display = 'block'; // Show the activity
                        kegiatanFoundCount++;
                    } else {
                        item.style.display = 'none'; // Hide the activity
                    }
                });

                // Handle "no results" message
                if (searchTerm !== '') { // If there's a search term
                    if (kegiatanFoundCount === 0) {
                        noSearchResults.style.display = 'block';
                    } else {
                        noSearchResults.style.display = 'none';
                    }
                    noKegiatanFound.style.display = 'none'; // Hide the "no activities at all" message
                } else { // If the search term is empty, show original "no activities" message if applicable
                    noSearchResults.style.display = 'none';
                    if (kegiatanItems.length === 0) {
                        noKegiatanFound.style.display = 'block';
                    } else {
                        noKegiatanFound.style.display = 'none'; // Hide it if there are activities
                    }
                }
            }

            // Add event listener for input changes (live search)
            searchKegiatanInput.addEventListener('keyup', performKegiatanSearch);

            // Prevent form submission on search form
            searchKegiatanForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Stop the default form submission
                performKegiatanSearch(); // Perform search on submit as well (e.g., if user presses Enter)
            });

            // Initial check for no activities if the page loads with no activities
            if (kegiatanItems.length === 0 && noKegiatanFound) {
                noKegiatanFound.style.display = 'block';
            } else if (noKegiatanFound) {
                noKegiatanFound.style.display = 'none'; // Hide if there are activities
            }

            // --- Modal Logic ---
            const kegiatanDetailModal = document.getElementById('kegiatanDetailModal');
            kegiatanDetailModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract info from data-bs-* attributes
                const id = button.getAttribute('data-id');
                const judul = button.getAttribute('data-judul');
                const lokasi = button.getAttribute('data-lokasi');
                const tanggal = button.getAttribute('data-tanggal');
                const kuota = button.getAttribute('data-kuota');
                const foto = button.getAttribute('data-foto'); // Keep foto to display at the top
                const isi = button.getAttribute('data-isi');

                // Update the modal's content
                const modalTitle = kegiatanDetailModal.querySelector('#kegiatanDetailModalLabel');
                const modalKegiatanId = kegiatanDetailModal.querySelector('#modalKegiatanId');
                const modalKegiatanFoto = kegiatanDetailModal.querySelector('#modalKegiatanFoto');
                const modalKegiatanJudul = kegiatanDetailModal.querySelector('#modalKegiatanJudul');
                const modalKegiatanIsi = kegiatanDetailModal.querySelector('#modalKegiatanIsi');
                const modalKegiatanTanggal = kegiatanDetailModal.querySelector('#modalKegiatanTanggal');
                const modalKegiatanLokasi = kegiatanDetailModal.querySelector('#modalKegiatanLokasi');
                const modalKegiatanKuota = kegiatanDetailModal.querySelector('#modalKegiatanKuota');

                modalTitle.textContent = 'Detail Kegiatan'; // Set to "Detail Kegiatan" as per image
                modalKegiatanId.value = id;
                modalKegiatanFoto.src = foto;
                modalKegiatanJudul.textContent = judul;
                modalKegiatanIsi.textContent = isi;
                modalKegiatanTanggal.textContent = tanggal;
                modalKegiatanLokasi.textContent = lokasi;
                modalKegiatanKuota.textContent = kuota;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sweetAlertData = @json(session('sweet_alert'));

            if (sweetAlertData) {
                // If the message is related to successful registration
                if (sweetAlertData.type === 'success' && sweetAlertData.message.includes('Anda berhasil mengikuti kegiatan')) {
                    Swal.fire({
                        icon: 'success', // Use 'success' icon for this specific message
                        title: 'Berhasil!',
                        text: 'Anda berhasil mengikuti kegiatan.', // Specific success message
                        toast: true, // Enable toast mode
                        position: 'bottom-start', // Position at bottom-left
                        showConfirmButton: false, // No confirm button
                        timer: 7000, // Display for 7 seconds
                        timerProgressBar: true, // Show a progress bar
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                } else {
                    // For other SweetAlerts (e.g., error, validation, or other success messages)
                    Swal.fire({
                        icon: sweetAlertData.type,
                        title: 'Informasi',
                        text: sweetAlertData.message,
                        showConfirmButton: false,
                        timer: 3000 // Default timer for others
                    });
                }
            }
        });
    </script>
@endpush