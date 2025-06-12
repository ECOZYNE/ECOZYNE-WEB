@extends('layouts.dashboard')

@section('title', 'Buat Setoran Sampah')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Setoran Sampah</h5>
        <hr>

        <!-- Alert untuk menampilkan pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Alert untuk menampilkan pesan error umum -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Alert untuk menampilkan pesan validasi dari form -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Formulir Setoran Sampah -->
        <form method="POST" action="{{ route('transaksi-sampah.store') }}" id="setorSampahForm">
            @csrf
            <div class="row">
                <!-- Kolom pertama untuk mencari username -->
                <div class="col-md-6 mb-3">
                    <label for="usernameSearch" class="form-label">Cari Username Komunitas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="usernameSearch" id="usernameSearch" 
                           placeholder="Ketik username komunitas..." autocomplete="off" value="{{ old('usernameSearch') }}">
                    <!-- Input hidden untuk menyimpan username yang dipilih -->
                    <input type="hidden" name="username" id="selectedUsername" value="{{ old('username') }}">
                    <small class="text-muted">Minimal 2 karakter untuk mencari</small>
                </div>

                <!-- Kolom kedua untuk memasukkan berat sampah -->
                <div class="col-md-6 mb-3">
                    <label for="beratSampah" class="form-label">Berat Sampah (kg) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="berat_sampah" id="beratSampah"
                           placeholder="Masukkan berat sampah" min="0.1" step="0.1" value="{{ old('berat_sampah') }}">
                    <small class="text-muted">100 gram = 1 Poin</small>
                    <br>
                    <small class="text-muted">1 kg = 10 poin</small>
                </div>
            </div>

            <!-- Loading indicator -->
            <div id="searchLoading" class="text-center mt-3" style="display: none;">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span class="ms-2">Mencari komunitas...</span>
            </div>

            <!-- Hasil pencarian username -->
            <div id="searchResults" class="mt-3" style="display: none;">
                <h6>Pilih Komunitas Penyetor:</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Username</th>
                                <th>Nama Komunitas</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="usernameResults">
                            <!-- Hasil akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Info komunitas terpilih -->
            <div id="selectedUserInfo" class="mt-3" style="display: none;">
                <div class="alert alert-info">
                    <h6 class="mb-2">Komunitas Penyetor Terpilih:</h6>
                    <div id="selectedUserDetails"></div>
                </div>
            </div>

            <!-- Info perhitungan poin -->
            <div id="pointCalculation" class="mt-3" style="display: none;">
                <div class="alert alert-success">
                    <h6 class="mb-2">Perhitungan Poin:</h6>
                    <div id="pointDetails"></div>
                </div>
            </div>

            <!-- Tombol submit -->
            <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-4 rounded-2" id="submitBtn" disabled>
                <span id="submitBtnText">Buat Setoran Sampah</span>
                <span id="submitBtnLoading" style="display: none;">
                    <span class="spinner-border spinner-border-sm" role="status"></span>
                    Menyimpan...
                </span>
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
let searchTimeout;
let selectedUser = null;

// Fungsi untuk mencari username komunitas
function searchUsername() {
    const input = document.getElementById('usernameSearch');
    const query = input.value.trim();
    const loadingDiv = document.getElementById('searchLoading');
    
    clearTimeout(searchTimeout);
    
    if (query.length < 2) {
        document.getElementById('searchResults').style.display = 'none';
        loadingDiv.style.display = 'none';
        clearSelection();
        return;
    }
    
    // Tampilkan loading
    loadingDiv.style.display = 'block';
    document.getElementById('searchResults').style.display = 'none';
    
    searchTimeout = setTimeout(() => {
        // Gunakan template literal yang benar untuk Laravel route
        const searchUrl = '{{ route("transaksi-sampah.search-username") }}';
        
        fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            loadingDiv.style.display = 'none';
            displaySearchResults(data);
        })
        .catch(error => {
            console.error('Error saat mencari username:', error);
            loadingDiv.style.display = 'none';
            document.getElementById('searchResults').style.display = 'none';
            
            // Tampilkan error message
            showError('Terjadi kesalahan saat mencari komunitas. Silakan coba lagi.');
        });
    }, 500); // Increased delay to 500ms
}

