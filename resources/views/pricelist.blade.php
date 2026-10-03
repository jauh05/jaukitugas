@extends('material.dash')

@section('temp')
    <div class="container py-5 mt-2">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold animate-fade-in">
                <i class="bi bi-tag-fill me-2"></i>Transparan & Terjangkau
            </span>
            <h1 class="display-4 fw-bold mb-3 hero-title">Daftar Harga Layanan</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 700px;">
                Pilih paket yang sesuai dengan kebutuhan dan deadline Anda. Kami menjamin kualitas terbaik dengan harga yang
                bersahabat bagi mahasiswa.
            </p>
            
            <!-- Search Bar -->
            <div class="search-container mx-auto" style="max-width: 500px;">
                <div class="input-group glass-card p-1 shadow-sm border-0">
                    <span class="input-group-text bg-transparent border-0 ps-3">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text" id="serviceSearch" class="form-control bg-transparent border-0 py-3 shadow-none" 
                           placeholder="Cari jenis tugas (ex: Makalah, PPT, Skripsi)...">
                </div>
            </div>
        </div>

        <!-- Paket Hemat Section -->
        @php
            $waBase = 'https://wa.me/6285184771744?text=';
            $paketSkripsi = [
                [
                    'name' => 'Paket Skripsi (SEMPRO)',
                    'scope' => 'BAB 1 - BAB 3',
                    'old' => 'Rp 2.000.000',
                    'price' => 'Rp 1.200.000',
                    'icon' => 'bi-journal-check',
                    'featured' => false,
                    'features' => ['Free Revisi 15x', 'Free Turnitin', 'Free Bimbingan'],
                ],
                [
                    'name' => 'Paket Skripsi Full Bab',
                    'scope' => 'Full Bab (Lengkap)',
                    'old' => 'Rp 3.500.000',
                    'price' => 'Rp 2.200.000',
                    'icon' => 'bi-mortarboard-fill',
                    'featured' => true,
                    'features' => ['Free Revisi 25x', 'Free Turnitin', 'Free Bimbingan', 'Free Zoom / Meet'],
                ],
            ];
            $paketTugas = [
                [
                    'name' => 'Paket Makalah',
                    'scope' => '10 Halaman Makalah',
                    'price' => 'Rp 50.000',
                    'icon' => 'bi-file-earmark-text-fill',
                    'featured' => false,
                ],
                [
                    'name' => 'Paket PPT',
                    'scope' => '10 Slide PPT',
                    'price' => 'Rp 30.000',
                    'icon' => 'bi-easel-fill',
                    'featured' => false,
                ],
                [
                    'name' => 'Paket Makalah + PPT',
                    'scope' => '10 Halaman Makalah + 10 Slide PPT',
                    'price' => 'Rp 75.000',
                    'icon' => 'bi-collection-fill',
                    'featured' => true,
                ],
            ];
        @endphp
        <div class="mb-5">
            <div class="text-center mb-4">
                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">
                    <i class="bi bi-fire me-1"></i>Paket Hemat
                </span>
                <h2 class="fw-bold mt-2 mb-0">Pilihan Paket Spesial</h2>
            </div>

            <!-- Paket Skripsi -->
            <div class="row g-4 mb-4">
                @foreach($paketSkripsi as $paket)
                <div class="col-lg-6 searchable-row">
                    <div class="glass-card package-card h-100 p-4 bg-white shadow-sm position-relative overflow-hidden {{ $paket['featured'] ? 'package-featured' : 'border-0' }}">
                        @if($paket['featured'])
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 fw-bold">
                                <i class="bi bi-star-fill me-1"></i>Best Value
                            </span>
                        @endif
                        <div class="position-absolute top-0 end-0 p-3 opacity-10">
                            <i class="bi {{ $paket['icon'] }} display-1 text-primary"></i>
                        </div>
                        <div class="{{ $paket['featured'] ? 'mt-4' : '' }}">
                            <h3 class="fw-bold text-primary mb-1">{{ $paket['name'] }}</h3>
                            <p class="text-muted mb-3"><i class="bi bi-bookmark-fill me-1"></i>{{ $paket['scope'] }}</p>

                            <div class="d-flex align-items-end gap-2 mb-3 flex-wrap">
                                <span class="text-muted text-decoration-line-through fs-5">{{ $paket['old'] }}</span>
                                <span class="fw-bolder text-danger display-6 lh-1">{{ $paket['price'] }}</span>
                            </div>

                            <ul class="list-unstyled mb-4">
                                @foreach($paket['features'] as $feature)
                                    <li class="mb-2 fw-medium">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>{{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ $waBase . rawurlencode('Halo Admin, saya mau order ' . $paket['name'] . ' (' . $paket['price'] . ')') }}"
                                target="_blank"
                                class="btn {{ $paket['featured'] ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 fw-bold w-100">
                                <i class="bi bi-whatsapp me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paket Tugas -->
            <div class="row g-4">
                @foreach($paketTugas as $paket)
                <div class="col-md-4 searchable-row">
                    <div class="glass-card package-card h-100 p-4 bg-white shadow-sm text-center position-relative {{ $paket['featured'] ? 'package-featured' : 'border-0' }}">
                        @if($paket['featured'])
                            <span class="badge bg-warning text-dark position-absolute top-0 start-50 translate-middle rounded-pill px-3 py-2 fw-bold">
                                <i class="bi bi-star-fill me-1"></i>Paling Hemat
                            </span>
                        @endif
                        <div class="package-icon mx-auto mb-3">
                            <i class="bi {{ $paket['icon'] }} fs-3 text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $paket['name'] }}</h5>
                        <p class="text-muted small mb-3">{{ $paket['scope'] }}</p>
                        <div class="fw-bolder text-danger fs-2 mb-3">{{ $paket['price'] }}</div>
                        <a href="{{ $waBase . rawurlencode('Halo Admin, saya mau order ' . $paket['name'] . ' (' . $paket['price'] . ')') }}"
                            target="_blank"
                            class="btn {{ $paket['featured'] ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 fw-bold w-100">
                            <i class="bi bi-whatsapp me-2"></i>Pesan
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="main-pricelist-container mb-5">
            <!-- Desktop Table View -->
            <div class="d-none d-lg-block glass-card p-0 overflow-hidden bg-white shadow-sm border-0">
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
                                <td colspan="6" class="py-3 ps-4 fw-bold text-primary border-top border-bottom">
                                    <i class="bi bi-file-text me-2"></i>WORLD 1 (Per Halaman)
                                </td>
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
                                    <td class="text-center text-danger fw-bold">Rp {{ number_format($item['p4'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach

                            <!-- WORLD 2 -->
                            <tr class="bg-light bg-opacity-50">
                                <td colspan="6" class="py-3 ps-4 fw-bold text-primary border-top border-bottom">
                                    <i class="bi bi-journal-text me-2"></i>WORLD 2 (Karya Ilmiah)
                                </td>
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
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- PPT -->
                            <tr class="bg-light bg-opacity-50">
                                <td colspan="6" class="py-3 ps-4 fw-bold text-primary border-top border-bottom">
                                    <i class="bi bi-easel me-2"></i>PRESENTASI (Per Slide)
                                </td>
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
                                    <td class="text-center text-danger fw-bold">Rp {{ number_format($item['p4'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach

                            <!-- TULIS -->
                            <tr class="bg-light bg-opacity-50">
                                <td colspan="6" class="py-3 ps-4 fw-bold text-primary border-top border-bottom">
                                    <i class="bi bi-pen me-2"></i>TULIS TANGAN (Khusus Yogyakarta)
                                </td>
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
                                <td colspan="4" class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                                </td>
                            </tr>

                            <!-- LAINNYA -->
                            <tr class="bg-light bg-opacity-50">
                                <td colspan="6" class="py-3 ps-4 fw-bold text-primary border-top border-bottom">
                                    <i class="bi bi-infinity me-2"></i>LAINNYA
                                </td>
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
                                    <td colspan="4" class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="d-lg-none">
                <!-- Group WORLD 1 -->
                <div class="category-header-mobile mb-3">
                    <h5 class="fw-bold text-primary"><i class="bi bi-file-text me-2"></i>WORLD 1</h5>
                </div>
                <div class="mobile-grid">
                    @foreach($world1 as $item)
                    <div class="glass-card mobile-price-card mb-3 p-3 border-0 searchable-row">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $item['name'] }}</h6>
                                <small class="text-muted font-monospace">{{ $item['code'] }}</small>
                            </div>
                            <span class="badge bg-primary bg-opacity-10 text-primary">Per Halaman</span>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="p-2 rounded bg-light">
                                    <small class="text-muted d-block ls-1">NORMAL</small>
                                    <span class="fw-bold">Rp {{ number_format($item['p1'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                    <small class="d-block ls-1">&lt; 2 HARI</small>
                                    <span class="fw-bold">Rp {{ number_format($item['p2'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                    <small class="d-block ls-1">&lt; 1 HARI</small>
                                    <span class="fw-bold">Rp {{ number_format($item['p3'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 rounded bg-danger text-white">
                                    <small class="d-block ls-1">LANGSUNG</small>
                                    <span class="fw-bold">Rp {{ number_format($item['p4'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Group WORLD 2 -->
                <div class="category-header-mobile mt-4 mb-3">
                    <h5 class="fw-bold text-primary"><i class="bi bi-journal-text me-2"></i>WORLD 2</h5>
                </div>
                @foreach($world2 as $item)
                <div class="glass-card mobile-price-card mb-3 p-3 border-0 searchable-row">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $item['name'] }}</h6>
                            <small class="text-muted font-monospace">{{ $item['code'] }}</small>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="p-2 rounded bg-light">
                                <small class="text-muted d-block ls-1">NORMAL</small>
                                <span class="fw-bold">Rp {{ number_format($item['p1'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                <small class="d-block ls-1">&lt; 2 H</small>
                                <span class="fw-bold">Rp {{ number_format($item['p2'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                <small class="d-block ls-1">&lt; 1 H</small>
                                <span class="fw-bold">Rp {{ number_format($item['p3'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Group PPT -->
                <div class="category-header-mobile mt-4 mb-3">
                    <h5 class="fw-bold text-primary"><i class="bi bi-easel me-2"></i>PRESENTASI</h5>
                </div>
                @foreach($ppt as $item)
                <div class="glass-card mobile-price-card mb-3 p-3 border-0 searchable-row">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $item['name'] }}</h6>
                            <small class="text-muted font-monospace">{{ $item['code'] }}</small>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary">Per Slide</span>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-2 rounded bg-light">
                                <small class="text-muted d-block ls-1">NORMAL</small>
                                <span class="fw-bold">Rp {{ number_format($item['p1'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                <small class="d-block ls-1">&lt; 2 HARI</small>
                                <span class="fw-bold">Rp {{ number_format($item['p2'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                <small class="d-block ls-1">&lt; 1 HARI</small>
                                <span class="fw-bold">Rp {{ number_format($item['p3'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded bg-danger text-white">
                                <small class="d-block ls-1">LANGSUNG</small>
                                <span class="fw-bold">Rp {{ number_format($item['p4'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Group TULIS -->
                <div class="category-header-mobile mt-4 mb-3">
                    <h5 class="fw-bold text-primary"><i class="bi bi-pen me-2"></i>TULIS TANGAN</h5>
                </div>
                @foreach($tulis as $item)
                <div class="glass-card mobile-price-card mb-3 p-3 border-0 searchable-row">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $item['name'] }}</h6>
                            <small class="text-muted font-monospace">{{ $item['code'] }}</small>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="p-2 rounded bg-light">
                                <small class="text-muted d-block ls-1">NORMAL</small>
                                <span class="fw-bold">Rp {{ number_format($item['p1'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                <small class="d-block ls-1">&lt; 2 H</small>
                                <span class="fw-bold">Rp {{ number_format($item['p2'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                <small class="d-block ls-1">&lt; 1 H</small>
                                <span class="fw-bold">Rp {{ number_format($item['p3'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Others/Lainnya on Mobile -->
                <div class="category-header-mobile mt-4 mb-3">
                    <h5 class="fw-bold text-primary"><i class="bi bi-infinity me-2"></i>LAINNYA</h5>
                </div>
                @foreach($lainnya as $item)
                <div class="glass-card mobile-price-card mb-2 p-3 border-0 searchable-row">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $item['name'] }}</h6>
                            <small class="text-muted font-monospace">{{ $item['code'] }}</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">CHAT ADMIN</span>
                    </div>
                </div>
                @endforeach
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
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-light">
                            <span class="fw-bold text-dark">SINTA 4</span>
                            <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">Rp 900rb - 1.2jt</span>
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
                    <h3 class="fw-bold text-success mb-1">Skripsi Per Bab</h3>
                    <p class="text-muted small mb-4">Harga eceran pengerjaan per bagian skripsi</p>

                    <div class="mb-3">
                        <h6 class="text-uppercase text-muted fw-bold small ls-1">Harga Per Bab</h6>
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

                    <div class="p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25 small">
                        <i class="bi bi-lightbulb-fill text-success me-1"></i>
                        Butuh lebih hemat? Ambil <strong>Paket Skripsi (SEMPRO)</strong> mulai
                        <strong class="text-success">Rp 1.200.000</strong> atau <strong>Paket Full Bab</strong>
                        <strong class="text-success">Rp 2.200.000</strong> di bagian atas.
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
                        class="btn btn-outline-light rounded-pill px-4 fw-bold hover-scale"><i class="bi bi-whatsapp me-2"></i>Tanya
                        Admin</a>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-muted"><i
                    class="bi bi-arrow-left me-2"></i>Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        document.getElementById('serviceSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('.searchable-row');
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                if (text.includes(value)) {
                    row.classList.remove('d-none');
                    // If it's a table row, it might need display: table-row
                    if(row.tagName === 'TR') row.style.display = '';
                } else {
                    row.classList.add('d-none');
                    if(row.tagName === 'TR') row.style.display = 'none';
                }
            });
            
            // Hide category headers if no items match in that category
            // This is a bit complex for mobile cards, so we just hide the cards
        });
    </script>

    <style>
        .package-card {
            border-radius: 20px !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .package-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(72, 52, 212, 0.12) !important;
        }

        .package-featured {
            border: 2px solid #4834d4 !important;
            box-shadow: 0 10px 30px rgba(72, 52, 212, 0.15) !important;
        }

        .package-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(72, 52, 212, 0.1);
        }

        .hover-bg:hover {
            background-color: rgba(72, 52, 212, 0.04) !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4834d4, #686de0) !important;
        }

        .ls-1 {
            letter-spacing: 1px;
            font-size: 0.65rem;
            font-weight: 700;
        }

        .mobile-price-card {
            border-radius: 16px !important;
            transition: all 0.3s ease;
        }

        .mobile-price-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0,0,0,0.05) !important;
        }

        .category-header-mobile {
            border-left: 4px solid var(--primary-accent);
            padding-left: 12px;
            background: rgba(72, 52, 212, 0.05);
            padding-top: 8px;
            padding-bottom: 8px;
            border-radius: 0 8px 8px 0;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .search-container .input-group {
            border-radius: 50px !important;
            background: white !important;
            border: 1px solid rgba(0,0,0,0.05) !important;
        }

        @media (max-width: 991px) {
            .display-4 {
                font-size: 2.2rem;
            }
            .lead {
                font-size: 1rem;
            }
            .glass-card {
                padding: 1.25rem !important;
            }
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .mobile-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 576px) and (max-width: 991px) {
            .mobile-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endsection