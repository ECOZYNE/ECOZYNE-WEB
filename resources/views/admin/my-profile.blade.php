@extends('layouts.dashboard')

@section('title', 'Profil Admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mt-4 mb-1">Profil Admin</h5>
        <p class="text-muted">Ubah informasi akun Anda di sini.</p>
        <hr>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <!-- Form Edit Profil -->
            <div class="col-md-8">
                <form action="{{ route('admin.update.profil') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                    </div>

                    <button type="submit" class="btn btn-danger">Simpan</button>
                </form>
            </div>

            <!-- Form Ubah Password -->
                <div class="col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Ubah Password</h6>
                               <form action="{{ route('admin.update.password') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="password_baru" class="form-label fw-semibold">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_baru_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
