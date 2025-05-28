@extends('layouts.dashboard')

@push('style')
    
@endpush

@section('title', 'Dahboard Pengguna')

@section('content')
<div class="col-lg-12">
    <!-- Greeting -->
    <div class="card mb-4">
        <div class="card-body p-4">
            <h4 id="greetingText" class="fw-bold mb-2"></h4>
            <p class="text-muted mb-0">Waktu saat ini: <span id="currentTime" class="fw-semibold"></span> WIB</p>
        </div>
    </div>

    <!-- Point Komunitas -->
    <div class="card overflow-hidden mb-4">
        <div class="card-body p-4">
            <h5 class="card-title mb-4 fw-semibold">Point Anda</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3">0 XP</h4>
                    <p class="text-muted mt-2 mb-0 fs-4">Masa Berlaku: 07 Mei 2026</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Point Masuk dan Keluar -->
    <div class="row">
        <!-- Point Masuk -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-start border-success border-4">
                <div class="card-body">
                    <h6 class="card-title fw-semibold mb-3">Point Masuk</h6>
                    <hr>
                    <ul></ul>
                </div>
            </div>
        </div>

        <!-- Point Keluar -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-start border-danger border-4">
                <div class="card-body">
                    <h6 class="card-title fw-semibold mb-3">Point Keluar</h6>
                    <hr>
                    <ul>
                        <li>
                            <span class="fw-semibold">06 Mei 2025</span>: <span class="text-danger">-100 XP</span> - 
                            <span class="text-muted">Tukar minyak 5 Liter</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

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

    updateGreeting();
    updateClock();
    setInterval(updateClock, 1000);
</script>

@endsection


