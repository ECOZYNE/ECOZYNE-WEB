@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-kegiatan.css') }}" />
@endpush

@section('title', 'Data Kegiatan')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Data Kegiatan</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchKegiatanInput" class="form-control" placeholder="Cari Kegiatan...">
            </div>
            <hr>

            <div class="row" id="kegiatanContainer">
                @foreach($kegiatans as $kegiatan)
                    <div class="col-sm-6 col-xl-3 mt-4 kegiatan-card">
                        <div class="card overflow-hidden rounded-2 h-100">
                            <div class="position-relative">
                                <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}"
                                    class="card-img-top rounded-0 img-fluid kegiatan-img" alt="{{ $kegiatan->judul }}">
                            </div>
                            <div class="card-body pt-3 p-4 d-flex flex-column">
                                <h6 class="fw-semibold fs-4 kegiatan-title">{{ $kegiatan->judul }}</h6>
                                <p class="text-muted kegiatan-teks">{{ $kegiatan->isi }}</p>
                                <p class="text-muted kegiatan-lokasi">Lokasi: {{ $kegiatan->lokasi }}</p>
                                <p class="text-muted kegiatan-tanggal_kegiatan">Waktu:
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y H:i') }}
                                </p>

                                <div class="d-flex gap-2 mt-auto">
                                    <a href="javascript:void(0);" class="btn btn-warning w-50 edit-kegiatan-btn"
                                        data-id="{{ $kegiatan->id_kegiatan }}" data-judul="{{ $kegiatan->judul }}"
                                        data-lokasi="{{ $kegiatan->lokasi }}"
                                        data-tanggal_kegiatan="{{ $kegiatan->tanggal_kegiatan }}"
                                        data-isi="{{ $kegiatan->isi }}" data-kouta="{{ $kegiatan->kouta }}"
                                        data-foto="{{ $kegiatan->foto }}"
                                        data-url="{{ route('kegiatan.update', $kegiatan->id_kegiatan) }}">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('kegiatan.destroy', $kegiatan->id_kegiatan) }}" method="POST"
                                        class="w-50" onsubmit="return confirm('Yakin mau hapus kegiatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="modal fade" id="editKegiatanModal" tabindex="-1" aria-labelledby="editKegiatanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="editKegiatanForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKegiatanModalLabel">Edit Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_kegiatan" id="edit-id-kegiatan">

                        <div class="mb-3">
                            <label for="edit-judul" class="form-label">Judul Kegiatan</label>
                            <input type="text" name="judul" id="edit-judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-tanggal_kegiatan" class="form-label">Waktu Kegiatan</label>
                            <input type="datetime-local" name="tanggal_kegiatan" id="edit-tanggal_kegiatan"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-lokasi" class="form-label">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi" id="edit-lokasi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-kouta" class="form-label">Kouta Kegiatan</label>
                            <input type="number" name="kouta" id="edit-kouta" class="form-control" required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Foto Kegiatan</label>
                            <div id="currentKegiatanImageContainer" style="display:none;">
                                <img id="currentKegiatanImage" src="" alt="Gambar Kegiatan" class="img-fluid"
                                    style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
                            </div>
                            <input type="file" name="foto" id="edit-foto" class="form-control" accept=".jpg, .jpeg, .png">
                        </div>

                        <div class="mb-3">
                            <label for="edit-isi" class="form-label">Deksripsi Kegiatan</label>
                            <textarea name="isi" id="edit-isi" class="form-control" rows="4" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Function to get current date and time in YYYY-MM-DDTHH:MM format
            function getCurrentDateTimeLocal() {
                const now = new Date();
                now.setMinutes(now.getMinutes() - now.getTimezoneOffset()); // Adjust for timezone
                return now.toISOString().slice(0, 16);
            }

            // Set min attribute for datetime-local input on page load
            $('#edit-tanggal_kegiatan').attr('min', getCurrentDateTimeLocal());

            // Handle klik tombol edit kegiatan
            $('.edit-kegiatan-btn').click(function () {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let isi = $(this).data('isi');
                let lokasi = $(this).data('lokasi');
                let kouta = $(this).data('kouta');
                let tanggal_kegiatan = $(this).data('tanggal_kegiatan');
                let foto = $(this).data('foto');
                let url = $(this).data('url');

                $('#edit-id-kegiatan').val(id);
                $('#edit-judul').val(judul);
                $('#edit-isi').val(isi);
                $('#edit-lokasi').val(lokasi);
                $('#edit-kouta').val(kouta);

                // Set the min attribute when the modal is opened
                const currentDateTimeLocal = getCurrentDateTimeLocal();
                $('#edit-tanggal_kegiatan').attr('min', currentDateTimeLocal);

                // Check if the existing date is in the past, if so, set to current time
                const existingDateTime = new Date(tanggal_kegiatan);
                const minDateTime = new Date(currentDateTimeLocal);

                if (existingDateTime < minDateTime) {
                    $('#edit-tanggal_kegiatan').val(currentDateTimeLocal);
                } else {
                    $('#edit-tanggal_kegiatan').val(new Date(tanggal_kegiatan).toISOString().slice(0, 16));
                }

                $('#editKegiatanForm').attr('action', url);

                if (foto) {
                    $('#currentKegiatanImage').attr('src', '/storage/kegiatan/' + foto);
                    $('#currentKegiatanImageContainer').show();
                } else {
                    $('#currentKegiatanImageContainer').hide();
                }

                $('#editKegiatanModal').modal('show');
            });

            // Fungsi cari kegiatan
            $('#searchKegiatanInput').on('input', function () {
                let input = $(this).val().toLowerCase();
                $('.kegiatan-card').each(function () {
                    let title = $(this).find('.kegiatan-title').text().toLowerCase();
                    let lokasi = $(this).find('.kegiatan-lokasi').text().toLowerCase();
                    if (title.includes(input) || lokasi.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endpush