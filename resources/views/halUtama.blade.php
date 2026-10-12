@extends('material.dash')

@section('temp')
    <!-- Hero Section -->
    <section class="container pt-3 pb-4">
        <div class="jt-hero-card position-relative overflow-hidden">
            <div class="jt-shape jt-shape--semi" style="--c: #F4A6B8; top: -18px; right: 34%;"></div>
            <div class="jt-shape jt-shape--spark" style="--c: #46A375; top: 34px; left: 46%;"></div>

            <div class="row align-items-center g-3 g-lg-5 p-3 p-lg-5 position-relative">
                <div class="col-7 col-md-6 text-start">
                    <div class="d-inline-flex align-items-center mb-3 word-reveal overflow-visible">
                        <span class="jt-chip px-3 py-2 hero-chip" style="letter-spacing: 0.1rem; font-size: 0.72rem;">
                            <i class="bi bi-stars text-jt-orange"></i>SAHABAT SETIA MAHASISWA #1 DI INDONESIA
                        </span>
                        <span class="ms-2 badge bg-jt-yellow text-jt-brown px-2 py-1 rounded-pill small fw-bold d-none d-sm-inline-block" style="font-size: 0.6rem;">HOT</span>
                    </div>

                    <h1 class="fw-bold mb-3 lh-tight hero-title hero-heading main-reveal" style="font-weight: 900 !important;">
                        <span class="d-block word-reveal overflow-visible" style="letter-spacing: -0.04em;">
                            <span class="text-premium-dark">Jauki Tugas</span>
                            <span class="position-relative d-inline-block ms-1">
                                <span class="text-jt-orange">Jogja</span>
                                <svg class="position-absolute start-0 bottom-0 w-100 h-25" viewBox="0 0 100 20" preserveAspectRatio="none" style="margin-bottom: -5px; z-index: -1;">
                                    <path d="M0 15 Q 50 5, 100 15" stroke="var(--jt-yellow)" stroke-width="5" fill="none" stroke-linecap="round" class="scribble-path" style="stroke-dasharray: 100; stroke-dashoffset: 100;"></path>
                                </svg>
                            </span>
                        </span>
                        <span class="text-gradient d-block highlight-reveal mt-2" style="font-size: 0.42em; letter-spacing: 0.08em; text-transform: uppercase;">
                            <i class="bi bi-shield-check-fill me-2"></i>Partner Akademik Profesional & Terpercaya
                        </span>
                    </h1>

                    <p class="lead text-muted mb-4 pe-lg-5 para-reveal hero-lead">
                        Raih nilai puncak tanpa harus begadang. Serahkan tugasmu kepada tim profesional kami. Dari makalah,
                        presentasi, hingga skripsi — kami siap membantu Anda lulus tepat waktu dengan hasil terbaik.
                    </p>

                    <div class="d-flex flex-row align-items-center gap-2 gap-xl-3 btn-reveal mb-4">
                        <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                            aria-label="Hubungi Kami via WhatsApp" class="btn btn-premium px-3 py-3 hero-cta hero-cta-wa d-flex align-items-center justify-content-center">
                            <i class="bi bi-whatsapp me-2 fs-4"></i>
                            <div class="text-start">
                                <small class="d-block fw-normal" style="font-size: 0.65rem; line-height: 1; opacity: 0.75;">Respon Cepat</small>
                                <span class="fw-bold">Hubungi Kami (WA)</span>
                            </div>
                        </a>
                        <a href="{{ url('/pricelist') }}"
                            class="btn btn-glass-outline-premium px-3 py-3 hero-cta d-flex align-items-center justify-content-center">
                            <i class="bi bi-tag-fill me-2 fs-5 text-jt-orange"></i>
                            <div class="text-start">
                                <small class="d-block fw-normal text-muted" style="font-size: 0.65rem; line-height: 1;">Mulai Rp 5.000</small>
                                <span class="fw-bold">Cek Harga & Layanan</span>
                            </div>
                        </a>
                    </div>

                    <div class="d-flex align-items-center gap-2 gap-lg-4 hero-stats">
                        <div class="d-flex border-end pe-2 pe-lg-4 align-items-center">
                            <i class="bi bi-people-fill fs-2 text-jt-orange me-3"></i>
                            <div>
                                <div class="jt-stat-num">1.5k+</div>
                                <div class="jt-stat-label">Klien Puas</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-star-fill fs-2 me-3" style="color: var(--jt-yellow);"></i>
                            <div>
                                <div class="jt-stat-num">4.9</div>
                                <div class="jt-stat-label">Rating Rata-rata</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5 col-md-6">
                    <div class="jt-hero-art position-relative mx-auto hero-art">
                        <div class="jt-arch jt-hero-arch bg-jt-yellow">
                            <img src="{{ asset('asset/generated/hero-scene.svg') }}" alt="Ilustrasi belajar dan menyelesaikan tugas">
                        </div>
                        <div class="jt-shape jt-shape--ring" style="--c: #46A375; top: -2%; left: -2%;"></div>
                        <div class="jt-shape jt-shape--blob" style="--c: #7CB1EB; top: -6%; right: -4%;"></div>
                        <div class="jt-play-orb" style="top: 40%; left: -8%; background: var(--jt-pink);"><i class="bi bi-play-fill"></i></div>
                        <div class="jt-wave-orb" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
                        <div class="jt-bubble" style="top: 10%; right: 2%;">Hello!</div>
                        <div class="jt-label" style="bottom: 8%; right: -2%;">Jauki Tugas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Hemat (list pill) -->
    @php
        $waHemat = 'https://wa.me/6285184771744?text=';
        $paketHemat = [
            ['name' => 'Paket Skripsi (SEMPRO)', 'meta' => 'BAB 1 - BAB 3 · Free Revisi 15x', 'price' => 'Rp 1.200.000', 'art' => 'layanan-skripsi.svg', 'bg' => 'bg-jt-pink'],
            ['name' => 'Paket Skripsi Full Bab', 'meta' => 'Full Bab · Free Revisi 25x', 'price' => 'Rp 2.200.000', 'art' => 'layanan-skripsi.svg', 'bg' => 'bg-jt-yellow'],
            ['name' => 'Paket Makalah + PPT', 'meta' => '10 halaman makalah + 10 slide PPT', 'price' => 'Rp 75.000', 'art' => 'layanan-makalah.svg', 'bg' => 'bg-jt-blue'],
            ['name' => 'Makalah', 'meta' => 'Per halaman', 'price' => 'Mulai Rp 5.000', 'art' => 'layanan-makalah.svg', 'bg' => 'bg-jt-blue'],
            ['name' => 'PPT (Materi Sudah Ada)', 'meta' => 'Per slide', 'price' => 'Mulai Rp 3.000', 'art' => 'layanan-ppt.svg', 'bg' => 'bg-jt-yellow'],
            ['name' => 'Proposal', 'meta' => 'Per halaman', 'price' => 'Mulai Rp 5.000', 'art' => 'layanan-makalah.svg', 'bg' => 'bg-jt-orange'],
        ];
    @endphp
    <section class="container py-5">
        <div class="text-center mb-5">
            <span class="jt-eyebrow">Paket Hemat</span>
            <h2 class="display-6 fw-bold mt-2">Pilihan Paket Favorit</h2>
        </div>
        <div class="row g-4">
            @foreach($paketHemat as $paket)
            <div class="col-md-6 col-lg-4">
                <a href="{{ $waHemat . rawurlencode('Halo Admin, saya mau order ' . $paket['name'] . ' (' . $paket['price'] . ')') }}"
                    target="_blank" class="jt-list-row">
                    <span class="jt-thumb {{ $paket['bg'] }}">
                        <img src="{{ asset('asset/generated/' . $paket['art']) }}" alt="">
                    </span>
                    <span class="jt-list-body">
                        <span class="d-block fw-bold lh-sm">{{ $paket['name'] }}</span>
                        <span class="d-block small text-muted lh-sm">{{ $paket['meta'] }}</span>
                        <span class="d-block fw-bold text-jt-orange">{{ $paket['price'] }}</span>
                    </span>
                    <span class="jt-play"><i class="bi bi-arrow-right"></i></span>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Layanan (2 kartu utama) -->
    <section id="features" class="container py-5">
        <div class="text-center mb-5 mw-md mx-auto" style="max-width: 700px;">
            <span class="jt-eyebrow">Layanan Kami</span>
            <h2 class="display-5 fw-bold mt-2">Apapun Tugasnya,<br>Kami Ahlinya</h2>
            <p class="text-muted mt-3">Kami menyediakan berbagai layanan akademik yang disesuaikan dengan kebutuhan Anda,
                dikerjakan oleh tim lulusan universitas ternama.</p>
        </div>

        <div class="row g-4 pt-3">
            <div class="col-lg-6 col-md-6">
                <div class="glass-card h-100 p-4 p-xl-5 position-relative overflow-hidden">
                    <span class="jt-chip mb-4"><i class="bi bi-mortarboard-fill text-jt-orange"></i>Skripsi</span>
                    <h3 class="fw-bold mb-3">Joki Skripsi</h3>
                    <p class="text-muted mb-4">Macet di Bab 2? Atau bingung olah data? Kami bantu dari judul sampai wisuda
                        dengan garansi bimbingan.</p>
                    <div class="jt-arch bg-jt-pink mb-4" style="height: 230px;">
                        <img src="{{ asset('asset/generated/layanan-skripsi.svg') }}" alt="Ilustrasi joki skripsi">
                    </div>
                    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                        class="stretched-link fw-bold text-decoration-none text-jt-orange">Konsultasi Gratis <i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="glass-card h-100 p-4 p-xl-5 position-relative overflow-hidden">
                    <span class="jt-chip mb-4"><i class="bi bi-tags-fill text-jt-orange"></i>Harga</span>
                    <h3 class="fw-bold mb-3">Cek Harga</h3>
                    <p class="text-muted mb-4">Transparansi adalah kunci. Lihat daftar harga lengkap layanan kami. Mulai
                        dari tugas harian hingga paket skripsi.</p>
                    <div class="jt-arch bg-jt-green mb-4" style="height: 230px;">
                        <img src="{{ asset('asset/generated/layanan-harga.svg') }}" alt="Ilustrasi daftar harga">
                    </div>
                    <a href="{{ url('/pricelist') }}" class="stretched-link fw-bold text-decoration-none text-jt-orange">Cek Harga Lengkap <i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Unggulan (kartu arch) -->
    @php
        $layananUnggulan = [
            ['name' => 'Joki Makalah', 'price' => 'Rp 50.000 / 10 halaman', 'art' => 'layanan-makalah.svg', 'bg' => 'bg-jt-blue'],
            ['name' => 'Joki PPT', 'price' => 'Rp 30.000 / 10 slide', 'art' => 'layanan-ppt.svg', 'bg' => 'bg-jt-yellow'],
            ['name' => 'Jurnal & Publikasi', 'price' => 'Mulai Rp 150.000', 'art' => 'layanan-jurnal.svg', 'bg' => 'bg-jt-pink'],
            ['name' => 'Tulis Tangan', 'price' => 'Mulai Rp 5.000', 'art' => 'layanan-tulis-tangan.svg', 'bg' => 'bg-jt-orange'],
        ];
    @endphp
    <section class="container py-5">
        <div class="text-center mb-5">
            <span class="jt-eyebrow">Layanan Unggulan</span>
            <h2 class="display-6 fw-bold mt-2">Tugas Harianmu, Kami Yang Urus</h2>
        </div>
        <div class="row g-4">
            @foreach($layananUnggulan as $item)
            <div class="col-6 col-lg-3">
                <div class="glass-card h-100 p-3 text-center">
                    <div class="jt-arch {{ $item['bg'] }} mx-auto mb-3" style="height: 220px;">
                        <img src="{{ asset('asset/generated/' . $item['art']) }}" alt="{{ $item['name'] }}" style="padding: 14px;">
                    </div>
                    <h5 class="fw-bold mb-1">{{ $item['name'] }}</h5>
                    <p class="small text-muted mb-3">{{ $item['price'] }}</p>
                    <a href="{{ $waHemat . rawurlencode('Halo Admin, saya mau tanya ' . $item['name']) }}" target="_blank"
                        class="btn btn-outline-primary rounded-pill btn-sm px-3 fw-bold">Pesan</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Why Us (Extended) -->
    <section class="container py-5">
        <div class="glass-card p-4 p-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center">
                    <div class="jt-stat-num" style="font-size: clamp(3.5rem, 8vw, 5.5rem);">{{ $jumlah_costomer_belum + 7 }}</div>
                    <p class="lead fw-bold mb-1 text-jt-brown">Antrean Aktif Saat Ini</p>
                    <p class="text-muted small">Bergabunglah dengan mereka yang memilih cerdas.</p>
                    <a href="https://wa.me/6285184771744?text=Halo%20Jauki%20Tugas%2C%20saya%20ingin%20konsultasi"
                        class="btn btn-premium mt-3 w-100">Amankan Slotmu Sekarang</a>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <span class="jt-check"><i class="bi bi-check-lg"></i></span>
                                <div>
                                    <h5 class="fw-bold mb-1">Privasi Aman</h5>
                                    <p class="text-muted small mb-0">Data diri dan data tugas Anda 100% rahasia dan tidak akan
                                        dipublikasikan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <span class="jt-check"><i class="bi bi-check-lg"></i></span>
                                <div>
                                    <h5 class="fw-bold mb-1">Tepat Waktu</h5>
                                    <p class="text-muted small mb-0">Deadline adalah harga mati. Kami memberikan garansi uang
                                        kembali jika telat.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <span class="jt-check"><i class="bi bi-check-lg"></i></span>
                                <div>
                                    <h5 class="fw-bold mb-1">Originalitas</h5>
                                    <p class="text-muted small mb-0">Setiap karya tulis dicek turnitin untuk memastikan bebas
                                        plagiasi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <span class="jt-check"><i class="bi bi-check-lg"></i></span>
                                <div>
                                    <h5 class="fw-bold mb-1">Revisi Unlimited</h5>
                                    <p class="text-muted small mb-0">Kami tidak akan berhenti sampai Anda benar-benar puas
                                        dengan hasilnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Talent Highlight Section -->
    <section class="container py-5">
        <div class="jt-banner">
            <div class="jt-shape jt-shape--semi" style="--c: #46A375; top: -18px; left: 42%;"></div>
            <div class="jt-shape jt-shape--dot" style="--c: #F4A6B8; bottom: 36px; left: 28px;"></div>
            <div class="jt-shape jt-shape--ring" style="--c: #E07540; bottom: -36px; right: 38%;"></div>
            <div class="row g-0 align-items-center">
                <div class="col-lg-7 p-4 p-md-5 jt-content">
                    <span class="jt-chip mb-4"><i class="bi bi-megaphone-fill text-jt-orange"></i>WE ARE HIRING!</span>
                    <h2 class="display-5 fw-bold mb-4 text-white">Bergabunglah Sebagai <br> <span
                            style="color: var(--jt-yellow);">Talent Jauki Tugas</span></h2>
                    <p class="lead mb-5">
                        Jadilah bagian dari ekosistem bantuan akademik terbesar. Dapatkan penghasilan jutaan rupiah, bekerja
                        fleksibel dari mana saja, dan asah kemampuan akademikmu.
                    </p>
                    <div class="row g-4 mb-5">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-check-circle-fill fs-4 me-3" style="color: var(--jt-yellow);"></i>
                                <span>Waktu Fleksibel</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-check-circle-fill fs-4 me-3" style="color: var(--jt-yellow);"></i>
                                <span>Penghasilan Menarik</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-check-circle-fill fs-4 me-3" style="color: var(--jt-yellow);"></i>
                                <span>Asah Kemampuan</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-check-circle-fill fs-4 me-3" style="color: var(--jt-yellow);"></i>
                                <span>Relasi Luas</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('talent.register') }}" class="btn btn-premium btn-lg px-5 py-3">
                        Daftar Talent Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center p-4 jt-content">
                    <img src="{{ asset('asset/generated/talent.svg') }}" class="w-100" alt="Ilustrasi talent Jauki Tugas" style="max-width: 420px;">
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="process" class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="jt-eyebrow">Proses Mudah</span>
                <h2 class="display-6 fw-bold mt-2">Cara Kerja Kami</h2>
            </div>

            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="jt-step bg-jt-yellow mx-auto d-flex align-items-center justify-content-center mb-4">
                            <span class="display-6 fw-bold text-jt-brown">1</span>
                        </div>
                        <h4 class="fw-bold">Kirim Detail Tugas</h4>
                        <p class="text-muted w-75 mx-auto">Hubungi kami via WhatsApp dan kirimkan detail tugas serta
                            deadline yang diinginkan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="jt-step bg-jt-green mx-auto d-flex align-items-center justify-content-center mb-4">
                            <span class="display-6 fw-bold text-white">2</span>
                        </div>
                        <h4 class="fw-bold">Proses Pengerjaan</h4>
                        <p class="text-muted w-75 mx-auto">Tim ahli kami akan mengerjakan tugas Anda dengan teliti. Anda
                            bisa memantau progressnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="jt-step bg-jt-orange mx-auto d-flex align-items-center justify-content-center mb-4">
                            <span class="display-6 fw-bold text-white">3</span>
                        </div>
                        <h4 class="fw-bold">Selesai & Revisi</h4>
                        <p class="text-muted w-75 mx-auto">File dikirim tepat waktu. Jika ada yang kurang sesuai, kami
                            berikan revisi gratis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials & Form -->
    <section id="testimonials" class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 order-2 order-lg-1">
                <div class="text-start mb-4">
                    <span class="jt-eyebrow">Testimoni</span>
                    <h2 class="display-6 fw-bold mt-2">Kata Mereka</h2>
                </div>

                <!-- Carousel Container -->
                <div class="carousel-container position-relative">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($komentar as $key => $value)
                                @php $tone = ['bg-jt-yellow', 'bg-jt-green', 'bg-jt-blue', 'bg-jt-pink'][$key % 4]; @endphp
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="glass-card overflow-hidden mx-1 text-center d-flex flex-column"
                                        style="min-height: 380px;">
                                        <div class="jt-testi-top {{ $tone }}">
                                            <i class="bi bi-chat-quote-fill"></i>
                                        </div>
                                        <div class="p-4 p-lg-5 d-flex flex-column flex-grow-1 align-items-center justify-content-center">
                                            <div class="text-jt-orange small mb-3">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                            <p class="lead text-dark fst-italic mb-4 px-lg-4">
                                                "{{ $value['komentar'] }}"
                                            </p>
                                            <div class="mt-auto">
                                                <h5 class="fw-bold mb-0 text-jt-brown">{{ $value['nama'] }}</h5>
                                                <small class="text-muted fw-bold text-uppercase tracking-wider"
                                                    style="font-size: 0.7rem;">{{ $value['tentang'] }}</small>
                                            </div>
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
                <div class="glass-card p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="jt-step bg-jt-orange mx-auto mb-3" style="width: 64px; height: 64px;">
                            <i class="bi bi-pen-fill fs-3 text-white"></i>
                        </div>
                        <h4 class="fw-bold">Bagikan Pengalamanmu</h4>
                        <p class="text-muted small">Pendapat Anda sangat berarti bagi pengembangan layanan kami.</p>
                    </div>

                    <form method="post" action="{{ url('utama/komentar') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ps-2">NAMA</label>
                            <input type="text" class="form-control border-0 bg-light py-3 px-4 fw-bold"
                                style="border-radius: 16px;" name="nama" placeholder="Nama Kamu" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted ps-2">TOPIK TUGAS</label>
                            <input type="text" class="form-control border-0 bg-light py-3 px-4 fw-bold"
                                style="border-radius: 16px;" name="tentang" placeholder="Cth: Skripsi Manajemen" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted ps-2">ULASAN</label>
                            <textarea class="form-control border-0 bg-light py-3 px-4 fw-bold" style="border-radius: 16px;"
                                name="komentar" rows="3" placeholder="Ceritakan pengalamanmu..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 py-3 rounded-pill fw-bold">Kirim
                            Ulasan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="container py-5">
        <div class="text-center mb-5">
            <span class="jt-eyebrow">FAQ</span>
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

    <!-- Latest Articles Section -->
    @if(isset($latest_articles) && $latest_articles->count() > 0)
    <section id="latest-articles" class="container py-5">
        <div class="text-center mb-5">
            <span class="jt-eyebrow">Blog & Update</span>
            <h2 class="display-5 fw-bold mt-2 mb-3">Artikel <span class="text-jt-orange">Terbaru</span></h2>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Tips, insight, dan informasi untuk membantu tugas, skripsi, riset, teknologi, dan produktivitas mahasiswa.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($latest_articles as $article)
            <div class="col-md-6 col-lg-4">
                <div class="glass-card h-100 overflow-hidden article-card">
                    <div class="position-relative p-3 pb-0">
                        <div class="jt-arch" style="height: 210px;">
                            @if($article->featured_image)
                                <img src="{{ $article->featured_image_url }}" class="jt-cover" alt="{{ $article->title }}">
                            @else
                                @include('partials.article-cover', ['article' => $article])
                            @endif
                        </div>
                        <div class="position-absolute top-0 end-0 m-4">
                            <span class="jt-chip">{{ $article->category ?? 'Umum' }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small">
                            <i class="bi bi-calendar3 me-1"></i> {{ $article->published_at ? $article->published_at->format('d M Y') : '' }}
                        </div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="{{ route('artikel.show', $article->slug) }}" class="text-decoration-none text-jt-brown">{{ Str::limit($article->title, 60) }}</a>
                        </h5>
                        <p class="card-text text-muted mb-4 flex-grow-1">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 90) }}</p>
                        <a href="{{ route('artikel.show', $article->slug) }}" class="text-jt-orange fw-semibold text-decoration-none d-inline-flex align-items-center mt-auto">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary rounded-pill px-5 py-2 fw-bold">
                Lihat Semua Artikel <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>
    @endif

    <section class="container py-5 text-center">
        <div class="py-5">
            <i class="bi bi-quote display-4 text-jt-orange opacity-50"></i>
            <h3 class="display-6 fst-italic my-4 mx-auto fw-normal" style="max-width: 800px;">
                "Setiap orang berhak melangkah dengan ritmenya sendiri,
                memberi waktu untuk bernapas, memahami, dan tumbuh tanpa tekanan."
            </h3>
            <div class="d-flex align-items-center justify-content-center mt-4">
                <div class="jt-step bg-jt-brown text-white rounded-circle d-flex align-items-center justify-content-center me-3"
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') {
                return;
            }

            const tl = gsap.timeline({
                defaults: {
                    ease: "expo.out"
                }
            });

            // Initial State
            gsap.set(".main-reveal", {
                visibility: "visible"
            });

            // Animation sequence
            tl.from(".word-reveal", {
                    y: 50,
                    opacity: 0,
                    duration: 1.5,
                    stagger: 0.2,
                    delay: 0.2
                })
                .from(".highlight-reveal", {
                    y: 30,
                    opacity: 0,
                    duration: 1.2
                }, "-=1")
                .to(".scribble-path", {
                    strokeDashoffset: 0,
                    duration: 1.5,
                    ease: "power2.out"
                }, "-=1.5")
                .from(".para-reveal", {
                    opacity: 0,
                    y: 20,
                    duration: 1.2
                }, "-=0.8")
                .from(".btn-reveal", {
                    opacity: 0,
                    y: 20,
                    duration: 1.2
                }, "-=1")
                .from(".hero-art", {
                    scale: 0.8,
                    opacity: 0,
                    duration: 1.5,
                    ease: "power4.out"
                }, "-=1.5");

            // Floating effect for hero art
            gsap.to(".hero-art", {
                y: 12,
                duration: 2.5,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });
        });
    </script>

    <style>
        .hero-art {
            max-width: 460px;
            padding: 24px;
        }

        /* Hero tetap dua kolom (kiri teks, kanan ilustrasi) di HP dan desktop */
        .hero-heading {
            font-size: clamp(1.6rem, 5.4vw, 4rem);
        }

        .hero-lead {
            font-size: clamp(0.72rem, 1.5vw, 1.15rem);
            line-height: 1.6;
        }

        .hero-stats .jt-stat-num {
            font-size: clamp(1.25rem, 3.4vw, 3rem);
        }

        .hero-stats .jt-stat-label {
            font-size: clamp(0.6rem, 1.2vw, 0.9rem);
        }

        @media (max-width: 767px) {
            .hero-chip {
                font-size: 0.55rem !important;
                letter-spacing: 0.04em !important;
                padding: 0.3rem 0.6rem !important;
                white-space: normal;
            }

            .hero-cta {
                padding: 0.55rem 0.7rem !important;
                border-radius: 22px !important;
            }

            .hero-cta .fs-4,
            .hero-cta .fs-5 {
                font-size: 1rem !important;
            }

            .hero-cta span {
                font-size: 0.8rem;
            }

            .hero-stats .fs-2 {
                font-size: 1.4rem !important;
            }

            .hero-stats .me-3 {
                margin-right: 0.4rem !important;
            }

            .hero-art {
                max-width: none;
                padding: 6px;
            }

            .hero-art .jt-play-orb {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .hero-art .jt-wave-orb {
                width: 54px;
                height: 54px;
                gap: 3px;
                left: -4px;
            }

            .hero-art .jt-wave-orb span {
                width: 5px;
            }

            .hero-art .jt-wave-orb span:nth-child(1) { height: 14px; }
            .hero-art .jt-wave-orb span:nth-child(2) { height: 24px; }
            .hero-art .jt-wave-orb span:nth-child(3) { height: 18px; }
            .hero-art .jt-wave-orb span:nth-child(4) { height: 10px; }

            .hero-art .jt-bubble,
            .hero-art .jt-label {
                font-size: 0.55rem;
                padding: 0.25rem 0.5rem;
            }

            .hero-art .jt-shape--blob,
            .hero-art .jt-shape--ring,
            .hero-art .jt-play-orb {
                display: none;
            }

            .hero-art .jt-wave-orb {
                bottom: -6px;
                left: -8px;
            }
        }

        /* Di layar kecil tombol WA cukup ikon saja; Cek Harga tetap berteks */
        @media (max-width: 1199.98px) {
            .hero-cta-wa {
                width: 52px;
                height: 52px;
                padding: 0 !important;
                border-radius: 50% !important;
                justify-content: center;
                flex-shrink: 0;
            }

            .hero-cta-wa > .bi {
                margin-right: 0 !important;
            }

            .hero-cta-wa > div {
                display: none !important;
            }
        }

        .jt-hero-card {
            background: var(--jt-cream-light);
            border-radius: 40px;
            box-shadow: var(--jt-shadow-sm);
        }

        .jt-hero-arch {
            width: 100%;
            max-width: 400px;
            aspect-ratio: 4 / 5;
            margin: 0 auto;
        }

        .jt-hero-art .jt-shape {
            z-index: 1;
        }

        .jt-play-orb,
        .jt-wave-orb,
        .jt-bubble,
        .jt-label {
            position: absolute;
            z-index: 2;
            box-shadow: var(--jt-shadow-sm);
        }

        .jt-play-orb {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--jt-brown);
            font-size: 1.6rem;
        }

        .jt-wave-orb {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            background: var(--jt-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            left: -10px;
            bottom: 24%;
            box-shadow: var(--jt-shadow);
        }

        .jt-wave-orb span {
            display: block;
            width: 8px;
            border-radius: 6px;
            background: #FFFFFF;
        }

        .jt-wave-orb span:nth-child(1) { height: 24px; }
        .jt-wave-orb span:nth-child(2) { height: 40px; }
        .jt-wave-orb span:nth-child(3) { height: 30px; }
        .jt-wave-orb span:nth-child(4) { height: 18px; }

        .jt-bubble {
            background: #FFFFFF;
            color: var(--jt-brown);
            font-weight: 800;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .jt-label {
            background: var(--jt-brown);
            color: #FFFFFF;
            border-radius: 999px;
            padding: 0.55rem 1.1rem;
            font-weight: 700;
            font-size: 0.85rem;
        }

        /* Badge bulat untuk langkah cara kerja */
        .jt-step {
            width: 104px;
            height: 104px;
            border-radius: 50%;
            box-shadow: var(--jt-shadow-sm);
        }

        /* Bagian atas kartu testimoni berbentuk lengkung */
        .jt-testi-top {
            height: 130px;
            border-radius: 28px 28px 50% 50% / 28px 28px 34px 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--jt-brown);
            font-size: 2.4rem;
        }

        .scribble-path {
            opacity: 0.9;
        }

        .tracking-wider {
            letter-spacing: 0.1em;
        }

        .article-card:hover {
            transform: translateY(-6px);
        }

        @media (max-width: 576px) {
            .display-3 {
                font-size: 2.5rem !important;
            }
            .hero-title {
                margin-top: 1rem;
            }
            .jt-step {
                width: 88px;
                height: 88px;
            }
        }
    </style>
@endsection
