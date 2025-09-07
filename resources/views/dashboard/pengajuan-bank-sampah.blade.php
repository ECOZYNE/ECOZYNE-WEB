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
    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const BATAM_BOUNDS = {
            north: 1.2,
            south: 0.45,       //  ke selatan
            east: 104.32,      //  ke timur
            west: 103.8
        };

        let map, marker;

        function initMap() {
            const defaultLocation = [1.1304, 104.0528]; // Batam Center

            map = L.map('map').setView(defaultLocation, 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            const batamBounds = L.latLngBounds(
                [BATAM_BOUNDS.south, BATAM_BOUNDS.west],
                [BATAM_BOUNDS.north, BATAM_BOUNDS.east]
            );

            map.setMaxBounds(batamBounds);
            map.fitBounds(batamBounds);

            marker = L.marker(defaultLocation, {
                draggable: true,
                title: "Geser marker ini untuk menentukan lokasi bank sampah"
            }).addTo(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const userLocation = [pos.coords.latitude, pos.coords.longitude];
                        if (isWithinBatamBounds(userLocation)) {
                            map.setView(userLocation, 15);
                            marker.setLatLng(userLocation);
                            updateLocationInfo(userLocation);
                        } else {
                            showLocationWarning();
                            updateLocationInfo(defaultLocation);
                        }
                    },
                    () => updateLocationInfo(defaultLocation)
                );
            } else {
                updateLocationInfo(defaultLocation);
            }

            marker.on('dragend', function (e) {
                const loc = [e.target.getLatLng().lat, e.target.getLatLng().lng];
                if (isWithinBatamBounds(loc)) {
                    updateLocationInfo(loc);
                } else {
                    marker.setLatLng(getValidBatamPosition(loc));
                    showBoundsWarning();
                }
            });

            map.on('click', function (e) {
                const loc = [e.latlng.lat, e.latlng.lng];
                if (isWithinBatamBounds(loc)) {
                    marker.setLatLng(loc);
                    updateLocationInfo(loc);
                } else {
                    showBoundsWarning();
                }
            });

            @if (!$canSubmitNewApplication && isset($lastPengajuan->latitude, $lastPengajuan->longitude))
                initStatusMap();
            @endif
        }

        function isWithinBatamBounds([lat, lng]) {
            return (
                lat >= BATAM_BOUNDS.south &&
                lat <= BATAM_BOUNDS.north &&
                lng >= BATAM_BOUNDS.west &&
                lng <= BATAM_BOUNDS.east
            );
        }

        function getValidBatamPosition([lat, lng]) {
            return [
                Math.max(BATAM_BOUNDS.south, Math.min(BATAM_BOUNDS.north, lat)),
                Math.max(BATAM_BOUNDS.west, Math.min(BATAM_BOUNDS.east, lng))
            ];
        }

        function showLocationWarning() {
            Swal.fire({
                icon: 'warning',
                title: 'Lokasi di Luar Batam!',
                text: 'Lokasi Anda berada di luar area Batam. Peta akan menampilkan lokasi default.',
                confirmButtonText: 'OK'
            });
        }

        function showBoundsWarning() {
            Swal.fire({
                icon: 'error',
                title: 'Di Luar Wilayah Batam',
                text: 'Lokasi bank sampah harus berada dalam wilayah Batam. Silakan pilih lokasi yang sesuai!',
                confirmButtonText: 'Mengerti'
            });
        }

        function updateLocationInfo([lat, lng]) {
            if (!isWithinBatamBounds([lat, lng])) return;

            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('lokasi_bank_sampah').value = data.display_name || `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                })
                .catch(() => {
                    document.getElementById('lokasi_bank_sampah').value = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                });
        }

        @if (!$canSubmitNewApplication && isset($lastPengajuan->latitude, $lastPengajuan->longitude))
        function initStatusMap() {
            const statusLoc = [
                parseFloat('{{ $lastPengajuan->latitude }}'),
                parseFloat('{{ $lastPengajuan->longitude }}')
            ];

            const statusMap = L.map('statusMap').setView(statusLoc, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(statusMap);

            L.marker(statusLoc).addTo(statusMap).bindPopup(`
                <div style="padding: 10px; min-width: 200px;">
                    <h6><strong>{{ $lastPengajuan->nama_bank_sampah }}</strong></h6>
                    <p style="font-size: 14px;">{{ $lastPengajuan->lokasi_bank_sampah ?? 'Alamat tidak tersedia' }}</p>
                    <small>Lat: {{ $lastPengajuan->latitude }}, Lng: {{ $lastPengajuan->longitude }}</small>
                </div>
            `).openPopup();
        }
        @endif

        document.addEventListener('DOMContentLoaded', function () {
            initMap();

            const form = document.querySelector('form[action="{{ route('pengajuan-bank-sampah.store') }}"]');
            if (form) {
                form.addEventListener('submit', function (e) {
                    const lat = parseFloat(document.getElementById('latitude').value);
                    const lng = parseFloat(document.getElementById('longitude').value);
                    const lokasi = document.getElementById('lokasi_bank_sampah').value;

                    if (!lat || !lng || !lokasi.trim()) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Lokasi Belum Diisi!',
                            text: 'Silakan pilih lokasi bank sampah di peta terlebih dahulu.',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }

                    if (!isWithinBatamBounds([lat, lng])) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Lokasi Tidak Valid',
                            text: 'Lokasi bank sampah harus berada dalam wilayah Batam. Silakan pilih lokasi yang sesuai!',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }
                });
            }
        });
    </script>
@endpush
