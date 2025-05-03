<style>
    .bg-custom {
        background-color: #f8fcf6 !important;
    }

    .shadow-custom {
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil URL saat ini
        let currentUrl = window.location.pathname;

        // Seleksi semua link dalam sidebar
        let menuLinks = document.querySelectorAll(".sidebar-link");

        // Loop melalui semua link
        menuLinks.forEach(link => {
            // Hapus semua kelas 'active' terlebih dahulu
            link.classList.remove("active");

            // Jika href dari menu cocok dengan URL saat ini, tambahkan 'active'
            if (link.getAttribute("href") === currentUrl) {
                link.classList.add("active");

                // Pastikan parent menu terbuka (untuk sub-menu)
                let parentMenu = link.closest(".collapse");
                if (parentMenu) {
                    parentMenu.classList.add("show"); // Pastikan sub-menu terbuka
                    let parentLink = parentMenu.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add("active");
                    }
                }
            }
        });
    });
</script>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index" class="text-nowrap logo-img d-flex align-items-center">
                    <img src="../assets/images/logos/ecozyne.png" width="50" alt="" />
                    <span class="ms-2 fw-bolder  text-dark fs-6">Ecozyne</span>
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>

            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link active" href="./index" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Menu Utama</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                            <span>
                                <i class="ti ti-shopping-cart"></i>
                            </span>
                            <span class="hide-menu">Pesanan Anda</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                            <span>
                                <i class="ti ti-gift"></i>
                            </span>
                            <span class="hide-menu">Penukaran Hadiah</span>
                        </a>
                    </li>

                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded p-3">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="unlimited-access-title">
                            <h6 class="fw-semibold fs-4 mb-3 text-dark">Menjadi<br> Bank Sampah?</h6>
                            <a href="pengajuan_bank_sampah" target="_blank" rel="noopener noreferrer" class="btn btn-success fs-4 fw-semibold">Mulai!</a>
                        </div>
                          <div class="unlimited-access-img" style="margin-top: 10px;">
                            <img src="../assets/images/backgrounds/garbage.png" alt="Gambar Sampah" style="max-width: 100px; height: auto;">
                          </div>
                        </div>
                      </div>
                      


                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Bank Sampah</span>
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
                            <a href="./add-komunitas" class="sidebar-link">
                              <span class="hide-menu">Tambah Porduk</span>
                            </a>
                          </li>
                          <li class="sidebar-item">
                            <a href="./view-komunitas" class="sidebar-link">
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
                            <a href="./add-komunitas" class="sidebar-link">
                              <span class="hide-menu">Pesanan Produk</span>
                            </a>
                          </li>
                          <li class="sidebar-item">
                            <a href="./add-komunitas" class="sidebar-link">
                              <span class="hide-menu">Riwayat Pesanan</span>
                            </a>
                          </li>
                        </ul>
                      </li>

                    <hr>

                    <x-version-info />

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->