@extends('dashboard')
@section('halo')
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
    {{-- <h1 class="mt-4">Selamat datang</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ session('id_admin') }}</li>
    </ol> --}}
@endsection
@section('info')
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <div class="glass-card bg-primary text-white p-4 position-relative overflow-hidden border-0">
                <div class="position-absolute top-0 end-0 opacity-25 p-3">
                    <i class="bi bi-calendar-event fs-1"></i>
                </div>
                <h4 class="fw-bold mb-1">Rekapitulasi: {{ strftime('%B %Y', strtotime(date('Y-m-d'))) }}</h4>
                <p class="mb-0 text-white-50">Pantau performa harian dan bulanan Anda secara real-time.</p>
            </div>
        </div>
    </div>

    <!-- Stats Row 1 -->
    <div class="row g-4 mb-4">
        <!-- New Comment Card -->
        <div class="col-xl col-md-4">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #6c5ce7, #a29bfe); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Komentar</p>
                        <h2 class="display-5 fw-bold mb-0">{{ $jumlah_komentar }}</h2>
                    </div>
                    <i class="bi bi-chat-quote-fill opacity-25" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>

        <!-- Pending Talent -->
        <div class="col-xl col-md-4">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #f0932b, #ffbe76); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Pendaftar Talent</p>
                        <h2 class="display-5 fw-bold mb-0">{{ $jumlah_talent }}</h2>
                    </div>
                    <i class="bi bi-person-badge-fill opacity-25" style="font-size: 2.5rem;"></i>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.talent.index') }}" class="badge bg-white bg-opacity-25 rounded-pill text-white text-decoration-none">
                        Cek Pendaftar <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="col-xl col-md-4">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #00b894, #55efc4); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Selesai</p>
                        <h2 class="display-5 fw-bold mb-0">{{ $jumlah_costomer_sudah }}</h2>
                    </div>
                    <i class="bi bi-check-circle-fill opacity-25" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="col-xl col-md-6">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #ff7675, #fab1a0); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Pending</p>
                        <h2 class="display-5 fw-bold mb-0">{{ $jumlah_costomer_belum }}</h2>
                    </div>
                    <i class="bi bi-clock-history opacity-25" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-xl col-md-6">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #0984e3, #74b9ff); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Pendapatan (Bln)</p>
                        <h3 class="fw-bold mb-0 fs-3">Rp {{ number_format($total_pendapatan) }}</h3>
                    </div>
                    <i class="bi bi-wallet-fill opacity-25" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row 2 (Daily & Overall) -->
    <div class="row g-4 mb-4">
        <div class="col-xl-6 col-md-6">
            <div class="glass-card h-100 p-4 bg-white border-start border-5 border-warning">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-sun-fill text-warning fs-3"></i>
                    </div>
                    <div>
                        <small class="text-uppercase text-muted fw-bold ls-1">Hari Ini</small>
                        <h3 class="fw-bold mb-0">Rp {{ number_format($rekap_harian_sum) }}</h3>
                    </div>
                    <div class="ms-auto text-end">
                        <small class="d-block text-muted">Customer</small>
                        <span class="fw-bold fs-4 text-warning">{{ $rekap_harian_count }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6">
            <div class="glass-card h-100 p-4 bg-white border-start border-5 border-primary">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-exclude text-primary fs-3"></i>
                    </div>
                    <div>
                        <small class="text-uppercase text-muted fw-bold ls-1">Total Keseluruhan</small>
                        <h3 class="fw-bold mb-0">Rp {{ number_format($rekap_total_sum) }}</h3>
                    </div>
                    <div class="ms-auto text-end">
                        <small class="d-block text-muted">Total Order</small>
                        <span class="fw-bold fs-4 text-primary">{{ number_format($rekap_total_count) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Daily Charts (Income & Count) --}}
    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="glass-card p-4 bg-white h-100 shadow-sm border-0">
                <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-graph-up me-2"></i>Tren Pendapatan Harian</h5>
                <canvas id="dailyIncomeChart" height="100"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 bg-white h-100 shadow-sm border-0">
                <h5 class="fw-bold mb-4 text-warning"><i class="bi bi-bar-chart me-2"></i>Order Harian</h5>
                <canvas id="dailyCountChart" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- Top Customers Table & Customer Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="glass-card p-4 bg-white h-100 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark m-0"><i class="bi bi-trophy-fill text-warning me-2"></i>Top 10 Pelanggan Setia</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#topCustomersModal">
                        Lihat Selengkapnya <i class="bi bi-arrows-angle-expand ms-1"></i>
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase fw-bold">
                            <tr>
                                <th class="ps-3 rounded-start">Rank</th>
                                <th>Nama Customer</th>
                                <th class="text-center">Jumlah Order</th>
                                <th class="text-end pe-3 rounded-end">Total Spend</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($top_customers->take(10) as $index => $cus)
                            <tr class="border-bottom hover-bg transition-all">
                                <td class="ps-3 fw-bold text-muted">#{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">
                                            {{ substr($cus->nama, 0, 1) }}
                                        </div>
                                        {{ $cus->nama }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">{{ $cus->total_order }} Order</span>
                                </td>
                                <td class="text-end pe-3 fw-bold text-success">Rp {{ number_format($cus->total_spend) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
             <div class="glass-card p-4 bg-white h-100 shadow-sm border-0">
                 <h5 class="fw-bold mb-4 text-secondary"><i class="bi bi-calendar-range me-2"></i>Statistik Customer</h5>
                {!! $chartCos->container() !!}
            </div>
        </div>
    </div>

    <!-- Modal Top Customers (Full List) -->
    <div class="modal fade" id="topCustomersModal" tabindex="-1" aria-labelledby="topCustomersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg overflow-hidden">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="topCustomersModalLabel"><i class="bi bi-trophy-fill me-2"></i>Leaderboard Pelanggan Setia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                         <table class="table table-striped align-middle mb-0">
                            <thead class="bg-light sticky-top">
                                <tr>
                                    <th class="ps-4 py-3">Rank</th>
                                    <th class="py-3">Nama Customer</th>
                                    <th class="text-center py-3">Jumlah Order</th>
                                    <th class="text-end pe-4 py-3">Total Spend</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_customers as $index => $cus)
                                <tr>
                                    <td class="ps-4 fw-bold {{ $index < 3 ? 'text-warning' : 'text-muted' }}">
                                        @if($index < 3) <i class="bi bi-crown-fill me-1"></i> @endif
                                        #{{ $index + 1 }}
                                    </td>
                                    <td class="fw-bold">{{ $cus->nama }}</td>
                                    <td class="text-center">
                                         <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">{{ $cus->total_order }} Order</span>
                                    </td>
                                    <td class="text-end pe-4 fw-bold text-success">Rp {{ number_format($cus->total_spend) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Yearly Revenue Chart --}}
    <div class="row mb-5">
         <div class="col-12">
             <div class="glass-card p-4 bg-white shadow-sm border-0">
                 <h5 class="fw-bold mb-4 text-dark"><i class="bi bi-clipboard-data me-2"></i>Pendapatan Tahunan</h5>
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Daily Income Chart
        const ctxDaily = document.getElementById('dailyIncomeChart').getContext('2d');
        new Chart(ctxDaily, {
            type: 'line',
            data: {
                labels: {!! $chart_daily_label !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! $chart_daily_data !!},
                    borderColor: '#4834d4',
                    backgroundColor: 'rgba(72, 52, 212, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true, grid: { borderDash: [5, 5] } }, x: { grid: { display: false } } } }
        });

        // Daily Count Chart (Bar)
        const ctxCount = document.getElementById('dailyCountChart').getContext('2d');
        new Chart(ctxCount, {
            type: 'bar',
            data: {
                labels: {!! $chart_daily_label !!},
                datasets: [{
                    label: 'Jumlah Order',
                    data: {!! $chart_daily_count !!},
                    backgroundColor: '#fbc531',
                    borderRadius: 4
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } }, x: { grid: { display: false } } } }
        });

        // JS for deleted charts removed
    </script>
    <script src="{{ $chartCos->cdn() }}"></script>
    {!! $chartCos->script() !!}
    <script src="{{ $chart->cdn() }}"></script>
    {!! $chart->script() !!}

    <script>
        $(document).ready(function () {
            $('#btn_rekap').click(function (e) {
                e.preventDefault();
                $('#rekap').toggle(500);
            });
            $('#btn_rekap_bulan').click(function (e) {
                e.preventDefault();
                $('#rekapBulan').toggle(500);
            });
        })
    </script>
    {{-- Recaps Buttons --}}
    <div class="p-3 mb-5 d-flex justify-content-center gap-3">
        <a href="" class="btn btn-outline-dark" id="btn_rekap_bulan"><i class="bi bi-calendar-minus me-2"></i>Lihat Rekap Bulan Lalu</a>
        <a href="" class="btn btn-outline-primary" id="btn_rekap"><i class="bi bi-calendar-check me-2"></i>Lihat Rekap Tahun Sebelumnya</a>
    </div>

    {{-- Rekap Bulan Lalu (Hidden) --}}
    <div class="row justify-content-center mb-4" style="display: none" id="rekapBulan">
        <div class="col-md-8">
            <div class="glass-card border-0 shadow-lg p-0 overflow-hidden bg-white">
                <div class="bg-dark text-white p-3 fw-bold">
                    <i class="bi bi-calendar-minus me-2"></i>Rekap Bulan Lalu ({{ strftime('%B %Y', strtotime(date('Y-m-d') . ' -1 month')) }})
                </div>
                <div class="card-body text-center p-5">
                    <h5 class="text-muted text-uppercase ls-1 mb-3">Total Pendapatan</h5>
                    <h2 class="display-3 fw-bold text-primary mb-4">Rp {{ number_format($rekap_bulan_lalu_sum) }}</h2>
                    
                    <div class="row justify-content-center g-4">
                        <div class="col-6 border-end">
                            <h6 class="text-muted small fw-bold">TOTAL ORDER</h6>
                            <h3 class="mb-0">{{ $rekap_bulan_lalu_count }}</h3>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted small fw-bold">RATA-RATA / ORDER</h6>
                            <h3 class="mb-0 fs-4">Rp {{ $rekap_bulan_lalu_count > 0 ? number_format($rekap_bulan_lalu_sum / $rekap_bulan_lalu_count) : 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- rekap tahunan --}}
    <div class="row" style="display: none" id="rekap">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar"></i>
                    Rekap tahunan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 shadow-sm border-0 p-3">
                            <div class="">
                                <div class="card-body">
                                    <div class="card bg-dark text-white mb-4">
                                        <div class="card-header text-center">Rekap <b>{{ $tahunSekarang - 1  }}</b></div>
                                        <div class="card-body">
                                            <h3 class="text-center">Rp. {{ number_format($tahun_1) }},- <i
                                                    class="bi bi-cash-stack"></i></h3>
                                        </div>
                                    </div>
                                    @foreach ($bulanLalu as $key => $bulan)
                                        <ol class="list-group mb-1">
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="">
                                                    <div class="fw-bold">Bulan <?php    $i = $key - 1 ?> {{ $i + 1 }} </div>
                                                    <!-- Menampilkan bulan dalam angka -->
                                                    <span class="fs-6">Rp {{ number_format($bulan) }},- </span>
                                                </div>
                                                <div>
                                                    <!-- Menampilkan jumlah customer per bulan -->
                                                    <span class="badge text-bg-success rounded-pill fs-6">
                                                        <i class="bi bi-person-check"></i> {{ $costomerLalu[$key] }} Costomer
                                                    </span>
                                                </div>
                                            </li>
                                        </ol>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 shadow-sm border-0 p-3">
                            <div class="">
                                <div class="card-body">
                                    <div class="card bg-dark text-white mb-4">
                                        <div class="card-header text-center">Rekap <b>{{ $tahunSekarang - 2  }}</b></div>
                                        <div class="card-body">
                                            <h3 class="text-center">Rp. {{ number_format($tahun_2) }},- <i
                                                    class="bi bi-cash-stack"></i></h3>
                                        </div>
                                    </div>
                                    @foreach ($bulanLalu2 as $key => $bulan)
                                        <ol class="list-group mb-1">
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="">
                                                    <div class="fw-bold">Bulan <?php    $i = $key - 1 ?> {{ $i + 1 }} </div>
                                                    <!-- Menampilkan bulan dalam angka -->
                                                    <span class="fs-6">Rp {{ number_format($bulan) }} ,- </span>
                                                </div>
                                                <div>
                                                    <!-- Menampilkan jumlah customer per bulan -->
                                                    <span class="badge text-bg-success rounded-pill fs-6">
                                                        <i class="bi bi-person-check"></i> {{ $costomerLalu2[$key] }} Costomer
                                                    </span>
                                                </div>
                                            </li>
                                        </ol>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#btn_rekap').click(function (e) {
                e.preventDefault();
                $('#rekap').toggle(500);
            })
        })
    </script>

@endsection