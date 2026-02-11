<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard Admin | Jauki Tugas</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Chart.js & Datatables -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 1);
            --glass-blur: none;
            --primary-accent: #4834d4;
            --secondary-accent: #686de0;
            --text-main: #2d3436;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f0f3f7;
            color: var(--text-main);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--primary-accent);
        }

        /* Stats/Numbers Styling */
        .card-body h1,
        .card-body .display-4 {
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--primary-accent);
        }

        /* Animated Background */
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
            opacity: 0.4;
            animation: floatblob 25s infinite alternate ease-in-out;
        }

        .blob-1 {
            top: -20%;
            left: -10%;
            background: #dfe6e9;
            opacity: 0.8;
        }

        .blob-2 {
            bottom: -20%;
            right: -10%;
            background: #dff9fb;
            animation-delay: -7s;
        }

        .blob-3 {
            top: 40%;
            left: 30%;
            background: #e3f2fd;
            animation-duration: 35s;
        }

        @keyframes floatblob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(100px, 50px) scale(1.1);
            }
        }

        /* Glass Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-right: 1px solid white;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            padding: 1rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .nav-link {
            color: var(--text-main);
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            color: white;
            box-shadow: 0 5px 15px rgba(72, 52, 212, 0.2);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        /* Glass Cards for Dashboard Widgets */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.8);
        }

        /* Table Overrides */
        .datatable-table {
            border-collapse: separate;
            border-spacing: 0 0.5rem;
            background: transparent !important;
        }

        .datatable-wrapper .datatable-container {
            border: none;
        }

        .datatable-table thead th {
            border-bottom: none;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding: 1rem;
        }

        .datatable-table tbody tr {
            background: rgba(255, 255, 255, 0.4);
            transition: all 0.2s;
        }

        .datatable-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .datatable-table td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }

        .datatable-table td:first-child {
            border-radius: 10px 0 0 10px;
        }

        .datatable-table td:last-child {
            border-radius: 0 10px 10px 0;
        }

        /* Premium Text Gradient for Stats */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Auto-apply gradient to big numbers in cards */
        .glass-card h2.display-2,
        .glass-card h1,
        .glass-card .display-4,
        .glass-card .fs-1 {
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Table Header Refinement */
        .datatable-table thead th {
            border-bottom: 2px solid rgba(72, 52, 212, 0.1);
            color: var(--primary-accent);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1.2px;
        }

        /* Navbar (Mobile Toggle) */
        .top-nav {
            display: none;
            /* Hidden on desktop */
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1001;
            border-bottom: 1px solid white;
        }

        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .top-nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Smaller scale for mobile phones */
        @media (max-width: 576px) {
            html {
                font-size: 14px;
                /* Default is usually 16px */
            }

            .glass-card {
                padding: 1.5rem !important;
                /* Force tighter padding */
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            h1.display-3 {
                font-size: 2.5rem;
            }

            h2.display-2 {
                font-size: 2rem;
            }
        }

        /* 
           FIX FOR MODAL INPUT BLUR ISSUE 
           Ensures that modals and their children are never blurred by parent filters 
        */
        .modal,
        .modal * {
            filter: none !important;
        }

        /* Ensure standard Bootstrap modal backdrop works */
        .modal-backdrop {
            --bs-backdrop-bg: #000;
            --bs-backdrop-opacity: 0.5;
            z-index: 1040 !important;
        }

        /* Ensure Modal sits on top */
        .modal {
            z-index: 1055 !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- Animated BG -->
    <div class="bg-gradient-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- Mobile Top Nav -->
    <div class="top-nav">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="30">
            <span class="fw-bold">Admin Panel</span>
        </div>
        <button class="btn btn-light rounded-circle shadow-sm" id="sidebarToggle"><i
                class="bi bi-list fs-4"></i></button>
    </div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="40">
            <div>
                <h5 class="mb-0 fw-bold">Jauki Admin</h5>
                <small class="text-muted">Desainer</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <small class="text-uppercase text-muted fw-bold mb-2 d-block px-2" style="font-size: 0.75rem;">Menu
                Utama</small>

            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>

            <a class="nav-link {{ Request::is('dashboard/costomer*') ? 'active' : '' }}"
                href="{{ url('/dashboard/costomer') }}">
                <i class="bi bi-people-fill"></i> Data Customer
            </a>

            <a class="nav-link {{ Request::is('dashboard/talent*') ? 'active' : '' }}"
                href="{{ route('admin.talent.index') }}">
                <i class="bi bi-person-badge-fill"></i> Data Talent
            </a>

            <div class="accordion accordion-flush bg-transparent" id="menuLainnya">
                <div class="accordion-item bg-transparent border-0">
                    <h2 class="accordion-header">
                        <button class="nav-link collapsed w-100 bg-transparent border-0" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                            <i class="bi bi-collection-fill"></i> Lainnya <i class="bi bi-chevron-down ms-auto"
                                style="font-size: 0.8rem;"></i>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse bg-transparent"
                        data-bs-parent="#menuLainnya">
                        <div class="d-flex flex-column ps-4 border-start ms-3">
                            <a class="nav-link py-2" href="{{ url('/metodepembayaran') }}"><small>Metode
                                    Pembayaran</small></a>
                            <a class="nav-link py-2" href="{{ url('/belum') }}"><small>Belum Diproses</small></a>
                        </div>
                    </div>
                </div>
            </div>

            <a class="nav-link {{ Request::is('dashboard/komentar*') ? 'active' : '' }}"
                href="{{ url('/dashboard/komentar') }}">
                <i class="bi bi-chat-dots-fill"></i> Komentar
            </a>

            <hr class="border-secondary opacity-25 my-3">

            <a class="nav-link" href="{{ url('/') }}">
                <i class="bi bi-browser-chrome"></i> Lihat Website
            </a>

            <a class="nav-link text-danger" href="{{ url('/logout') }}">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>

        <div class="p-3">
            <div class="glass-card bg-white bg-opacity-50 border-0 p-3 mb-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div style="overflow: hidden;">
                        <span class="d-block fw-bold text-truncate">{{ session('username') ?? 'Admin' }}</span>
                        <small class="text-success d-block lh-1"><i class="bi bi-dot"></i> Online</small>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @yield('halo')

        <div class="row g-4 mb-4">
            @yield('info')
        </div>

        <div class="glass-card">
            @yield('edit')
            @yield('tabel')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>

    <script>
        // Sidebar Toggle for Mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
            });
        }

        // ChartJS Defaults
        Chart.defaults.font.family = "'Outfit', sans-serif";
        Chart.defaults.color = '#636e72';

        // ChartJS Defaults
        Chart.defaults.font.family = "'Outfit', sans-serif";
        Chart.defaults.color = '#636e72';

        // Initialize Simple Datatables if table exists
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });

        // SweetAlert Delete Confirmation
        document.addEventListener("click", function (event) {
            if (event.target.closest(".deleteButton")) {
                event.preventDefault();
                const form = event.target.closest("form");

                Swal.fire({
                    title: "Yakin Hapus?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>

</html>