// Fungsi untuk menampilkan hasil pencarian
function displaySearchResults(users) {
    const resultsContainer = document.getElementById('usernameResults');
    const searchResults = document.getElementById('searchResults');
    
    if (users.length === 0) {
        resultsContainer.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Tidak ada komunitas ditemukan dengan kata kunci tersebut.</td></tr>';
        searchResults.style.display = 'block';
        return;
    }
    
    let html = '';
    users.forEach(user => {
        const userDataAttr = JSON.stringify(user).replace(/"/g, '&quot;');
        html += `
            <tr style="cursor: pointer;" onclick="selectUser(${userDataAttr})" class="user-row">
                <td>${escapeHtml(user.username)}</td>
                <td>${escapeHtml(user.nama || '-')}</td>
                <td>${escapeHtml(user.email)}</td>
                <td>${escapeHtml(user.no_telp || '-')}</td>
                <td><button type="button" class="btn btn-sm btn-primary">Pilih</button></td>
            </tr>
        `;
    });
    
    resultsContainer.innerHTML = html;
    searchResults.style.display = 'block';
}

// Fungsi untuk escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Fungsi untuk memilih user
function selectUser(user) {
    selectedUser = user;
    
    // Set nilai input
    document.getElementById('selectedUsername').value = user.username;
    document.getElementById('usernameSearch').value = user.username;
    
    // Sembunyikan hasil pencarian
    document.getElementById('searchResults').style.display = 'none';
    
    // Tampilkan info user terpilih
    showSelectedUserInfo(user);
    
    // Update perhitungan poin
    updatePointCalculation();
    
    // Update tombol submit
    updateSubmitButton();
}

// Fungsi untuk menampilkan info user terpilih
function showSelectedUserInfo(user) {
    const selectedInfo = document.getElementById('selectedUserInfo');
    const selectedDetails = document.getElementById('selectedUserDetails');
    
    selectedDetails.innerHTML = `
        <strong>Username:</strong> ${escapeHtml(user.username)}<br>
        <strong>Nama Komunitas:</strong> ${escapeHtml(user.nama || '-')}<br>
        <strong>Email:</strong> ${escapeHtml(user.email)}<br>
        <strong>No. Telp:</strong> ${escapeHtml(user.no_telp || '-')}
    `;
    
    selectedInfo.style.display = 'block';
}

// Fungsi untuk menghitung poin
function updatePointCalculation() {
    const weight = parseFloat(document.getElementById('beratSampah').value);
    const pointCalc = document.getElementById('pointCalculation');
    const pointDetails = document.getElementById('pointDetails');
    
    if (selectedUser && !isNaN(weight) && weight > 0) {
        const points = Math.floor(weight * 10);
        pointDetails.innerHTML = `
            <strong>Berat Sampah:</strong> ${weight} kg<br>
            <strong>Poin yang akan didapat:</strong> ${points} poin<br>
            <strong>Penerima Poin:</strong> ${escapeHtml(selectedUser.username)} (${escapeHtml(selectedUser.nama || 'N/A')})
        `;
        pointCalc.style.display = 'block';
    } else {
        pointCalc.style.display = 'none';
    }
}

// Fungsi untuk update tombol submit
function updateSubmitButton() {
    const submitBtn = document.getElementById('submitBtn');
    const weight = parseFloat(document.getElementById('beratSampah').value);
    
    if (selectedUser && !isNaN(weight) && weight >= 0.1) {
        submitBtn.disabled = false;
        submitBtn.classList.remove('btn-secondary');
        submitBtn.classList.add('btn-primary');
    } else {
        submitBtn.disabled = true;
        submitBtn.classList.remove('btn-primary');
        submitBtn.classList.add('btn-secondary');
    }
}

// Fungsi untuk clear selection
function clearSelection() {
    selectedUser = null;
    document.getElementById('selectedUsername').value = '';
    document.getElementById('selectedUserInfo').style.display = 'none';
    document.getElementById('pointCalculation').style.display = 'none';
    updateSubmitButton();
}

// Fungsi untuk menampilkan error
function showError(message) {
    // Buat alert error temporary
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const form = document.getElementById('setorSampahForm');
    form.insertBefore(alertDiv, form.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// Event listeners
document.getElementById('usernameSearch').addEventListener('input', function() {
    if (this.value.trim() === '') {
        clearSelection();
        document.getElementById('searchResults').style.display = 'none';
        document.getElementById('searchLoading').style.display = 'none';
    } else {
        searchUsername();
    }
});

document.getElementById('beratSampah').addEventListener('input', function() {
    updatePointCalculation();
    updateSubmitButton();
});

// Handle form submission
document.getElementById('setorSampahForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText');
    const submitBtnLoading = document.getElementById('submitBtnLoading');
    
    // Disable button and show loading
    submitBtn.disabled = true;
    submitBtnText.style.display = 'none';
    submitBtnLoading.style.display = 'inline-block';
});

// Initialize berdasarkan old input (untuk kasus validation error)
document.addEventListener('DOMContentLoaded', function() {
    const oldUsername = document.getElementById('selectedUsername').value;
    const oldUsernameSearch = document.getElementById('usernameSearch').value;
    
    if (oldUsername && oldUsernameSearch) {
        // Simulate selected user for validation errors
        selectedUser = { username: oldUsername };
        updatePointCalculation();
        updateSubmitButton();
    }
});

// SweetAlert notifications (jika tersedia)
@if (session('success'))
    @if(isset($GLOBALS['sweetalert']) || function_exists('sweetalert'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: true,
            confirmButtonText: 'OK'
        });
    @endif
@elseif (session('error'))
    @if(isset($GLOBALS['sweetalert']) || function_exists('sweetalert'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            showConfirmButton: true,
            confirmButtonText: 'OK'
        });
    @endif
@endif
</script>
@endpush
@endsection