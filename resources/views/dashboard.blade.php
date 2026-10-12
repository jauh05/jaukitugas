<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard Admin | Jauki Tugas</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Chart.js & Datatables -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        /* Palet dari gambar DR+ (diambil dari piksel): putih dominan, navbar hitam,
           sentuhan pastel biru, lavender, hijau, dan kuning. Tanpa gradien. */
        :root {
            --bg: #FFFFFF;
            --panel: #F6F7F9;
            --surface: #FFFFFF;
            --black: #000000;
            --nav-bg: #FAF9F7;
            --nav-ink: #1F1D1A;
            --nav-muted: #8A8783;
            --nav-active: #FBDDA9;
            --ink: #111111;
            --ink-2: #4A4A4A;
            --muted: #9F9F9F;
            --line: #EEF0F3;
            --accent: #789FEC;
            --sky: #D2EFFA;
            --lav: #DFD8F9;
            --green: #D6E2C3;
            --yellow: #FCF1C8;
            --pill-green: #DAEAC5;
            --pill-lav: #D9D2F1;
            --danger: #E5484D;
            --danger-soft: #FDE7E8;
            --success: #5E9E4A;
            --warning: #D9A21B;

            /* Nama variabel lama tetap dipakai view admin, nilainya kini ikut palet baru */
            --primary-accent: #111111;
            --secondary-accent: #4A4A4A;
            --text-main: #111111;
            --text-muted: #9F9F9F;

            /* Lebar navbar: ikon saja (84px) atau dengan label (224px) */
            --side-w: 84px;

            /* Override tema Bootstrap supaya utilitas bawaan ikut palet baru */
            --bs-primary: #111111;
            --bs-primary-rgb: 17, 17, 17;
            --bs-dark: #111111;
            --bs-dark-rgb: 17, 17, 17;
            --bs-secondary-color: #9F9F9F;
            --bs-light: #F6F7F9;
            --bs-light-rgb: 246, 247, 249;
            --bs-warning: #D9A21B;
            --bs-warning-rgb: 217, 162, 27;
            --bs-success: #5E9E4A;
            --bs-success-rgb: 94, 158, 74;
            --bs-danger: #E5484D;
            --bs-danger-rgb: 229, 72, 77;
            --bs-info: #789FEC;
            --bs-info-rgb: 120, 159, 236;
            --bs-border-color: #EEF0F3;
            --bs-link-color: #111111;
            --bs-link-color-rgb: 17, 17, 17;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--ink);
            overflow-x: hidden;
            padding: 16px;
        }

        body.sidebar-expanded {
            --side-w: 224px;
        }

        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: -0.01em;
        }

        /* ===== Navbar hitam melengkung: ikon saja, bisa diperbesar/dikecilkan ===== */
        .sidebar {
            width: var(--side-w);
            position: fixed;
            left: 16px;
            top: 16px;
            bottom: 16px;
            background: var(--nav-bg);
            border: 1px solid #EFEDE8;
            border-radius: 28px;
            z-index: 1000;
            transition: width 0.25s ease, transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 20px 0 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            width: 100%;
        }

        .sidebar-brand-text {
            display: none;
        }

        .sidebar-toggle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 0;
            background: rgba(17, 17, 17, 0.06);
            color: var(--nav-ink);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(17, 17, 17, 0.12);
        }

        .sidebar-menu {
            padding: 4px 0 12px;
            overflow-y: auto;
            overflow-x: hidden;
            flex-grow: 1;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .nav-label {
            display: none;
            white-space: nowrap;
        }

        .sidebar .nav-link {
            color: var(--nav-muted);
            width: 52px;
            height: 52px;
            padding: 0;
            border-radius: 16px;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            text-decoration: none;
            border: 0;
            background: transparent;
            font-size: 1rem;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            color: var(--nav-ink);
            background: rgba(17, 17, 17, 0.05);
        }

        /* Item aktif (gaya referensi): ikon di dalam lingkaran kuning, baris tetap bersih */
        .sidebar .nav-link.active {
            color: var(--nav-ink);
            background: transparent;
        }

        .sidebar .nav-link.active i {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--nav-active);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            line-height: 1;
        }

        /* Mode diperbesar: ikon + label di sebelah kiri */
        body.sidebar-expanded .sidebar .nav-link {
            width: calc(100% - 24px);
            height: 46px;
            justify-content: flex-start;
            padding: 0 14px;
            gap: 12px;
        }

        body.sidebar-expanded .nav-label {
            display: inline;
        }

        body.sidebar-expanded .sidebar-brand-text {
            display: block;
            color: var(--nav-ink);
            font-weight: 600;
            font-size: 0.95rem;
            line-height: 1.1;
        }

        body.sidebar-expanded .sidebar-header {
            flex-direction: row;
            justify-content: space-between;
            padding: 20px 16px 12px;
        }

        body.sidebar-expanded .sidebar-header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        body.sidebar-expanded .sidebar-toggle {
            width: 32px;
            height: 32px;
        }

        .sidebar .submenu {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 4px;
        }

        .sidebar .submenu .nav-link {
            width: 42px;
            height: 42px;
            margin-bottom: 6px;
        }

        .sidebar .submenu .nav-link i {
            font-size: 1rem;
        }

        body.sidebar-expanded .sidebar .submenu {
            align-items: stretch;
            padding-left: 22px;
        }

        body.sidebar-expanded .sidebar .submenu .nav-link {
            width: auto;
            height: 40px;
            justify-content: flex-start;
            padding: 0 12px;
        }

        .sidebar hr {
            width: 36px;
            border-color: rgba(17, 17, 17, 0.1);
            margin: 10px auto;
            opacity: 1;
        }

        body.sidebar-expanded .sidebar hr {
            width: calc(100% - 32px);
        }

        /* Teks yang hanya tampil saat navbar diperbesar (atau di mode mobile) */
        .sb-text {
            display: none;
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sb-label {
            display: none;
            width: 100%;
            padding: 0 16px;
            margin-bottom: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--nav-muted);
        }

        body.sidebar-expanded .sb-text,
        body.sidebar-expanded .sb-label {
            display: block;
        }

        /* Profil admin di atas menu (gaya referensi): avatar inisial, nama, dan peran */
        .sidebar-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 4px 0 14px;
        }

        .sidebar-profile .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--nav-active);
            color: var(--nav-ink);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-profile .sb-name {
            color: var(--nav-ink);
            font-weight: 600;
            font-size: 0.92rem;
            line-height: 1.2;
        }

        .sidebar-profile .sb-sub {
            color: var(--nav-muted);
            font-size: 0.78rem;
        }

        body.sidebar-expanded .sidebar-profile {
            flex-direction: row;
            justify-content: flex-start;
            padding: 4px 16px 14px;
            gap: 12px;
        }

        /* Bagian bawah: tombol Pesanan Baru (putus-putus) dan kartu kalender */
        .sidebar-bottom {
            width: 100%;
            padding: 8px 12px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .sidebar-cta {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 1.5px dashed #CFCBC3;
            color: var(--nav-ink);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            flex-shrink: 0;
        }

        body.sidebar-expanded .sidebar-cta {
            width: 100%;
            border-radius: 999px;
            justify-content: flex-start;
            padding: 0 16px;
            gap: 10px;
            font-weight: 500;
        }

        .sidebar-card {
            display: none;
            width: 100%;
            background: var(--ink);
            color: #FFFFFF;
            border-radius: 22px;
            padding: 16px;
        }

        body.sidebar-expanded .sidebar-card {
            display: block;
        }

        .sidebar-card-title {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .sidebar-card-sub {
            font-size: 0.8rem;
            opacity: 0.7;
            margin: 2px 0 12px;
        }

        /* ===== Main content ===== */
        .main-content {
            margin-left: calc(var(--side-w) + 32px);
            padding: 24px 24px 40px;
            transition: margin-left 0.25s ease;
        }

        /* ===== Kartu putih, garis tipis, sudut besar ===== */
        .glass-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .glass-card h1,
        .glass-card h2,
        .glass-card h3,
        .glass-card h4,
        .glass-card h5,
        .glass-card h6 {
            color: inherit;
        }

        .glass-card h2.display-2,
        .glass-card h1,
        .glass-card .display-4,
        .glass-card .fs-1 {
            color: var(--ink);
            font-weight: 600;
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .card-title-lg {
            font-size: 1.05rem;
            font-weight: 600;
            margin: 0;
            color: var(--ink);
        }

        .card-sub {
            color: var(--muted);
            font-size: 0.85rem;
        }

        /* ===== Ikon dalam bubble yang kontras ===== */
        .bubble {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #FFFFFF;
            color: var(--ink);
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }

        .bubble--soft {
            background: var(--panel);
            box-shadow: none;
        }

        .bubble--ink {
            background: var(--ink);
            color: #FFFFFF;
            box-shadow: none;
        }

        /* ===== KPI pastel: kartu statistik dengan label, angka, dan catatan ===== */
        .kpi {
            border-radius: 22px;
            padding: 20px 22px;
            position: relative;
            overflow: hidden;
            color: var(--ink);
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .kpi::after {
            content: '';
            position: absolute;
            top: -46px;
            right: -46px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: 0 0 0 24px rgba(255, 255, 255, 0.28), 0 0 0 48px rgba(255, 255, 255, 0.16);
            pointer-events: none;
        }

        .kpi > * {
            position: relative;
            z-index: 1;
        }

        .kpi-label {
            font-size: 0.85rem;
            color: var(--ink-2);
            font-weight: 500;
            margin: 0;
        }

        .kpi-value {
            font-size: 1.9rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            line-height: 1.1;
            margin: 0;
            color: var(--ink);
        }

        .kpi-value--sm {
            font-size: 1.4rem;
        }

        .kpi-note {
            font-size: 0.8rem;
            color: var(--ink-2);
            margin: 0;
        }

        .kpi--sky { background: var(--sky); }
        .kpi--lav { background: var(--lav); }
        .kpi--green { background: var(--green); }
        .kpi--yellow { background: var(--yellow); }

        .kpi--ink {
            background: var(--black);
            color: #FFFFFF;
        }

        .kpi--ink::after {
            box-shadow: 0 0 0 24px rgba(255, 255, 255, 0.06), 0 0 0 48px rgba(255, 255, 255, 0.03);
        }

        .kpi--ink .kpi-label,
        .kpi--ink .kpi-note {
            color: rgba(255, 255, 255, 0.7);
        }

        .kpi--ink .kpi-value {
            color: #FFFFFF;
        }

        /* ===== Pill / chip halus ===== */
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 500;
            background: var(--panel);
            color: var(--ink-2);
            border: 1px solid var(--line);
        }

        .chip--sky { background: var(--sky); border-color: transparent; color: var(--ink); }
        .chip--lav { background: var(--lav); border-color: transparent; color: var(--ink); }
        .chip--green { background: var(--pill-green); border-color: transparent; color: var(--ink); }
        .chip--yellow { background: var(--yellow); border-color: transparent; color: var(--ink); }
        .chip--ink { background: var(--black); border-color: transparent; color: #FFFFFF; }

        /* ===== Tabel: header tipis, baris putih, hover halus ===== */
        .table {
            --bs-table-bg: transparent;
            --bs-table-border-color: var(--line);
        }

        .table thead th {
            color: var(--muted);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 600;
            background: #FFFFFF;
            border-bottom: 1px solid var(--line);
            padding-top: 0.9rem;
            padding-bottom: 0.9rem;
        }

        .table tbody tr:hover {
            background: var(--panel);
        }

        .table td {
            border-color: var(--line);
            vertical-align: middle;
        }

        .datatable-table {
            border-collapse: separate;
            border-spacing: 0;
            background: transparent !important;
        }

        .datatable-wrapper .datatable-container {
            border: none;
        }

        .datatable-table thead th {
            border-bottom: 1px solid var(--line);
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            padding: 0.9rem 1rem;
        }

        .datatable-table tbody tr {
            background: #FFFFFF;
            transition: background 0.2s;
        }

        .datatable-table tbody tr:hover {
            background: var(--panel);
        }

        .datatable-table td {
            border-bottom: 1px solid var(--line);
            padding: 1rem;
            vertical-align: middle;
        }

        /* ===== Tombol pill: utama hitam, outline, halus berwarna ===== */
        .btn {
            border-radius: 999px;
            font-weight: 500;
            padding: 0.5rem 1.1rem;
            transition: all 0.2s ease;
        }

        .btn-sm {
            padding: 0.35rem 0.85rem;
            font-size: 0.85rem;
        }

        .btn-lg {
            padding: 0.75rem 1.4rem;
        }

        .btn-primary {
            --bs-btn-color: #FFFFFF;
            --bs-btn-bg: #111111;
            --bs-btn-border-color: #111111;
            --bs-btn-hover-color: #FFFFFF;
            --bs-btn-hover-bg: #2A2A2A;
            --bs-btn-hover-border-color: #2A2A2A;
            --bs-btn-focus-shadow-rgb: 17, 17, 17;
            --bs-btn-active-color: #FFFFFF;
            --bs-btn-active-bg: #2A2A2A;
            --bs-btn-active-border-color: #2A2A2A;
            --bs-btn-disabled-color: #FFFFFF;
            --bs-btn-disabled-bg: #111111;
            --bs-btn-disabled-border-color: #111111;
        }

        .btn-outline-primary {
            --bs-btn-color: #111111;
            --bs-btn-border-color: #D9DCE2;
            --bs-btn-hover-color: #FFFFFF;
            --bs-btn-hover-bg: #111111;
            --bs-btn-hover-border-color: #111111;
            --bs-btn-focus-shadow-rgb: 17, 17, 17;
            --bs-btn-active-color: #FFFFFF;
            --bs-btn-active-bg: #111111;
            --bs-btn-active-border-color: #111111;
            --bs-btn-disabled-color: #111111;
            --bs-btn-disabled-border-color: #D9DCE2;
        }

        .btn-light {
            background: #FFFFFF;
            color: var(--ink);
            border: 1px solid var(--line);
            box-shadow: none;
        }

        .btn-light:hover {
            background: var(--panel);
            color: var(--ink);
        }

        .btn-outline-secondary {
            color: var(--ink-2);
            border: 1px solid var(--line);
            background: #FFFFFF;
        }

        .btn-outline-secondary:hover {
            background: var(--panel);
            color: var(--ink);
            border-color: var(--line);
        }

        .btn-secondary {
            background: var(--panel);
            color: var(--ink);
            border: 1px solid var(--panel);
        }

        .btn-secondary:hover {
            background: var(--line);
            color: var(--ink);
        }

        .btn-info {
            background: var(--sky);
            color: var(--ink);
            border: 1px solid transparent;
        }

        .btn-info:hover {
            background: #BFE7F7;
            color: var(--ink);
        }

        .btn-success {
            background: var(--pill-green);
            color: var(--ink);
            border: 1px solid transparent;
        }

        .btn-success:hover {
            background: #CBDDB5;
            color: var(--ink);
        }

        .btn-warning {
            background: var(--yellow);
            color: var(--ink);
            border: 1px solid transparent;
        }

        .btn-warning:hover {
            background: #F7E7A4;
            color: var(--ink);
        }

        .btn-danger {
            background: var(--danger-soft);
            color: #C9363B;
            border: 1px solid transparent;
        }

        .btn-danger:hover {
            background: #FBD3D5;
            color: #C9363B;
        }

        .btn-outline-danger {
            background: #FFFFFF;
            color: #C9363B;
            border: 1px solid #F3C4C6;
        }

        .btn-outline-danger:hover {
            background: var(--danger-soft);
            color: #C9363B;
        }

        .btn-link {
            color: var(--ink-2);
            text-decoration: none;
            border-radius: 999px;
        }

        .btn-link:hover {
            color: var(--ink);
            background: var(--panel);
        }

        /* Tombol ikon bulat (aksi di baris tabel dan kartu) */
        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* CTA utama: hitam solid, pill, tanpa gradien */
        .btn-premium {
            background: #111111;
            color: #FFFFFF;
            border: none;
            font-weight: 500;
            box-shadow: none;
        }

        .btn-premium:hover {
            background: #2A2A2A;
            color: #FFFFFF;
            transform: translateY(-1px);
        }

        /* ===== Form: kolom abu halus, fokus putih berbingkai biru ===== */
        .form-control,
        .form-select {
            border: 1px solid transparent;
            background: var(--panel);
            border-radius: 14px;
            color: var(--ink);
            padding: 0.6rem 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            background: #FFFFFF;
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(120, 159, 236, 0.18);
        }

        .form-label {
            color: var(--ink-2);
            font-size: 0.82rem;
            font-weight: 500;
        }

        /* Navbar mobile */
        .top-nav {
            display: none;
            background: var(--nav-bg);
            color: var(--nav-ink);
            padding: 0.9rem 1rem;
            border: 1px solid #EFEDE8;
            position: sticky;
            top: 0;
            z-index: 1001;
            border-radius: 22px;
            margin-bottom: 16px;
        }

        .top-nav .btn-light {
            background: rgba(17, 17, 17, 0.06);
            color: var(--nav-ink);
            border: 0;
        }

        /* ===== Responsif ===== */
        @media (max-width: 992px) {
            body {
                padding: 0;
            }

            .sidebar {
                left: 0;
                top: 0;
                bottom: 0;
                border-radius: 0 28px 28px 0;
                transform: translateX(-110%);
                width: 224px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }

            .top-nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar .nav-label,
            .sidebar-brand-text {
                display: inline;
            }

            .sb-text,
            .sb-label,
            .sidebar-card {
                display: block;
            }

            .sidebar-profile {
                flex-direction: row;
                justify-content: flex-start;
                padding: 4px 16px 14px;
                gap: 12px;
            }

            .sidebar-cta {
                width: 100%;
                border-radius: 999px;
                justify-content: flex-start;
                padding: 0 16px;
                gap: 10px;
                font-weight: 500;
            }

            .sidebar .nav-link {
                width: calc(100% - 24px);
                height: 46px;
                justify-content: flex-start;
                padding: 0 14px;
                gap: 12px;
            }

            .sidebar-toggle {
                display: none;
            }
        }

        @media (max-width: 576px) {
            html {
                font-size: 14px;
            }

            .glass-card {
                padding: 1.1rem !important;
            }

            .kpi-value {
                font-size: 1.5rem;
            }
        }

        /* Modal */
        .modal,
        .modal * {
            filter: none !important;
        }

        .modal-backdrop {
            --bs-backdrop-bg: #000;
            --bs-backdrop-opacity: 0.4;
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1055 !important;
        }

        .modal-content {
            border-radius: 24px;
            border: 1px solid var(--line);
        }

        .modal-header,
        .modal-footer {
            border-color: var(--line);
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #FFFFFF;
        }

        ::-webkit-scrollbar-thumb {
            background: #D9DCE2;
            border-radius: 10px;
            border: 3px solid #FFFFFF;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- Mobile Top Nav -->
    <div class="top-nav">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="30">
            <span class="fw-semibold">Admin Panel</span>
        </div>
        <button class="btn btn-light btn-icon" id="sidebarToggle"><i class="bi bi-list fs-5"></i></button>
    </div>

    <!-- Sidebar: ikon saja (bisa diperbesar agar menampilkan label) -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-header-brand">
                <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="34" title="Jauki Admin">
                <span class="sidebar-brand-text">Jauki Admin</span>
            </div>
            <button class="sidebar-toggle" id="sidebarCollapse" type="button" title="Perbesar / kecilkan navbar" aria-label="Perbesar atau kecilkan navbar">
                <i class="bi bi-chevron-double-right" id="sidebarCollapseIcon"></i>
            </button>
        </div>

        <div class="sidebar-profile" title="{{ session('username') ?? 'Admin' }}">
            <div class="avatar">{{ strtoupper(substr(session('username') ?? 'Admin', 0, 1)) }}</div>
            <div class="sb-text">
                <div class="sb-name">{{ session('username') ?? 'Admin' }}</div>
                <div class="sb-sub">Administrator</div>
            </div>
        </div>

        <div class="sidebar-menu">
            <span class="sb-label">Menu</span>

            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}" title="Dashboard">
                <i class="bi bi-grid"></i><span class="nav-label">Dashboard</span>
            </a>

            <a class="nav-link {{ Request::is('dashboard/costomer*') ? 'active' : '' }}"
                href="{{ url('/dashboard/costomer') }}" title="Data Customer">
                <i class="bi bi-people"></i><span class="nav-label">Data Customer</span>
            </a>

            <a class="nav-link {{ Request::is('dashboard/jadwal*') ? 'active' : '' }}"
                href="{{ route('costomer.jadwal') }}" title="Jadwal">
                <i class="bi bi-kanban"></i><span class="nav-label">Jadwal</span>
            </a>

            <a class="nav-link {{ Request::is('dashboard/kalender*') ? 'active' : '' }}"
                href="{{ route('kalender.index') }}" title="Kalender">
                <i class="bi bi-calendar3"></i><span class="nav-label">Kalender</span>
            </a>

            <a class="nav-link {{ Request::is('dashboard/pengeluaran*') ? 'active' : '' }}"
                href="{{ route('pengeluaran.index') }}" title="Pengeluaran">
                <i class="bi bi-cash-coin"></i><span class="nav-label">Pengeluaran</span>
            </a>

            <a class="nav-link {{ Request::is('dashboard/talent*') ? 'active' : '' }}"
                href="{{ route('admin.talent.index') }}" title="Data Talent">
                <i class="bi bi-person-badge"></i><span class="nav-label">Data Talent</span>
            </a>

            <div class="accordion accordion-flush bg-transparent w-100" id="menuLainnya">
                <div class="accordion-item bg-transparent border-0">
                    <h2 class="accordion-header">
                        <button class="nav-link collapsed" type="button" title="Lainnya"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                            <i class="bi bi-collection"></i><span class="nav-label">Lainnya</span>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse bg-transparent"
                        data-bs-parent="#menuLainnya">
                        <div class="submenu">
                            <a class="nav-link" href="{{ url('/metodepembayaran') }}" title="Metode Pembayaran">
                                <i class="bi bi-credit-card"></i><span class="nav-label">Metode Pembayaran</span>
                            </a>
                            <a class="nav-link" href="{{ url('/belum') }}" title="Belum Diproses">
                                <i class="bi bi-hourglass-split"></i><span class="nav-label">Belum Diproses</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <a class="nav-link {{ Request::is('dashboard/articles*') ? 'active' : '' }}"
                href="{{ route('admin.articles.index') }}" title="Artikel">
                <i class="bi bi-journal-text"></i><span class="nav-label">Artikel</span>
            </a>

            <a class="nav-link {{ Request::is('dashboard/komentar*') ? 'active' : '' }}"
                href="{{ url('/dashboard/komentar') }}" title="Komentar">
                <i class="bi bi-chat-dots"></i><span class="nav-label">Komentar</span>
            </a>

            <hr>

            <a class="nav-link" href="{{ url('/') }}" title="Lihat Website">
                <i class="bi bi-browser-chrome"></i><span class="nav-label">Lihat Website</span>
            </a>

            <a class="nav-link" href="{{ url('/logout') }}" title="Logout">
                <i class="bi bi-box-arrow-right"></i><span class="nav-label">Logout</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            <a class="sidebar-cta" href="{{ route('costomer.tambah') }}" title="Pesanan Baru">
                <i class="bi bi-plus-lg"></i><span class="sb-text">Pesanan Baru</span>
            </a>

            <div class="sidebar-card">
                <div class="sidebar-card-title">Deadline bulan ini</div>
                <div class="sidebar-card-sub">Pantau jadwal pengerjaan di kalender.</div>
                <a href="{{ route('kalender.index') }}" class="btn btn-light rounded-pill btn-sm w-100">Buka Kalender</a>
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
        // Navbar: buka/tutup mode label, dan simpan pilihan di browser
        const sidebar = document.getElementById('sidebar');
        const sidebarCollapse = document.getElementById('sidebarCollapse');
        const sidebarCollapseIcon = document.getElementById('sidebarCollapseIcon');

        function applySidebarMode(expanded) {
            document.body.classList.toggle('sidebar-expanded', expanded);
            if (sidebarCollapseIcon) {
                sidebarCollapseIcon.className = expanded ? 'bi bi-chevron-double-left' : 'bi bi-chevron-double-right';
            }
        }

        let savedSidebarMode = null;
        try { savedSidebarMode = localStorage.getItem('jt-sidebar'); } catch (e) {}
        applySidebarMode(savedSidebarMode === 'expanded');

        if (sidebarCollapse) {
            sidebarCollapse.addEventListener('click', function () {
                const next = !document.body.classList.contains('sidebar-expanded');
                applySidebarMode(next);
                try { localStorage.setItem('jt-sidebar', next ? 'expanded' : 'collapsed'); } catch (e) {}
            });
        }

        // Sidebar Toggle for Mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
            });
        }

        // ChartJS Defaults (palet dashboard)
        Chart.defaults.font.family = "'Outfit', sans-serif";
        Chart.defaults.color = '#9F9F9F';
        Chart.defaults.borderColor = '#EEF0F3';
        Chart.defaults.plugins.tooltip.backgroundColor = '#111111';
        Chart.defaults.plugins.tooltip.padding = 10;
        Chart.defaults.plugins.tooltip.cornerRadius = 10;
        Chart.defaults.plugins.tooltip.titleFont = { weight: '600' };
        Chart.defaults.plugins.legend.labels.usePointStyle = true;
        Chart.defaults.plugins.legend.labels.boxWidth = 8;

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

        // Prevent double form submission
        document.addEventListener('submit', function (e) {
            const form = e.target;
            const submitButton = form.querySelector('button[type="submit"], button:not([type])');

            if (submitButton && !submitButton.disabled) {
                // If it's already submitting, prevent second submission
                if (form.getAttribute('data-submitting') === 'true') {
                    e.preventDefault();
                    return;
                }

                // Native HTML5 validation check
                if (form.checkValidity && !form.checkValidity()) {
                    return;
                }

                form.setAttribute('data-submitting', 'true');

                // Using setTimeout ensures the browser processes the submit event (including native validation)
                // before actually disabling the button and changing its HTML.
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
</body>

</html>
