@extends('layouts.dashboard')

@push('style')
    {{-- Tambahkan style khusus di sini jika diperlukan --}}
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
                <h5 class="card-title mb-4 fw-semibold">Point Anda</h5>
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

        <!-- Point Masuk dan Keluar -->
        <div class="row">
            <!-- Point Masuk -->
            <div class="col-md-6 mb-4">
                 <div class="card h-100 border-start border-4 rounded-lg shadow-sm" style="border-left-color: #63c13b !important;">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-3">Point Masuk</h6>
                        <hr>
                        <ul class="list-unstyled">
                            @forelse ($pointMasuk as $masuk)
                                <li class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="fw-semibold">{{ $masuk->point_didapat }} XP</div>
                                            <small class="text-muted">{{ $masuk->created_at->format('d M Y H:i') }}</small><br>
                                            <small class="text-muted">
                                                Dari Bank Sampah:
                                                {{ $masuk->bank_sampah_penerima->pengajuanBankSampah->nama_bank_sampah ?? '-' }}
                                             <i class="bi bi-patch-check-fill" style="color: #63c13b; font-size: 1.6rem; margin-left: 0.5rem;"></i>
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
                        <h6 class="card-title fw-semibold mb-3">Point Keluar</h6>
                        <hr>
                        <ul class="list-unstyled">
                            <li>
                                <p class="text-muted">Tidak ada point keluar.</p>
                            </li>
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
            const nama = @json(Auth::user()?->name ?? 'Pengguna');
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
            const timeStr = jakartaTime.toLocaleTimeString('id-ID', {
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