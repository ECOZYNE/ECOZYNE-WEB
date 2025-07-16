@extends('layouts.index-menu')

@push('style')
    <link href="assets2/css/custom-index.css" rel="stylesheet">
    {{-- Pindahkan font links ke sini atau langsung ke layout utama jika diperlukan di banyak halaman --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

@endpush

@section('title', 'Ecozyne | Hadiah')

@section('content')
    <div class="page-title mt-5">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <i class="fas fa-gift fa-3x text-success mb-3"></i>
                        <h1>Tukarkan Poin Anda Dengan Hadiah Menarik</h1>
                    </div>
                    <div class="search-widget widget-item mt-6">
                        <form id="searchForm"> {{-- Add an ID to the form --}}
                            <input type="text" id="searchInput" placeholder="Cari di katalog....."> {{-- Add an ID to the input --}}
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
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section id="pricing" class="pricing section-bg">
                    <div class="container" data-aos="fade-up">
                        <div class="section-title">
                            <h2>Katalog Hadiah</h2>
                            <p>Tukarkan poin anda dengan hadiah menarik</p>
                        </div>

                        <div class="row gy-4 justify-content-center" id="hadiahCatalog"> {{-- Add an ID to the catalog container --}}
                            {{-- Loop untuk setiap hadiah --}}
                            @foreach ($hadiah as $item)
                                <div class="col-lg-3 col-md-6 hadiah-item" data-name="{{ strtolower($item->nama_hadiah) }}" data-description="{{ strtolower($item->deskripsi) }}"> {{-- Add a class and data attributes for search --}}
                                    <div class="card shadow-sm h-100 hover-lift">
                                        <img src="{{ asset('storage/hadiah/' . $item->foto) }}" class="card-img-top"
                                            alt="{{ $item->nama_hadiah }}">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title two-line-title">{{ $item->nama_hadiah }}</h5>
                                            <p class="card-text text-danger fs-5 mb-1">{{ number_format($item->point_satuan) }} XP</p>
                                            <p class="card-text mb-2">Stok : {{ number_format($item->stok) }}</p>
                                            <p class="card-text small text-muted mb-2">{{ Str::limit($item->deskripsi, 100) }}</p>

                                            <div class="d-flex align-items-center mt-1 mb-2">
                                                <span class="badge badge-custom-green me-2"><i class="bi bi-truck"></i> Pengiriman 1-4 Hari</span>
                                                <span class="badge badge-custom-orange"><span class="fst-italic">COD</span></span>
                                            </div>

                                            @if ($loggedIn)
                                                <div class="mt-auto">
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                                            onclick="changeQuantity('{{ $item->id_hadiah }}', -1)">-</button>
                                                        <input type="number" id="quantity_{{ $item->id_hadiah }}"
                                                            class="form-control form-control-sm text-center" value="1" min="1"
                                                            max="{{ $item->stok }}" aria-label="Jumlah" readonly>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                                            onclick="changeQuantity('{{ $item->id_hadiah }}', 1)">+</button>
                                                    </div>

                                                    <button type="button" class="btn btn-primary w-100"
                                                        onclick="openModal('{{ $item->id_hadiah }}', '{{ $item->nama_hadiah }}', {{ $item->point_satuan }}, {{ $item->stok }}, '{{ $item->deskripsi }}', '{{ asset('storage/hadiah/' . $item->foto) }}')"
                                                        @if ($item->stok <= 0 || $userPoints < $item->point_satuan) disabled @endif>
                                                        Tukarkan
                                                    </button>

                                                    @if ($item->stok <= 0)
                                                        <small class="text-danger">Stok habis!</small>
                                                    @elseif ($userPoints < $item->point_satuan)
                                                        <small class="text-danger">Poin tidak cukup!</small>
                                                    @endif
                                                </div>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary w-100 disabled" tabindex="-1" role="button"
                                                aria-disabled="true">
                                                Login untuk Tukarkan
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Modal Konfirmasi Penukaran --}}
                        <div class="modal fade" id="modalPenukaran" tabindex="-1" aria-labelledby="modalPenukaranLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPenukaranLabel">Konfirmasi Penukaran Hadiah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img id="modalImage" src="" class="img-fluid rounded" alt="Hadiah">
                                            </div>
                                            <div class="col-md-8">
                                                <h5 id="modalNamaHadiah"></h5>
                                                <p class="text-muted" id="modalDeskripsi"></p>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <strong>Harga per unit:</strong><br>
                                                        <span class="text-danger fs-5" id="modalPointSatuan"></span> XP
                                                    </div>
                                                    <div class="col-6">
                                                        <strong>Jumlah:</strong><br>
                                                        <span id="modalJumlah" class="fs-5"></span> unit
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <strong>Total Poin:</strong><br>
                                                        <span class="text-danger fs-4" id="modalTotalPoint"></span> XP
                                                    </div>
                                                    <div class="col-6">
                                                        <strong>Poin Anda:</strong><br>
                                                        <span class="text-success fs-4">{{ number_format($userPoints) }} XP</span>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <strong>Sisa Poin:</strong>
                                                    <span id="modalSisaPoint" class="fs-5"></span> XP
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form id="formPenukaran" action="{{ route('penukaran.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_hadiah" id="formIdHadiah">
                                            <input type="hidden" name="jumlah" id="formJumlah">
                                            <input type="hidden" name="point_satuan" id="formPointSatuan">
                                            <button type="submit" class="btn btn-primary">Buat Penukaran</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    {{-- Ini adalah tempat yang tepat untuk script JS, HANYA script JS --}}
    <script>
        function changeQuantity(idHadiah, delta) {
            const input = document.getElementById('quantity_' + idHadiah);
            let currentValue = parseInt(input.value);
            let minValue = parseInt(input.min);
            let maxValue = parseInt(input.max);

            let newValue = currentValue + delta;

            if (newValue >= minValue && newValue <= maxValue) {
                input.value = newValue;
            } else if (newValue < minValue) {
                input.value = minValue;
            } else if (newValue > maxValue) {
                input.value = maxValue;
            }
        }

        function openModal(idHadiah, namaHadiah, pointSatuan, stok, deskripsi, foto) {
            const quantity = parseInt(document.getElementById('quantity_' + idHadiah).value);
            const totalPoint = pointSatuan * quantity;
            const userPoints = {{ $userPoints }};
            const sisaPoint = userPoints - totalPoint;

            // Update modal content
            document.getElementById('modalImage').src = foto;
            document.getElementById('modalNamaHadiah').textContent = namaHadiah;
            document.getElementById('modalDeskripsi').textContent = deskripsi;
            document.getElementById('modalPointSatuan').textContent = pointSatuan.toLocaleString();
            document.getElementById('modalJumlah').textContent = quantity;
            document.getElementById('modalTotalPoint').textContent = totalPoint.toLocaleString();
            document.getElementById('modalSisaPoint').textContent = sisaPoint.toLocaleString();
            document.getElementById('modalSisaPoint').className = sisaPoint >= 0 ? 'fs-5 text-success' : 'fs-5 text-danger';

            // Update form values
            document.getElementById('formIdHadiah').value = idHadiah;
            document.getElementById('formJumlah').value = quantity;
            document.getElementById('formPointSatuan').value = pointSatuan;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('modalPenukaran'));
            modal.show();
        }

    document.addEventListener('DOMContentLoaded', function() {
        // Scroll ke section tertentu jika ada sweet alert
        @if(session('sweet_alert.scroll_to'))
            const section = document.getElementById('{{ session('sweet_alert.scroll_to') }}');
            if (section) {
                // Delay sedikit untuk memastikan page sudah fully loaded
                setTimeout(() => {
                    section.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        @endif

        // Tampilkan SweetAlert jika ada session
        @if(session('sweet_alert'))
            Swal.fire({
                icon: '{{ session('sweet_alert.type') }}', // success, error, warning, info
                title: '{{ session('sweet_alert.title') ?? "Notifikasi" }}',
                text: '{{ session('sweet_alert.message') }}',
                timer: 7500, // Durasi 7.5 detik (7 detik + sedikit buffer)
                timerProgressBar: true,
                showConfirmButton: true, // Ubah ke true jika ingin tombol 'OK' muncul setelah timer habis
                confirmButtonText: 'OK',
                toast: false, // Ubah ke false untuk alert biasa (bukan toast)
                position: 'center', // Tampilkan di tengah
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        @endif

        // Modifikasi untuk sweet_alert type 'success'
        @if(session('sweet_alert.type') === 'success')
            Swal.fire({
                icon: 'success', // Icon bawaan SweetAlert (centang)
                title: '{{ session('sweet_alert.title') ?? "Berhasil!" }}',
                text: '{{ session('sweet_alert.message') }}',
                position: 'bottom-start', // Pindah ke pojok kiri bawah
                showConfirmButton: false, // Sembunyikan tombol konfirmasi
                timer: 7000, // 7 detik
                timerProgressBar: true,
                toast: true, // Jadikan toast untuk posisi pojok
                customClass: {
                    popup: 'colored-toast' // Kelas kustom jika ingin styling tambahan
                }
            });
        @endif

        // Legacy support untuk session success/error (backup), ini bisa dipertimbangkan untuk dihapus
        // karena sudah ada sweet_alert di atas
        @if(session('success') && !session('sweet_alert'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error') && !session('sweet_alert'))
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak!!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif


        // --- JavaScript for search functionality ---
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        const hadiahItems = document.querySelectorAll('.hadiah-item'); // Get all gift item cards

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim(); // Get and clean search term

            hadiahItems.forEach(item => {
                const itemName = item.dataset.name;
                const itemDescription = item.dataset.description;

                if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                    item.style.display = 'block'; // Show the item
                } else {
                    item.style.display = 'none'; // Hide the item
                }
            });
        }

        // Add event listener for input changes (live search)
        searchInput.addEventListener('keyup', performSearch);

        // Prevent form submission on search form
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Stop the default form submission
            performSearch(); // Perform search on submit as well (e.g., if user presses Enter)
        });
        // --- End of JavaScript for search functionality ---

    });
    </script>
@endpush