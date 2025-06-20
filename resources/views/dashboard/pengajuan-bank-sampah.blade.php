@extends('layouts.dashboard')

@section('title', 'Pengajuan Bank Sampah')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Perhatian!</strong>
                <p class="mb-1">Pastikan Anda memenuhi persyaratan berikut sebelum mengajukan permohonan:</p>
                <ul class="mb-2">
                    <li>1. Bank Sampah menerima sampah organik berupa daun dan sayuran, dan limbah dapur rumah tangga lainnya.</li>
                    <li>2. Bank Sampah wajib membuat surat pengajuan dalam bentuk PDF.</li>
                    <li>3. Surat pengajuan harus mencantumkan izin resmi dari kelurahan pada surat.</li>
                    <li>4. Tentukan lokasi bank sampah dengan menggeser marker pada peta.</li>
                    <br>
                    <a href="{{ asset('storage/files/surat_pengajuan_bank_sampah.docx') }}" download>[Format surat pengajuan bank sampah]</a>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Perhatian!</strong> Silakan unggah surat permohonan dalam format PDF. Pastikan nama bank sampah sesuai dengan surat permohonan yang diajukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <h5 class="card-title fw-semibold mt-4 mb-4">Pengajuan Bank Sampah</h5>

            <hr>

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Display Success Messages from session --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Display Error Messages from session --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Conditional Rendering based on application status --}}
            @if ($canSubmitNewApplication)
                {{-- Show rejection note if applicable --}}
                @if ($rejectionNote)
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <h4 class="alert-heading">Pengajuan Anda Sebelumnya Ditolak!</h4>
                        <p>Pengajuan bank sampah Anda sebelumnya telah ditolak dengan catatan dari administrator:</p>
                        <p class="fw-bold">"{{ $rejectionNote }}"</p>
                        <p class="mb-0">Silakan perbaiki dan ajukan kembali permohonan Anda.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Application Form for new submission or re-submission --}}
                <form method="POST" action="{{ route('pengajuan-bank-sampah.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_bank_sampah" class="form-label">Nama Bank Sampah <span class="text-danger">*</label>
                                <input type="text" class="form-control" name="nama_bank_sampah" id="nama_bank_sampah"
                                    placeholder="Masukkan Nama Bank Sampah" value="{{ old('nama_bank_sampah') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="file_dokumen" class="form-label">Surat Permohonan Pembentukan Bank Sampah (PDF) <span class="text-danger">*</label>
                                <input type="file" class="form-control" name="file_dokumen" id="file_dokumen" accept=".pdf" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="lokasi_bank_sampah" class="form-label">Alamat Lokasi Bank Sampah <span class="text-danger">*</label>
                                <textarea class="form-control" name="lokasi_bank_sampah" id="lokasi_bank_sampah" rows="3"
                                    placeholder="Alamat akan terisi otomatis setelah memilih lokasi di peta" readonly required>{{ old('lokasi_bank_sampah') }}</textarea>
                                <small class="form-text text-muted">Geser marker di peta untuk menentukan lokasi bank sampah</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label">Latitude <span class="text-danger">*</label>
                                <input type="text" class="form-control" name="latitude" id="latitude"
                                    placeholder="Latitude akan terisi otomatis" value="{{ old('latitude') }}" readonly required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label">Longitude <span class="text-danger">*</label>
                                <input type="text" class="form-control" name="longitude" id="longitude"
                                    placeholder="Longitude akan terisi otomatis" value="{{ old('longitude') }}" readonly required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pilih Lokasi Bank Sampah di Peta <span class="text-danger">*</label>
                                <div id="map" style="height: 400px; width: 100%; border: 1px solid #ddd; border-radius: 5px;"></div>
                                <small class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle"></i> Klik dan geser marker merah untuk menentukan lokasi bank sampah. 
                                    Koordinat dan alamat akan terisi otomatis.
                                </small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-4 rounded-2">Buat Pengajuan</button>
                    </div>
                </form>
            @else
                {{-- Display existing application status and details --}}
                <div class="alert alert-info mb-4">
                    <h4 class="alert-heading">Status Pengajuan Anda</h4>
                    <p class="mb-1">Anda sudah memiliki pengajuan bank sampah yang sedang **{{ $lastPengajuan->status === 'diproses' ? 'diproses' : 'diterima' }}**.</p>
                    @if ($lastPengajuan->status === 'diproses')
                        <p class="mb-0">Silakan tunggu persetujuan dari administrator.</p>
                    @elseif ($lastPengajuan->status === 'diterima')
                        <p class="mb-0">Selamat! Pengajuan Bank Sampah Anda telah disetujui!</p>
                    @endif
                    @if ($lastPengajuan->catatan)
                        <p class="mt-2 mb-0">Catatan dari administrator: **{{ $lastPengajuan->catatan }}**</p>
                    @endif
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Detail Pengajuan Terakhir</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Nama Bank Sampah:</strong> {{ $lastPengajuan->nama_bank_sampah }}</p>
                                <p class="mb-2"><strong>Status:</strong> <span class="badge bg-{{ $lastPengajuan->status == 'diterima' ? 'success' : ($lastPengajuan->status == 'diproses' ? 'warning' : 'danger') }}">{{ ucfirst($lastPengajuan->status) }}</span></p>
                                @if(isset($lastPengajuan->lokasi_bank_sampah))
                                <p class="mb-2"><strong>Alamat:</strong> {{ $lastPengajuan->lokasi_bank_sampah }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Tanggal Pengajuan:</strong> {{ $lastPengajuan->created_at->format('d M Y H:i') }}</p>
                                @if($lastPengajuan->file_dokumen)
                                <p class="mb-2"><strong>Dokumen:</strong> <a href="{{ Storage::url($lastPengajuan->file_dokumen) }}" target="_blank" class="btn btn-sm btn-info text-white">Lihat Dokumen</a></p>
                                @else
                                <p class="mb-2"><strong>Dokumen:</strong> Tidak ada</p>
                                @endif
                                @if(isset($lastPengajuan->latitude) && isset($lastPengajuan->longitude))
                                <p class="mb-2"><strong>Koordinat:</strong> {{ $lastPengajuan->latitude }}, {{ $lastPengajuan->longitude }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection

@push('style')
    {{-- Load Leaflet CSS and JS (OpenStreetMap!) --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map;
let marker;

function initMap() {
    // Default location (Indonesia - Jakarta)
    const defaultLocation = [-6.2088, 106.8456]; // [lat, lng] format for Leaflet
    
    // Initialize map
    map = L.map('map').setView(defaultLocation, 13);

    // Add OpenStreetMap tile layer (FREE!)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Create draggable marker
    marker = L.marker(defaultLocation, {
        draggable: true,
        title: "Geser marker ini untuk menentukan lokasi bank sampah"
    }).addTo(map);

    // Get user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = [position.coords.latitude, position.coords.longitude];
                map.setView(userLocation, 15);
                marker.setLatLng(userLocation);
                updateLocationInfo(userLocation);
            },
            () => {
                // If geolocation fails, use default location
                updateLocationInfo(defaultLocation);
            }
        );
    } else {
        // Browser doesn't support Geolocation
        updateLocationInfo(defaultLocation);
    }

    // Add event listener for marker drag
    marker.on('dragend', function(e) {
        const position = e.target.getLatLng();
        const location = [position.lat, position.lng];
        updateLocationInfo(location);
    });

    // Add event listener for map click
    map.on('click', function(e) {
        const location = [e.latlng.lat, e.latlng.lng];
        marker.setLatLng(location);
        updateLocationInfo(location);
    });

    // Initialize status map if exists
    @if (!$canSubmitNewApplication && isset($lastPengajuan->latitude) && isset($lastPengajuan->longitude))
    initStatusMap();
    @endif
}

function updateLocationInfo(location) {
    const lat = location[0];
    const lng = location[1];
    
    // Update latitude and longitude inputs
    document.getElementById('latitude').value = lat.toFixed(6);
    document.getElementById('longitude').value = lng.toFixed(6);

    // Get address using Nominatim reverse geocoding (FREE OpenStreetMap service!)
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
        .then(response => response.json())
        .then(data => {
            if (data && data.display_name) {
                document.getElementById('lokasi_bank_sampah').value = data.display_name;
            } else {
                document.getElementById('lokasi_bank_sampah').value = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }
        })
        .catch(error => {
            console.error('Error getting address:', error);
            document.getElementById('lokasi_bank_sampah').value = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        });
}

@if (!$canSubmitNewApplication && isset($lastPengajuan->latitude) && isset($lastPengajuan->longitude))
function initStatusMap() {
    const statusLocation = [
        parseFloat('{{ $lastPengajuan->latitude }}'), 
        parseFloat('{{ $lastPengajuan->longitude }}')
    ];
    
    // Initialize status map
    const statusMap = L.map('statusMap').setView(statusLocation, 15);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(statusMap);

    // Add marker with popup
    const statusMarker = L.marker(statusLocation).addTo(statusMap);
    
    statusMarker.bindPopup(`
        <div style="padding: 10px; min-width: 200px;">
            <h6 style="margin-bottom: 10px;"><strong>{{ $lastPengajuan->nama_bank_sampah }}</strong></h6>
            <p style="margin: 5px 0; font-size: 14px;">{{ $lastPengajuan->lokasi_bank_sampah ?? 'Alamat tidak tersedia' }}</p>
            <small style="color: #666;">Lat: {{ $lastPengajuan->latitude }}, Lng: {{ $lastPengajuan->longitude }}</small>
        </div>
    `).openPopup();
}
@endif

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    
    // Handle form submission validation
    const form = document.querySelector('form[action="{{ route('pengajuan-bank-sampah.store') }}"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            const lokasi = document.getElementById('lokasi_bank_sampah').value;

            if (!latitude || !longitude || !lokasi || lokasi.trim() === '') {
                e.preventDefault();
                alert('Silakan pilih lokasi bank sampah di peta terlebih dahulu!');
                return false;
            }
        });
    }
});
</script>
@endpush