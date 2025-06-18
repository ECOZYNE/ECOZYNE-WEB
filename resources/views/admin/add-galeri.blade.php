@extends('layouts.dashboard')

@section('title', 'Tambah Galeri')

@section('content')
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Tambah Galeri</h5>
      <hr>

      <form id="galeri-form" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="foto" class="form-label">
                Foto <span class="text-danger">*</span>
              </label>
              <input type="file" class="form-control" name="foto" id="foto" accept=".jpg,.jpeg,.png" required
                placeholder="Pilih foto galeri">
            </div>

            <div class="col-md-6 mb-3">
              <label for="deskripsi" class="form-label">
                Deskripsi singkat <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="deskripsi" id="deskripsi" required
                placeholder="Masukkan deskripsi singkat galeri">
            </div>

            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Buat Galeri</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
          const form = document.querySelector("#galeri-form");

          form.addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(form);
            let actionUrl = "{{ route('galeri.post') }}";
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            fetch(actionUrl, {
              method: "POST",
              body: formData,
              headers: {
                "X-CSRF-TOKEN": csrfToken
              }
            })
            .then(async (response) => {
              if (!response.ok) {
                if (response.status === 422) {
                  const data = await response.json();
                  let messages = Object.values(data.errors).flat().join('\n');
                  throw new Error(messages);
                } else {
                  throw new Error("Terjadi kesalahan pada server.");
                }
              }
              return response.json();
            })
            .then(data => {
              Swal.fire({
                title: "Berhasil!",
                text: data.message,
                icon: "success",
                confirmButtonText: "OK"
              });

              form.reset(); // Reset form setelah submit sukses (optional)
            })
            .catch(error => {
              Swal.fire("Gagal", error.message || "Terjadi kesalahan.", "error");
            });
          });
        });
      </script>
@endpush
