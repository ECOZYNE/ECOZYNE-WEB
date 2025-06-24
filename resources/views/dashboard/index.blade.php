@extends('layouts.dashboard')

@push('style')
    <style>
        .icon-float {
            animation: floatUpDown 1.5s ease-in-out infinite;
        }

        @keyframes floatUpDown {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('title', 'Dashboard Pengguna')

@section('content')
    <div class="col-lg-12">
        <!-- Greeting -->
        <div class="card mb-4 rounded-lg shadow-sm">
            <div class="card-body p-4">
                <h4 id="greetingText" class="fw-bold mb-2"></h4>
                <p class="text-muted mb-0">Waktu saat ini: <span id="currentTime" class="fw-semibold"></span> WIB</p>
            </div>
        </div>

        <!-- Point Komunitas -->
        <div class="card overflow-hidden mb-4 rounded-lg shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4 fw-semibold">
                    Point Anda
                    <button type="button" class="btn btn-link p-0 m-0 align-baseline" data-bs-toggle="modal"
                        data-bs-target="#infoModal">
                        <i class="bi bi-info-circle-fill fs-5 ms-1"></i>
                    </button>
                </h5>

                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="fw-semibold mb-3">{{ $totalPoints }} XP</h4>
                        <p class="text-muted mt-2 mb-0 fs-4">
                            Masa Berlaku: <span class="fw-semibold">{{ $expirationDate }}</span>
                        </p>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fa-solid fa-star text-warning" style="font-size: 3.2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Info -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-lg shadow-lg border-0">
                    <div class="modal-header bg-light border-bottom-0">
                        <h5 class="modal-title fw-semibold text-dark" id="infoModalLabel">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>Informasi Poin
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-dark fs-6">
                        <ol class="mb-0 ps-4">
                            <li>Anda harus menyetor sampah organik ke bank sampah untuk mendapatkan poin.</li>
                            <div class="mt-1">
                                <a href="{{ url('/bank_sampah') }}" class="btn btn-sm btn-outline-info rounded-pill">
                                    <i class="bi bi-search me-1"></i> Cari Bank Sampah?
                                </a>
                            </div>
                            <hr>
                            <li>
                                Setiap <strong>1 kg</strong> sampah bernilai <strong>10 poin</strong>.
                                <br><i>(Setara dengan 100 gram = 1 poin)</i>
                                <br><i class="text-danger small">* Bank sampah akan menilai berat sampah yang Anda setorkan
                                    di lokasi.</i>
                            </li>
                            <hr>
                            <li>Poin dapat ditukarkan dengan hadiah jika:
                                <ul class="mb-0">
                                    <li>- Poin Anda mencukupi.</li>
                                    <li>- Stok hadiah masih tersedia.</li>
                                    <li>- telah dikonfirmasi oleh admin</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <!-- Point Masuk dan Keluar -->
        <div class="row">
            <!-- Point Masuk -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-start border-4 rounded-lg shadow-sm"
                    style="border-left-color: #63c13b !important;">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-3">
                            <i class="fa-solid fa-arrow-down me-2 icon-float" style="color: #63c13b;"></i>Point Masuk
                        </h6>
                        <hr>
                        <ul class="list-unstyled">
                            @forelse ($pointMasuk as $masuk)
                                <li class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="fw-semibold" style="color: #63c13b;">+{{ $masuk->point_didapat }} XP
                                            </div>
                                            <small class="text-muted">{{ $masuk->created_at->format('d M Y H:i') }}</small><br>
                                            <small class="text-muted">
                                                Dari Bank Sampah:
                                                {{ $masuk->bank_sampah_penerima->pengajuanBankSampah->nama_bank_sampah ?? '-' }}
                                                <i class="bi bi-patch-check-fill"
                                                    style="color: #63c13b; font-size: 1.6rem; margin-left: 0.5rem;"></i>
                                            </small>
                                            <hr>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li>
                                    <p class="text-muted">Tidak ada point masuk.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Point Keluar -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-start border-danger border-4 rounded-lg shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-3">
                            <i class="fa-solid fa-arrow-up me-2 text-danger me-2 icon-float"></i>Point Keluar
                        </h6>
                        <hr>
                        <ul class="list-unstyled">
                            @forelse ($pointKeluar as $keluar)
                                <li class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="fw-semibold text-danger">-{{ $keluar->total_point_keluar }} XP</div>
                                            <small class="text-muted">{{ $keluar->created_at->format('d M Y H:i') }}</small><br>
                                            <small class="text-muted">
                                                Penukaran Hadiah:
                                                @foreach($keluar->transaksi as $transaksi)
                                                    {{ $transaksi->hadiah->nama_hadiah ?? '-' }}
                                                    ({{ $transaksi->jumlah }}x)
                                                    @if(!$loop->last), @endif
                                                @endforeach
                                                <i class="bi bi-gift-fill"
                                                    style="color: #dc3545; font-size: 1.6rem; margin-left: 0.5rem;"></i>
                                            </small>
                                            <hr>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li>
                                    <p class="text-muted">Tidak ada point keluar.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function updateGreeting() {
            const nama = @json(Auth::user()?->username ?? 'Pengguna');
            const now = new Date();
            const jakartaTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
            const hours = jakartaTime.getHours();

            let greeting = "";
            if (hours >= 5 && hours < 12) {
                greeting = "Selamat pagi, " + nama + "!";
            } else if (hours >= 12 && hours < 15) {
                greeting = "Selamat siang, " + nama + "!";
            } else if (hours >= 15 && hours < 18) {
                greeting = "Selamat sore, " + nama + "!";
            } else {
                greeting = "Selamat malam, " + nama + "!";
            }

            document.getElementById("greetingText").textContent = greeting;
        }

 function updateClock() {
    const now = new Date();
    const jakartaTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
    const timeStr = jakartaTime.toLocaleTimeString('en-GB', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById("currentTime").textContent = timeStr;
}


        document.addEventListener('DOMContentLoaded', () => {
            updateGreeting();
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
@endpush