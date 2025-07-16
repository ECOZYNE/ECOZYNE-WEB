@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
    <style>
        .profile-edit-container {
            position: relative;
            display: inline-block;
        }
        
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #f8f9fa;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .profile-image:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .edit-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.3);
            border: 3px solid white;
        }
        
        .edit-overlay:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #b02a37 0%, #dc3545 100%);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        }
        
        .edit-overlay i {
            color: white;
            font-size: 12px;
        }
        
        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .upload-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1rem;
            border-radius: 12px;
            border-left: 4px solid #dc3545;
            margin-top: 1rem;
        }
        
        .upload-info small {
            color: #6c757d;
            font-size: 0.875rem;
            line-height: 1.4;
        }
        
        .upload-info .info-icon {
            color: #dc3545;
            margin-right: 0.5rem;
        }
        
        .upload-success {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .upload-success.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .profile-edit-container::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dc3545, #b02a37);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }
        
        .profile-edit-container:hover::before {
            opacity: 0.1;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .uploading .edit-overlay {
            animation: pulse 1s infinite;
        }
        
        .profile-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            margin-bottom: 1rem;
        }
        
        .profile-section h6 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .profile-section h6 i {
            margin-right: 0.5rem;
            color: #dc3545;
        }
    </style>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mt-4 mb-1">Profil Saya</h5>
            <p class="text-muted">Pastikan data Anda selalu diperbarui agar kami bisa melayani dengan lebih baik.</p>
            <hr>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <!-- Kolom Kiri: Form Edit Data Profil -->
                <div class="col-md-8">
                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->username }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $komunitas->nama ?? '' }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" value="{{ $komunitas->no_telp ?? '' }}"
                                required>
                        </div>

                        {{-- Perbaikan di sini: Menangani pengajuanBankSampah sebagai koleksi --}}
                        @php
                            $pengajuanBankSampahDiterima = null;
                            if ($komunitas && $komunitas->pengajuanBankSampah) {
                                // Cari pengajuan dengan status 'diterima'
                                $pengajuanBankSampahDiterima = $komunitas->pengajuanBankSampah->firstWhere('status', 'diterima');

                                // Jika tidak ada yang diterima, ambil yang paling baru (opsional, tergantung kebutuhan)
                                if (!$pengajuanBankSampahDiterima && $komunitas->pengajuanBankSampah->isNotEmpty()) {
                                    $pengajuanBankSampahDiterima = $komunitas->pengajuanBankSampah->sortByDesc('created_at')->first();
                                }
                            }
                        @endphp

                        @if($pengajuanBankSampahDiterima)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Bank Sampah</label>
                                <input type="text" class="form-control" name="bank_sampah"
                                    value="{{ $pengajuanBankSampahDiterima->nama_bank_sampah }}" readonly>
                            </div>
                          
                        @else
                            {{-- Opsional: Tampilkan pesan jika tidak ada pengajuan yang diterima atau pengajuan sama sekali --}}
                            <div class="mb-3">
                                <p class="text-muted">Belum ada pengajuan Bank Sampah yang disetujui atau tersedia.</p>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-danger mt-2">Simpan</button>
                    </form>
                </div>

                <!-- Kolom Kanan: Form Ubah Password -->
                <div class="col-md-4">
                    <!-- Foto Profil Section -->
                    <div class="profile-section">
                        <div class="d-flex align-items-center">
                            <div class="profile-edit-container me-3">
                                <img src="{{ $komunitas->foto ?? 'https://api.dicebear.com/9.x/initials/svg?seed=default' }}" 
                                     alt="Foto Profil" 
                                     class="profile-image"
                                     id="profilePreview">
                                
                                <div class="edit-overlay" id="editButton">
                                    <i class="fas fa-pencil-alt"></i>
                                    <input type="file" 
                                           class="file-input" 
                                           name="foto" 
                                           id="fotoInput" 
                                           accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Ubah Password</h6>
                            <form action="{{ route('ubah-password') }}" method="POST" id="passwordForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="password_baru" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password_baru" id="password_baru" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_baru_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_baru_confirmation" id="password_baru_confirmation" required>
                                    <div id="password-feedback" class="mt-2" style="display: none;"></div>
                                </div>
                                <button type="submit" class="btn btn-danger w-100" id="submitPasswordBtn" disabled>Simpan Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password validation
            const passwordBaru = document.getElementById('password_baru');
            const passwordConfirmation = document.getElementById('password_baru_confirmation');
            const passwordFeedback = document.getElementById('password-feedback');
            const submitBtn = document.getElementById('submitPasswordBtn');
            const passwordForm = document.getElementById('passwordForm');

            function validatePassword() {
                const password = passwordBaru.value;
                const confirmation = passwordConfirmation.value;

                if (password === '' && confirmation === '') {
                    passwordFeedback.style.display = 'none';
                    submitBtn.disabled = true;
                    return;
                }

                if (password !== confirmation) {
                    passwordFeedback.innerHTML = '<small class="text-danger"><i class="fas fa-times-circle"></i> Password tidak sama</small>';
                    passwordFeedback.style.display = 'block';
                    passwordConfirmation.classList.add('is-invalid');
                    passwordConfirmation.classList.remove('is-valid');
                    submitBtn.disabled = true;
                } else if (password === confirmation && password !== '') {
                    passwordFeedback.innerHTML = '<small class="text-success"><i class="fas fa-check-circle"></i> Password cocok</small>';
                    passwordFeedback.style.display = 'block';
                    passwordConfirmation.classList.add('is-valid');
                    passwordConfirmation.classList.remove('is-invalid');
                    submitBtn.disabled = false;
                } else {
                    passwordFeedback.style.display = 'none';
                    passwordConfirmation.classList.remove('is-invalid', 'is-valid');
                    submitBtn.disabled = true;
                }
            }

            // Event listeners for password validation
            passwordBaru.addEventListener('input', validatePassword);
            passwordConfirmation.addEventListener('input', validatePassword);

            // Prevent form submission if passwords don't match
            passwordForm.addEventListener('submit', function(e) {
                if (passwordBaru.value !== passwordConfirmation.value) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password harus sama!');
                }
            });

            // Modern Photo preview functionality
            const fotoInput = document.getElementById('fotoInput');
            const profilePreview = document.getElementById('profilePreview');
            const editButton = document.getElementById('editButton');
            const uploadSuccess = document.getElementById('uploadSuccess');

            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    // Add uploading animation
                    editButton.classList.add('uploading');
                    
                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak diizinkan. Gunakan JPG, PNG, atau JPEG.');
                        e.target.value = '';
                        editButton.classList.remove('uploading');
                        return;
                    }

                    // Validate file size (2MB)
                    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        e.target.value = '';
                        editButton.classList.remove('uploading');
                        return;
                    }

                    // Preview image with smooth transition
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Simulate upload delay for better UX
                        setTimeout(() => {
                            profilePreview.src = e.target.result;
                            editButton.classList.remove('uploading');
                            uploadSuccess.classList.add('show');
                            
                            // Hide success message after 3 seconds
                            setTimeout(() => {
                                uploadSuccess.classList.remove('show');
                            }, 3000);
                        }, 800);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Add hover effects for edit button
            editButton.addEventListener('mouseenter', function() {
                if (!this.classList.contains('uploading')) {
                    this.style.transform = 'scale(1.1)';
                }
            });

            editButton.addEventListener('mouseleave', function() {
                if (!this.classList.contains('uploading')) {
                    this.style.transform = 'scale(1)';
                }
            });
        });
    </script>
@endsection