@extends('layouts.index-menu')

@section('title', 'Ecozyne | Bank Sampah')

@section('content')
<div class="page-title mt-5">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Bank Sampah</h1>
                    <p class="mb-0">Ayo salurkan sampah organik anda ke bank sampah terdekat, Anda telah menyelamatkan bumi!</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li class="current">Bank Sampah</li>
            </ol>
        </div>
    </nav>
</div>

<div class="container">
    <div class="card shadow-sm mb-4 mt-4">
        <div class="card-header p-3" data-bs-toggle="collapse" data-bs-target="#filterData" style="cursor:pointer;">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-primary"><i class="bi bi-funnel-fill me-2"></i> Filter data</span>
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>

        <div class="collapse" id="filterData">
            <div class="card-body">
                <form id="filterForm">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="namaBankInput" placeholder="Masukkan nama atau lokasi Bank Sampah...">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-info me-2" id="resetFilter">
                            <i class="bi bi-arrow-clockwise"></i> Bersihkan
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                        <button type="button" class="btn btn-outline-success ms-2" id="btnNearest">
                            <i class="bi bi-geo-alt"></i> Terdekat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h2 class="text-center mt-4 mb-3">Bank Sampah adalah mitra kami untuk gerakan Zero Waste menuju lingkungan bersih dan berkelanjutan.</h2>
    <p class="text-center text-muted mb-4">Temukan Bank Sampah terdekat!</p>

     <div id="radiusInfo" class="alert alert-success mt-3 text-center" style="display: none;">
        <i class="bi bi-geo-alt-fill me-2"></i> Menampilkan Bank Sampah dalam radius 10 km dari lokasi Anda.
    </div>

    <div class="no-results" id="noResults" style="display: none;">
        <div class="alert alert-info mt-3">
            <i class="bi bi-info-circle me-2"></i> Tidak ada Bank Sampah yang sesuai dengan kriteria pencarian Anda.
        </div>
    </div>

    <div class="row g-4" id="bankSampahList">
        @forelse ($bankSampahs as $bankSampah)
        <div class="col-md-6 col-lg-3"
            data-nama="{{ strtolower($bankSampah->pengajuanBankSampah->nama_bank_sampah ?? '') }}"
            data-lokasi="{{ strtolower($bankSampah->pengajuanBankSampah->lokasi_bank_sampah ?? '') }}"
            data-lat="{{ $bankSampah->pengajuanBankSampah->latitude }}"
            data-lng="{{ $bankSampah->pengajuanBankSampah->longitude }}">
            <a href="{{ route('bank_sampah.show', $bankSampah->id_bank_sampah) }}" class="text-decoration-none">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
                        <h5 class="card-title text-dark">{{ $bankSampah->pengajuanBankSampah->nama_bank_sampah ?? 'Nama Tidak Tersedia' }}</h5>
                        <p class="text-muted small">{{ $bankSampah->pengajuanBankSampah->lokasi_bank_sampah ?? 'Alamat tidak tersedia' }}</p>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i> Belum ada Bank Sampah yang terdaftar saat ini.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const namaInput = document.getElementById('namaBankInput');
    const form = document.getElementById('filterForm');
    const cards = document.querySelectorAll('#bankSampahList .col-md-6');
    const noResults = document.getElementById('noResults');
    const radiusInfo = document.getElementById('radiusInfo');
    const btnNearest = document.getElementById('btnNearest');
    const container = document.getElementById('bankSampahList');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const keyword = namaInput.value.toLowerCase().trim();
        let found = false;

        cards.forEach(card => {
            const nama = card.dataset.nama;
            const lokasi = card.dataset.lokasi;
            const match = nama.includes(keyword) || lokasi.includes(keyword);
            card.style.display = match ? 'block' : 'none';
            if (match) found = true;
        });

        noResults.style.display = found ? 'none' : 'block';
        radiusInfo.style.display = 'none'; // Sembunyikan alert radius saat filter manual
    });

    document.getElementById('resetFilter').addEventListener('click', () => {
        namaInput.value = '';
        cards.forEach(card => card.style.display = 'block');
        noResults.style.display = 'none';
        radiusInfo.style.display = 'none';
    });

    // Tombol untuk mencari Bank Sampah terdekat dengan radius 10km
    btnNearest.addEventListener('click', function () {
        if (!navigator.geolocation) {
            alert('Geolocation tidak didukung oleh browser Anda.');
            return;
        }

        navigator.geolocation.getCurrentPosition(pos => {
            const userLat = pos.coords.latitude;
            const userLng = pos.coords.longitude;
            const MAX_RADIUS_KM = 10;

            const nearbyCards = Array.from(cards).map(card => {
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                if (isNaN(lat) || isNaN(lng)) return null;

                const distance = getDistance(userLat, userLng, lat, lng);
                return { card, distance };
            }).filter(item => item && item.distance <= MAX_RADIUS_KM);

            // Bersihkan tampilan lama
            container.innerHTML = '';

            if (nearbyCards.length > 0) {
                nearbyCards
                    .sort((a, b) => a.distance - b.distance)
                    .forEach(({ card }) => container.appendChild(card));
                noResults.style.display = 'none';
                radiusInfo.style.display = 'block';
            } else {
                noResults.style.display = 'block';
                radiusInfo.style.display = 'none';
            }

        }, () => {
            alert('Gagal mendapatkan lokasi Anda.');
        });
    });

    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam kilometer
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) ** 2 +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon / 2) ** 2;
        return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
    }
});
</script>
@endpush
