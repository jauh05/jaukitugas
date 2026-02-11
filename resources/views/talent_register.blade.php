@extends('material.dash')

@section('temp')
    <div class="container py-5 mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header Card -->
                <div class="glass-card p-4 p-md-5 mb-4 border-0 shadow-lg">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-people-fill text-primary fs-1"></i>
                        </div>
                        <h2 class="fw-bold display-6">FORM PENDAFTARAN TALENT JAUKI TUGAS</h2>
                        <p class="text-muted">Bergabunglah dengan tim kami untuk memberikan bantuan akademik terbaik.</p>
                    </div>

                    <div class="alert alert-info border-0 bg-primary bg-opacity-10 text-primary rounded-4 p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-info-circle-fill me-2"></i> Ketentuan Pendaftaran:</h5>
                        <ul class="mb-0">
                            <li><strong>Wajib Follow Instagram:</strong> Untuk melengkapi proses pendaftaran, pastikan Anda sudah mengikuti Instagram kami di <a href="https://instagram.com/jaukitugas" target="_blank" class="fw-bold text-decoration-none text-primary">@jaukitugas</a>.</li>
                            <li><strong>Isi Formulir dengan Lengkap:</strong> Pastikan Anda mengisi semua informasi yang diminta dengan lengkap dan akurat.</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Langkah Pendaftaran:</h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded-4 text-center h-100">
                                    <div class="fw-bold text-primary mb-1">Step 1</div>
                                    <small class="text-muted d-block">Follow IG @jaukitugas</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded-4 text-center h-100">
                                    <div class="fw-bold text-primary mb-1">Step 2</div>
                                    <small class="text-muted d-block">Isi Formulir Ini</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded-4 text-center h-100">
                                    <div class="fw-bold text-primary mb-1">Step 3</div>
                                    <small class="text-muted d-block">Verifikasi Tim</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded-4 text-center h-100">
                                    <div class="fw-bold text-primary mb-1">Step 4</div>
                                    <small class="text-muted d-block">Konfirmasi Lolos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-4 p-4 mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Form Card -->
                <div class="glass-card p-4 p-md-5 border-0 shadow-lg">
                    <form action="{{ route('talent.register.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted small ps-2">NAMA LENGKAP <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control border-0 bg-light py-3 px-4 rounded-4 @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" required placeholder="Masukkan nama lengkap sesuai identitas">
                                @error('nama_lengkap') <div class="invalid-feedback ps-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small ps-2">EMAIL <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control border-0 bg-light py-3 px-4 rounded-4 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Alamat email aktif">
                                @error('email') <div class="invalid-feedback ps-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small ps-2">INSTAGRAM <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light rounded-start-4 ps-4">@</span>
                                    <input type="text" name="instagram" class="form-control border-0 bg-light py-3 pe-4 rounded-end-4 @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}" required placeholder="username_ig">
                                </div>
                                @error('instagram') <div class="invalid-feedback d-block ps-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small ps-2">NO WA (YANG BISA DIHUBUNGI) <span class="text-danger">*</span></label>
                                <input type="text" name="no_wa" class="form-control border-0 bg-light py-3 px-4 rounded-4 @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}" required placeholder="Contoh: 08123456789">
                                @error('no_wa') <div class="invalid-feedback ps-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small ps-2">ASAL UNIVERSITAS <span class="text-danger">*</span></label>
                                <input type="text" name="asal_univ" class="form-control border-0 bg-light py-3 px-4 rounded-4 @error('asal_univ') is-invalid @enderror" value="{{ old('asal_univ') }}" required placeholder="Contoh: Universitas Indonesia">
                                @error('asal_univ') <div class="invalid-feedback ps-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted small ps-2">PROGRAM STUDY DAN SEMESTER <span class="text-danger">*</span></label>
                                <input type="text" name="program_study_semester" class="form-control border-0 bg-light py-3 px-4 rounded-4 @error('program_study_semester') is-invalid @enderror" value="{{ old('program_study_semester') }}" required placeholder="Contoh: Kedokteran semester 5">
                                @error('program_study_semester') <div class="invalid-feedback ps-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted small ps-2">KEAHLIAN TERTENTU <span class="text-danger">*</span></label>
                                <div class="row g-2 px-2 mt-1">
                                    @php
                                        $keahlian_list = [
                                            'Makalah, Jurnal, dan Sejenisnya',
                                            'Power Point / Presentasi / Animasi',
                                            'Akuntansi',
                                            'Statistika',
                                            'Skripsi',
                                            'Desain Grafis',
                                            'Coding / IT'
                                        ];
                                    @endphp
                                    @foreach($keahlian_list as $item)
                                        <div class="col-md-6">
                                            <div class="form-check custom-checkbox p-3 rounded-4 bg-light bg-opacity-50">
                                                <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $item }}" id="check_{{ $loop->index }}" {{ is_array(old('keahlian')) && in_array($item, old('keahlian')) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="check_{{ $loop->index }}">
                                                    {{ $item }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 mt-3">
                                        <div class="p-4 rounded-4 bg-primary bg-opacity-5 border border-primary border-opacity-10">
                                            <label class="form-label fw-bold text-primary small">Upload Dokumen (PDF) <span class="text-danger">*</span></label>
                                            <p class="text-muted small mb-3">Jadikan 1 file PDF: (1) Surat Lamaran, (2) CV, (3) Transkrip Nilai, (4) Dokumen Pendukung. Maks 10MB.</p>
                                            <input type="file" name="file_pdf" class="form-control border-0 py-2 px-3 rounded-3 @error('file_pdf') is-invalid @enderror" required accept=".pdf">
                                            @error('file_pdf') <div class="invalid-feedback ps-2">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-5">
                                <button type="submit" class="btn btn-premium w-100 py-3 rounded-4 fw-bold shadow-lg">
                                    KIRIM PENDAFTARAN <i class="bi bi-send-fill ms-2"></i>
                                </button>
                                <p class="text-center text-muted small mt-4">
                                    Terima kasih telah berminat bergabung. Kami berharap dapat bekerja sama dengan Anda. <br>
                                    <strong>Salam sukses, Tim Jauki Tugas</strong>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-checkbox {
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            border: 2px solid transparent;
        }
        .custom-checkbox:hover {
            background-color: rgba(72, 52, 212, 0.05) !important;
            border-color: rgba(72, 52, 212, 0.1);
        }
        .custom-checkbox .form-check-input {
            margin-right: 15px;
            margin-left: 0;
            cursor: pointer;
            width: 20px;
            height: 20px;
            float: none;
        }
        .custom-checkbox .form-check-label {
            cursor: pointer;
            width: 100%;
        }
        .form-control:focus {
            box-shadow: none !important;
            background-color: #fff !important;
            border: 1px solid var(--primary-accent) !important;
        }
        .input-group-text {
            color: var(--primary-accent);
            font-weight: bold;
        }
    </style>
@endsection
