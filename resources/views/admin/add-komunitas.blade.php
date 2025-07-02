@extends('layouts.dashboard')

@section('title', 'Tambah Komunitas')

@section('content')
  <div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Komunitas</h5>
    <hr>
    <!-- Formulir Pendaftaran -->
    <form method="POST" action="{{ route('register.byAdmin') }}">
      @csrf
      <div class="row">
      <div class="col-md-4 mb-3">
        <label for="namaLengkap" class="form-label">
        Nama Lengkap <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" name="nama" id="namaLengkap" placeholder="Masukkan nama lengkap"
        required>
      </div>

      <div class="col-md-4 mb-3">
        <label for="email" class="form-label">
        Email <span class="text-danger">*</span>
        </label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required>
      </div>

      <div class="col-md-4 mb-3">
        <label for="noTelp" class="form-label">
        No Telp <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" name="no_telp" id="noTelp" placeholder="Masukkan nomor telepon"
        required minlength="12" maxlength="12">
      </div>

      <div class="col-md-4 mb-3">
        <label for="kecamatan" class="form-label">
        Kecamatan <span class="text-danger">*</span>
        </label>
        <select id="kecamatan" name="kecamatan" class="form-control" required>
        <option value="">-- Pilih Kecamatan --</option>
        @foreach($kecamatan as $item)
      <option value="{{ $item->id_kecamatan }}">{{ $item->kecamatan }}</option>
      @endforeach
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label for="kelurahan" class="form-label">
        Kelurahan <span class="text-danger">*</span>
        </label>
        <select id="kelurahan" name="kelurahan" class="form-control" required>
        <option value="">-- Pilih Kelurahan --</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label for="kode_pos" class="form-label">
        Kode Pos <span class="text-danger">*</span>
        </label>
        <input type="number" class="form-control" name="kode_pos" id="kode_pos" placeholder="Masukkan kode pos"
        required min="10000" max="99999">
      </div>

      <div class="col-md-12 mb-3">
        <label for="alamat" class="form-label">
        Alamat Lengkap <span class="text-danger">*</span>
        </label>
        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap"
        required></textarea>
      </div>

      <hr>

      <div class="col-md-6 mb-3">
        <label for="namaPengguna" class="form-label">
        Nama Pengguna <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" name="username" id="namaPengguna" placeholder="Masukkan nama pengguna"
        required>
      </div>

      <div class="col-md-6 mb-3">
        <label for="kataSandi" class="form-label">
        Kata Sandi <span class="text-danger">*</span>
        </label>
        <div class="input-group">
        <input type="password" class="form-control" name="password" id="kataSandi" placeholder="Masukkan kata sandi"
          required>
        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
          <i id="eyeIcon" class="bi bi-eye-slash"></i>
        </button>
        </div>
      </div>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Daftar</button>
    </form>

    <script>
      document.getElementById('kecamatan').addEventListener('change', function () {
      var kecamatanId = this.value;

      fetch('/get-kelurahan/' + kecamatanId)
        .then(response => response.json())
        .then(data => {
        var kelurahanSelect = document.getElementById('kelurahan');
        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        data.forEach(function (kelurahan) {
          kelurahanSelect.innerHTML += `<option value="${kelurahan.id_kelurahan}">${kelurahan.kelurahan}</option>`;
        });
        });
      });

      function togglePassword() {
      var passwordField = document.getElementById("kataSandi");
      var eyeIcon = document.getElementById("eyeIcon");
      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("bi-eye-slash");
        eyeIcon.classList.add("bi-eye");
      } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("bi-eye");
        eyeIcon.classList.add("bi-eye-slash");
      }
      }
    </script>

    </div>
  </div>
  </form>

  <script>
    @if (session('success'))
    Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    showConfirmButton: true,
    confirmButtonText: 'OK'
    });
    @elseif (session('error'))
    Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "{{ session('error') }}",
    showConfirmButton: true,
    confirmButtonText: 'OK'
    });
    @endif
  </script>

  </div>
  </div>

@endsection