@extends('layouts.auth')

@section('title', 'Ecozyne | Portal Masuk')

@section('content')
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-10 col-lg-8 col-xl-5">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="login" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ asset('assets/images/logos/ecozyne.png') }}" class="logo-img"
                                    alt="Logo Ecozyne" />
                                <span class="ms-1 fw-bolder text-dark fs-8">Ecozyne</span>
                            </a>
                            <hr>

                            <form id="loginForm" action="{{ route('login-post') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Pengguna<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Masukkan Nama Pengguna" required onpaste="return false">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukkan kata sandi" required onpaste="return false">
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                            <i id="eyeIcon" class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Error message container -->
                                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <a class="text-primary fw-bold" href="forgot-password">Lupa Kata Sandi ?</a>
                                </div>
                                <button type="submit" id="loginBtn" class="btn btn-primary w-100">
                                    <span id="loginBtnText">Masuk</span>
                                    <span id="loginBtnSpinner" class="spinner-border spinner-border-sm d-none ms-2"
                                        role="status" aria-hidden="true"></span>
                                </button>
                                <div class="d-flex align-items-center justify-content-center mt-4">
                                    <p class="fs-4 mb-0 fw-bold">Belum Punya Akun ?</p>
                                    <a class="text-primary fw-bold ms-2" href="register">Buat Akun</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            window.onload = function() {
                // Sembunyikan loader jika ada
                const loader = document.getElementById("loader");
                if (loader) loader.style.display = "none";

                // Tampilkan alert sukses jika ada
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2500
                    });
                @endif
            };
        </script>
    @endif

    @if (session('login_success'))
        <script>
            window.onload = function() {
                // Sembunyikan loader jika ada
                const loader = document.getElementById("loader");
                if (loader) loader.style.display = "none";

                // Tampilkan alert login sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: '{{ session('login_success') }}',
                    showConfirmButton: true,
                    confirmButtonText: 'Lanjutkan',
                    confirmButtonColor: '#28a745',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect akan dilakukan otomatis oleh Laravel
                        window.location.reload();
                    }
                });
            };
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['username', 'password'];

            inputs.forEach(function(id) {
                const input = document.getElementById(id);
                input.addEventListener('paste', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Aksi Tidak Diizinkan',
                        text: 'Anda tidak diizinkan untuk melakukan tempel teks!',
                        confirmButtonColor: '#6C63FF'
                    });
                });
            });

            // Handle login form submission with AJAX
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');
            const loginBtnSpinner = document.getElementById('loginBtnSpinner');
            const errorMessage = document.getElementById('error-message');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Disable button and show loading
                loginBtn.disabled = true;
                loginBtnText.textContent = 'Memproses...';
                loginBtnSpinner.classList.remove('d-none');
                errorMessage.classList.add('d-none');

                // Prepare form data
                const formData = new FormData(loginForm);

                // Send AJAX request
                fetch(loginForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') || document.querySelector(
                                    'input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        loginBtn.disabled = false;
                        loginBtnText.textContent = 'Masuk';
                        loginBtnSpinner.classList.add('d-none');

                        if (data.success) {
                            // Show success SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Berhasil!',
                                text: data.message,
                                showConfirmButton: true,
                                confirmButtonText: 'Lanjutkan',
                                confirmButtonColor: '#28a745',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                timer: 2500,
                                timerProgressBar: true
                            }).then((result) => {
                                // Redirect after SweetAlert
                                window.location.href = data.redirect_url;
                            });
                        } else {
                            // Show error message
                            errorMessage.textContent = data.message;
                            errorMessage.classList.remove('d-none');

                            // Also show SweetAlert for error
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal!',
                                text: data.message,
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Reset button state
                        loginBtn.disabled = false;
                        loginBtnText.textContent = 'Masuk';
                        loginBtnSpinner.classList.add('d-none');

                        // Show error
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: 'Silakan coba lagi dalam beberapa saat.',
                            confirmButtonColor: '#dc3545'
                        });
                    });
            });
        });

        function togglePassword() {
            var passwordField = document.getElementById("password");
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
@endpush
