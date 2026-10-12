<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Jauki Tugas</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        /* Palet dari contoh desain: krem, cokelat, oranye, kuning, hijau, biru, pink */
        :root {
            --jt-cream: #FFE8D0;
            --jt-cream-light: #FEF4EB;
            --jt-brown: #532923;
            --jt-muted: #7D5F54;
            --jt-orange: #E07540;
            --jt-yellow: #F3C75F;
            --jt-green: #46A375;
            --jt-blue: #7CB1EB;
            --jt-pink: #F4A6B8;
            --jt-shadow: 0 16px 36px rgba(83, 41, 35, 0.10);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #FFFFFF;
            color: var(--jt-brown);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Shape dekoratif geometris di latar, sama dengan halaman publik */
        .jt-shape {
            position: absolute;
            pointer-events: none;
            z-index: 0;
            background: var(--c, var(--jt-orange));
        }

        .jt-shape--semi {
            width: 180px;
            height: 90px;
            border-radius: 180px 180px 0 0;
        }

        .jt-shape--quarter {
            width: 160px;
            height: 160px;
            border-radius: 100% 0 0 0;
        }

        .jt-shape--ring {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: transparent;
            border: 24px solid var(--c, var(--jt-green));
        }

        .jt-shape--dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .login-card {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            border-radius: 32px;
            box-shadow: var(--jt-shadow);
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }

        /* Header krem dengan lengkung di bawah, gaya kartu arch */
        .login-head {
            background: var(--jt-cream-light);
            border-radius: 24px 24px 50% 50% / 24px 24px 40px 40px;
            padding: 2rem 1.5rem 3.5rem;
            text-align: center;
            margin: -2.5rem -2.5rem 1.5rem;
        }

        .login-head h2 {
            color: var(--jt-brown);
            font-weight: 800;
        }

        .form-control {
            background: var(--jt-cream-light);
            border: 2px solid transparent;
            border-radius: 16px;
            padding: 1rem 1.1rem;
            transition: all 0.3s ease;
            color: var(--jt-brown);
            font-weight: 600;
        }

        .form-control:focus {
            background: #FFFFFF;
            box-shadow: 0 0 0 0.2rem rgba(224, 117, 64, 0.2);
            border-color: var(--jt-orange);
        }

        .form-control::placeholder {
            color: #B49A8F;
        }

        /* Tombol utama kuning pill dengan teks cokelat, sama dengan CTA publik */
        .btn-premium {
            background: var(--jt-yellow);
            border: none;
            color: var(--jt-brown);
            font-weight: 800;
            padding: 1rem;
            border-radius: 16px;
            width: 100%;
            box-shadow: 0 10px 22px rgba(243, 199, 95, 0.45);
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px rgba(243, 199, 95, 0.55);
            color: var(--jt-brown);
            background: #F7D27A;
        }

        .btn-back {
            color: var(--jt-brown);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-bottom: 1.25rem;
            transition: color 0.3s ease;
        }

        .btn-back:hover {
            color: var(--jt-orange);
        }
    </style>
</head>

<body>
    <!-- Shape dekoratif -->
    <div class="jt-shape jt-shape--semi" style="--c: #46A375; top: -30px; left: 8%;"></div>
    <div class="jt-shape jt-shape--quarter" style="--c: #F3C75F; bottom: 0; left: 0;"></div>
    <div class="jt-shape jt-shape--ring" style="--c: #E07540; top: 18%; right: 6%;"></div>
    <div class="jt-shape jt-shape--dot" style="--c: #F4A6B8; bottom: 14%; right: 12%;"></div>

    @if (session('pesan_berhasil'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('pesan_berhasil') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    @if (session('pesan_gagal'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "{{ session('pesan_gagal') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <div class="login-card">
        <div class="login-head">
            <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="60" class="mb-3">
            <h2 class="mb-1">Admin Login</h2>
            <p class="small mb-0" style="color: var(--jt-muted);">Masuk untuk mengelola pesanan.</p>
        </div>

        <a href="{{ url('/') }}" class="btn-back"><i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda</a>

        <form method="post" action="{{ url('login/admin') }}">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                    name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" name="password" required>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-premium">Masuk Sekarang</button>
        </form>
    </div>
</body>

</html>
