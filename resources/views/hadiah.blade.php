@extends('layouts.index-menu')

@push('style')
    <link href="assets2/css/custom-index.css" rel="stylesheet">
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
                        <form id="searchForm">
                            <input type="text" id="searchInput" placeholder="Cari di katalog.....">
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

                        <div class="row gy-4 justify-content-center" id="hadiahCatalog">
                            @foreach ($hadiah as $item)
                                <div class="col-lg-3 col-md-6 hadiah-item" data-name="{{ strtolower($item->nama_hadiah) }}"
                                    data-description="{{ strtolower($item->deskripsi) }}">
                                    <div class="card shadow-sm h-100 hover-lift">
                                        <img src="{{ asset('storage/hadiah/' . $item->foto) }}" class="card-img-top"
                                            alt="{{ $item->nama_hadiah }}">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title two-line-title">{{ $item->nama_hadiah }}</h5>
                                            <p class="card-text text-danger fs-5 mb-1">
                                                {{ number_format($item->point_satuan) }} XP</p>
                                            <p class="card-text mb-2">Stok : {{ number_format($item->stok) }}</p>
                                            <p class="card-text small text-muted mb-2">
                                                {{ Str::limit($item->deskripsi, 100) }}</p>

                                            <div class="d-flex align-items-center mt-1 mb-2">
                                                <span class="badge badge-custom-green me-2"><i class="bi bi-truck"></i>
                                                    Pengiriman 1-4 Hari</span>
                                                <span class="badge badge-custom-orange"><span
                                                        class="fst-italic">COD</span></span>
                                            </div>

                                            @if ($loggedIn)
                                                <div class="mt-auto">
                                                    <button type="button" class="btn btn-green w-100"
                                                        onclick="openModal('{{ $item->id_hadiah }}', '{{ $item->nama_hadiah }}', {{ $item->point_satuan }}, {{ $item->stok }}, '{{ addslashes($item->deskripsi) }}', '{{ asset('storage/hadiah/' . $item->foto) }}')"
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
                                                <a href="{{ route('login') }}" class="btn btn-primary w-100 disabled"
                                                    tabindex="-1" role="button" aria-disabled="true">
                                                    Login untuk Tukarkan
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Modal Konfirmasi Penukaran --}}
                        <div class="modal fade" id="modalPenukaran" tabindex="-1" aria-labelledby="modalPenukaranLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPenukaranLabel">Konfirmasi Penukaran Hadiah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img id="modalImage" src="" class="img-fluid rounded"
                                                    alt="Hadiah">
                                            </div>
                                            <div class="col-md-8">
                                                <h5 id="modalNamaHadiah"></h5>
                                                <p class="text-muted" id="modalDeskripsi"></p>
                                                <hr>

                                                {{-- Input Jumlah di Modal --}}
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Pilih Jumlah:</strong></label>
                                                    <div class="input-group" style="max-width: 200px;">
                                                        <button type="button" class="btn btn-outline-green"
                                                            onclick="changeModalQuantity(-1)">-</button>
                                                        <input type="number" id="modalQuantityInput"
                                                            class="form-control text-center" value="1"
                                                            min="1" readonly>
                                                        <button type="button" class="btn btn-outline-green"
                                                            onclick="changeModalQuantity(1)">+</button>
                                                    </div>
                                                </div>

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
                                                        <span class="text-green fs-4">{{ number_format($userPoints) }}
                                                            XP</span>
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
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form id="formPenukaran" action="{{ route('penukaran.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_hadiah" id="formIdHadiah">
                                            <input type="hidden" name="jumlah" id="formJumlah">
                                            <input type="hidden" name="point_satuan" id="formPointSatuan">
                                            <button type="submit" class="btn btn-green" id="btnSubmitPenukaran">Buat
                                                Penukaran</button>
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
    <script>
        let currentStok = 0;
        let currentPointSatuan = 0;
        const userPoints = {{ $userPoints }};

        function changeModalQuantity(delta) {
            const input = document.getElementById('modalQuantityInput');
            let currentValue = parseInt(input.value);
            let newValue = currentValue + delta;

            if (newValue >= 1 && newValue <= currentStok) {
                input.value = newValue;
                updateModalCalculation();
            }
        }

        function updateModalCalculation() {
            const quantity = parseInt(document.getElementById('modalQuantityInput').value);
            const totalPoint = currentPointSatuan * quantity;
            const sisaPoint = userPoints - totalPoint;

            document.getElementById('modalJumlah').textContent = quantity;
            document.getElementById('modalTotalPoint').textContent = totalPoint.toLocaleString();
            document.getElementById('modalSisaPoint').textContent = sisaPoint.toLocaleString();
            document.getElementById('modalSisaPoint').className = sisaPoint >= 0 ? 'fs-5 text-green' : 'fs-5 text-danger';
            document.getElementById('formJumlah').value = quantity;

            // Disable/enable tombol submit berdasarkan sisa poin
            const btnSubmit = document.getElementById('btnSubmitPenukaran');
            if (sisaPoint < 0) {
                btnSubmit.disabled = true;
                btnSubmit.classList.add('disabled');
            } else {
                btnSubmit.disabled = false;
                btnSubmit.classList.remove('disabled');
            }
        }

        function openModal(idHadiah, namaHadiah, pointSatuan, stok, deskripsi, foto) {
            // Set global variables
            currentStok = stok;
            currentPointSatuan = pointSatuan;

            // Reset quantity to 1
            document.getElementById('modalQuantityInput').value = 1;
            document.getElementById('modalQuantityInput').max = stok;

            // Update modal content
            document.getElementById('modalImage').src = foto;
            document.getElementById('modalNamaHadiah').textContent = namaHadiah;
            document.getElementById('modalDeskripsi').textContent = deskripsi;
            document.getElementById('modalPointSatuan').textContent = pointSatuan.toLocaleString();

            // Update form values
            document.getElementById('formIdHadiah').value = idHadiah;
            document.getElementById('formPointSatuan').value = pointSatuan;

            // Calculate initial values
            updateModalCalculation();

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('modalPenukaran'));
            modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Scroll ke section tertentu jika ada sweet alert
            @if (session('sweet_alert.scroll_to'))
                const section = document.getElementById('{{ session('sweet_alert.scroll_to') }}');
                if (section) {
                    setTimeout(() => {
                        section.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 100);
                }
            @endif

            // Tampilkan SweetAlert jika ada session
            @if (session('sweet_alert'))
                Swal.fire({
                    icon: '{{ session('sweet_alert.type') }}',
                    title: '{{ session('sweet_alert.title') ?? 'Notifikasi' }}',
                    text: '{{ session('sweet_alert.message') }}',
                    timer: 7500,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    toast: false,
                    position: 'center',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            @endif

            @if (session('sweet_alert.type') === 'success')
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('sweet_alert.title') ?? 'Berhasil!' }}',
                    text: '{{ session('sweet_alert.message') }}',
                    position: 'bottom-start',
                    showConfirmButton: false,
                    timer: 7000,
                    timerProgressBar: true,
                    toast: true,
                    customClass: {
                        popup: 'colored-toast'
                    }
                });
            @endif

            @if (session('success') && !session('sweet_alert'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error') && !session('sweet_alert'))
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak!!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            @endif

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            const hadiahItems = document.querySelectorAll('.hadiah-item');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                hadiahItems.forEach(item => {
                    const itemName = item.dataset.name;
                    const itemDescription = item.dataset.description;

                    if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', performSearch);

            searchForm.addEventListener('submit', function(event) {
                event.preventDefault();
                performSearch();
            });
        });
    </script>
@endpush
