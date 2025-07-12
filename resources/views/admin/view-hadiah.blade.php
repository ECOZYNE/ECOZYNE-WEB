@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-hadiah.css') }}" />
@endpush

@section('title', 'Data Hadiah')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3">Data Hadiah</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Hadiah...">
            </div>
            <hr>

            <!-- Display messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Hadiah Cards -->
            <div class="row" id="hadiahContainer">
                @forelse($hadiahList as $hadiah)
                    <div class="col-sm-6 col-xl-3 mb-4 hadiah-item" data-nama="{{ strtolower($hadiah->nama_hadiah) }}"
                        data-deskripsi="{{ strtolower($hadiah->deskripsi) }}">
                        <div class="card hadiah-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                @if($hadiah->foto && file_exists(public_path('storage/hadiah/' . $hadiah->foto)))
                                    <img src="{{ asset('storage/hadiah/' . $hadiah->foto) }}" class="hadiah-img"
                                        alt="{{ $hadiah->nama_hadiah }}" loading="lazy">
                                @else
                                    <div class="hadiah-img bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif

                                <!-- Stock status badge -->
                                @if($hadiah->stok <= 0)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger">Habis</span>
                                @elseif($hadiah->stok <= 5)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-warning">Stok Sedikit</span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="fw-bold mb-2">{{ $hadiah->nama_hadiah }}</h5>

                                <div class="mb-2">
                                    <small class="text-muted d-block">
                                        <i class="fa-solid fa-box" style="color: #675b1e;"></i> Stok:
                                        <span
                                            class="fw-semibold {{ $hadiah->stok <= 0 ? 'text-danger' : ($hadiah->stok <= 5 ? 'text-warning' : 'text-success') }}">
                                            {{ $hadiah->stok }}
                                        </span>
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i> Poin:
                                        <span class="fw-semibold text-info">{{ number_format($hadiah->point_satuan) }}</span>
                                    </small>
                                </div>

                                <p class="hadiah-deskripsi text-muted small mb-3 flex-grow-1">
                                    {{ $hadiah->deskripsi }}
                                </p>

                                <div class="d-flex gap-2 mt-auto">
                                    <button type="button" class="btn btn-warning w-50 edit-hadiah-btn"
                                        data-id="{{ $hadiah->id_hadiah }}" 
                                        data-nama="{{ $hadiah->nama_hadiah }}"
                                        data-deskripsi="{{ $hadiah->deskripsi }}" 
                                        data-foto="{{ $hadiah->foto }}"
                                        data-stok="{{ $hadiah->stok }}"
                                        data-point="{{ $hadiah->point_satuan }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editHadiahModal">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>

                                    <form action="{{ route('hadiah.destroy', $hadiah->id_hadiah) }}" method="POST"
                                        class="flex-fill"
                                        onsubmit="return confirm('Yakin ingin menghapus hadiah {{ $hadiah->nama_hadiah }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action w-100">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-gift fa-4x mb-3 text-muted"></i>
                            <h5 class="text-muted">Belum ada data hadiah</h5>
                            <p class="text-muted">Silakan tambah hadiah baru untuk memulai.</p>
                            <a href="{{ route('hadiah.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Hadiah Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- No search results -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="fas fa-search fa-4x mb-3 text-muted"></i>
                <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                <p class="text-muted">Coba gunakan kata kunci yang berbeda.</p>
            </div>
        </div>
    </div>

    <!-- Edit Hadiah Modal -->
    <div class="modal fade" id="editHadiahModal" tabindex="-1" aria-labelledby="editHadiahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHadiahModalLabel">Edit Hadiah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editHadiahForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editHadiahId" name="hadiah_id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editNamaHadiah" class="form-label">Nama Hadiah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="editNamaHadiah" name="nama_hadiah" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editPointSatuan" class="form-label">Poin Satuan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="editPointSatuan" name="point_satuan" min="0" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editStok" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="editStok" name="stok" min="0" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editFoto" class="form-label">Foto Hadiah</label>
                                    <input type="file" class="form-control" id="editFoto" name="foto" accept="image/*">
                                    <div class="form-text">Kosongkan jika tidak ingin mengubah foto</div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview foto saat ini -->
                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            <div>
                                <img id="currentFotoPreview" src="" alt="Foto Hadiah" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Preview foto baru -->
                        <div class="mb-3" id="newFotoPreview" style="display: none;">
                            <label class="form-label">Preview Foto Baru</label>
                            <div>
                                <img id="newFotoImg" src="" alt="Preview Foto Baru" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();
                const hadiahItems = document.querySelectorAll('.hadiah-item');
                const noResults = document.getElementById('noResults');
                let visibleItems = 0;

                hadiahItems.forEach(function (item) {
                    const nama = item.getAttribute('data-nama');
                    const deskripsi = item.getAttribute('data-deskripsi');

                    if (nama.includes(searchTerm) || deskripsi.includes(searchTerm)) {
                        item.style.display = 'block';
                        visibleItems++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleItems === 0 && searchTerm !== '') {
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                }
            });

            // Edit hadiah functionality
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.edit-hadiah-btn');
                const editForm = document.getElementById('editHadiahForm');
                const saveBtn = document.getElementById('saveEditBtn');
                const editModal = document.getElementById('editHadiahModal');
                const fotoInput = document.getElementById('editFoto');
                const newFotoPreview = document.getElementById('newFotoPreview');
                const newFotoImg = document.getElementById('newFotoImg');

                // Handle edit button click
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const nama = this.dataset.nama;
                        const deskripsi = this.dataset.deskripsi;
                        const foto = this.dataset.foto;
                        const stok = this.dataset.stok;
                        const point = this.dataset.point;

                        // Fill form with current data
                        document.getElementById('editHadiahId').value = id;
                        document.getElementById('editNamaHadiah').value = nama;
                        document.getElementById('editDeskripsi').value = deskripsi;
                        document.getElementById('editStok').value = stok;
                        document.getElementById('editPointSatuan').value = point;

                        // Set current photo preview
                        const currentPreview = document.getElementById('currentFotoPreview');
                        if (foto) {
                            currentPreview.src = `{{ asset('storage/hadiah/') }}/${foto}`;
                        } else {
                            currentPreview.src = '';
                        }

                        // Reset form validation
                        editForm.classList.remove('was-validated');
                        clearValidationErrors();
                    });
                });

                // Handle foto preview
                fotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            newFotoImg.src = e.target.result;
                            newFotoPreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        newFotoPreview.style.display = 'none';
                    }
                });

                // Handle save button click
                saveBtn.addEventListener('click', function() {
                    const formData = new FormData(editForm);
                    const hadiahId = document.getElementById('editHadiahId').value;
                    
                    // Disable save button and show loading
                    saveBtn.disabled = true;
                    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';

                    fetch(`{{ route('hadiah.update', '') }}/${hadiahId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            showAlert('success', data.message);
                            
                            // Close modal
                            const modal = bootstrap.Modal.getInstance(editModal);
                            modal.hide();
                            
                            // Reload page to show updated data
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            // Show validation errors
                            if (data.errors) {
                                showValidationErrors(data.errors);
                            } else {
                                showAlert('danger', data.message);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('danger', 'Terjadi kesalahan saat menyimpan data.');
                    })
                    .finally(() => {
                        // Re-enable save button
                        saveBtn.disabled = false;
                        saveBtn.innerHTML = '<i class="fas fa-save me-1"></i> Simpan Perubahan';
                    });
                });

                // Helper functions
                function showAlert(type, message) {
                    const alertDiv = document.createElement('div');
                    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
                    alertDiv.innerHTML = `
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-1"></i> ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    
                    const cardBody = document.querySelector('.card-body');
                    cardBody.insertBefore(alertDiv, cardBody.firstChild);
                    
                    // Auto hide after 5 seconds
                    setTimeout(() => {
                        alertDiv.remove();
                    }, 5000);
                }

                function showValidationErrors(errors) {
                    clearValidationErrors();
                    
                    for (const [field, messages] of Object.entries(errors)) {
                        const input = document.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            const feedback = input.nextElementSibling;
                            if (feedback && feedback.classList.contains('invalid-feedback')) {
                                feedback.textContent = messages[0];
                            }
                        }
                    }
                }

                function clearValidationErrors() {
                    const invalidInputs = editForm.querySelectorAll('.is-invalid');
                    invalidInputs.forEach(input => {
                        input.classList.remove('is-invalid');
                        const feedback = input.nextElementSibling;
                        if (feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.textContent = '';
                        }
                    });
                }

                // Reset form when modal is closed
                editModal.addEventListener('hidden.bs.modal', function() {
                    editForm.reset();
                    clearValidationErrors();
                    newFotoPreview.style.display = 'none';
                });
            });
        </script>
    @endpush
@endsection