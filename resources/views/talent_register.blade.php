@extends('material.dash')

@section('temp')
    <div class="registration-page py-5">
        <div class="container py-lg-5">
            <div class="row g-5 align-items-start">
                <!-- Left Side: Information & Benefits -->
                <div class="col-lg-5 text-white">
                    <div class="sticky-top" style="top: 100px; z-index: 1;">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                            <i class="bi bi-stars me-2"></i>Join Our Elite Team
                        </span>
                        <h1 class="display-3 fw-bold mb-4 lh-sm">Wujudkan Karir <br><span
                                class="text-warning">Akademikmu</span> Bersama Kami</h1>
                        <p class="lead opacity-75 mb-5">
                            Bantu ribuan mahasiswa meraih impian mereka sambil mengasah keahlian dan mendapatkan penghasilan
                            tambahan yang kompetitif.
                        </p>

                        <div class="benefits-grid">
                            <div
                                class="benefit-item d-flex align-items-center mb-4 p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur">
                                <div class="icon-box bg-warning text-dark rounded-circle me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; min-width: 50px;">
                                    <i class="bi bi-clock-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Waktu Fleksibel</h5>
                                    <small class="opacity-75">Kerja kapan saja, di mana saja.</small>
                                </div>
                            </div>
                            <div
                                class="benefit-item d-flex align-items-center mb-4 p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur">
                                <div class="icon-box bg-info text-white rounded-circle me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; min-width: 50px;">
                                    <i class="bi bi-cash-stack fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Penghasilan Menarik</h5>
                                    <small class="opacity-75">Sistem bagi hasil yang transparan.</small>
                                </div>
                            </div>
                            <div
                                class="benefit-item d-flex align-items-center p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur">
                                <div class="icon-box bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; min-width: 50px;">
                                    <i class="bi bi-shield-lock-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Keamanan Terjamin</h5>
                                    <small class="opacity-75">Sistem pembayaran & data aman.</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 p-4 rounded-4 bg-warning bg-opacity-10 border border-warning border-opacity-20">
                            <h6 class="fw-bold text-warning mb-2"><i class="bi bi-instagram me-2"></i>Wajib Follow Instagram
                            </h6>
                            <p class="small mb-0 opacity-75">Pastikan Anda sudah mengikuti <a
                                    href="https://instagram.com/jaukitugas" target="_blank"
                                    class="text-warning fw-bold text-decoration-none">@jaukitugas</a> sebelum mengirim
                                formulir ini.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Side: The Form -->
                <div class="col-lg-7">
                    <div class="glass-card p-4 p-md-5 border-0 shadow-2xl bg-white bg-opacity-95">
                        <div class="form-header mb-5">
                            <h2 class="fw-bold text-dark mb-2">Formulir Pendaftaran</h2>
                            <p class="text-muted">Lengkapi data diri Anda dengan benar untuk proses verifikasi cepat.</p>
                            <div class="h-1 bg-primary bg-opacity-10 rounded-pill mt-4"></div>
                        </div>

                        @if(session('success'))
                            <div
                                class="alert alert-success border-0 shadow-sm rounded-4 p-4 mb-4 animate__animated animate__fadeIn">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Berhasil Terkirim!</h6>
                                        <small>{{ session('success') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('talent.register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-floating-custom">
                                        <label class="form-label ms-1 fw-bold text-dark small mb-2">NAMA LENGKAP</label>
                                        <div class="input-group-custom">
                                            <span class="input-icon"><i class="bi bi-person"></i></span>
                                            <input type="text" name="nama_lengkap"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                value="{{ old('nama_lengkap') }}" required
                                                placeholder="Masukkan nama sesuai KTP/KTM">
                                        </div>
                                        @error('nama_lengkap') <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <label class="form-label ms-1 fw-bold text-dark small mb-2">EMAIL AKTIF</label>
                                        <div class="input-group-custom">
                                            <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" required placeholder="email@contoh.com">
                                        </div>
                                        @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <label class="form-label ms-1 fw-bold text-dark small mb-2">WHATSAPP</label>
                                        <div class="input-group-custom">
                                            <span class="input-icon"><i class="bi bi-whatsapp"></i></span>
                                            <input type="text" name="no_wa"
                                                class="form-control @error('no_wa') is-invalid @enderror"
                                                value="{{ old('no_wa') }}" required placeholder="08xxxxxxxxxx">
                                        </div>
                                        @error('no_wa') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <label class="form-label ms-1 fw-bold text-dark small mb-2">USERNAME
                                            INSTAGRAM</label>
                                        <div class="input-group-custom">
                                            <span class="input-icon">@</span>
                                            <input type="text" name="instagram"
                                                class="form-control @error('instagram') is-invalid @enderror"
                                                value="{{ old('instagram') }}" required placeholder="username_kamu">
                                        </div>
                                        @error('instagram') <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <label class="form-label ms-1 fw-bold text-dark small mb-2">ASAL UNIVERSITAS</label>
                                        <div class="input-group-custom">
                                            <span class="input-icon"><i class="bi bi-building"></i></span>
                                            <input type="text" name="asal_univ"
                                                class="form-control @error('asal_univ') is-invalid @enderror"
                                                value="{{ old('asal_univ') }}" required placeholder="Nama Kampus">
                                        </div>
                                        @error('asal_univ') <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating-custom">
                                        <label class="form-label ms-1 fw-bold text-dark small mb-2">PROGRAM STUDI &
                                            SEMESTER</label>
                                        <div class="input-group-custom">
                                            <span class="input-icon"><i class="bi bi-mortarboard"></i></span>
                                            <input type="text" name="program_study_semester"
                                                class="form-control @error('program_study_semester') is-invalid @enderror"
                                                value="{{ old('program_study_semester') }}" required
                                                placeholder="Contoh: Manajemen, Semester 4">
                                        </div>
                                        @error('program_study_semester') <div class="invalid-feedback d-block">
                                        {{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label ms-1 fw-bold text-dark small mb-3">KEAHLIAN UTAMA (Bisa pilih
                                        lebih dari satu)</label>
                                    <div class="row g-3">
                                        @php
                                            $skills = [
                                                ['id' => 'akademik', 'label' => 'Makalah & Jurnal', 'icon' => 'bi-journal-text'],
                                                ['id' => 'visual', 'label' => 'PPT & Animasi', 'icon' => 'bi-projector'],
                                                ['id' => 'akuntansi', 'label' => 'Akuntansi', 'icon' => 'bi-calculator'],
                                                ['id' => 'statistika', 'label' => 'Statistika', 'icon' => 'bi-graph-up-arrow'],
                                                ['id' => 'skripsi', 'label' => 'Skripsi/Tesis', 'icon' => 'bi-mortarboard-fill'],
                                                ['id' => 'desain', 'label' => 'Desain Grafis', 'icon' => 'bi-palette'],
                                                ['id' => 'it', 'label' => 'Coding / IT', 'icon' => 'bi-code-slash'],
                                                ['id' => 'other', 'label' => 'Lainnya', 'icon' => 'bi-plus-circle'],
                                            ];
                                        @endphp
                                        @foreach($skills as $skill)
                                            <div class="col-6 col-md-4">
                                                <input type="checkbox" class="btn-check" name="keahlian[]"
                                                    value="{{ $skill['label'] }}" id="skill_{{ $skill['id'] }}" {{ is_array(old('keahlian')) && in_array($skill['label'], old('keahlian')) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-outline-light text-dark w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center gap-2 transition-all skill-label"
                                                    for="skill_{{ $skill['id'] }}">
                                                    <i class="bi {{ $skill['icon'] }} fs-4 text-primary"></i>
                                                    <span class="small fw-bold">{{ $skill['label'] }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('keahlian') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <div
                                        class="upload-area p-4 p-md-5 rounded-4 border-2 border-dashed text-center bg-light">
                                        <div class="upload-icon mb-3">
                                            <i class="bi bi-file-earmark-pdf-fill display-4 text-primary opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Upload Berkas PDF</h6>
                                        <p class="text-muted small mb-4">Gabungkan menjadi satu PDF: CV, Lamaran, Transkrip
                                            Nilai, & Sertifikat (Maks 10MB)</p>

                                        <label for="pdf_upload" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                            <i class="bi bi-upload me-2"></i>Pilih File PDF
                                        </label>
                                        <input type="file" name="file_pdf" id="pdf_upload" class="d-none" accept=".pdf"
                                            required onchange="updateFileName(this)">
                                        <div id="file-name-preview" class="mt-3 small fw-bold text-primary"></div>
                                        @error('file_pdf') <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit"
                                        class="btn btn-premium w-100 py-3 rounded-4 fw-bold shadow-lg transform-hover">
                                        KIRIM LAMARAN SEKARANG <i class="bi bi-arrow-right-short ms-2 fs-4"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .registration-page {
            background: linear-gradient(135deg, #4834d4 0%, #686de0 100%);
            min-height: 100vh;
            background-attachment: fixed;
        }

        .backdrop-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Custom Input Groups */
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            color: var(--primary-accent);
            font-weight: bold;
            z-index: 5;
        }

        .input-group-custom .form-control {
            padding: 15px 15px 15px 50px !important;
            background-color: #f8f9fa !important;
            border: 2px solid transparent !important;
            border-radius: 15px !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .input-group-custom .form-control:focus {
            background-color: #fff !important;
            border-color: var(--primary-accent) !important;
            box-shadow: 0 0 0 4px rgba(72, 52, 212, 0.1) !important;
        }

        /* Skill Checkboxes */
        .skill-label {
            border: 2px solid #eee !important;
            background: #fff;
        }

        .btn-check:checked+.skill-label {
            border-color: var(--primary-accent) !important;
            background: rgba(72, 52, 212, 0.05) !important;
            box-shadow: 0 5px 15px rgba(72, 52, 212, 0.1);
        }

        .btn-check:checked+.skill-label i {
            transform: scale(1.2);
            transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Upload Area */
        .upload-area {
            border: 2px dashed #d1d8e0;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: var(--primary-accent);
            background-color: rgba(72, 52, 212, 0.02) !important;
        }

        /* Animations */
        .transition-all {
            transition: all 0.2s ease-in-out;
        }

        .transform-hover:hover {
            transform: translateY(-2px);
        }

        .h-1 {
            height: 4px;
            width: 80px;
        }

        @media (max-width: 991px) {
            .registration-page {
                background-attachment: scroll;
            }

            .display-3 {
                font-size: 2.5rem;
            }
        }
    </style>

    <script>
        function updateFileName(input) {
            const fileNamePreview = document.getElementById('file-name-preview');
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                fileNamePreview.innerHTML = `<i class="bi bi-file-check me-2"></i>File terpilih: ${fileName}`;
            }
        }

        // Add some scroll effects
        window.addEventListener('scroll', function () {
            const scrolled = window.window.scrollY;
            const hero = document.querySelector('.registration-page');
            if (hero) {
                // Subtle moving background pattern or color shift can be added here
            }
        });
    </script>
@endsection