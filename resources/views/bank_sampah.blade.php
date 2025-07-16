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
    <!-- Card Filter Data -->
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
                    <!-- Input pencarian nama/lokasi -->
                    <div class="mb-3">
                        <input type="text" class="form-control" id="namaBankInput" placeholder="Masukkan nama atau lokasi Bank Sampah...">
                    </div>
                    
                    <!-- Tombol aksi filter -->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-info me-2" id="resetFilter">
                            <i class="bi bi-arrow-clockwise"></i> Bersihkan
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                        
                        <!-- Dropdown untuk filter berdasarkan jarak -->
                        <div class="btn-group ms-2">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="bi bi-geo-alt"></i> Terdekat
                            </button>
                            <div class="dropdown-menu p-3" style="width: 300px;">
                                <!-- Kontrol radius pencarian -->
                                <div class="mb-3">
                                    <label for="radiusInput" class="form-label">Radius: <span id="radiusValue">5</span> km</label>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-sm btn-secondary me-2" id="decreaseRadius">-</button>
                                        <input type="range" class="form-range" min="1" max="10" id="radiusInput" value="5">
                                        <button type="button" class="btn btn-sm btn-secondary ms-2" id="increaseRadius">+</button>
                                    </div>
                                </div>
                                
                                <!-- Tombol untuk mencari bank sampah terdekat -->
                                <button type="button" class="btn btn-success w-100" id="btnNearest">
                                    <i class="bi bi-search"></i> Cari Terdekat
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Heading dan deskripsi -->
    <h2 class="text-center mt-4 mb-3">Bank Sampah adalah mitra kami untuk gerakan Zero Waste menuju lingkungan bersih dan berkelanjutan.</h2>
    <p class="text-center text-muted mb-4">Temukan Bank Sampah terdekat!</p>

    <!-- Informasi status lokasi user -->
    <div id="locationStatus" class="alert alert-info mt-3 text-center" style="display: none;">
        <i class="bi bi-geo-alt-fill me-2"></i> <span id="locationStatusText"></span>
    </div>

    <!-- Informasi radius pencarian -->
    <div id="radiusInfo" class="alert alert-success mt-3 text-center" style="display: none;">
    </div>

    <!-- Pesan jika tidak ada hasil -->
    <div class="no-results" id="noResults" style="display: none;">
        <div class="alert alert-info mt-3">
            <i class="bi bi-info-circle me-2"></i> Tidak ada Bank Sampah yang sesuai dengan kriteria pencarian Anda.
        </div>
    </div>

    <!-- Daftar Bank Sampah -->
    <div class="row g-4 mb-5" id="bankSampahList">
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
                        <!-- Tampilkan jarak jika tersedia -->
                        <p class="text-success small distance-info" style="display: none;"></p>
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
    // === INISIALISASI ELEMEN DOM ===
    const namaInput = document.getElementById('namaBankInput');
    const form = document.getElementById('filterForm');
    const allCards = document.querySelectorAll('#bankSampahList .col-md-6');
    const noResults = document.getElementById('noResults');
    const radiusInfo = document.getElementById('radiusInfo');
    const container = document.getElementById('bankSampahList');
    const locationStatus = document.getElementById('locationStatus');
    const locationStatusText = document.getElementById('locationStatusText');

    // Element untuk kontrol radius pencarian
    const btnNearest = document.getElementById('btnNearest');
    const radiusInput = document.getElementById('radiusInput');
    const radiusValueSpan = document.getElementById('radiusValue');
    const decreaseRadiusBtn = document.getElementById('decreaseRadius');
    const increaseRadiusBtn = document.getElementById('increaseRadius');

    // === VARIABEL GLOBAL ===
    let userLocation = null; // Menyimpan koordinat lokasi user
    let isGettingLocation = false; // Flag untuk mencegah multiple request lokasi

    
    /**
     * Menghitung jarak antara dua koordinat menggunakan formula Haversine
     * @param {number} lat1 - Latitude titik pertama
     * @param {number} lon1 - Longitude titik pertama
     * @param {number} lat2 - Latitude titik kedua
     * @param {number} lon2 - Longitude titik kedua
     * @returns {number} Jarak dalam kilometer
     */
    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam kilometer
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) ** 2 +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon / 2) ** 2;
        return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
    }

    /**
     * Memformat jarak untuk ditampilkan
     * @param {number} distance - Jarak dalam kilometer
     * @returns {string} Jarak yang sudah diformat
     */
    function formatDistance(distance) {
        if (distance < 1) {
            return `${Math.round(distance * 1000)} meter`;
        }
        return `${distance.toFixed(1)} km`;
    }

    /**
     * Menampilkan status lokasi kepada user
     * @param {string} message - Pesan status
     * @param {string} type - Tipe alert (info, success, warning, danger)
     */
    function showLocationStatus(message, type = 'info') {
        locationStatusText.textContent = message;
        locationStatus.className = `alert alert-${type} mt-3 text-center`;
        locationStatus.style.display = 'block';
        
        // Auto hide setelah 3 detik untuk pesan sukses
        if (type === 'success') {
            setTimeout(() => {
                locationStatus.style.display = 'none';
            }, 3000);
        }
    }

    /**
     * Mendapatkan lokasi saat ini dari browser
     * @returns {Promise} Promise yang resolve dengan koordinat atau reject dengan error
     */
    function getCurrentLocation() {
        return new Promise((resolve, reject) => {
            // Cek apakah browser mendukung geolocation
            if (!navigator.geolocation) {
                reject(new Error('Geolocation tidak didukung oleh browser Anda.'));
                return;
            }

            // Opsi untuk mendapatkan lokasi
            const options = {
                enableHighAccuracy: true,    // Gunakan GPS jika tersedia
                timeout: 5000,              // Timeout 5 detik
                maximumAge: 300000           // Cache lokasi selama 5 menit
            };

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const coords = {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude,
                        accuracy: position.coords.accuracy
                    };
                    resolve(coords);
                },
                (error) => {
                    let errorMessage = 'Gagal mendapatkan lokasi Anda. ';
                    
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage += 'Izin akses lokasi ditolak.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage += 'Informasi lokasi tidak tersedia.';
                            break;
                        case error.TIMEOUT:
                            errorMessage += 'Permintaan lokasi timeout.';
                            break;
                        default:
                            errorMessage += 'Terjadi kesalahan yang tidak diketahui.';
                            break;
                    }
                    
                    reject(new Error(errorMessage));
                },
                options
            );
        });
    }

    // === EVENT LISTENERS ===

    /**
     * Event listener untuk form pencarian berdasarkan nama/lokasi
     */
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const keyword = namaInput.value.toLowerCase().trim();
        let found = false;

        // Sembunyikan informasi radius dan status lokasi
        radiusInfo.style.display = 'none';
        locationStatus.style.display = 'none';

        // Filter bank sampah berdasarkan keyword
        allCards.forEach(card => {
            const nama = card.dataset.nama;
            const lokasi = card.dataset.lokasi;
            const match = nama.includes(keyword) || lokasi.includes(keyword);
            
            card.style.display = match ? 'block' : 'none';
            
            // Sembunyikan informasi jarak saat pencarian teks
            const distanceInfo = card.querySelector('.distance-info');
            if (distanceInfo) {
                distanceInfo.style.display = 'none';
            }
            
            if (match) found = true;
        });

        // Tampilkan pesan jika tidak ada hasil
        noResults.style.display = found ? 'none' : 'block';
    });

    /**
     * Event listener untuk tombol reset filter
     */
    document.getElementById('resetFilter').addEventListener('click', () => {
        namaInput.value = '';
        container.innerHTML = '';
        
        // Kembalikan semua card ke tampilan awal
        allCards.forEach(card => {
            container.appendChild(card);
            card.style.display = 'block';
            
            // Sembunyikan informasi jarak
            const distanceInfo = card.querySelector('.distance-info');
            if (distanceInfo) {
                distanceInfo.style.display = 'none';
            }
        });
        
        // Sembunyikan semua pesan status
        noResults.style.display = 'none';
        radiusInfo.style.display = 'none';
        locationStatus.style.display = 'none';
        
        // Reset lokasi user
        userLocation = null;
    });

    /**
     * Event listener untuk slider radius
     */
    radiusInput.addEventListener('input', (e) => {
        radiusValueSpan.textContent = e.target.value;
    });

    /**
     * Event listener untuk tombol kurangi radius
     */
    decreaseRadiusBtn.addEventListener('click', () => {
        radiusInput.value = Math.max(1, parseInt(radiusInput.value) - 1);
        radiusValueSpan.textContent = radiusInput.value;
    });

    /**
     * Event listener untuk tombol tambah radius
     */
    increaseRadiusBtn.addEventListener('click', () => {
        radiusInput.value = Math.min(10, parseInt(radiusInput.value) + 1);
        radiusValueSpan.textContent = radiusInput.value;
    });

    /**
     * Event listener untuk tombol cari terdekat
     */
    btnNearest.addEventListener('click', async function () {
        // Cegah multiple request
        if (isGettingLocation) {
            showLocationStatus('Sedang mendapatkan lokasi, mohon tunggu...', 'warning');
            return;
        }

        try {
            isGettingLocation = true;
            btnNearest.disabled = true;
            btnNearest.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengambil Lokasi...';
            
            showLocationStatus('Mengambil lokasi Anda', 'info');

            // Dapatkan lokasi user jika belum tersedia
            if (!userLocation) {
                userLocation = await getCurrentLocation();
                showLocationStatus(`Lokasi berhasil didapatkan (akurasi: ${Math.round(userLocation.accuracy)} meter)`, 'success');
            }

            // Ambil radius yang dipilih
            const maxRadiusKm = parseInt(radiusInput.value);
            
            // Hitung jarak setiap bank sampah dari lokasi user
            const nearbyCards = Array.from(allCards).map(card => {
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                
                // Skip jika koordinat tidak valid
                if (isNaN(lat) || isNaN(lng)) return null;

                const distance = getDistance(userLocation.latitude, userLocation.longitude, lat, lng);
                return { card, distance };
            }).filter(item => item && item.distance <= maxRadiusKm);

            // Bersihkan tampilan sebelumnya
            container.innerHTML = '';

            if (nearbyCards.length > 0) {
                // Urutkan berdasarkan jarak terdekat
                nearbyCards
                    .sort((a, b) => a.distance - b.distance)
                    .forEach(({ card, distance }) => {
                        // Tampilkan informasi jarak pada card
                        const distanceInfo = card.querySelector('.distance-info');
                        if (distanceInfo) {
                            distanceInfo.textContent = `📍 ${formatDistance(distance)} dari Anda`;
                            distanceInfo.style.display = 'block';
                        }
                        
                        container.appendChild(card);
                    });

                // Tampilkan informasi radius
                radiusInfo.innerHTML = `<i class="bi bi-geo-alt-fill me-2"></i> Menampilkan ${nearbyCards.length} Bank Sampah dalam radius <strong>${maxRadiusKm} km</strong> dari lokasi Anda, diurutkan berdasarkan jarak terdekat.`;
                radiusInfo.style.display = 'block';
                noResults.style.display = 'none';
            } else {
                // Tidak ada bank sampah dalam radius
                noResults.style.display = 'block';
                radiusInfo.innerHTML = `<i class="bi bi-exclamation-triangle-fill me-2"></i> Tidak ada Bank Sampah dalam radius <strong>${maxRadiusKm} km</strong> dari lokasi Anda. Coba perbesar radius pencarian.`;
                radiusInfo.className = 'alert alert-warning mt-3 text-center';
                radiusInfo.style.display = 'block';
            }

        } catch (error) {
            console.error('Error getting location:', error);
            showLocationStatus(error.message, 'danger');
            
            // Tampilkan semua bank sampah jika gagal mendapatkan lokasi
            container.innerHTML = '';
            allCards.forEach(card => {
                container.appendChild(card);
                card.style.display = 'block';
            });
            
        } finally {
            isGettingLocation = false;
            btnNearest.disabled = false;
            btnNearest.innerHTML = '<i class="bi bi-search"></i> Cari Terdekat';
        }
    });
    
    /**
     * Cek apakah browser mendukung geolocation saat halaman dimuat
     */
    if (!navigator.geolocation) {
        showLocationStatus('Browser Anda tidak mendukung fitur lokasi. Fitur pencarian terdekat tidak tersedia.', 'warning');
        btnNearest.disabled = true;
        btnNearest.innerHTML = '<i class="bi bi-x-circle"></i> Tidak Didukung';
    }
});
</script>
@endpush