@extends('layouts.dashboard')

@section('title', 'Buat Setoran Sampah')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Setoran Sampah</h5>
        <hr>

        <!-- Alert untuk menampilkan pesan -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulir Setoran Sampah -->
        <form method="POST" action="{{ route('transaksi-sampah.store') }}">
            @csrf
            <div class="row">
                <!-- Kolom pertama untuk mencari username -->
                <div class="col-md-6 mb-3">
                    <label for="usernameSearch" class="form-label">Cari Username Komunitas</label>
                    <input type="text" class="form-control" name="usernameSearch" id="usernameSearch" 
                           placeholder="Ketik username komunitas..." autocomplete="off" required>
                    <input type="hidden" name="username" id="selectedUsername" required>
                    <small class="text-muted">Ketik untuk mencari username komunitas penyetor</small>
                </div>

                <!-- Kolom kedua untuk memasukkan berat sampah -->
                <div class="col-md-6 mb-3">
                    <label for="beratSampah" class="form-label">Berat Sampah (kg)</label>
                    <input type="number" class="form-control" name="berat_sampah" id="beratSampah"
                           placeholder="Masukkan berat sampah" min="0.1" step="0.1" required>
                    <small class="text-muted">1 kg = 10 poin</small>
                </div>
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
                            <!-- Results will be populated by JavaScript -->
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

            <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-4 rounded-2" id="submitBtn" disabled>
                Buat Setoran Sampah
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
let searchTimeout;
let selectedUser = null;

// Fungsi untuk mencari username
function searchUsername() {
    const input = document.getElementById('usernameSearch');
    const query = input.value.trim();
    
    // Clear previous timeout
    clearTimeout(searchTimeout);
    
    if (query.length < 2) {
        document.getElementById('searchResults').style.display = 'none';
        clearSelection();
        return;
    }
    
    // Debounce search
    searchTimeout = setTimeout(() => {
        fetch(`{{ route('transaksi-sampah.search-username') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySearchResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('searchResults').style.display = 'none';
            });
    }, 300);
}

// Fungsi untuk menampilkan hasil pencarian
function displaySearchResults(users) {
    const resultsContainer = document.getElementById('usernameResults');
    const searchResults = document.getElementById('searchResults');
    
    if (users.length === 0) {
        searchResults.style.display = 'none';
        return;
    }
    
    let html = '';
    users.forEach(user => {
        html += `
            <tr style="cursor: pointer;" onclick="selectUser('${user.username}', '${user.nama}', '${user.email}', '${user.no_telp}')">
                <td>${user.username}</td>
                <td>${user.nama || '-'}</td>
                <td>${user.email}</td>
                <td>${user.no_telp || '-'}</td>
                <td><button type="button" class="btn btn-sm btn-primary">Pilih</button></td>
            </tr>
        `;
    });
    
    resultsContainer.innerHTML = html;
    searchResults.style.display = 'block';
}

// Fungsi untuk memilih user
function selectUser(username, nama, email, no_telp) {
    selectedUser = { username, nama, email, no_telp };
    
    // Set hidden input
    document.getElementById('selectedUsername').value = username;
    
    // Update search input
    document.getElementById('usernameSearch').value = username;
    
    // Hide search results
    document.getElementById('searchResults').style.display = 'none';
    
    // Show selected user info
    const selectedInfo = document.getElementById('selectedUserInfo');
    const selectedDetails = document.getElementById('selectedUserDetails');
    
    selectedDetails.innerHTML = `
        <strong>Username:</strong> ${username}<br>
        <strong>Nama Komunitas:</strong> ${nama || '-'}<br>
        <strong>Email:</strong> ${email}<br>
        <strong>No. Telp:</strong> ${no_telp || '-'}
    `;
    
    selectedInfo.style.display = 'block';
    
    // Update point calculation if weight is entered
    updatePointCalculation();
    
    // Enable submit button if both user and weight are selected
    updateSubmitButton();
}

// Fungsi untuk menghitung dan menampilkan poin
function updatePointCalculation() {
    const weight = document.getElementById('beratSampah').value;
    const pointCalc = document.getElementById('pointCalculation');
    const pointDetails = document.getElementById('pointDetails');
    
    if (selectedUser && weight && weight > 0) {
        const points = weight * 10;
        pointDetails.innerHTML = `
            <strong>Berat Sampah:</strong> ${weight} kg<br>
            <strong>Poin yang akan didapat:</strong> ${points} poin<br>
            <strong>Penerima Poin:</strong> ${selectedUser.username} (${selectedUser.nama})
        `;
        pointCalc.style.display = 'block';
    } else {
        pointCalc.style.display = 'none';
    }
}

// Fungsi untuk update status tombol submit
function updateSubmitButton() {
    const submitBtn = document.getElementById('submitBtn');
    const weight = document.getElementById('beratSampah').value;
    
    if (selectedUser && weight && weight > 0) {
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

// Event listeners
document.getElementById('usernameSearch').addEventListener('input', searchUsername);
document.getElementById('beratSampah').addEventListener('input', function() {
    updatePointCalculation();
    updateSubmitButton();
});

// Clear selection when search input is cleared
document.getElementById('usernameSearch').addEventListener('input', function() {
    if (this.value.trim() === '') {
        clearSelection();
    }
});

// SweetAlert untuk notifikasi
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
@endpush
@endsection