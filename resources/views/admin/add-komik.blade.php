@extends('layouts.dashboard')

@section('title', 'Tambah Komik')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Komik</h5>

            <hr>

            <!-- Formulir tambah komik -->
            <form method="POST" action="{{ route('komik.post') }}" enctype="multipart/form-data" id="formKomik">
                @csrf
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="judul" class="form-label">
                                Judul <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                                id="judul" placeholder="Masukkan Judul Komik" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="penulis" class="form-label">
                                Penulis <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis"
                                id="penulis" placeholder="Masukkan Nama Penulis" value="{{ old('penulis') }}" required>
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cover" class="form-label">
                                Cover Komik <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover"
                                id="cover" accept=".jpg,.jpeg,.png" required>
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 5MB</small>
                            @error('cover')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!-- Preview Cover -->
                            <div id="coverPreview" class="mt-2" style="display:none;">
                                <img id="coverImage" src="" alt="Preview Cover" class="img-thumbnail"
                                    style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="file_pdf" class="form-label">
                                File PDF <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('file_pdf') is-invalid @enderror" name="file_pdf"
                                id="file_pdf" accept=".pdf" required>
                            <small class="text-muted">Maksimal 100MB. Jumlah halaman akan otomatis terhitung.</small>
                            @error('file_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jml_halaman" class="form-label">
                                Jumlah Halaman <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control @error('jml_halaman') is-invalid @enderror"
                                name="jml_halaman" id="jml_halaman" placeholder="Masukkan jumlah halaman"
                                value="{{ old('jml_halaman') }}" min="1" required>
                            @error('jml_halaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">
                        Upload Komik
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("formKomik");
            const coverInput = document.getElementById("cover");
            const coverPreview = document.getElementById("coverPreview");
            const coverImage = document.getElementById("coverImage");

            // Preview cover saat file dipilih
            coverInput.addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        coverImage.src = e.target.result;
                        coverPreview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                } else {
                    coverPreview.style.display = "none";
                }
            });

            form.addEventListener("submit", function (event) {
                event.preventDefault();

                // Validasi cover size
                const coverFile = coverInput.files[0];
                if (coverFile) {
                    const coverSize = coverFile.size / 1024 / 1024; // dalam MB
                    if (coverSize > 5) {
                        Swal.fire({
                            title: "Cover Terlalu Besar!",
                            text: "Ukuran cover maksimal 5MB",
                            icon: "warning",
                            confirmButtonText: "OK"
                        });
                        return;
                    }
                }

                // Validasi PDF size
                const fileInput = document.getElementById("file_pdf");
                if (fileInput.files.length > 0) {
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // dalam MB
                    if (fileSize > 100) {
                        Swal.fire({
                            title: "File PDF Terlalu Besar!",
                            text: "Ukuran file maksimal 100MB",
                            icon: "warning",
                            confirmButtonText: "OK"
                        });
                        return;
                    }
                }

                // Show loading
                Swal.fire({
                    title: 'Mengupload...',
                    html: 'Mohon tunggu, sistem sedang menghitung jumlah halaman...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let formData = new FormData(this);
                let actionUrl = this.getAttribute("action");

                fetch(actionUrl, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Accept": "application/json"
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => Promise.reject(err));
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: data.message || "Komik berhasil ditambahkan!",
                                icon: "success",
                                timer: 2500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "{{ route('komik.index') }}";
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: data.message || "Terjadi kesalahan saat menambahkan komik.",
                                icon: "error",
                                confirmButtonText: "Coba Lagi"
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        let errorMessage = "Terjadi kesalahan pada server.";

                        if (error.message) {
                            errorMessage = error.message;
                        } else if (error.errors) {
                            // Validasi error dari Laravel
                            errorMessage = Object.values(error.errors).flat().join("\n");
                        }

                        Swal.fire({
                            title: "Error!",
                            text: errorMessage,
                            icon: "error",
                            confirmButtonText: "Coba Lagi"
                        });
                    });
            });
        });
    </script>
@endsection