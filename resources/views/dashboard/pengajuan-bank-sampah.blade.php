@extends('layouts.dashboard')

@section('title', 'Pengajuan Bank Sampah')

@section('content')
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

@endsection