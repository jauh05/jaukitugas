@extends('material.dash')

@section('temp')
    <div class="container py-5 mt-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">
                <i class="bi bi-tag-fill me-2"></i>Transparan & Terjangkau
            </span>
            <h1 class="display-4 fw-bold mb-3">Daftar Harga Layanan</h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Pilih paket yang sesuai dengan kebutuhan dan deadline Anda. Kami menjamin kualitas terbaik dengan harga yang
                bersahabat bagi mahasiswa. Perlu diketahui, harga dapat menyesuaikan dengan waktu pengerjaan dan kondisi
                antrean yang sedang berjalan.
            </p>
        </div>

        <div class="glass-card p-0 overflow-hidden bg-white mb-5">
            <div class="table-responsive">
                <table class="table table-borderless mb-0 align-middle">
                    <thead class="bg-light border-bottom">
                        <tr class="text-center text-uppercase fs-7 fw-bold text-secondary">
                            <th class="py-4 ps-4 text-start">Kode</th>
                            <th class="py-4 text-start">Jenis Tugas</th>
                            <th class="py-4">Normal</th>
                            <th class="py-4 text-danger">&lt; 2 Hari</th>
                            <th class="py-4 text-danger">&lt; 1 Hari</th>
                            <th class="py-4 text-danger fw-bolder">Langsung</th>
                        </tr>
                    </thead>
                    <tbody class="fw-medium text-dark">
                        <!-- WORLD 1 -->
                        <tr class="bg-light bg-opacity-50">
                            <td colspan="6" class="py-3 ps-4 fw-bold text-primary"><i class="bi bi-file-text me-2"></i>WORLD
                                1 (Per Halaman)</td>
                        </tr>
                        @php
                            $world1 = [
                                ['code' => 'W0001', 'name' => 'MAKALAH', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0002', 'name' => 'PROPOSAL', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0003', 'name' => 'ESSAY', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0004', 'name' => 'LAPORAN', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0005', 'name' => 'RESUME', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0006', 'name' => 'CERPEN', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0007', 'name' => 'KARANGAN', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                                ['code' => 'W0008', 'name' => 'SOAL ESSAY', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000, 'p4' => 10000],
                            ];
                        @endphp
                        @foreach($world1 as $item)
                            <tr class="searchable-row border-bottom transition-all hover-bg">
                                <td class="ps-4 text-muted font-monospace">{{ $item['code'] }}</td>
                                <td class="fw-bold">{{ $item['name'] }}</td>
                                <td class="text-center">Rp {{ number_format($item['p1'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p2'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p3'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger fw-bold">Rp {{ number_format($item['p4'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach

                        <!-- WORLD 2 -->
                        <tr class="bg-light bg-opacity-50">
                            <td colspan="6" class="py-3 ps-4 fw-bold text-primary"><i
                                    class="bi bi-journal-text me-2"></i>WORLD 2 (Karya Ilmiah)</td>
                        </tr>
                        @php
                            $world2 = [
                                ['code' => 'W1001', 'name' => 'KARYA ILMIAH', 'p1' => 7000, 'p2' => 8000, 'p3' => 9000],
                                ['code' => 'W1002', 'name' => 'KARYA ILMIAH (JAMINAN TURNITIN)', 'p1' => 7000, 'p2' => 8000, 'p3' => 9000],
                                ['code' => 'W1003', 'name' => 'JURNAL', 'p1' => 7000, 'p2' => 8000, 'p3' => 9000],
                                ['code' => 'W1004', 'name' => 'JURNAL (JAMINAN TURNITIN)', 'p1' => 7000, 'p2' => 8000, 'p3' => 9000],
                            ];
                        @endphp
                        @foreach($world2 as $item)
                            <tr class="searchable-row border-bottom transition-all hover-bg">
                                <td class="ps-4 text-muted font-monospace">{{ $item['code'] }}</td>
                                <td class="fw-bold">{{ $item['name'] }}</td>
                                <td class="text-center">Rp {{ number_format($item['p1'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p2'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p3'], 0, ',', '.') }}</td>
                                <td class="text-center"><span
                                        class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                                </td>
                            </tr>
                        @endforeach

                        <!-- PPT -->
                        <tr class="bg-light bg-opacity-50">
                            <td colspan="6" class="py-3 ps-4 fw-bold text-primary"><i
                                    class="bi bi-easel me-2"></i>PRESENTASI (Per Slide)</td>
                        </tr>
                        @php
                            $ppt = [
                                ['code' => 'P0001', 'name' => 'PPT (MATERI SUDAH ADA)', 'p1' => 3000, 'p2' => 3000, 'p3' => 4000, 'p4' => 5000],
                                ['code' => 'P0002', 'name' => 'PPT (TANPA MATERI)', 'p1' => 4000, 'p2' => 4000, 'p3' => 5000, 'p4' => 6000],
                                ['code' => 'P0003', 'name' => 'PPT ANIMASI', 'p1' => 5000, 'p2' => 5000, 'p3' => 6000, 'p4' => 7000],
                            ];
                        @endphp
                        @foreach($ppt as $item)
                            <tr class="searchable-row border-bottom transition-all hover-bg">
                                <td class="ps-4 text-muted font-monospace">{{ $item['code'] }}</td>
                                <td class="fw-bold">{{ $item['name'] }}</td>
                                <td class="text-center">Rp {{ number_format($item['p1'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p2'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p3'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger fw-bold">Rp {{ number_format($item['p4'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach

                        <!-- TULIS -->
                        <tr class="bg-light bg-opacity-50">
                            <td colspan="6" class="py-3 ps-4 fw-bold text-primary"><i class="bi bi-pen me-2"></i>TULIS
                                TANGAN (Khusus Yogyakarta)</td>
                        </tr>
                        @php
                            $tulis = [
                                ['code' => 'T0001', 'name' => 'KERTAS BUKU (TINGGAL SALIN)', 'p1' => 5000, 'p2' => 6000, 'p3' => 7000],
                                ['code' => 'T0002', 'name' => 'KERTAS BUKU', 'p1' => 10000, 'p2' => 11000, 'p3' => 12000],
                                ['code' => 'T0003', 'name' => 'KERTAS FOLIO (TINGGAL SALIN)', 'p1' => 8000, 'p2' => 9000, 'p3' => 10000],
                                ['code' => 'T0004', 'name' => 'KERTAS FOLIO', 'p1' => 13000, 'p2' => 14000, 'p3' => 15000],
                            ];
                        @endphp
                        @foreach($tulis as $item)
                            <tr class="searchable-row border-bottom transition-all hover-bg">
                                <td class="ps-4 text-muted font-monospace">{{ $item['code'] }}</td>
                                <td class="fw-bold">{{ $item['name'] }}</td>
                                <td class="text-center">Rp {{ number_format($item['p1'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p2'], 0, ',', '.') }}</td>
                                <td class="text-center text-danger">Rp {{ number_format($item['p3'], 0, ',', '.') }}</td>
                                <td class="text-center text-muted">-</td>
                            </tr>
                        @endforeach
                        <tr class="searchable-row border-bottom transition-all hover-bg">
                            <td class="ps-4 text-muted font-monospace">T0005</td>
                            <td class="fw-bold">GAMBAR</td>
                            <td colspan="4" class="text-center"><span
                                    class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                            </td>
                        </tr>

                        <!-- LAINNYA -->
                        <tr class="bg-light bg-opacity-50">
                            <td colspan="6" class="py-3 ps-4 fw-bold text-primary"><i
                                    class="bi bi-infinity me-2"></i>LAINNYA</td>
                        </tr>
                        @php
                            $lainnya = [
                                ['code' => 'L0001', 'name' => 'AKUNTANSI'],
                                ['code' => 'L0002', 'name' => 'STATISTIKA'],
                                ['code' => 'L0003', 'name' => 'MATEMATIKA'],
                                ['code' => 'L0004', 'name' => 'SOAL OPTION / PILGAN'],
                            ];
                        @endphp
                        @foreach($lainnya as $item)
                            <tr class="searchable-row border-bottom transition-all hover-bg">
                                <td class="ps-4 text-muted font-monospace">{{ $item['code'] }}</td>
                                <td class="fw-bold">{{ $item['name'] }}</td>
                                <td colspan="4" class="text-center"><span
                                        class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Additional Packages Section -->
        <div class="row g-4 mb-5">
            <!-- Jurnal Card -->
            <div class="col-md-6">
                <div class="glass-card h-100 p-4 border-0 shadow-sm bg-white position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="bi bi-journal-bookmark-fill display-1 text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary mb-1">Jurnal & Publikasi</h3>
                    <p class="text-muted small mb-4">Paket Artikel + Publish Jurnal</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-light">
                            <span class="fw-bold text-dark">NON SINTA</span>
                            <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">Rp 150.000</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-light">
                            <span class="fw-bold text-dark">SINTA 6</span>
                            <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">Rp 350.000</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-light">
                            <span class="fw-bold text-dark">SINTA 5</span>
                            <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">Rp 500.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skripsi Card -->
            <div class="col-md-6">
                <div class="glass-card h-100 p-4 border-0 shadow-sm bg-white position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="bi bi-mortarboard-fill display-1 text-success"></i>
                    </div>
                    <h3 class="fw-bold text-success mb-4">Skripsi & Tugas Akhir</h3>

                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted fw-bold small ls-1">Paket Lengkap</h6>
                        <div class="p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">Full Skripsi</span>
                                <span class="fw-bold text-success">Rp 2.5jt - 3.0jt</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="text-uppercase text-muted fw-bold small ls-1">Harga Eceran (Per Bagian)</h6>
                        <ul class="list-group list-group-flush rounded-3">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-light border-0 mb-1 rounded">
                                <span>Judul</span>
                                <span class="fw-bold">Rp 50k - 100k</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-light border-0 mb-1 rounded">
                                <span>BAB I, II, III, V</span>
                                <span class="fw-bold">Rp 500k - 700k <small class="fw-normal text-muted">/bab</small></span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-light border-0 rounded">
                                <span>BAB IV (Analisis)</span>
                                <span class="fw-bold">Rp 900k - 1.1jt</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skripsi Banner -->
        <div class="glass-card p-5 bg-gradient-primary text-white text-center position-relative overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-75 z-0"
                style="background: linear-gradient(135deg, #4834d4, #686de0);"></div>
            <div class="position-relative z-1">
                <h2 class="fw-bold mb-3">🎓 Skripsi & Sempro</h2>
                <p class="lead mb-4 opacity-90">Bimbingan intensif dari judul hingga wisuda. Cek info lengkapnya di
                    Instagram kami.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://instagram.com/jaukitugas" target="_blank"
                        class="btn btn-light rounded-pill px-4 fw-bold text-primary"><i class="bi bi-instagram me-2"></i>Cek
                        Instagram</a>
                    <a href="https://wa.me/6285184771744?text=Halo%20Admin%2C%20mau%20tanya%20paket%20Skripsi"
                        class="btn btn-outline-light rounded-pill px-4 fw-bold"><i class="bi bi-whatsapp me-2"></i>Tanya
                        Admin</a>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-muted"><i
                    class="bi bi-arrow-left me-2"></i>Kembali ke Beranda</a>
        </div>
    </div>

    <style>
        .hover-bg:hover {
            background-color: rgba(72, 52, 212, 0.03) !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4834d4, #686de0) !important;
        }
    </style>
@endsection