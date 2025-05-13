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

          <!-- Banner Petunjuk -->
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong>
            <p class="mb-1">Pastikan Anda memenuhi persyaratan berikut sebelum mengajukan permohonan:</p>
            <ul class="mb-2">
              <li>1. Bank Sampah menerima sampah organik berupa daun dan sayuran, dan limbah dapur rumah tangga
                lainnya.</li>
              <li>2. Bank Sampah wajib membuat surat pengajuan dalam format PDF.</li>
              <li>3. Surat pengajuan harus mencantumkan izin resmi dari kelurahan pada surat.</li>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>


          <!-- Banner Petunjuk -->
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Silakan unggah surat permohonan dalam format PDF. Pastikan nama bank sampah
            sesuai dengan surat permohonan yang diajukan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          
          <h5 class="card-title fw-semibold mt-4 mb-4">Pengajuan Bank Sampah</h5>
          
          <hr>

          <!-- Formulir Pendaftaran -->
          {{-- <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama_bank_sampah" class="form-label">Nama Bank Sampah</label>
                  <input type="text" class="form-control" name="nama_bank_sampah" id="nama_bank_sampah"
                    placeholder="Masukkan Nama Bank Sampah" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="file_dokumen" class="form-label">Surat Permohonan Pembentukan Bank Sampah</label>
                  <input type="file" class="form-control" name="file_dokumen" id="file_dokumen" accept=".pdf" required>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Buat Pengajuan</button>
            </div>
          </form> --}}


          @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif


@if($sudahMengajukan)
    <div class="alert alert-info">Anda sudah mengajukan permohonan Bank Sampah.</div>
@else
          <form method="POST" action="{{ route('pengajuan-bank-sampah.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama_bank_sampah" class="form-label">Nama Bank Sampah</label>
                  <input type="text" class="form-control" name="nama_bank_sampah" id="nama_bank_sampah"
                    placeholder="Masukkan Nama Bank Sampah" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="file_dokumen" class="form-label">Surat Permohonan Pembentukan Bank Sampah (PDF)</label>
                  <input type="file" class="form-control" name="file_dokumen" id="file_dokumen" accept=".pdf" required>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-4 rounded-2">Buat Pengajuan</button>
            </div>
          </form>
          @endif

        </div>
      </div>
    </div>


    

  </div>
  </div>
  </div>

  </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>