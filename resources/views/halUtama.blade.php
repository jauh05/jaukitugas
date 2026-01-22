
 @extends('material.dash')
 @section('temp')
    <header class="container py-5">
        <div class="row align-items-center">
            <!-- Text Section -->
            <div class="col-md-6 text-center text-md-start">
                <h1 class="fw-bold text-animation">Selesaikan tugasmu kapan saja dan dimana saja bersama <i>Jauki -
                        Tugas</i></h1>
                <p class="text-muted text-animation">Berbagai macam tugas mulai dari softfile dan hardfile </p>
                <div class="d-flex justify-content-center justify-content-md-start mt-3">
                    <a href="https://wa.me/6285184771744" class="btn btn-success me-2">
                        <i class="bi bi-whatsapp"> Hubungi Kami Segera</i>
                    </a>
                    <a href="{{ url('login') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-person-badge-fill"> Admin</i>
                    </a>
                </div>
            </div>

            <!-- Profiles Section -->
            <div class="col-md-6 mt-5">
                <div class="row g-3 justify-content-center">
                    <img class="img-fluid mt-3 img-animation" src="{{ asset('asset/Hal1.svg') }}" alt="" srcset="">
                </div>
            </div>
        </div>
        </div>
    </header>

    <!-- Our Programs Section -->
    <section class="container py-5 scroll-animation">
        <h2 class="text-center mb-4">Kenali Layanan Jauki Tugas</h2>
        <p class="text-center text-muted mb-5">
            Temukan berbagai layanan terbaik kami untuk membantu tugas dan skripsi Anda.
        </p>
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('asset/c1.svg') }}" class="card-img-top" alt="Open Talent">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title text-dark">Open Talent Jauki Tugas</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Kesempatan emas bagi Anda yang ingin bekerja sambil belajar. Dapatkan ilmu sekaligus penghasilan tambahan!
                        </p>
                        <a href="https://forms.gle/5QYUNjTukfX5GMsP9" class="btn btn-outline-primary mt-auto">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('asset/c2.svg') }}" class="card-img-top" alt="Joki Skripsi">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title text-dark">Joki Skripsi Bergaransi</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Butuh bantuan skripsi? Kami hadir dengan bahan ajar yang simple dan bergaransi agar Anda tetap paham.
                        </p>
                        <a href="https://wa.me/6285184771744" class="btn btn-outline-primary mt-auto" onclick="alert('Hubungi admin kami untuk layanan joki skripsi.')">Hubungi Admin</a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('asset/c3.svg') }}" class="card-img-top" alt="Price List">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title text-dark">Daftar Harga Jauki Tugas</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Cek informasi lengkap mengenai harga layanan kami sebelum memesan.
                        </p>
                        <a href="{{ asset('asset/pricelist.pdf') }}" class="btn btn-outline-primary mt-auto" download="" onclick="alert('Apakah Anda ingin mengunduh daftar harga kami?')">Lihat Price List</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Features Section -->
        <section class="container py-5">
            <h2 class="text-center">Layanan Joki Tugas Profesional</h2>
            <div class="row text-center">
                <div class="col-md-3">
                    <i class="bi bi-graph-up text-warning" style="font-size: 2rem;"></i>
                    <h5>Telah Melayani 1000+ Tugas</h5>
                    <p>Menyelesaikan lebih dari 1000 tugas setiap semester dengan kualitas terbaik.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-person-check text-primary" style="font-size: 2rem;"></i>
                    <h5>Joki Berpengalaman</h5>
                    <p>Ditangani oleh tim profesional yang paham berbagai bidang ilmu.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-arrow-repeat text-success" style="font-size: 2rem;"></i>
                    <h5>Revisi Gratis</h5>
                    <p>Dapatkan revisi sesuai permintaan tanpa biaya tambahan.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-clock-history text-danger" style="font-size: 2rem;"></i>
                    <h5>Deadline Terjamin</h5>
                    <p>Tugas selesai tepat waktu, tanpa khawatir keterlambatan.</p>
                </div>
            </div>
        </section>
    
    <!-- Smart Online Education Section -->
    <section class="container text-center py-5 bg-dark scroll-animation mb-3">
        <div class="card-body">
            <h1 class="text-warning"> <b> {{ $jumlah_costomer_belum + 7 }} </b> <i class="bi bi-person-dash fs-1"></i></h1>
            <p class="text-warning">Jumlah antrean</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-light scroll-animation">
        <div class="container py-5">
            <h2 class="text-center text-dark fw-bold mb-4">Tanggapan Kalian tentang Jauki - Tugas</h2>
            <p class="text-center text-muted">Bagikan pengalaman dan pendapatmu bersama Jauki - Tugas! 👇</p>
        
            <form method="post" action="{{ url('utama/komentar') }}" class="row justify-content-center g-3 needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-light"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control border-0 shadow-sm" placeholder="Nama Anda" name="nama" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-light"><i class="bi bi-chat-left-text-fill"></i></span>
                        <input type="text" class="form-control border-0 shadow-sm" placeholder="Mengenai Apa?" name="tentang" required>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-floating">
                        <textarea class="form-control border-0 shadow-sm" placeholder="Tulis komentar kamu di sini..." name="komentar" id="floatingTextarea" required></textarea>
                        <label for="floatingTextarea">📝 Masukkan Komentar</label>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <button class="btn btn-warning text-dark fw-bold w-100 py-2 shadow-sm" type="submit">
                        <i class="bi bi-send-fill"></i> Kirim Tanggapan
                    </button>
                </div>
            </form>
        </div>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <h2 class="text-center text-dark fw-bold mb-4">Apa Kata Mereka?</h2>
            <p class="text-center text-muted">Testimoni dari pelanggan kami yang puas dengan layanan Jauki - Tugas! 🏆</p>
        
            <div class="carousel-inner text-center">
                @foreach ($komentar as $key => $value)
                    <div class="carousel-item {{ $key == $komentar->keys()->last() ? 'active' : '' }}">
                        <div class="card shadow-sm mx-auto testimonial-card border-0" style="max-width: 600px; background-color: #fff3e0;">
                            <div class="card-body text-dark">
                                <div class="text-center">
                                    <h5 class="fw-bold text-dark">🗣 KOMENTAR {{ $key+1 }}</h5>
                                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                                        Berterimakasih atas {{ $value['tentang'] }}
                                    </span>
                                    <span class="badge rounded-pill bg-dark text-light px-3 py-2">
                                        oleh: {{ $value['nama'] }}
                                    </span>
                                </div>
                                <p class="card-text mt-3 text-dark fst-italic">"{{ $value['komentar'] }}"</p>
                                <p class="blockquote-footer text-muted"><i class="bi bi-clock-history"></i> {{ $value['created_at'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
        {{-- <section class="testimonial-section" id="testimonials">
            <div class="container">
                <div class="text-center mb-5 fade-in">
                    <h2>What Our Students Say</h2>
                    <p class="lead">Success stories from our community</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 fade-in">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-4">
                                <img src="/api/placeholder/80/80" alt="Student" class="client-image me-3">
                                <div>
                                    <h5 class="mb-1">Sarah Johnson</h5>
                                    <p class="mb-0">Music Club Member</p>
                                </div>
                            </div>
                            <p class="mb-0">"The music program has transformed my understanding of rhythm and melody. The instructors are incredibly supportive and knowledgeable."</p>
                        </div>
                    </div>
                    <div class="col-lg-6 fade-in">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-4">
                                <img src="/api/placeholder/80/80" alt="Student" class="client-image me-3">
                                <div>
                                    <h5 class="mb-1">Michael Chen</h5>
                                    <p class="mb-0">Sports Team Captain</p>
                                </div>
                            </div>
                            <p class="mb-0">"Being part of the sports team has taught me leadership, teamwork, and discipline. It's been an amazing journey of growth."</p>
                        </div>
                    </div>
                </div>
                <div class="navigation-dots mt-4">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </section> --}}
    </section>
    <!-- Testimonial Section -->
    <section class="container py-5 mt-5 scroll-animation">
        <h2 class="text-center mb-4">Apa Kata Mereka?</h2>
        <div class="row text-center my-4">
            <div class="col-md-6 mx-auto">
                <i class="bi bi-person-circle text-primary" style="font-size: 3rem;"></i>
                <p class="mt-3 fst-italic">
                    "Pendidikan adalah senjata paling ampuh yang bisa kamu gunakan untuk mengubah dunia."
                </p>
                <h5 class="fw-bold">- Nelson Mandela</h5>
            </div>
        </div>
    </section>
    
    @endsection 
