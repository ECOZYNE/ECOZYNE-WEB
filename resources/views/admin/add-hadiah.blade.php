@extends('layouts.dashboard')

@section('title', 'Tambah Hadiah')

@section('content')
  <div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Hadiah</h5>
    <hr>

    <form method="POST" action="{{ route('hadiah.store') }}" enctype="multipart/form-data" id="hadiahForm">
      @csrf
      <div class="row">
      <div class="col-md-6 mb-3">
        <label for="nama_hadiah" class="form-label">Nama Hadiah <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('nama_hadiah') is-invalid @enderror" name="nama_hadiah"
        id="nama_hadiah" placeholder="Masukkan Nama Hadiah" value="{{ old('nama_hadiah') }}" required>
        @error('nama_hadiah')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      </div>

      <div class="col-md-6 mb-3">
        <label for="foto" class="form-label">Foto <span class="text-danger">*</span></label>
        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto"
        accept="image/*" required>
        @error('foto')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        <small class="text-muted">Format: JPEG, PNG, JPG. Maksimal 2MB</small>
      </div>

      <div class="col-md-6 mb-3">
        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" required
        min="0" value="{{ old('stok') }}">
        @error('stok')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      </div>

      <div class="col-md-6 mb-3">
        <label for="point_satuan" class="form-label">Poin Satuan <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('point_satuan') is-invalid @enderror" name="point_satuan"
        id="point_satuan" required min="0" value="{{ old('point_satuan') }}">
        @error('point_satuan')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      </div>

      <div class="col-md-12 mb-3">
        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi"
        rows="4" placeholder="Masukkan deskripsi hadiah" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2" id="submitBtn">
        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        <span class="button-text">Buat Hadiah</span>
        </button>
      </div>
      </div>
    </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("hadiahForm");
    const submitBtn = document.getElementById("submitBtn");
    const spinner = submitBtn.querySelector(".spinner-border");
    const buttonText = submitBtn.querySelector(".button-text");

    form.addEventListener("submit", function (event) {
      event.preventDefault();

      if (!validateForm()) return;

      submitBtn.disabled = true;
      spinner.classList.remove("d-none");
      buttonText.textContent = "Menyimpan...";

      let formData = new FormData(this);
      let actionUrl = this.getAttribute("action");
      let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

      fetch(actionUrl, {
      method: "POST",
      body: formData,
      headers: {
        "X-CSRF-TOKEN": csrfToken,
        "X-Requested-With": "XMLHttpRequest"
      }
      })
      .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.json();
      })
      .then(data => {
        if (data.success) {
        Swal.fire({
          title: "Berhasil!",
          text: data.message,
          icon: "success",
          confirmButtonText: "OK",
          confirmButtonColor: "#28a745",
          allowOutsideClick: false,
          allowEscapeKey: false
        }).then(() => {
          form.reset(); // Reset semua field
          clearFieldErrors();
        });
        } else {
        let errorMessage = data.message || "Terjadi kesalahan saat menyimpan data.";
        if (data.errors) {
          let errorList = [];
          Object.values(data.errors).forEach(errors => {
          errors.forEach(error => errorList.push(error));
          });
          errorMessage = errorList.join('<br>');
        }

        Swal.fire({
          title: "Gagal!",
          html: errorMessage,
          icon: "error",
          confirmButtonText: "OK",
          confirmButtonColor: "#dc3545"
        });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire({
        title: "Error!",
        text: "Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.",
        icon: "error",
        confirmButtonText: "OK",
        confirmButtonColor: "#dc3545"
        });
      })
      .finally(() => {
        submitBtn.disabled = false;
        spinner.classList.add("d-none");
        buttonText.textContent = "Buat Hadiah";
      });
    });

    function validateForm() {
      const namaHadiah = document.getElementById("nama_hadiah").value.trim();
      const foto = document.getElementById("foto").files[0];
      const stok = document.getElementById("stok").value;
      const pointSatuan = document.getElementById("point_satuan").value;
      const deskripsi = document.getElementById("deskripsi").value.trim();

      if (!namaHadiah) {
      showFieldError("nama_hadiah", "Nama hadiah wajib diisi");
      return false;
      }

      if (!foto) {
      showFieldError("foto", "Foto wajib diupload");
      return false;
      }

      const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
      if (!allowedTypes.includes(foto.type)) {
      showFieldError("foto", "Format foto harus JPEG, PNG, atau JPG");
      return false;
      }

      if (foto.size > 2 * 1024 * 1024) {
      showFieldError("foto", "Ukuran foto maksimal 2MB");
      return false;
      }

      if (!stok || parseInt(stok) < 0) {
      showFieldError("stok", "Stok harus diisi dan tidak boleh negatif");
      return false;
      }

      if (!pointSatuan || parseInt(pointSatuan) < 0) {
      showFieldError("point_satuan", "Poin satuan harus diisi dan tidak boleh negatif");
      return false;
      }

      if (!deskripsi) {
      showFieldError("deskripsi", "Deskripsi wajib diisi");
      return false;
      }

      clearFieldErrors();
      return true;
    }

    function showFieldError(fieldId, message) {
      const field = document.getElementById(fieldId);
      field.classList.add("is-invalid");

      const existingError = field.parentNode.querySelector(".invalid-feedback");
      if (existingError) existingError.remove();

      const errorDiv = document.createElement("div");
      errorDiv.className = "invalid-feedback";
      errorDiv.textContent = message;
      field.parentNode.appendChild(errorDiv);

      field.focus();
    }

    function clearFieldErrors() {
      document.querySelectorAll(".is-invalid").forEach(field => field.classList.remove("is-invalid"));
      document.querySelectorAll(".invalid-feedback").forEach(error => error.remove());
    }

    document.getElementById("foto").addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (file) {
      const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
      if (!allowedTypes.includes(file.type)) {
        showFieldError("foto", "Format foto harus JPEG, PNG, atau JPG");
        this.value = '';
        return;
      }

      if (file.size > 2 * 1024 * 1024) {
        showFieldError("foto", "Ukuran foto maksimal 2MB");
        this.value = '';
        return;
      }

      this.classList.remove("is-invalid");
      const errorMsg = this.parentNode.querySelector(".invalid-feedback");
      if (errorMsg) errorMsg.remove();
      }
    });

    document.querySelectorAll('input[type="number"]').forEach(input => {
      input.addEventListener("input", function () {
      if (this.value < 0) this.value = 0;
      });
    });
    });
  </script>
@endpush