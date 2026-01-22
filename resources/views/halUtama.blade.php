@extends('material.dash')

@section('temp')
    <!-- Hero Section -->
    <!-- Hero Section -->
    <header class="container py-5 mt-3">
        <div class="row align-items-center g-5 py-lg-5 py-3">
            <div class="col-lg-6 text-center-sm">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">
                    <i class="bi bi-stars me-2"></i>Solusi Akademik #1 di Indonesia
                </span>
                <h1 class="display-3 fw-bold mb-4 lh-sm">
                    Raih Nilai Sempurna <br>
                    <span class="text-gradient">Tanpa Stress</span>
                </h1>
                <p class="lead text-muted mb-5 pe-lg-5">
                    Serahkan tumpukan tugasmu kepada tim profesional kami. Dari makalah, presentasi, hingga skripsi, kami
                    siap membantu Anda lulus tepat waktu dengan hasil terbaik.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center-sm">
                    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                        class="btn btn-premium shadow-lg">
                        <i class="bi bi-whatsapp me-2"></i> Hubungi Kami
                    </a>
                    <a href="#features" class="btn btn-glass-outline">
                        Pelajari Layanan
                    </a>
                </div>

                <div class="mt-5 d-flex align-items-center gap-4 justify-content-center-sm">
                    <div class="d-flex border-end pe-4 align-items-center">
                        <i class="bi bi-people-fill fs-2 text-primary me-3"></i>
                        <div>
                            <h4 class="fw-bold mb-0">1.5k+</h4>
                            <small class="text-muted">Klien Puas</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-star-fill fs-2 text-warning me-3"></i>
                        <div>
                            <h4 class="fw-bold mb-0">4.9</h4>
                            <small class="text-muted">Rating Rata-rata</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 text-center position-relative">
                <div
                    class="position-absolute top-50 start-50 translate-middle w-75 h-75 bg-primary opacity-25 rounded-circle z-n1">
                </div>
                <!-- Updated Image with better scaling for mobile -->
                <img class="img-fluid floating-animation hero-img" src="{{ asset('asset/hero.png') }}"
                    alt="Student Success">
                <style>
                    .hero-img {
                        max-height: 480px;
                        width: auto;
                    }

                    @media(max-width: 768px) {
                        .hero-img {
                            max-height: 200px !important;
                            width: auto !important;
                            margin-top: 1rem;
                        }
                    }
                </style>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="features" class="container py-5">
        <div class="text-center mb-5 mw-md mx-auto" style="max-width: 700px;">
            <span class="text-primary fw-bold text-uppercase tracking-wider small">Layanan Kami</span>
            <h2 class="display-5 fw-bold mt-2">Apapun Tugasnya,<br>Kami Ahlinya</h2>
            <p class="text-muted mt-3">Kami menyediakan berbagai layanan akademik yang disesuaikan dengan kebutuhan Anda,
                dikerjakan oleh tim lulusan universitas ternama.</p>
        </div>

        <div class="row g-4 pt-3">
            <!-- Service Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="glass-card h-100 p-4 p-xl-5 position-relative overflow-hidden group-hover">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="icon-box bg-white shadow-sm p-3 rounded-4">
                            <i class="bi bi-people fw-bold fs-3 text-primary"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Terpopuler</span>
                    </div>
                    <h3 class="fw-bold mb-3">Open Talent</h3>
                    <p class="text-muted mb-4">Bergabunglah dengan ekosistem kami. Bekerja fleksibel, asah skill, dan
                        dapatkan penghasilan tambahan sambil kuliah.</p>
                    <div class="mb-4 rounded-4 overflow-hidden bg-light" style="height: 180px;">
                        <img src="{{ asset('asset/talent.png') }}" class="w-100 h-100 object-fit-cover" alt="Talent">
                    </div>
                    <a href="https://forms.gle/5QYUNjTukfX5GMsP9"
                        class="stretched-link fw-bold text-decoration-none text-primary">Daftar Sekarang <i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>

            <!-- Service Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="glass-card h-100 p-4 p-xl-5 position-relative overflow-hidden border-primary">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="icon-box bg-primary text-white shadow-lg p-3 rounded-4">
                            <i class="bi bi-mortarboard-fill fs-3"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-3">Joki Skripsi</h3>
                    <p class="text-muted mb-4">Macet di Bab 2? Atau bingung olah data? Kami bantu dari judul sampai wisuda
                        dengan garansi bimbingan.</p>
                    <div class="mb-4 rounded-4 overflow-hidden bg-light" style="height: 180px;">
                        <img src="{{ asset('asset/writing.png') }}" class="w-100 h-100 object-fit-cover" alt="Skripsi">
                    </div>
                    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                        class="stretched-link fw-bold text-decoration-none text-primary">Konsultasi Gratis <i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>

            <!-- Service Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="glass-card h-100 p-4 p-xl-5 position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="icon-box bg-white shadow-sm p-3 rounded-4">
                            <i class="bi bi-tags-fill fs-3 text-warning"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-3">Cek Harga</h3>
                    <p class="text-muted mb-4">Transparansi adalah kunci. Unduh daftar harga lengkap layanan kami. Mulai
                        dari tugas harian hingga paket skripsi.</p>
                    <div class="mb-4 rounded-4 overflow-hidden bg-light" style="height: 180px;">
                        <img src="{{ asset('asset/pricing.png') }}" class="w-100 h-100 object-fit-cover" alt="Pricing">
                    </div>
                    <a href="{{ url('/pricelist') }}" class="stretched-link fw-bold text-decoration-none text-primary">Lihat
                        Pricelist List <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="process" class="py-5 my-5 bg-white bg-opacity-50">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Proses Mudah</span>
                <h2 class="display-6 fw-bold mt-2">Cara Kerja Kami</h2>
            </div>

            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="bg-white rounded-circle shadow-sm mx-auto d-flex align-items-center justify-content-center mb-4"
                            style="width: 100px; height: 100px;">
                            <span class="display-6 fw-bold text-primary">1</span>
                        </div>
                        <h4 class="fw-bold">Kirim Detail Tugas</h4>
                        <p class="text-muted w-75 mx-auto">Hubungi kami via WhatsApp dan kirimkan detail tugas serta
                            deadline yang diinginkan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="bg-white rounded-circle shadow-sm mx-auto d-flex align-items-center justify-content-center mb-4"
                            style="width: 100px; height: 100px;">
                            <span class="display-6 fw-bold text-primary">2</span>
                        </div>
                        <h4 class="fw-bold">Proses Pengerjaan</h4>
                        <p class="text-muted w-75 mx-auto">Tim ahli kami akan mengerjakan tugas Anda dengan teliti. Anda
                            bisa memantau progressnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="bg-white rounded-circle shadow-sm mx-auto d-flex align-items-center justify-content-center mb-4"
                            style="width: 100px; height: 100px;">
                            <span class="display-6 fw-bold text-primary">3</span>
                        </div>
                        <h4 class="fw-bold">Selesai & Revisi</h4>
                        <p class="text-muted w-75 mx-auto">File dikirim tepat waktu. Jika ada yang kurang sesuai, kami
                            berikan revisi gratis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us (Extended) -->
    <section class="container py-5">
        <div class="glass-card p-5 bg-white">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center">
                    <h2 class="display-2 fw-bold text-primary">{{ $jumlah_costomer_belum + 7 }}</h2>
                    <p class="lead fw-bold mb-1">Antrean Aktif Saat Ini</p>
                    <p class="text-muted small">Bergabunglah dengan mereka yang memilih cerdas.</p>
                    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                        class="btn btn-premium mt-3 w-100">Amankan Slotmu Sekarang</a>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3"><i
                                        class="bi bi-shield-check-fill text-primary fs-4"></i></div>
                                <h5 class="fw-bold mb-0">Privasi Aman</h5>
                            </div>
                            <p class="text-muted small ps-5 ms-2">Data diri dan data tugas Anda 100% rahasia dan tidak akan
                                dipublikasikan.</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3"><i
                                        class="bi bi-clock-history text-success fs-4"></i></div>
                                <h5 class="fw-bold mb-0">Tepat Waktu</h5>
                            </div>
                            <p class="text-muted small ps-5 ms-2">Deadline adalah harga mati. Kami memberikan garansi uang
                                kembali jika telat.</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3"><i
                                        class="bi bi-award-fill text-warning fs-4"></i></div>
                                <h5 class="fw-bold mb-0">Originalitas</h5>
                            </div>
                            <p class="text-muted small ps-5 ms-2">Setiap karya tulis dicek turnitin untuk memastikan bebas
                                plagiasi.</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3"><i
                                        class="bi bi-infinity text-info fs-4"></i></div>
                                <h5 class="fw-bold mb-0">Revisi Unlimited</h5>
                            </div>
                            <p class="text-muted small ps-5 ms-2">Kami tidak akan berhenti sampai Anda benar-benar puas
                                dengan hasilnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials & Form -->
    <section id="testimonials" class="container py-5 mt-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 order-2 order-lg-1">
                <div class="text-start mb-4">
                    <span class="text-primary fw-bold text-uppercase tracking-wider small">Testimoni</span>
                    <h2 class="display-6 fw-bold mt-2">Kata Mereka</h2>
                </div>

                <!-- Carousel Container -->
                <div class="carousel-container position-relative">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($komentar as $key => $value)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="glass-card p-5 bg-white border-0 shadow-sm text-center mx-1 d-flex flex-column align-items-center justify-content-center"
                                        style="min-height: 350px;">

                                        <div class="mb-4">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 80px; height: 80px;">
                                                <i class="bi bi-chat-quote-fill text-primary fs-1"></i>
                                            </div>
                                            <div class="text-warning small">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>

                                        <p class="lead text-dark fst-italic mb-4 position-relative z-1 px-lg-5">
                                            "{{ $value['komentar'] }}"
                                        </p>

                                        <div class="mt-auto">
                                            <h5 class="fw-bold mb-0 text-primary">{{ $value['nama'] }}</h5>
                                            <small class="text-muted fw-bold text-uppercase tracking-wider"
                                                style="font-size: 0.7rem;">{{ $value['tentang'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Fixed Controls -->
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button class="btn btn-light rounded-circle shadow-sm" type="button"
                                data-bs-target="#testimonialCarousel" data-bs-slide="prev"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-arrow-left"></i>
                            </button>
                            <button class="btn btn-light rounded-circle shadow-sm" type="button"
                                data-bs-target="#testimonialCarousel" data-bs-slide="next"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 order-1 order-lg-2">
                <div class="glass-card p-4 bg-white shadow-lg border-primary border-opacity-25">
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 60px; height: 60px; box-shadow: 0 5px 15px rgba(72, 52, 212, 0.3);">
                            <i class="bi bi-pen-fill fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Bagikan Pengalamanmu</h4>
                        <p class="text-muted small">Pendapat Anda sangat berarti bagi pengembangan layanan kami.</p>
                    </div>

                    <form method="post" action="{{ url('utama/komentar') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ps-2">NAMA</label>
                            <input type="text" class="form-control border-0 bg-light py-3 px-4 fw-bold"
                                style="border-radius: 12px;" name="nama" placeholder="Nama Kamu" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ps-2">TOPIK TUGAS</label>
                            <input type="text" class="form-control border-0 bg-light py-3 px-4 fw-bold"
                                style="border-radius: 12px;" name="tentang" placeholder="Cth: Skripsi Manajemen" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted ps-2">ULASAN</label>
                            <textarea class="form-control border-0 bg-light py-3 px-4 fw-bold" style="border-radius: 12px;"
                                name="komentar" rows="3" placeholder="Ceritakan pengalamanmu..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 py-3 rounded-4 fw-bold shadow-lg">Kirim
                            Ulasan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (New) -->
    <section id="faq" class="container py-5 my-5">
        <div class="text-center mb-5">
            <span class="text-primary fw-bold text-uppercase tracking-wider small">FAQ</span>
            <h2 class="fw-bold mt-2">Pertanyaan Sering Diajukan</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush glass-card overflow-hidden" id="accordionFAQ">

                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1">
                                Berapa lama proses pengerjaan tugas?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted">
                                Waktu pengerjaan menyesuaikan tingkat kesulitan dan jenis tugas. Untuk tugas harian umumnya
                                membutuhkan 1–5 hari, sedangkan skripsi atau tesis mengikuti kebutuhan dan alur bimbingan
                                Anda.
                                Tersedia juga layanan prioritas untuk kebutuhan mendesak.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah data dan privasi saya aman?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted">
                                Keamanan dan privasi Anda adalah prioritas kami. Seluruh data bersifat rahasia dan tidak
                                akan
                                dibagikan ke pihak mana pun.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah tersedia layanan revisi?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted">
                                Ya. Kami menyediakan <strong>1x revisi gratis</strong>. Revisi dapat diajukan setelah hasil
                                pengerjaan selesai dan dikirimkan, sesuai dengan kesepakatan awal.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq5">
                                Layanan apa saja yang tersedia?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted">
                                Kami melayani berbagai kebutuhan akademik seperti Makalah, Proposal, Essay, Jurnal, Skripsi,
                                Tesis, Presentasi (PPT), hingga jasa tulis tangan. Detail layanan dapat dilihat pada menu
                                pricelist.
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3">
                                Bagaimana sistem pembayarannya?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted">
                                Pembayaran dilakukan <strong>di akhir pengerjaan</strong>, setelah pembayaran hasil
                                pekerjaan selesai
                                dan
                                dikirimkan kepada Anda.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- Closing Quote -->
    <section class="container py-5 text-center mb-5">
        <div class="py-5">
            <i class="bi bi-quote fs-1 text-primary opacity-25"></i>
            <h3 class="display-6 fst-italic my-4 mx-auto fw-normal" style="max-width: 800px;">
                "Setiap orang berhak melangkah dengan ritmenya sendiri,
                memberi waktu untuk bernapas, memahami, dan tumbuh tanpa tekanan."
            </h3>
            <div class="d-flex align-items-center justify-content-center mt-4">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 50px; height: 50px;">
                    <i class="bi bi-person-fill fs-4"></i>
                </div>
                <div class="text-start">
                    <h5 class="fw-bold mb-0">Tertanda</h5>
                    <small class="text-muted">Admin Jauki</small>
                </div>
            </div>
        </div>
    </section>


    <style>
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) scale(1.1);
            }

            50% {
                transform: translateY(-20px) scale(1.1);
            }

            100% {
                transform: translateY(0px) scale(1.1);
            }
        }


        .tracking-wider {
            letter-spacing: 0.1em;
        }

        /* Accordion Custom */
        .accordion-button:not(.collapsed) {
            color: var(--primary-accent);
            background-color: rgba(72, 52, 212, 0.05);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }

        /* Group Hover Effects */
        .group-hover:hover .icon-box {
            background-color: var(--primary-accent) !important;
            color: white !important;
        }

        .group-hover .icon-box {
            transition: all 0.3s ease;
        }
    </style>
@endsection