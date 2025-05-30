@extends('layouts.dashboard')

@section('title', 'Tambah Hadiah')

@section('content')
  <div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Hadiah</h5>
    <hr>
    <!-- Formulir Pendaftaran -->
    <form method="POST" action="{{ route('hadiah.post') }}" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid">
      <div class="row">

        <div class="col-md-6 mb-3">
        <label for="nama_hadiah" class="form-label">Nama Hadiah</label>
        <input type="text" class="form-control" name="nama_hadiah" id="nama_hadiah"
          placeholder="Masukkan Nama Hadiah" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" name="foto" id="foto" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="poin_satuan" class="form-label">Poin Per Item</label>
        <input type="number" class="form-control" name="poin_satuan" id="poin_satuan"
          placeholder="Masukkan Poin Per Item" required>
        </div>

        <div class="col-md-12 mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Masukkan Deskripsi"
          required></textarea>
        </div>

      </div>
      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Buat Hadiah</button>
      </div>
    </form>

    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if (session('success'))
      Swal.fire({
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    @endif
  </script>
@endpush
