<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | buat Pengajuan Bank Sampah</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tambahkan Bootstrap Icons jika belum ada -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>

    <x-loader />

    <x-sidebar-user />

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <x-nav-header-user />

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title fw-semibold mt-4 mb-1">Profil Saya</h5>
                    <p class="text-muted">Pastikan data yang Anda masukkan selalu diperbarui agar kami bisa melayani
                        Anda dengan lebih baik.</p>

                    <hr>

                    <!-- Formulir Pendaftaran -->
                    <form id="pengajuanForm" enctype="multipart/form-data">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- Form Data -->
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Pengguna</label>
                                        <input type="text" class="form-control" value="nabil" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama</label>
                                        <input type="text" class="form-control" value="NabilAditya">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" value="nabiladitya2203@gmail.com">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="number" class="form-control" value="081270080123">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Bank Sampah</label>
                                        <input type="text" class="form-control" value="Bank Sampah Nabil">
                                    </div>

                                    <button type="submit" class="btn btn-danger mt-4">Simpan</button>
                                </div>

                                <!-- Foto Profil -->
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('assets/images/profile/users.png') }}" alt="Foto Profil"
                                        class="rounded-circle mb-3"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                    <div class="mb-2">
                                        <button type="button" class="btn btn-outline-secondary">Pilih Gambar</button>
                                    </div>
                                    <p class="text-muted small">Ukuran gambar: maks. 15 MB<br>Format gambar: .JPG, .JPEG., .PNG
                                    </p>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <script>
        function submitForm() {
            // Lakukan pengecekan form jika diperlukan sebelum redirect
            // Misalnya, jika file atau nama bank sampah belum terisi
            const namaBankSampah = document.getElementById('nama_bank_sampah').value;
            const fileDokumen = document.getElementById('file_dokumen').files.length;

            if (namaBankSampah === '' || fileDokumen === 0) {
                alert('Harap lengkapi form sebelum mengajukan.');
                return;
            }

            // Setelah pengecekan, arahkan ke halaman index-super
            window.location.href = 'index-super'; // Ganti dengan URL yang sesuai
        }
    </script>
</body>

</html>