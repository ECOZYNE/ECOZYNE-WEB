<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Ecozyne</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">

    <meta name="description" content="Ecozyne - Sistem Pengelolaan Sampah dan Komunitas Berkelanjutan">
    <meta name="keywords" content="ecozyne, pengelolaan sampah, komunitas berkelanjutan, e-commerce">
    <meta name="author" content="Ecozyne Team">

    <style>
        .profile-dropdown {
            display: flex;
            align-items: center;
            margin-left: 30px;
        }

        .profile-dropdown img {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-dropdown img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 5px rgba(127, 201, 127, 0.5);
        }

        .profile-dropdown img[aria-expanded="true"] {
            animation: glow 2s infinite;
            border: 2px solid #7FC97F;
            box-shadow: 0 0 15px rgba(127, 201, 127, 0.8);
            transform: scale(1.05);
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 5px #7FC97F;
            }

            50% {
                box-shadow: 0 0 20px #115511;
            }

            100% {
                box-shadow: 0 0 5px #7FC97F;
            }
        }

        /* MODERN MOBILE STYLES */
        @media (max-width: 1114px) {

            /* Enhanced Mobile Navigation */
            .navmenu {
                /* Mengubah ini untuk menghilangkan background putih dan efek blur */
                background: transparent;
                backdrop-filter: none;
                -webkit-backdrop-filter: none;
                border-radius: 0; /* Hapus border-radius jika tidak diinginkan */
                box-shadow: none; /* Hapus bayangan jika tidak diinginkan */
            }

            .navmenu ul {
                padding: 0;
                margin: 0;
            }

            .navmenu li {
                border-bottom: 1px solid rgba(40, 167, 69, 0.1);
                transform: translateX(-20px);
                opacity: 0;
                animation: slideInFromLeft 0.5s ease forwards;
            }

            .navmenu li:nth-child(1) {
                animation-delay: 0.1s;
            }

            .navmenu li:nth-child(2) {
                animation-delay: 0.2s;
            }

            .navmenu li:nth-child(3) {
                animation-delay: 0.3s;
            }

            .navmenu li:nth-child(4) {
                animation-delay: 0.4s;
            }

            .navmenu li:nth-child(5) {
                animation-delay: 0.5s;
            }

            .navmenu li:nth-child(6) {
                animation-delay: 0.6s;
            }

            .navmenu li:nth-child(7) {
                animation-delay: 0.7s;
            }

            .navmenu li:nth-child(8) {
                animation-delay: 0.8s;
            }

            @keyframes slideInFromLeft {
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            /* Modern Mobile Profile Section */
            .mobile-profile {
                padding: 20px 25px;
                background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
                border-radius: 0 0 15px 15px;
                margin-bottom: 10px;
                box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
                position: relative;
                overflow: hidden;
            }

            .mobile-profile::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 100px;
                height: 100px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                transform: translate(30px, -30px);
            }

            .mobile-profile::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 80px;
                height: 80px;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 50%;
                transform: translate(-20px, 20px);
            }

            .mobile-profile-left {
                display: flex;
                align-items: center;
                gap: 15px;
                position: relative;
                z-index: 2;
            }

            .mobile-profile img {
                width: 55px;
                height: 55px;
                border-radius: 50%;
                border: 3px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                transition: all 0.3s ease;
                position: relative;
            }

            .mobile-profile img:hover {
                transform: scale(1.05);
                border-color: rgba(255, 255, 255, 0.6);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .mobile-profile-info {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .mobile-profile-info .points {
                margin: 0;
                font-size: 1.2rem;
                font-weight: 700;
                color: #ffc107;
                display: flex;
                align-items: center;
                gap: 8px;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .mobile-profile-info .points i {
                font-size: 1.1rem;
                animation: sparkle 2s infinite;
                filter: drop-shadow(0 0 5px rgba(255, 193, 7, 0.5));
            }

            @keyframes sparkle {

                0%,
                100% {
                    transform: scale(1) rotate(0deg);
                }

                50% {
                    transform: scale(1.1) rotate(5deg);
                }
            }

            .mobile-profile-info .username {
                margin: 0;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.9);
                font-weight: 500;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }

            .mobile-logout-btn {
                padding: 10px 20px;
                font-size: 0.85rem;
                border: 2px solid rgba(255, 255, 255, 0.3);
                color: white;
                background: rgba(220, 53, 69, 0.8);
                border-radius: 25px;
                transition: all 0.3s ease;
                font-weight: 600;
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                position: relative;
                z-index: 2;
                box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            }

            .mobile-logout-btn:hover {
                background: rgba(220, 53, 69, 1);
                border-color: rgba(255, 255, 255, 0.5);
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            }

            /* Modern Mobile Account Menu */
            .mobile-account-menu {
                display: flex;
                align-items: center;
                gap: 15px;
                color: #28a745;
                text-decoration: none;
                padding: 18px 25px;
                background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
                border-left: 4px solid transparent;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                margin: 0 10px;
                border-radius: 10px;
            }

            .mobile-account-menu::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                transition: left 0.6s ease;
            }

            /* Menghilangkan efek hover pada mobile-account-menu */
            .mobile-account-menu:hover::before {
                left: -100%; /* Memastikan tidak ada efek geser */
            }

            .mobile-account-menu:hover {
                background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%); /* Kembali ke background non-hover */
                color: #28a745; /* Kembali ke warna teks non-hover */
                transform: translateX(0); /* Menghilangkan translasi */
                border-left-color: transparent; /* Menghilangkan border kiri */
                box-shadow: none; /* Menghilangkan bayangan */
            }

            .mobile-account-menu i {
                font-size: 1.2rem;
                width: 25px;
                text-align: center;
                transition: all 0.3s ease;
            }

            .mobile-account-menu:hover i {
                transform: rotate(0deg); /* Menghilangkan rotasi ikon */
            }

            .mobile-account-menu span {
                font-weight: 600;
                font-size: 1rem;
                letter-spacing: 0.5px;
            }

            /* Enhanced Navigation Links */
            .navmenu a {
                display: block;
                padding: 18px 25px;
                font-size: 1.05rem;
                font-weight: 500;
                color: #333;
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
                border-left: 4px solid transparent;
                margin: 0 10px;
                border-radius: 10px;
            }

            /* Menghilangkan efek hover pada navmenu a */
            .navmenu a::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 0 !important; /* Penting: gunakan !important untuk menimpa gaya */
                height: 100%;
                background: transparent !important; /* Pastikan background pada pseudo-element transparan */
                transition: none; /* Menghilangkan transisi */
                border-radius: 10px;
            }

            .navmenu a:hover::before {
                width: 0; /* Menghilangkan efek background expand pada hover */
            }

            .navmenu a:hover,
            .navmenu a.active { /* 'active' tetap dipertahankan jika diinginkan */
                color: #28a745; /* Tetap pertahankan warna aktif */
                background: transparent;
                border-left-color: #28a745; /* Tetap pertahankan border aktif */
                transform: translateX(0); /* Menghilangkan translasi pada hover */
                font-weight: 500; /* Mengembalikan berat font ke default */
                box-shadow: none; /* Menghilangkan bayangan pada hover */
            }
            
            /* Pastikan gaya 'active' tetap berfungsi */
            .navmenu a.active {
                color: #28a745;
                background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
                border-left-color: #28a745;
                transform: translateX(5px);
                font-weight: 600;
                box-shadow: 0 3px 10px rgba(40, 167, 69, 0.15);
            }


            /* Mobile Navigation Toggle - SIMPLE VERSION WITHOUT HOVER */
            .mobile-nav-toggle {
                font-size: 1.5rem;
                color: #28a745;
                background: transparent;
                border: none;
                padding: 10px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Smooth Animations */
            .navmenu,
            .navmenu * {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Enhanced Focus States */
            .mobile-logout-btn:focus,
            .mobile-account-menu:focus,
            .navmenu a:focus {
                outline: 2px solid #28a745;
                outline-offset: 2px;
            }

            /* Improved Typography */
            .mobile-profile-info .points {
                font-family: 'Segoe UI', system-ui, sans-serif;
                letter-spacing: 0.5px;
            }

            .mobile-profile-info .username {
                font-family: 'Segoe UI', system-ui, sans-serif;
                letter-spacing: 0.3px;
            }

            /* Loading Animation for Profile Image */
            .mobile-profile img {
                background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%),
                    linear-gradient(-45deg, #f0f0f0 25%, transparent 25%),
                    linear-gradient(45deg, transparent 75%, #f0f0f0 75%),
                    linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
                background-size: 20px 20px;
                background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            }

            /* Micro-interactions */
            .mobile-profile {
                transform: translateY(-2px);
                animation: slideDown 0.4s ease;
            }

            @keyframes slideDown {
                from {
                    transform: translateY(-10px);
                    opacity: 0;
                }

                to {
                    transform: translateY(-2px);
                    opacity: 1;
                }
            }

            /* Enhanced Shadows */
            .mobile-profile { /* Hanya pada mobile-profile, hilangkan dari hover navmenu a */
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            }
            .mobile-account-menu:hover { /* Hilangkan hover shadow jika tidak diinginkan */
                box-shadow: none;
            }
            .navmenu a:hover { /* Hilangkan hover shadow jika tidak diinginkan */
                box-shadow: none;
            }


            /* Responsive Text Scaling */
            @media (max-width: 480px) {
                .mobile-profile-info .points {
                    font-size: 1.1rem;
                }

                .mobile-profile-info .username {
                    font-size: 0.85rem;
                }

                .mobile-logout-btn {
                    font-size: 0.8rem;
                    padding: 8px 16px;
                }
            }
        }
    </style>
</head>

<body>

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets2/img/ecozyne.png') }}" alt="Ecozyne Logo">
                <h1 class="sitename">Ecozyne</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @php
                        use App\Models\Komunitas;
                        $user = Auth::user();
                    @endphp

                    @if ($user && $user->id_user && $user->role === 'komunitas')
                        @php
                            $komunitas = \App\Models\Komunitas::where('id_user', $user->id_user)->first();
                            $point = $user->komunitas->point->point ?? 0;
                        @endphp
                        <li class="d-block d-xl-none">
                            <div class="mobile-profile">
                                <div class="mobile-profile-left">
                                    <img src="{{ $komunitas ? $komunitas->foto : asset('assets/images/profile/users.png') }}" alt="Profil">
                                    <div class="mobile-profile-info">
                                        <p class="points">
                                            <i class="fas fa-star"></i>
                                            {{ $point }} XP
                                        </p>
                                        <p class="username">{{ $komunitas ? $komunitas->nama : 'Komunitas' }}</p>
                                    </div>
                                </div>
                                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                                    @csrf
                                    <button type="submit" class="mobile-logout-btn mt-3">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                        <li class="d-block d-xl-none">
                            <a href="{{ url('dashboard/index') }}" class="mobile-account-menu mb-2">
                                <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
                                <span>Akun Saya</span>
                            </a>
                        </li>
                    @endif

                    <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                            </i>Beranda
                        </a></li>
                    <li><a href="{{ url('tentang-eco-enzim') }}" class="{{ request()->is('tentang-eco-enzim') ? 'active' : '' }}">
                            </i>Tentang Kami
                        </a></li>
                    <li><a href="{{ url('kegiatan') }}" class="{{ request()->is('kegiatan') ? 'active' : '' }}">
                            </i>Kegiatan
                        </a></li>
                    <li><a href="{{ url('artikel') }}" class="{{ request()->is('artikel') ? 'active' : '' }}">
                            </i>Artikel
                        </a></li>
                    <li><a href="{{ url('bank_sampah') }}" class="{{ request()->is('bank_sampah') ? 'active' : '' }}">
                            </i>Bank Sampah
                        </a></li>
                    <li><a href="#footer">
                            </i>Kontak
                        </a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @if ($user && $user->id_user)
                @if ($user->role !== 'komunitas')
                    <a class="btn-getstarted flex-md-shrink-0" href="/login">Bergabung!</a>
                @else
                    @php
                        $komunitas = Komunitas::where('id_user', $user->id_user)->first();
                        $point = $user->komunitas->point->point ?? 0;
                    @endphp
                    <div class="profile-dropdown d-none d-xl-flex">
                        <a href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $komunitas ? $komunitas->foto : asset('assets/images/profile/users.png') }}" alt="Foto Komunitas"
                                width="40" height="40" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="{{ url('dashboard/index') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="fas fa-star fs-4 text-warning"></i>
                                    <div>
                                        <p class="mb-0 fs-3 fw-bold">{{ $point }} XP</p>
                                    </div>
                                </a>
                                <a href="{{ url('dashboard/index') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="fas fa-user fs-4" style="color: #03af37;"></i>
                                    <p class="mb-0 fs-3 fw-bold">Akun Saya</p>
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger mx-3 mt-3 d-block">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <a class="btn-getstarted flex-md-shrink-0" href="/login">Bergabung!</a>
            @endif

        </div>
    </header>

</body>

</html>