@php
    $role = Auth::user()->role ?? '';
@endphp

@push('style')
    <style>
        .bg-custom {
            background-color: #f8fcf6 !important;
        }

        .shadow-custom {
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentUrl = window.location.pathname;
            let menuLinks = document.querySelectorAll(".sidebar-link");
            menuLinks.forEach(link => {
                link.classList.remove("active");
                if (link.getAttribute("href") === currentUrl) {
                    link.classList.add("active");
                    let parentMenu = link.closest(".collapse");
                    if (parentMenu) {
                        parentMenu.classList.add("show");
                        let parentLink = parentMenu.previousElementSibling;
                        if (parentLink) parentLink.classList.add("active");
                    }
                }
            });
        });
    </script>
@endpush

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index" class="text-nowrap logo-img d-flex align-items-center">
                    <img src="{{ asset('assets/images/logos/ecozyne.png') }}" width="50" alt="" />
                    <span class="ms-2 fw-bolder text-dark fs-6">Ecozyne</span>
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>

            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./index" aria-expanded="false">
                            <span><i class="ti ti-layout-dashboard"></i></span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    @if ($role === 'admin')
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Menu Utama</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Kelola Komunitas</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-komunitas" class="sidebar-link">
                                        <span class="hide-menu">Tambah Komunitas</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-komunitas" class="sidebar-link">
                                        <span class="hide-menu">Data Komunitas</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="hide-menu">Kelola Bank Sampah</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./persetujuan-bank-sampah" class="sidebar-link">
                                        <span class="hide-menu">Persetujuan Bank Sampah</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-bank-sampah" class="sidebar-link">
                                        <span class="hide-menu">Data Bank Sampah</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Kelola Artikel</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-artikel" class="sidebar-link">
                                        <span class="hide-menu">Tambah Artikel</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-artikel" class="sidebar-link">
                                        <span class="hide-menu">Data Artikel</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-book"></i>
                                </span>
                                <span class="hide-menu">Kelola Komik</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-komik" class="sidebar-link">
                                        <span class="hide-menu">Tambah Komik</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-komik" class="sidebar-link">
                                        <span class="hide-menu">Data Komik</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-pin"></i>
                                </span>
                                <span class="hide-menu">Kelola Kegiatan</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-kegiatan" class="sidebar-link">
                                        <span class="hide-menu">Tambah Kegiatan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-kegiatan" class="sidebar-link">
                                        <span class="hide-menu">Data Kegiatan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-peserta-kegiatan" class="sidebar-link">
                                        <span class="hide-menu">Data Pendaftar Kegiatan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-camera"></i>
                                </span>
                                <span class="hide-menu">Kelola Galeri</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-galeri" class="sidebar-link">
                                        <span class="hide-menu">Tambah Galeri</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-galeri" class="sidebar-link">
                                        <span class="hide-menu">Data Galeri</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-gift"></i>
                                </span>
                                <span class="hide-menu">Kelola Hadiah</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-hadiah" class="sidebar-link">
                                        <span class="hide-menu">Tambah Hadiah</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-hadiah" class="sidebar-link">
                                        <span class="hide-menu">Data Hadiah</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-truck"></i>
                                </span>
                                <span class="hide-menu">Kelola Penukaran</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./konfirmasi-penukaran" class="sidebar-link">
                                        <span class="hide-menu">Konfirmasi Penukaran</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-penukaran" class="sidebar-link">
                                        <span class="hide-menu">Penukaran Hadiah</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./riwayat-penukaran" class="sidebar-link">
                                        <span class="hide-menu">Riwayat Penukaran</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <hr>
                        <x-version-info />
                    @elseif($role === 'komunitas')
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Menu Utama</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./my-kegiatan" aria-expanded="false">
                                <span>
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <span class="hide-menu">Kegiatan Anda</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-truck"></i>
                                </span>
                                <span class="hide-menu">Pesanan Anda</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./my-pesanan-produk" class="sidebar-link">
                                        <span class="hide-menu">Pesanan Produk</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./my-riwayat-pesanan-produk" class="sidebar-link">
                                        <span class="hide-menu">Riwayat Pesanan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-gift"></i>
                                </span>
                                <span class="hide-menu">Penukaran Anda</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./my-penukaran-hadiah" class="sidebar-link">
                                        <span class="hide-menu">Penukaran Hadiah</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./my-riwayat-penukaran-hadiah" class="sidebar-link">
                                        <span class="hide-menu">Riwayat Penukaran</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @php
                            $user = Auth::user();
                            $isBankSampah = false;

                            if ($user && $user->role === 'komunitas') {
                                $komunitas = \App\Models\Komunitas::where('id_user', $user->id_user)->first();
                                if ($komunitas) {
                                    $pengajuan = \App\Models\PengajuanBankSampah::where(
                                        'id_komunitas',
                                        $komunitas->id_komunitas,
                                    )
                                        ->where('status', 'diterima')
                                        ->first();
                                    if ($pengajuan) {
                                        $bankSampah = \App\Models\BankSampah::where(
                                            'id_pengajuan_bank_sampah',
                                            $pengajuan->id_pengajuan_bank_sampah,
                                        )->first();
                                        $isBankSampah = $bankSampah !== null;
                                    }
                                }
                            }
                        @endphp

                        {{-- Cek apakah komunitas sudah menjadi Bank Sampah --}}

                        @if ($isBankSampah)
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Bank Sampah</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="./kelola-bank-sampah" aria-expanded="false">
                                    <span><i class="ti ti-recycle"></i></span>
                                    <span class="hide-menu">Kelola Bank Sampah</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                    style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                    <span>
                                        <i class="ti ti-package"></i>
                                    </span>
                                    <span class="hide-menu">Kelola Setor Sampah</span>
                                    <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                                </a>
                                <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                    <li class="sidebar-item">
                                        <a href="./add-setor-sampah" class="sidebar-link">
                                            <span class="hide-menu">Buat Setoran Sampah</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="./riwayat-setor-sampah" class="sidebar-link">
                                            <span class="hide-menu">Riwayat Setor Sampah</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                    style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                    <span>
                                        <i class="ti ti-package"></i>
                                    </span>
                                    <span class="hide-menu">Kelola Produk</span>
                                    <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                                </a>
                                <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                    <li class="sidebar-item">
                                        <a href="./add-produk" class="sidebar-link">
                                            <span class="hide-menu">Tambah Porduk</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="./view-produk" class="sidebar-link">
                                            <span class="hide-menu">Data Produk</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                    style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                    <span>
                                        <i class="ti ti-truck"></i>
                                    </span>
                                    <span class="hide-menu">Penjualan Produk</span>
                                    <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                                </a>
                                <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                    <li class="sidebar-item">
                                        <a href="./konfirmasi-pesanan-produk" class="sidebar-link">
                                            <span class="hide-menu">Konfirmasi Pesanan Produk</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="./view-pesanan-produk" class="sidebar-link">
                                            <span class="hide-menu">Pesanan Produk</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="./riwayat-pesanan-produk" class="sidebar-link">
                                            <span class="hide-menu">Riwayat Pesanan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- Tampilkan fitur Bank Sampah --}}
                            {{-- @include('partials.bank-sampah-menu') --}}
                        @else
                            {{-- Tampilkan prompt ajukan Bank Sampah --}}
                            <div
                                class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="unlimited-access-title">
                                        <h6 class="fw-semibold fs-4 mb-3 text-dark">Menjadi<br> Bank Sampah?</h6>
                                        <a href="./pengajuan-bank-sampah"
                                            class="btn btn-success fs-4 fw-semibold">Mulai!</a>
                                    </div>
                                    <div class="unlimited-access-img" style="margin-top: 10px;">
                                        <img src="../assets/images/backgrounds/garbage.png" alt="Gambar Sampah"
                                            style="max-width: 100px; height: auto;">
                                    </div>
                                </div>
                            </div>
                        @endif


                        {{-- <div
                            class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="unlimited-access-title">
                                    <h6 class="fw-semibold fs-4 mb-3 text-dark">Menjadi<br> Bank Sampah?</h6>
                                    <a href="./pengajuan-bank-sampah" class="btn btn-success fs-4 fw-semibold">Mulai!</a>
                                </div>
                                <div class="unlimited-access-img" style="margin-top: 10px;">
                                    <img src="../assets/images/backgrounds/garbage.png" alt="Gambar Sampah"
                                        style="max-width: 100px; height: auto;">
                                </div>
                            </div>
                        </div> --}}

                        <!-- Sidebar bank sampah-->

                        {{-- <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Bank Sampah</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="hide-menu">Kelola Setor Sampah</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-setor-sampah" class="sidebar-link">
                                        <span class="hide-menu">Buat Setoran Sampah</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./riwayat-setor-sampah" class="sidebar-link">
                                        <span class="hide-menu">Riwayat Setor Sampah</span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-package"></i>
                                </span>
                                <span class="hide-menu">Kelola Produk</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./add-produk" class="sidebar-link">
                                        <span class="hide-menu">Tambah Porduk</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-produk" class="sidebar-link">
                                        <span class="hide-menu">Data Produk</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false"
                                style="display: flex; justify-content: space-between; align-items: center; padding-right: 10px;">
                                <span>
                                    <i class="ti ti-truck"></i>
                                </span>
                                <span class="hide-menu">Penjualan Produk</span>
                                <span class="dropdown-icon" style="margin-left: auto;">▾</span>
                            </a>
                            <ul class="collapse first-level bg-custom shadow-custom rounded p-2">
                                <li class="sidebar-item">
                                    <a href="./konfirmasi-pesanan-produk" class="sidebar-link">
                                        <span class="hide-menu">Konfirmasi Pesanan Produk</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./view-pesanan-produk" class="sidebar-link">
                                        <span class="hide-menu">Pesanan Produk</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./riwayat-pesanan-produk" class="sidebar-link">
                                        <span class="hide-menu">Riwayat Pesanan</span>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <hr>
                        <x-version-info />
                    @endif

                </ul>
            </nav>
        </div>
    </aside>
