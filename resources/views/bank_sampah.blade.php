
@extends('layouts.index-menu')

@section('title', 'Ecozyne | Bank Sampah')

@section('content')
  <!-- Page Title -->
  <div class="page-title mt-5">
    <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
      <div class="col-lg-8">
        <h1>Bank Sampah</h1>
        <p class="mb-0">Ayo Salurkan sampah organik anda ke bank sampah terdekat, Anda telah menyelamatkan bumi!</p>
      </div>
      </div>
    </div>
    </div>
    <nav class="breadcrumbs">
    <div class="container">
      <ol>
      <li><a href="/">Beranda</a></li>
      <li class="current">Bank Sampah</li>
      </ol>
    </div>
    </nav>
  </div>

  <div class="container">
    <!-- Filter Section -->
    <div class="card shadow-sm mb-4 mt-4 filter-section">
    <div class="card-header p-3 filter-btn" id="filterToggle">
      <div class="d-flex justify-content-between align-items-center">
      <span class="text-primary d-flex align-items-center">
        <i class="bi bi-funnel-fill me-2"></i> Filter data
      </span>
      <i class="bi bi-chevron-down toggle-icon"></i>
      </div>
    </div>

    <div class="collapse" id="filterData">
      <div class="card-body">
      <form id="filterForm">
        <div class="mb-3">
        <input type="text" class="form-control" id="namaBankInput" placeholder="Masukkan nama Bank Sampah...">
        </div>
        <p>--- Atau ---</P>
        <div class="mb-3">
        <select class="form-select" id="kecamatanSelect">
          <option selected disabled value="">Pilih Kecamatan</option>
          <option value="batamkota">Batam Kota</option>
          <option value="sekupang">Sekupang</option>
          <option value="lubukbaja">Lubuk Baja</option>
          <option value="bengkong">Bengkong</option>
          <option value="baloi">Baloi</option>
          <option value="sei_beduk">Sei Beduk</option>
          <option value="belakangpadang">Belakang Padang</option>
          <option value="nongsapura">Nongsa</option>
          <option value="batuaji">Batu Aji</option>
          <option value="batamcenter">Batam Center</option>
          <option value="galang">Galang</option>
          <option value="sagulung">Sagulung</option>
        </select>
        </div>
        <div class="mb-3">
        <select class="form-select d-none" id="kelurahanSelect">
          <option selected disabled value="">Pilih Kelurahan</option>
        </select>
        </div>
        <div class="d-flex justify-content-end">
        <button type="reset" class="btn btn-info me-2" id="resetFilter">
          <i class="bi bi-arrow-clockwise"></i> Bersihkan
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-funnel-fill"></i> Filter
        </button>
        </div>
      </form>
      </div>
    </div>
    </div>

    <h2 class="text-center mt-6 mb-4">Bank Sampah adalah mitra kami untuk gerakan Zero Waste menuju lingkungan bersih dan
    berkelanjutan.</h2>
    <p class="text-center text-muted mb-5">Temukan Bank Sampah terdekat!</p>

    <div class="row g-4" id="bankSampahList">
    <div class="col-md-6 col-lg-3" data-kecamatan="batamkota" data-kelurahan="belian" data-nama="bank sampah asri">
      <a href="/bank_sampah_asri" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Asri</h5>
        <p class="text-muted small">Bida Asri 2 Blok G18, Belian, Batam Kota</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="sekupang" data-kelurahan="tiban_baru"
      data-nama="bank sampah sejahtera">
      <a href="/bank_sampah_sejahtera" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Sejahtera</h5>
        <p class="text-muted small">Jl. Keluarga No.45, Tiban Baru, Sekupang</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="lubukbaja" data-kelurahan="baloi_indah"
      data-nama="bank sampah perumahan">
      <a href="/bank_sampah_perumahan" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Perumahan</h5>
        <p class="text-muted small">Perumahan Baloi Indah Blok A21, Lubuk Baja</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="bengkong" data-kelurahan="bengkong_indah"
      data-nama="bank sampah berseri">
      <a href="/bank_sampah_berseri" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Berseri</h5>
        <p class="text-muted small">Jl. Bunga Anggrek No.10, Bengkong Indah</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="batamkota" data-kelurahan="sungai_panas"
      data-nama="bank sampah mandiri">
      <a href="/bank_sampah/mandiri" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Mandiri</h5>
        <p class="text-muted small">Komplek Permata Garden No.34, Sungai Panas</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="batuaji" data-kelurahan="buliang" data-nama="bank sampah batuaji">
      <a href="/bank_sampah/batuaji" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Batuaji</h5>
        <p class="text-muted small">Perum Buliang Indah Blok B12, Buliang</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="sagulung" data-kelurahan="sagulung_kota"
      data-nama="bank sampah bersih">
      <a href="/bank_sampah/bersih" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Bersih</h5>
        <p class="text-muted small">Jl. Mawar No.78, Sagulung Kota</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3" data-kecamatan="baloi" data-kelurahan="baloi_permai" data-nama="bank sampah hijau">
      <a href="/bank_sampah/hijau" class="text-decoration-none">
      <div class="card text-center shadow-sm h-100 transition-hover">
        <div class="card-body">
        <i class="fas fa-recycle fa-3x text-success mb-3"></i>
        <h5 class="card-title text-dark">Bank Sampah Hijau</h5>
        <p class="text-muted small">Jl. Setia No.22, Baloi Permai</p>
        </div>
      </div>
      </a>
    </div>

    <!-- Pesan tidak ada hasil -->
    <div class="no-results" id="noResults">
      <div class="alert alert-info">
      <i class="bi bi-info-circle me-2"></i>
      Tidak ada Bank Sampah yang sesuai dengan kriteria pencarian Anda.
      </div>
    </div>

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

      <div class="container">
      <div class="d-flex justify-content-center">
        <ul>
        <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
        <li><a href="#" class="active">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li>...</li>
        <li><a href="#">10</a></li>
        <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
        </ul>
      </div>
      </div>

    </section>

    </div>
  </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const filterToggle = document.getElementById('filterToggle');
    const filterData = document.getElementById('filterData');
    const toggleIcon = document.querySelector('.toggle-icon');
    const kecamatanSelect = document.getElementById("kecamatanSelect");
    const kelurahanSelect = document.getElementById("kelurahanSelect");
    const namaBankInput = document.getElementById("namaBankInput");
    const filterForm = document.getElementById("filterForm");
    const resetFilter = document.getElementById("resetFilter");
    const cards = document.querySelectorAll("#bankSampahList .col-md-6");
    const noResults = document.getElementById("noResults");

    // Toggle filter section
    filterToggle.addEventListener('click', function () {
      const bsCollapse = new bootstrap.Collapse(filterData, {
      toggle: true
      });

      // Change icon
      if (filterData.classList.contains('show')) {
      toggleIcon.classList.replace('bi-chevron-down', 'bi-chevron-up');
      } else {
      toggleIcon.classList.replace('bi-chevron-up', 'bi-chevron-down');
      }
    });

    filterData.addEventListener('show.bs.collapse', () => {
      toggleIcon.classList.replace('bi-chevron-down', 'bi-chevron-up');
    });

    filterData.addEventListener('hide.bs.collapse', () => {
      toggleIcon.classList.replace('bi-chevron-up', 'bi-chevron-down');
    });

    // Kelurahan data
    const kelurahanData = {
      batamkota: ["Belian", "Teluk Tering", "Sungai Panas", "Baloi Permai", "Taman Baloi"],
      sekupang: ["Tiban Lama", "Tiban Baru", "Patam Lestari", "Tanjung Pinggir"],
      lubukbaja: ["Baloi Indah", "Tanjung Uma", "Kampung Pelita", "Lubuk Baja Kota"],
      bengkong: ["Bengkong Laut", "Bengkong Sadai", "Bengkong Indah"],
      baloi: ["Baloi Kolam", "Baloi Permai"],
      sei_beduk: ["Mangsang", "Duriangkang", "Tanjung Piayu"],
      belakangpadang: ["Kasai", "Pemping", "Sambu", "Pecung"],
      nongsapura: ["Kabil", "Sambau", "Ngenang", "Batu Besar"],
      batuaji: ["Bukit Tempayan", "Buliang", "Tanjung Uncang"],
      batamcenter: ["Teluk Tering", "Sungai Panas", "Baloi Permai"],
      galang: ["Pulau Abang", "Air Raja"],
      sagulung: ["Sei Lekop", "Sungai Langkai", "Tembesi", "Sagulung Kota"]
    };

    // Populate kelurahan dropdown when kecamatan changes
    kecamatanSelect.addEventListener("change", function () {
      const selected = this.value;
      const kelurahans = kelurahanData[selected] || [];

      kelurahanSelect.innerHTML = '<option selected disabled value="">Pilih Kelurahan</option>';

      kelurahans.forEach(kel => {
      const opt = document.createElement("option");
      opt.value = kel.toLowerCase().replace(/\s+/g, "_");
      opt.textContent = kel;
      kelurahanSelect.appendChild(opt);
      });

      if (kelurahans.length > 0) {
      kelurahanSelect.classList.remove("d-none");
      } else {
      kelurahanSelect.classList.add("d-none");
      }
    });

    // Filter function
    function filterBankSampah() {
      const kecValue = kecamatanSelect.value;
      const kelValue = kelurahanSelect.value;
      const namaValue = namaBankInput.value.trim().toLowerCase();

      let visibleCount = 0;

      cards.forEach(card => {
      // Filter logic with AND conditions
      const kecMatch = !kecValue || card.dataset.kecamatan === kecValue;
      const kelMatch = !kelValue || card.dataset.kelurahan === kelValue;
      const namaMatch = !namaValue || card.dataset.nama.toLowerCase().includes(namaValue);

      // Show/hide based on all conditions
      if (kecMatch && kelMatch && namaMatch) {
        card.style.display = "";
        visibleCount++;
      } else {
        card.style.display = "none";
      }
      });

      // Show no results message if needed
      if (visibleCount === 0) {
      noResults.style.display = "block";
      } else {
      noResults.style.display = "none";
      }
    }

    // Form submit handler
    filterForm.addEventListener("submit", function (e) {
      e.preventDefault();
      filterBankSampah();
    });

    // Reset filter
    resetFilter.addEventListener("click", function () {
      kecamatanSelect.selectedIndex = 0;
      kelurahanSelect.classList.add("d-none");
      kelurahanSelect.innerHTML = '<option selected disabled value="">Pilih Kelurahan</option>';
      namaBankInput.value = "";

      // Reset display
      cards.forEach(card => {
      card.style.display = "";
      });
      noResults.style.display = "none";
    });

    // Enable searching as user types
    namaBankInput.addEventListener("input", function () {
      if (this.value.length > 2 || this.value.length === 0) {
      filterBankSampah();
      }
    });
    });
  </script>

@endsection