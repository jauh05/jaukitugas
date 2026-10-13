<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jauki Tugas | Joki Tugas Jogja Terpercaya</title>

    <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- Jika jsDelivr gagal dimuat (jaringan tertentu), pakai cdnjs agar tampilan tidak hilang -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        onerror="this.onerror=null;this.href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css';">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        onerror="this.onerror=null;this.href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css';">

    <!-- GSAP for Premium Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />

    <style>
        /* Palet diambil dari contoh desain: krem peach, cokelat, oranye, kuning, hijau, biru, pink */
        :root {
            --jt-cream: #FFE8D0;
            --jt-cream-light: #FEF4EB;
            --jt-brown: #532923;
            --jt-brown-hover: #6E3B31;
            --jt-muted: #7D5F54;
            --jt-orange: #E07540;
            --jt-yellow: #F3C75F;
            --jt-green: #46A375;
            --jt-blue: #7CB1EB;
            --jt-pink: #F4A6B8;
            --jt-shadow: 0 16px 36px rgba(83, 41, 35, 0.10);
            --jt-shadow-sm: 0 6px 18px rgba(83, 41, 35, 0.08);

            /* Override tema Bootstrap supaya utilitas bawaan ikut palet baru */
            --bs-primary: #532923;
            --bs-primary-rgb: 83, 41, 35;
            --bs-dark: #532923;
            --bs-dark-rgb: 83, 41, 35;
            --bs-secondary-color: #7D5F54;
            --bs-light: #FEF4EB;
            --bs-light-rgb: 254, 244, 235;
            --bs-warning: #F3C75F;
            --bs-warning-rgb: 243, 199, 95;
            --bs-success: #46A375;
            --bs-success-rgb: 70, 163, 117;
            --bs-danger: #E07540;
            --bs-danger-rgb: 224, 117, 64;
            --bs-info: #7CB1EB;
            --bs-info-rgb: 124, 177, 235;
            --bs-border-color: rgba(83, 41, 35, 0.12);
            --bs-link-color: #532923;
            --bs-link-color-rgb: 83, 41, 35;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFFFFF;
            color: var(--jt-brown);
            overflow-x: hidden;
            min-height: 100vh;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            color: var(--jt-brown);
            letter-spacing: -0.02em;
        }

        /* Kartu putih dengan sudut besar, dipakai di semua halaman publik */
        .glass-card {
            background: #FFFFFF;
            border: 0;
            border-radius: 28px;
            box-shadow: var(--jt-shadow);
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .glass-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 44px rgba(83, 41, 35, 0.14);
        }

        /* Kartu arch: lengkung penuh di bagian atas, untuk frame gambar */
        .jt-arch {
            border-radius: 50% 50% 24px 24px / 36% 36% 24px 24px;
            overflow: hidden;
            position: relative;
        }

        .jt-arch > img,
        .jt-arch > svg {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .jt-arch > img.jt-cover {
            object-fit: cover;
        }

        /* Baris list pill putih (gaya "Weekly Podcast") */
        .jt-list-row {
            background: #FFFFFF;
            border-radius: 26px;
            box-shadow: var(--jt-shadow-sm);
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.55rem 0.6rem 0.55rem 0.55rem;
            color: var(--jt-brown);
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .jt-list-row:hover {
            transform: translateX(4px);
            box-shadow: var(--jt-shadow);
            color: var(--jt-brown);
        }

        .jt-list-body {
            flex: 1 1 auto;
            min-width: 0;
        }

        .jt-thumb {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .jt-thumb svg,
        .jt-thumb img {
            width: 100%;
            height: 100%;
        }

        .jt-play {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--jt-yellow);
            color: var(--jt-brown);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-left: auto;
        }

        /* Ikon centang kuning (gaya "What makes us different") */
        .jt-check {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--jt-yellow);
            color: var(--jt-brown);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Angka statistik oranye besar */
        .jt-stat-num {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: var(--jt-orange);
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .jt-stat-label {
            color: var(--jt-brown);
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Banner cokelat gelap dengan CTA kuning (gaya "Listen to the latest") */
        .jt-banner {
            background: var(--jt-brown);
            color: #FFFFFF;
            border-radius: 36px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 24px 50px rgba(83, 41, 35, 0.25);
        }

        .jt-banner h1,
        .jt-banner h2,
        .jt-banner h3,
        .jt-banner h4,
        .jt-banner h5 {
            color: #FFFFFF;
        }

        .jt-banner p {
            color: rgba(255, 255, 255, 0.85);
        }

        .jt-banner .jt-content {
            position: relative;
            z-index: 1;
        }

        /* Shape dekoratif geometris, pengganti blob blur */
        .jt-shape {
            position: absolute;
            pointer-events: none;
            z-index: 0;
            background: var(--c, var(--jt-orange));
        }

        .jt-shape--semi {
            width: 150px;
            height: 75px;
            border-radius: 150px 150px 0 0;
        }

        .jt-shape--quarter {
            width: 140px;
            height: 140px;
            border-radius: 100% 0 0 0;
        }

        .jt-shape--ring {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: transparent;
            border: 22px solid var(--c, var(--jt-green));
        }

        .jt-shape--dot {
            width: 26px;
            height: 26px;
            border-radius: 50%;
        }

        .jt-shape--pill {
            width: 110px;
            height: 36px;
            border-radius: 999px;
        }

        .jt-shape--blob {
            width: 130px;
            height: 130px;
            border-radius: 62% 38% 55% 45% / 48% 60% 40% 52%;
        }

        .jt-shape--spark {
            width: 44px;
            height: 44px;
            clip-path: polygon(50% 0, 62% 38%, 100% 50%, 62% 62%, 50% 100%, 38% 62%, 0 50%, 38% 38%);
        }

        /* Chip dan label kecil */
        .jt-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 999px;
            padding: 0.35rem 0.85rem;
            font-weight: 700;
            font-size: 0.78rem;
            background: #FFFFFF;
            color: var(--jt-brown);
            box-shadow: var(--jt-shadow-sm);
        }

        .jt-eyebrow {
            display: inline-block;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.75rem;
            color: var(--jt-orange);
        }

        /* Warna utilitas sendiri */
        .text-jt-orange { color: var(--jt-orange) !important; }
        .text-jt-brown { color: var(--jt-brown) !important; }
        .bg-jt-yellow { background-color: var(--jt-yellow) !important; }
        .bg-jt-green { background-color: var(--jt-green) !important; }
        .bg-jt-blue { background-color: var(--jt-blue) !important; }
        .bg-jt-pink { background-color: var(--jt-pink) !important; }
        .bg-jt-orange { background-color: var(--jt-orange) !important; }
        .bg-jt-brown { background-color: var(--jt-brown) !important; }
        .bg-jt-cream-light { background-color: var(--jt-cream-light) !important; }

        /* Glass navbar dan footer diganti krem solid */
        .glass-nav {
            background: #FFFFFF !important;
            border-bottom: 0;
            box-shadow: none;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .glass-footer {
            background: var(--jt-cream-light);
            border-top: 0;
            padding: 3.5rem 0 2rem;
            margin-top: 3rem;
        }

        /* Tombol: CTA utama kuning pill dengan teks cokelat */
        .btn-premium {
            background: var(--jt-yellow);
            border: none;
            color: var(--jt-brown);
            font-weight: 800;
            padding: 0.8rem 2rem;
            border-radius: 999px;
            box-shadow: 0 10px 22px rgba(243, 199, 95, 0.45);
            transition: all 0.3s ease;
        }

        .btn-premium:hover,
        .btn-premium:focus {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(243, 199, 95, 0.55);
            color: var(--jt-brown);
            background: #F7D27A;
        }

        .btn-glass-outline-premium {
            background: #FFFFFF;
            border: 2px solid rgba(83, 41, 35, 0.10);
            color: var(--jt-brown);
            border-radius: 999px;
            transition: all 0.3s ease;
        }

        .btn-glass-outline-premium:hover {
            border-color: var(--jt-orange);
            box-shadow: var(--jt-shadow-sm);
            transform: translateY(-2px);
        }

        .btn-primary {
            --bs-btn-color: #FFFFFF;
            --bs-btn-bg: #532923;
            --bs-btn-border-color: #532923;
            --bs-btn-hover-color: #FFFFFF;
            --bs-btn-hover-bg: #6E3B31;
            --bs-btn-hover-border-color: #6E3B31;
            --bs-btn-focus-shadow-rgb: 83, 41, 35;
            --bs-btn-active-color: #FFFFFF;
            --bs-btn-active-bg: #6E3B31;
            --bs-btn-active-border-color: #6E3B31;
            --bs-btn-disabled-color: #FFFFFF;
            --bs-btn-disabled-bg: #532923;
            --bs-btn-disabled-border-color: #532923;
            font-weight: 700;
        }

        .btn-outline-primary {
            --bs-btn-color: #532923;
            --bs-btn-border-color: #532923;
            --bs-btn-hover-color: #FFFFFF;
            --bs-btn-hover-bg: #532923;
            --bs-btn-hover-border-color: #532923;
            --bs-btn-focus-shadow-rgb: 83, 41, 35;
            --bs-btn-active-color: #FFFFFF;
            --bs-btn-active-bg: #532923;
            --bs-btn-active-border-color: #532923;
            --bs-btn-disabled-color: #532923;
            --bs-btn-disabled-border-color: #532923;
        }

        .bg-whatsapp {
            background-color: #25D366 !important;
            color: white !important;
        }

        .bg-whatsapp:hover {
            background-color: #128C7E !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.25) !important;
        }

        /* Teks gradien lama dibuat warna solid */
        .text-gradient {
            color: var(--jt-orange);
            font-weight: 800;
        }

        .text-premium-dark {
            color: var(--jt-brown);
            font-weight: 800;
        }

        .text-glow-soft,
        .hero-title {
            text-shadow: none;
        }

        /* Navigasi */
        .nav-link {
            color: var(--jt-muted) !important;
            font-weight: 600;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--jt-orange) !important;
        }

        /* Form dan accordion */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--jt-orange);
            box-shadow: 0 0 0 0.2rem rgba(224, 117, 64, 0.2);
        }

        .accordion-button:not(.collapsed) {
            color: var(--jt-brown);
            background-color: var(--jt-cream-light);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--jt-cream-light);
        }

        ::-webkit-scrollbar-thumb {
            background: #D9B9A4;
            border-radius: 10px;
            border: 3px solid var(--jt-cream-light);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--jt-orange);
        }

        /* Mobile */
        @media (max-width: 768px) {
            .glass-card {
                padding: 1.5rem !important;
            }

            h1.display-3 {
                font-size: 2.5rem;
            }

            h2.display-2 {
                font-size: 3rem;
            }

            .navbar-brand span {
                font-size: 1.2rem;
            }

            .glass-footer {
                padding: 3rem 0 2rem;
            }

            /* Center text on mobile for hero */
            header .text-center-sm {
                text-align: center !important;
            }

            header .justify-content-center-sm {
                justify-content: center !important;
            }

            /* Adjust padding for sections */
            section {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light glass-nav sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset("asset/jlogo.svg") }}" alt="Logo" height="40" class="me-2">
                <span class="fw-bold fs-3 text-premium-dark">Jauki<span class="text-jt-orange">Tugas</span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('artikel*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#features') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#process') }}">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#testimonials') }}">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-jt-orange" href="{{ url('/payment') }}">
                            Info Pembayaran
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="https://www.instagram.com/jaukitugas" class="btn btn-light rounded-circle shadow-sm"
                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                        class="btn btn-premium btn-sm px-4">Konsultasi</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('temp')
    </main>

    <!-- Footer -->
    <footer class="glass-footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset("asset/jlogo.svg") }}" alt="Logo" height="35" class="me-2">
                        <span class="fw-bold fs-4">Jauki<span class="text-jt-orange">Tugas</span></span>
                    </div>
                    <p class="text-muted pe-lg-5">Joki tugas Jogja terpercaya nomor 1 di Indonesia. Kami hadir
                        untuk meringankan beban studi Anda dengan kualitas terbaik.</p>
                </div>
                <div class="col-6 col-md-3">
                    <h6 class="fw-bold mb-4 text-dark">Layanan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Joki Tugas Harian</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Bimbingan Skripsi</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Open Talent</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h6 class="fw-bold mb-4 text-dark">Perusahaan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Karir</a></li>
                        <li class="mb-2"><a href="{{ url('login') }}" class="text-decoration-none text-muted">Login
                                Admin</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-4 text-dark">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="https://www.instagram.com/jaukitugas" class="text-dark fs-4"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="text-dark fs-4"><i class="bi bi-tiktok"></i></a>
                        <a href="https://wa.me/6285184771744" class="text-dark fs-4"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-5 opacity-25">
            <div class="text-center text-muted small">
                <p class="mb-0">&copy; 2025 Jauki Academy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-card border-0 overflow-hidden">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-jt-brown"><i class="bi bi-wallet2 me-2"></i>Informasi Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-md-5 text-center">
                            <div class="bg-white p-3 rounded-4 shadow-sm d-inline-block">
                                <img src="{{ asset('asset/qris.jpeg') }}" alt="QRIS Payment" class="img-fluid rounded-3"
                                    style="max-height: 300px;">
                            </div>
                            <small class="d-block text-muted mt-2 fw-bold">Scan QRIS untuk Pembayaran</small>
                        </div>
                        <div class="col-md-7">
                            <div
                                class="alert alert-primary bg-primary bg-opacity-10 border-0 mb-4 rounded-3 text-primary">
                                <i class="bi bi-info-circle-fill me-2"></i>Pastikan nominal transfer sesuai dengan
                                tagihan.
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <!-- DANA -->
                                <div class="bg-white p-3 rounded-4 shadow-sm border-start border-4 border-primary">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg"
                                            alt="DANA" height="18" class="me-2">
                                        <span class="fw-bold text-dark">DANA</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <h5 class="fw-bold mb-0 font-monospace text-dark copy-text" role="button"
                                                onclick="copyToClipboard('089529104230')">089529104230 <i
                                                    class="bi bi-copy fs-6 text-muted ms-1"></i></h5>
                                            <small class="text-muted text-uppercase" style="font-size: 0.75rem;">A.N
                                                JAUHAR FAUZI ULUL ALBAB</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- SHOPEEPAY -->
                                <div class="bg-white p-3 rounded-4 shadow-sm border-start border-4 border-warning">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('asset/generated/logo-shopeepay.svg') }}"
                                            alt="ShopeePay" height="18" class="me-2">
                                        <span class="fw-bold text-dark">SHOPEEPAY</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <h5 class="fw-bold mb-0 font-monospace text-dark copy-text" role="button"
                                                onclick="copyToClipboard('089529104230')">089529104230 <i
                                                    class="bi bi-copy fs-6 text-muted ms-1"></i></h5>
                                            <small class="text-muted text-uppercase" style="font-size: 0.75rem;">A.N
                                                JAU.ID</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOPAY -->
                                <div class="bg-white p-3 rounded-4 shadow-sm border-start border-4 border-success">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('asset/generated/logo-gopay.svg') }}"
                                            alt="Gopay" height="18" class="me-2">
                                        <span class="fw-bold text-dark">GOPAY</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <h5 class="fw-bold mb-0 font-monospace text-dark copy-text" role="button"
                                                onclick="copyToClipboard('0895291054230')">0895291054230 <i
                                                    class="bi bi-copy fs-6 text-muted ms-1"></i></h5>
                                            <small class="text-muted text-uppercase" style="font-size: 0.75rem;">A.N
                                                JAUHAR FAUZI ULUL ALBAB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                    <small class="text-muted">Simpan bukti transfer untuk konfirmasi pembayaran.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast for Copy -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1060">
        <div id="copyToast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>Nomor berhasil disalin!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function () {
                var toastEl = document.getElementById('copyToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }, function (err) {
                console.error('Could not copy text: ', err);
            });
        }

        // Prevent double form submission
        document.addEventListener('submit', function (e) {
            const form = e.target;
            const submitButton = form.querySelector('button[type="submit"], button:not([type])');

            if (submitButton && !submitButton.disabled) {
                // If native HTML5 validation exists, check it
                if (form.checkValidity && !form.checkValidity()) {
                    return;
                }

                // If already submitting, prevent second submission
                if (form.getAttribute('data-submitting') === 'true') {
                    e.preventDefault();
                    return;
                }

                form.setAttribute('data-submitting', 'true');

                // Using setTimeout ensures the browser processes the submit event
                // before actually disabling the button.
                setTimeout(() => {
                    submitButton.disabled = true;
                    if (!submitButton.querySelector('.spinner-border')) {
                        const originalText = submitButton.innerHTML;
                        submitButton.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>${originalText}`;
                    }
                }, 0);
            }
        });
    </script>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
       class="btn-whatsapp-floating shadow-lg"
       target="_blank"
       aria-label="Chat with us on WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span>Chat CS</span>
    </a>

    <style>
        .btn-whatsapp-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            text-decoration: none;
            z-index: 1000;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-whatsapp-floating i {
            font-size: 1.5rem;
            margin-right: 8px;
        }

        .btn-whatsapp-floating:hover {
            transform: translateY(-5px) scale(1.05);
            color: white;
            box-shadow: 0 15px 30px rgba(37, 211, 102, 0.4);
            background: linear-gradient(135deg, #25d366 0%, #075e54 100%);
        }

        @media (max-width: 768px) {
            .btn-whatsapp-floating {
                bottom: 20px;
                right: 20px;
                padding: 10px 15px;
            }
            .btn-whatsapp-floating span {
                display: none;
            }
            .btn-whatsapp-floating i {
                margin-right: 0;
            }
        }
    </style>
</body>

</html>
