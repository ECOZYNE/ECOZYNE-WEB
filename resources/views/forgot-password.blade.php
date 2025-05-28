@extends('layouts.auth')

@section('title', 'Ecozyne | Reset Kata Sandi')

@section('content')
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-10 col-lg-8 col-xl-5">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="login" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="../assets/images/logos/ecozyne.png" class="logo-img" alt="Logo Ecozyne" />
                                <span class="ms-1 fw-bolder text-dark fs-8">Ecozyne</span>
                            </a>
                            <hr>

                            <form action="{{ route('forgot.handle') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Email Pemulihan</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Masukkan Email Anda" required onpaste="return false">

                                    @if(session('success'))
                                        <div style="color:green">{{ session('success') }}</div>
                                    @endif

                                    @if(session('error'))
                                        <div style="color:red">{{ session('error') }}</div>
                                    @endif

                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const inputs = ['email'];

                                        inputs.forEach(function (id) {
                                            const input = document.getElementById(id);
                                            input.addEventListener('paste', function (e) {
                                                e.preventDefault();

                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Aksi Tidak Diizinkan',
                                                    text: 'Anda tidak diizinkan untuk melakukan tempel teks!',
                                                    confirmButtonColor: '#6C63FF'
                                                });
                                            });
                                        });
                                    });
                                </script>

                                <button type="submit" class="btn btn-primary w-100">Reset Kata Sandi</button>
                                <div class="d-flex align-items-center justify-content-center mt-4">
                                    <p class="fs-4 mb-0 fw-bold">Coba Masuk ?</p>
                                    <a class="text-primary fw-bold ms-2" href="login">Portal Masuk</a>
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
            window.onload = function () {
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = ['email'];

            inputs.forEach(function (id) {
                const input = document.getElementById(id);
                input.addEventListener('paste', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Aksi Tidak Diizinkan',
                        text: 'Anda tidak diizinkan untuk melakukan tempel teks!',
                        confirmButtonColor: '#6C63FF'
                    });
                });
            });
        });
    </script>
@endpush