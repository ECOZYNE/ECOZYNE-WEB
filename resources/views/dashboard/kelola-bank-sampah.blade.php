@extends('layouts.dashboard')

@section('title', 'Kelola Bank Sampah')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Kelola Bank Sampah</h5>

                <hr>

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
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

                {{-- Update Form --}}
                <form method="POST" action="{{ route('kelola-bank-sampah.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_bank_sampah" class="form-label">Nama Bank Sampah </label>
                                <input type="text" class="form-control" name="nama_bank_sampah" id="nama_bank_sampah"
                                    placeholder="Masukkan Nama Bank Sampah"
                                    value="{{ old('nama_bank_sampah', $pengajuan->nama_bank_sampah) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="file_dokumen" class="form-label">Surat Permohonan Pembentukan Bank Sampah
                                    (PDF)</label>
                                <input type="file" class="form-control" name="file_dokumen" id="file_dokumen"
                                    accept=".pdf">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah dokumen</small>
                                @if ($pengajuan->file_dokumen)
                                    <div class="mt-2">
                                        <a href="{{ Storage::url($pengajuan->file_dokumen) }}" target="_blank"
                                            class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-file-pdf"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Jam Operasional -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Jam Operasional</label>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jam Buka</th>
                                            <th>Jam Tutup</th>
                                            <th>Tutup?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                            @php
                                                $jamData = $jamOperasional->get($hari);
                                                $isTutup = $jamData ? $jamData->is_tutup : 0;
                                                $jamBuka = $jamData ? $jamData->jam_buka : '';
                                                $jamTutup = $jamData ? $jamData->jam_tutup : '';
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $hari }}</td>
                                                <td>
                                                    <input type="time" name="jam_buka[{{ $hari }}]"
                                                        class="form-control jam-input"
                                                        value="{{ old('jam_buka.' . $hari, $jamBuka) }}"
                                                        {{ $isTutup ? 'disabled' : '' }}>
                                                </td>
                                                <td>
                                                    <input type="time" name="jam_tutup[{{ $hari }}]"
                                                        class="form-control jam-input"
                                                        value="{{ old('jam_tutup.' . $hari, $jamTutup) }}"
                                                        {{ $isTutup ? 'disabled' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="is_tutup[{{ $hari }}]"
                                                        class="tutup-checkbox" value="1"
                                                        {{ old('is_tutup.' . $hari, $isTutup) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="lokasi_bank_sampah" class="form-label">Alamat Lokasi Bank Sampah </label>
                            <textarea class="form-control" name="lokasi_bank_sampah" id="lokasi_bank_sampah" rows="3"
                                placeholder="Alamat akan terisi otomatis setelah memilih lokasi di peta" readonly required>{{ old('lokasi_bank_sampah', $pengajuan->lokasi_bank_sampah) }}</textarea>
                            <small class="form-text text-muted">Geser marker di peta untuk menentukan lokasi bank
                                sampah</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" name="latitude" id="latitude"
                                placeholder="Latitude akan terisi otomatis"
                                value="{{ old('latitude', $pengajuan->latitude) }}" readonly required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="longitude" class="form-label">Longitude </label>
                            <input type="text" class="form-control" name="longitude" id="longitude"
                                placeholder="Longitude akan terisi otomatis"
                                value="{{ old('longitude', $pengajuan->longitude) }}" readonly required>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pilih Lokasi Bank Sampah di Peta </label>
                                <div id="map"
                                    style="height: 400px; width: 100%; border: 1px solid #ddd; border-radius: 5px;">
                                </div>
                                <small class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle"></i> Klik dan geser marker untuk menentukan lokasi
                                    bank sampah.
                                    Koordinat dan alamat akan terisi otomatis.
                                </small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-4 rounded-2">
                            <i class="fas fa-save"></i> Update Data Bank Sampah
                        </button>
                    </div>
                </form>

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
            south: 0.45,
            east: 104.32,
            west: 103.8
        };

        let map, marker;

        function initMap() {
            // Ambil koordinat dari database atau default
            const savedLat = {{ $pengajuan->latitude ?? '1.1304' }};
            const savedLng = {{ $pengajuan->longitude ?? '104.0528' }};
            const initialLocation = [savedLat, savedLng];

            map = L.map('map').setView(initialLocation, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            const batamBounds = L.latLngBounds(
                [BATAM_BOUNDS.south, BATAM_BOUNDS.west],
                [BATAM_BOUNDS.north, BATAM_BOUNDS.east]
            );

            map.setMaxBounds(batamBounds);

            marker = L.marker(initialLocation, {
                draggable: true,
                title: "Geser marker ini untuk menentukan lokasi bank sampah"
            }).addTo(map);

            marker.on('dragend', function(e) {
                const loc = [e.target.getLatLng().lat, e.target.getLatLng().lng];
                if (isWithinBatamBounds(loc)) {
                    updateLocationInfo(loc);
                } else {
                    marker.setLatLng(getValidBatamPosition(loc));
                    showBoundsWarning();
                }
            });

            map.on('click', function(e) {
                const loc = [e.latlng.lat, e.latlng.lng];
                if (isWithinBatamBounds(loc)) {
                    marker.setLatLng(loc);
                    updateLocationInfo(loc);
                } else {
                    showBoundsWarning();
                }
            });
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
                    document.getElementById('lokasi_bank_sampah').value = data.display_name ||
                        `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                })
                .catch(() => {
                    document.getElementById('lokasi_bank_sampah').value =
                        `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap();

            // Handle checkbox "Tutup?" untuk disable/enable input jam
            const checkboxes = document.querySelectorAll('.tutup-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const jamInputs = row.querySelectorAll('.jam-input');

                    jamInputs.forEach(input => {
                        if (this.checked) {
                            input.value = '';
                            input.disabled = true;
                        } else {
                            input.disabled = false;
                        }
                    });
                });
            });

            // Form validation
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
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
                            text: 'Lokasi bank sampah harus berada dalam wilayah Batam!',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }

                    // Validasi jam operasional
                    let hasError = false;
                    const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                    hariList.forEach(hari => {
                        const checkbox = document.querySelector(`input[name="is_tutup[${hari}]"]`);
                        const isTutup = checkbox ? checkbox.checked : false;
                        const jamBuka = document.querySelector(`input[name="jam_buka[${hari}]"]`)
                            .value;
                        const jamTutup = document.querySelector(`input[name="jam_tutup[${hari}]"]`)
                            .value;

                        if (!isTutup && (!jamBuka || !jamTutup)) {
                            hasError = true;
                        }
                    });

                    if (hasError) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Jam Operasional Belum Lengkap!',
                            text: 'Silakan lengkapi jam operasional atau centang "Tutup?" untuk hari libur.',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }
                });
            }
        });
    </script>
@endpush
