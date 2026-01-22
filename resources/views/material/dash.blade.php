<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Interface</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset/style.css') }}">
</head>

<body>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset("asset/jlogo.svg") }}" alt="Logo" style="" class="img-fluid">
                <!-- Ganti dengan logo Anda -->
            </a>
            <!-- Hamburger menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <!-- Tambahkan elemen ini ke dalam menu collapsible -->
                <div class="d-flex">
                    <a href="https://www.instagram.com/jaukitugas" class="text-white mx-2"><i class="bi bi-house-door-fill"></i></a>
                    <a href="https://www.instagram.com/jaukitugas" class="text-white mx-2"><i class="bi bi-tiktok"></i></a>
                    <a href="https://www.instagram.com/jaukitugas" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </nav>
    @yield('temp')


     <!-- Footer 1: Informasi Utama -->
    <footer class="footer-1 py-5 bg-dark text-white mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p>tidak ada yang tidak mungkin di dunia ini</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Projects</a></li>
                        <li><a href="#" class="text-white">Services</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Follow Us</h5>
                    <a href="https://www.instagram.com/jaukitugas" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/jaukitugas" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.instagram.com/jaukitugas" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer 2: Penutup -->
    <footer class="footer-2 py-3 bg-secondary text-white text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 by jaukiacademy</p>
        </div>
    </footer>

    <script src="{{ url('asset/animation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<style>

.testimonial-section {
    background-color: var(--accent-cream);
    padding: 60px 0;
    margin: 40px 0;
}

.testimonial-card {
    background-color: rgb(255, 255, 255);
    padding: 30px;
    border-radius: 15px;
    margin: 20px 0;
}

</style>
