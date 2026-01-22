<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .login-container {
            min-height: 100vh;
            background-color: white;
        }

        .visual-section {
            background-color: #505050;
            min-height: 100vh;
            position: relative;
            border-radius: 0 40px 40px 0;
            overflow: hidden;
        }

        .featured-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        .user-info {
            position: absolute;
            bottom: 30px;
            left: 30px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffffff20;
        }

        .control-buttons {
            position: absolute;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 10px;
        }

        .control-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffffff20;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0a0a0a;
        }

        .login-form {
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .btn-login {
            background-color: #000000;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            width: 100%;
            margin-top: 1rem;
        }

        .social-links {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 2rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0a0a0a;
            text-decoration: none;
        }

        .nav-link {
            color: #0a0a0a;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .selected-text {
            position: absolute;
            top: 30px;
            left: 30px;
            color: white;
            z-index: 2;
        }
    </style>
</head>
<body>
    @if (session('pesan_berhasil'))
    <script>
        Swal.fire({
            position: "top-center",
            icon: "success",
            html: "<p style='color: #28a745; font-size: 18px;'>{{ session('pesan_berhasil') }}</p>",
            showConfirmButton: false,
            timer: 2500,
            customClass: {
            popup: 'swal-borderless'
        }
    });
    </script>
    @endif
    @if (session('pesan_gagal'))
    <script>
        Swal.fire({
            position: "top-center",
            icon: "error",
            html: "<p style='color: #dc3545; font-size: 18px;'>{{ session('pesan_gagal') }}</p>",
            showConfirmButton: false,
            timer: 2500,
            customClass: {
            popup: 'swal-borderless'
        }
    });
    </script>
    @endif
    <div class="container-fluid">
            <div class="col-md-12">
                <div class="login-container d-flex flex-column">
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center p-4">
                        <div class="login-form">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('asset/jlogofav.svg') }}" alt="" width="50">
                                <h1 class="mb-2">Halo Admin Jauki</h1>
                            </div>
                            <p class="text-muted mb-4">Selamat Datang Kembali</p>
                            <div class=" mb-3 ">
                                <a class="btn btn-warning" href="{{ url('/') }}"><i class="bi bi-house-fill"> Kembali</i></a>
                            </div>
                            <form method="post" action="{{ url('login/admin') }}">
                                @method('post')
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username" name="username" value="{{ old('username') }}">
                                    @error('username')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                                    @error('password')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>