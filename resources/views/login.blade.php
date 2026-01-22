<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Jauki Tugas</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('asset/jlogo.svg') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.65);
            --glass-border: rgba(255, 255, 255, 0.8);
            --glass-blur: blur(20px);
            --primary-accent: #4834d4;
            --secondary-accent: #686de0;
            --text-main: #2d3436;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f0f3f7;
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
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
            filter: blur(80px);
            opacity: 0.6;
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

        .glass-login {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid transparent;
            border-radius: 15px;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-color: var(--primary-accent);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            border: none;
            color: white;
            font-weight: 700;
            padding: 1rem;
            border-radius: 15px;
            width: 100%;
            box-shadow: 0 10px 20px rgba(72, 52, 212, 0.2);
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(72, 52, 212, 0.3);
            color: white;
        }

        .btn-back {
            color: var(--text-main);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-bottom: 2rem;
            transition: color 0.3s ease;
        }

        .btn-back:hover {
            color: var(--primary-accent);
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

    <div class="glass-login">
        <a href="{{ url('/') }}" class="btn-back"><i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda</a>

        <div class="text-center mb-4">
            <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="60" class="mb-3">
            <h2 class="fw-bold mb-1">Admin Login</h2>
            <p class="text-muted small">Masuk untuk mengelola pesanan.</p>
        </div>

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