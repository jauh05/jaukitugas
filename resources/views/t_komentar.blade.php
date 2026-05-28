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
                <h4 class="fw-bold mb-1">Rekapitulasi: {{ $namaBulanSekarang }}</h4>
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
        <div class="col-xl col-md-4">
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

        <div class="col-xl col-md-4">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #e17055, #fab1a0); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Pengeluaran (Bln)</p>
                        <h3 class="fw-bold mb-0 fs-3">Rp {{ number_format($total_pengeluaran) }}</h3>
                    </div>
                    <i class="bi bi-cash-stack opacity-25" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="col-xl col-md-4">
            <div class="glass-card h-100 p-4 position-relative overflow-hidden border-0"
                style="background: linear-gradient(135deg, #00b894, #55efc4); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 opacity-75 fw-bold">Bersih (Bln)</p>
                        <h3 class="fw-bold mb-0 fs-3">Rp {{ number_format($total_bersih) }}</h3>
                    </div>
                    <i class="bi bi-graph-up-arrow opacity-25" style="font-size: 2.5rem;"></i>
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
                        <small class="d-block text-danger mt-1">Pengeluaran: Rp {{ number_format($rekap_total_pengeluaran) }}</small>
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

    <div class="glass-card p-4 mb-5 bg-white shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <h5 class="fw-bold m-0 text-dark"><i class="bi bi-sliders me-2"></i>Filter Rekap Interaktif</h5>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="rekapTahunSelect" style="min-width: 120px;">
                    @foreach ($rekap_tahun_pilihan as $tahun)
                        <option value="{{ $tahun }}" @selected($tahun == $tahunSekarang)>{{ $tahun }}</option>
                    @endforeach
                </select>
                <select class="form-select form-select-sm" id="rekapBulanSelect" style="min-width: 150px;">
                    @php
                        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    @endphp
                    @foreach ($months as $idx => $monthName)
                        <option value="{{ $idx + 1 }}" @selected($idx + 1 == now()->month)>{{ $monthName }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary btn-sm" id="btnShowRekapDynamic">Tampilkan</button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3"><div class="p-3 bg-light rounded-4"><small class="text-muted">Pendapatan Tahun</small><div class="fw-bold text-primary" id="yearIncomeText">-</div></div></div>
            <div class="col-md-3"><div class="p-3 bg-light rounded-4"><small class="text-muted">Pengeluaran Tahun</small><div class="fw-bold text-danger" id="yearExpenseText">-</div></div></div>
            <div class="col-md-3"><div class="p-3 bg-light rounded-4"><small class="text-muted">Pendapatan Bulan Dipilih</small><div class="fw-bold text-primary" id="monthIncomeText">-</div></div></div>
            <div class="col-md-3"><div class="p-3 bg-light rounded-4"><small class="text-muted">Keterangan</small><div class="fw-bold text-success" id="monthInfoText">-</div></div></div>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <h6 class="fw-bold text-secondary mb-3">Grafik Bulanan (Tahun Dipilih)</h6>
                <canvas id="yearDynamicChart" height="100"></canvas>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold text-secondary mb-3">Perbandingan Bulan Dipilih</h6>
                <canvas id="monthDynamicChart" height="220"></canvas>
            </div>
        </div>
    </div>

    <script>
        const rekapPerTahun = {!! $rekap_per_tahun_json !!};
        const rekapPerBulan = {!! $rekap_per_bulan_json !!};
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const yearSelect = document.getElementById('rekapTahunSelect');
        const monthSelect = document.getElementById('rekapBulanSelect');

        const yearCtx = document.getElementById('yearDynamicChart').getContext('2d');
        const monthCtx = document.getElementById('monthDynamicChart').getContext('2d');
        const yearChart = new Chart(yearCtx, {
            type: 'line',
            data: { labels: monthNames, datasets: [] },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
        const monthChart = new Chart(monthCtx, {
            type: 'bar',
            data: { labels: ['Pendapatan', 'Pengeluaran', 'Bersih'], datasets: [{ data: [0, 0, 0], backgroundColor: ['#0d6efd', '#dc3545', '#20c997'] }] },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        function formatRupiah(val) {
            return 'Rp ' + Number(val || 0).toLocaleString('id-ID');
        }

        function renderDynamicRekap() {
            const year = yearSelect.value;
            const month = monthSelect.value;
            const yearData = rekapPerTahun[year];
            if (!yearData) return;

            const monthlyIncome = [];
            const monthlyExpense = [];
            for (let i = 1; i <= 12; i++) {
                const item = yearData.bulanan[i] || { pendapatan: 0, pengeluaran: 0 };
                monthlyIncome.push(item.pendapatan || 0);
                monthlyExpense.push(item.pengeluaran || 0);
            }

            yearChart.data.datasets = [
                { label: 'Pendapatan', data: monthlyIncome, borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,0.1)', fill: true, tension: 0.3 },
                { label: 'Pengeluaran', data: monthlyExpense, borderColor: '#dc3545', backgroundColor: 'rgba(220,53,69,0.08)', fill: true, tension: 0.3 }
            ];
            yearChart.update();

            const monthData = yearData.bulanan[month] || { pendapatan: 0, pengeluaran: 0, bersih: 0, order: 0 };
            monthChart.data.datasets[0].data = [monthData.pendapatan || 0, monthData.pengeluaran || 0, monthData.bersih || 0];
            monthChart.update();

            document.getElementById('yearIncomeText').textContent = formatRupiah(yearData.pendapatan);
            document.getElementById('yearExpenseText').textContent = formatRupiah(yearData.pengeluaran);
            document.getElementById('monthIncomeText').textContent = formatRupiah(monthData.pendapatan);
            document.getElementById('monthInfoText').textContent = `${monthNames[month - 1]} ${year} • ${monthData.order || 0} order`;
        }

        document.getElementById('btnShowRekapDynamic').addEventListener('click', renderDynamicRekap);
        renderDynamicRekap();
    </script>

@endsection