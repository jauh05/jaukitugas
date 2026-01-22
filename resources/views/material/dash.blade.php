<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jauki Tugas | Solusi Akademik Profesional</title>

    <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />

    <style>
        :root {
            /* Bright Glass Theme Variables */
            --glass-bg: rgba(255, 255, 255, 0.65);
            --glass-border: rgba(255, 255, 255, 0.8);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            --glass-blur: blur(20px);

            --primary-accent: #4834d4;
            /* Deep Blurple */
            --secondary-accent: #686de0;
            /* Soft Blurple */
            --highlight: #f0932b;
            /* Orange for CTA */

            --text-main: #2d3436;
            --text-muted: #636e72;

            --bg-gradient: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f3f7;
            color: var(--text-main);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated Background Blobs (Bright Version) */
        .bg-gradient-blobs {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            background: linear-gradient(to bottom right, #f6f8fb, #eef2f5);
        }

        .blob {
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.6;
            animation: floatblob 25s infinite alternate ease-in-out;
        }

        .blob-1 {
            top: -20%;
            left: -10%;
            background: #dfe6e9;
            opacity: 0.8;
        }

        /* Soft Grey */
        .blob-2 {
            bottom: -20%;
            right: -10%;
            background: #dff9fb;
            animation-delay: -7s;
        }

        /* Soft Cyan */
        .blob-3 {
            top: 40%;
            left: 30%;
            background: #e3f2fd;
            animation-duration: 35s;
        }

        /* Soft Blue */

        @keyframes floatblob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(100px, 50px) scale(1.1);
            }
        }

        /* Glassmorphism Components */
        .glass-nav {
            background: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid white;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.03);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid white;
            border-radius: 24px;
            box-shadow: var(--glass-shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: var(--secondary-accent);
        }

        .glass-footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-top: 1px solid white;
            padding: 5rem 0 2rem;
            margin-top: 5rem;
        }

        /* Buttons */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            box-shadow: 0 10px 20px rgba(72, 52, 212, 0.15);
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(72, 52, 212, 0.25);
            color: white;
        }

        .btn-glass-outline {
            background: rgba(255, 255, 255, 0.5);
            border: 2px solid var(--primary-accent);
            color: var(--primary-accent);
            font-weight: 700;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-glass-outline:hover {
            background: var(--primary-accent);
            color: white;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            letter-spacing: -0.03em;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary-accent) 0%, #a29bfe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Navigation */
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 600;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-accent) !important;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f2f6;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
            border: 3px solid #f1f2f6;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-accent);
        }

        /* Mobile Responsiveness */
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

            /* Hide giant blobs on mobile to improve performance and readability */
            .blob {
                opacity: 0.4;
                filter: blur(60px);
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
    <!-- Animated BG -->
    <div class="bg-gradient-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light glass-nav sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset("asset/jlogo.svg") }}" alt="Logo" height="40" class="me-2">
                <span class="fw-bold fs-3">Jauki<span class="text-primary">Tugas</span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimoni</a>
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
                        <span class="fw-bold fs-4">Jauki<span class="text-primary">Tugas</span></span>
                    </div>
                    <p class="text-muted pe-lg-5">Platform bantuan akademik terpercaya nomor 1 di Indonesia. Kami hadir
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('asset/animation.js') }}"></script>
</body>

</html>