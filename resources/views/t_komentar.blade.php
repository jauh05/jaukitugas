@extends('dashboard')
@section('halo')
    @if (session('pesan_berhasil'))
        <script>
            Swal.fire({
                position: "top-center",
                icon: "success",
                html: "<p style='color: #111111; font-size: 18px;'>{{ session('pesan_berhasil') }}</p>",
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
                html: "<p style='color: #E5484D; font-size: 18px;'>{{ session('pesan_gagal') }}</p>",
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
    @php
        $pesananBulan = (int) $jumlah_costomer_sudah + (int) $jumlah_costomer_belum;
        $persenSelesai = $pesananBulan > 0 ? round(($jumlah_costomer_sudah / $pesananBulan) * 100) : 0;
    @endphp

    <div class="col-xl-8">
        <div class="row g-4">
            <!-- Sapaan: lonceng bulat, CTA gelap, dan pill terang (gaya referensi) -->
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h3 class="fw-semibold mb-1" style="font-size: 1.7rem;">Selamat datang, {{ session('username') ?? 'Admin' }}!</h3>
                        <div class="card-sub">Rekapitulasi {{ $namaBulanSekarang }}. Pantau pesanan, deadline, dan keuangan Anda.</div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="{{ route('costomer.jadwal') }}" class="home-bell" title="Lihat jadwal pesanan">
                            <i class="bi bi-bell"></i>
                            @if ($jumlah_costomer_belum > 0)
                                <span class="home-bell-dot"></span>
                            @endif
                        </a>
                        <a href="{{ route('costomer.tambah') }}" class="btn btn-primary rounded-pill px-4"><i class="bi bi-plus-lg me-1"></i>Pesanan Baru</a>
                        <a href="{{ route('kalender.index') }}" class="btn btn-light rounded-pill px-4"><i class="bi bi-calendar3 me-1"></i>Kalender</a>
                    </div>
                </div>
            </div>

            <!-- Tiga kartu statistik: gelap, lavender, biru muda -->
            <div class="col-md-4">
                <div class="home-tile home-tile--dark">
                    <div class="home-tile-num">{{ $pesananBulan }}</div>
                    <div class="home-tile-label">Pesanan bulan ini</div>
                    <div class="home-tile-sub">{{ $jumlah_costomer_belum }} menunggu diproses</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="home-tile home-tile--lav">
                    <div class="home-tile-num">{{ $jumlah_costomer_sudah }}</div>
                    <div class="home-tile-label">Pesanan selesai</div>
                    <div class="home-tile-sub">{{ $persenSelesai }}% dari pesanan bulan ini</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="home-tile home-tile--sky">
                    <div class="home-tile-num home-tile-num--sm">Rp {{ number_format($total_bersih) }}</div>
                    <div class="home-tile-label">Keuangan bersih</div>
                    <div class="home-tile-sub">Pendapatan Rp {{ number_format($total_pendapatan) }}</div>
                </div>
            </div>

            <!-- Order harian -->
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-bag me-2"></i>Order Harian</h5>
                            <div class="card-sub">Jumlah pesanan per hari bulan ini</div>
                        </div>
                    </div>
                    <canvas id="dailyCountChart" height="150"></canvas>
                </div>
            </div>

            <!-- Pendapatan harian + filter -->
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-graph-up me-2"></i>Pendapatan Harian</h5>
                            <div class="card-sub">Tren harian pendapatan bulan ini</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                        <input type="date" id="dailyFilterStart" class="form-control form-control-sm home-input" style="min-width: 140px;">
                        <span class="small" style="color: var(--ink-2);">s/d</span>
                        <input type="date" id="dailyFilterEnd" class="form-control form-control-sm home-input" style="min-width: 140px;">
                        <button class="btn btn-sm btn-primary" id="applyDailyFilterBtn">Filter</button>
                    </div>
                    <canvas id="dailyIncomeChart" height="150"></canvas>
                </div>
            </div>

            <!-- Status pengerjaan -->
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-check2-circle me-2"></i>Status Pengerjaan</h5>
                            <div class="card-sub">Pesanan selesai bulan ini</div>
                        </div>
                        <span class="chip chip--green fw-semibold">{{ $persenSelesai }}%</span>
                    </div>
                    <div class="home-progress mb-3"><span style="width: {{ $persenSelesai }}%;"></span></div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="home-mini">
                                <div class="home-mini-label">Selesai</div>
                                <div class="home-mini-value">{{ $jumlah_costomer_sudah }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="home-mini">
                                <div class="home-mini-label">Belum</div>
                                <div class="home-mini-value">{{ $jumlah_costomer_belum }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keuangan -->
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-wallet2 me-2"></i>Keuangan</h5>
                            <div class="card-sub">Bersih setelah pengeluaran</div>
                        </div>
                    </div>
                    <div class="home-mini mb-2 d-flex justify-content-between align-items-center">
                        <span class="home-mini-label mb-0">Pendapatan</span>
                        <span class="fw-semibold">Rp {{ number_format($total_pendapatan) }}</span>
                    </div>
                    <div class="home-mini d-flex justify-content-between align-items-center">
                        <span class="home-mini-label mb-0">Pengeluaran</span>
                        <span class="fw-semibold" style="color: var(--danger);">Rp {{ number_format($total_pengeluaran) }}</span>
                    </div>
                </div>
            </div>

            <!-- Ringkasan harian dan keseluruhan -->
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100 d-flex align-items-center gap-3 flex-wrap">
                    <span class="bubble" style="background: var(--yellow);"><i class="bi bi-sun"></i></span>
                    <div>
                        <div class="card-sub text-uppercase fw-semibold" style="letter-spacing: 0.08em;">Hari Ini</div>
                        <div class="kpi-value kpi-value--sm">Rp {{ number_format($rekap_harian_sum) }}</div>
                    </div>
                    <div class="ms-auto text-end">
                        <div class="card-sub">Customer</div>
                        <span class="chip chip--yellow fw-semibold">{{ $rekap_harian_count }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100 d-flex align-items-center gap-3 flex-wrap">
                    <span class="bubble" style="background: var(--sky);"><i class="bi bi-wallet"></i></span>
                    <div>
                        <div class="card-sub text-uppercase fw-semibold" style="letter-spacing: 0.08em;">Total Keseluruhan</div>
                        <div class="kpi-value kpi-value--sm">Rp {{ number_format($rekap_total_sum) }}</div>
                        <div class="small" style="color: var(--danger);">Pengeluaran: Rp {{ number_format($rekap_total_pengeluaran) }}</div>
                    </div>
                    <div class="ms-auto text-end">
                        <div class="card-sub">Total Order</div>
                        <span class="chip chip--sky fw-semibold">{{ number_format($rekap_total_count) }}</span>
                    </div>
                </div>
            </div>

            <!-- Top customers -->
            <div class="col-12">
                <div class="glass-card mb-0">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-trophy me-2"></i>Top 10 Pelanggan Setia</h5>
                            <div class="card-sub">Pelanggan dengan total belanja terbesar</div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#topCustomersModal">
                            Lihat Selengkapnya <i class="bi bi-arrows-angle-expand ms-1"></i>
                        </button>
                    </div>

                    <!-- Daftar pelanggan: baris abu muda dengan avatar bulat (gaya "Your assignments") -->
                    <div class="home-list">
                        @forelse($top_customers->take(10) as $index => $cus)
                        <div class="home-row">
                            <span class="home-row-avatar">{{ substr($cus->nama, 0, 1) }}</span>
                            <div class="flex-grow-1" style="min-width: 0;">
                                <div class="fw-semibold text-truncate">{{ $cus->nama }}</div>
                                <div class="small" style="color: var(--muted);">{{ $cus->total_order }} order</div>
                            </div>
                            <div class="text-end">
                                <div class="fw-semibold">Rp {{ number_format($cus->total_spend) }}</div>
                                <div class="small" style="color: var(--muted);">Total spend</div>
                            </div>
                            <span class="chip {{ $index === 0 ? 'chip--yellow' : ($index < 3 ? 'chip--lav' : '') }} fw-semibold">#{{ $index + 1 }}</span>
                        </div>
                        @empty
                        <div class="home-agenda-empty">Belum ada data transaksi</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Statistik customer + pendapatan tahunan (Larapex) -->
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-calendar-range me-2"></i>Statistik Customer</h5>
                            <div class="card-sub">Jumlah customer per bulan</div>
                        </div>
                    </div>
                    {!! $chartCos->container() !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card mb-0 h-100">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-clipboard-data me-2"></i>Pendapatan Tahunan</h5>
                            <div class="card-sub">Visualisasi performa tahunan pendapatan bisnis.</div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="chip chip--green">{{ $tahunSekarang }}</span>
                        </div>
                    </div>
                    {!! $chart->container() !!}
                </div>
            </div>

            <!-- Filter rekap interaktif -->
            <div class="col-12">
                <div class="glass-card mb-0">
                    <div class="card-head">
                        <div>
                            <h5 class="card-title-lg"><i class="bi bi-sliders me-2"></i>Filter Rekap Interaktif</h5>
                            <div class="card-sub">Pilih tahun dan bulan untuk melihat rekap</div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
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
                            <button class="btn btn-sm btn-primary" id="btnShowRekapDynamic">Tampilkan</button>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3"><div class="home-mini"><div class="home-mini-label">Pendapatan Tahun</div><div class="fw-semibold" id="yearIncomeText">-</div></div></div>
                        <div class="col-md-3"><div class="home-mini"><div class="home-mini-label">Pengeluaran Tahun</div><div class="fw-semibold" id="yearExpenseText">-</div></div></div>
                        <div class="col-md-3"><div class="home-mini"><div class="home-mini-label">Pendapatan Bulan Dipilih</div><div class="fw-semibold" id="monthIncomeText">-</div></div></div>
                        <div class="col-md-3"><div class="home-mini"><div class="home-mini-label">Keterangan</div><div class="fw-semibold" id="monthInfoText">-</div></div></div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h6 class="fw-semibold mb-3" style="color: var(--ink-2);">Grafik Bulanan (Tahun Dipilih)</h6>
                            <canvas id="yearDynamicChart" height="110"></canvas>
                        </div>
                        <div class="col-lg-4">
                            <h6 class="fw-semibold mb-3" style="color: var(--ink-2);">Perbandingan Bulan Dipilih</h6>
                            <canvas id="monthDynamicChart" height="220"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom kanan: kalender, agenda, dan feed deadline (mengisi tinggi kolom kiri) -->
    <div class="col-xl-4 d-flex flex-column">
        <div class="glass-card home-calendar mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div class="card-sub text-uppercase fw-semibold" style="letter-spacing: 0.08em;">Kalender</div>
                    <h5 class="fw-semibold m-0" id="homeCalTitle">-</h5>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light btn-icon" id="homeCalPrev" title="Bulan sebelumnya"><i class="bi bi-chevron-left"></i></button>
                    <button type="button" class="btn btn-light btn-icon" id="homeCalNext" title="Bulan berikutnya"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
            <div class="home-cal-grid" id="homeCalGrid"></div>
            <a href="{{ route('kalender.index') }}" class="btn btn-primary w-100 mt-3"><i class="bi bi-plus-lg me-1"></i>Buka Kalender</a>
        </div>

        <div class="glass-card mb-4">
            <div class="card-sub text-uppercase fw-semibold" style="letter-spacing: 0.08em;">Deadline</div>
            <h5 class="fw-semibold mb-3" id="homeAgendaTitle">-</h5>
            <div id="homeAgendaList"></div>
        </div>

        <!-- Feed deadline bulan ini: memanjang mengisi sisa tinggi kolom -->
        <div class="glass-card mb-0 flex-grow-1 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="fw-semibold m-0" style="font-size: 1.05rem;">Deadline bulan ini</h5>
                <span class="chip" id="homeFeedCount">0</span>
            </div>
            <div id="homeFeedList" class="flex-grow-1"></div>
        </div>
    </div>

    <!-- Modal Top Customers (Full List) -->
    <div class="modal fade" id="topCustomersModal" tabindex="-1" aria-labelledby="topCustomersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content shadow-lg overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" id="topCustomersModalLabel"><i class="bi bi-trophy me-2"></i>Leaderboard Pelanggan Setia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                         <table class="table align-middle mb-0">
                            <thead class="sticky-top">
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
                                    <td class="ps-4 fw-semibold" style="color: {{ $index < 3 ? 'var(--ink)' : 'var(--muted)' }};">
                                        @if($index < 3) <i class="bi bi-award me-1"></i> @endif
                                        #{{ $index + 1 }}
                                    </td>
                                    <td class="fw-semibold">{{ $cus->nama }}</td>
                                    <td class="text-center">
                                         <span class="chip">{{ $cus->total_order }} Order</span>
                                    </td>
                                    <td class="text-end pe-4 fw-semibold">Rp {{ number_format($cus->total_spend) }}</td>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const currentYear = {{ $tahunSekarang }};
        const currentMonth = {{ now()->month }};
        const daysInCurrentMonth = {{ now()->daysInMonth }};
        const baseDailyLabels = {!! $chart_daily_label !!};
        const baseDailyIncome = {!! $chart_daily_data !!};
        const baseDailyCount = {!! $chart_daily_count !!};

        const startInput = document.getElementById('dailyFilterStart');
        const endInput = document.getElementById('dailyFilterEnd');
        const applyDailyFilterBtn = document.getElementById('applyDailyFilterBtn');

        const toDateString = (day) => {
            const monthStr = String(currentMonth).padStart(2, '0');
            const dayStr = String(day).padStart(2, '0');
            return `${currentYear}-${monthStr}-${dayStr}`;
        };

        startInput.min = toDateString(1);
        startInput.max = toDateString(daysInCurrentMonth);
        endInput.min = toDateString(1);
        endInput.max = toDateString(daysInCurrentMonth);
        startInput.value = toDateString(1);
        endInput.value = toDateString(daysInCurrentMonth);

        // Tren pendapatan harian (kartu pink): garis hitam, titik halus, tanpa area
        const ctxDaily = document.getElementById('dailyIncomeChart').getContext('2d');
        const dailyIncomeChart = new Chart(ctxDaily, {
            type: 'line',
            data: {
                labels: baseDailyLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: baseDailyIncome,
                    borderColor: '#111111',
                    backgroundColor: '#111111',
                    borderWidth: 2,
                    pointRadius: 2.5,
                    pointHoverRadius: 5,
                    pointBackgroundColor: '#111111',
                    pointBorderColor: '#F6BEE0',
                    pointBorderWidth: 2,
                    fill: false,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(17,17,17,0.08)' }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });

        // Order harian (kartu kuning): batang hitam membulat
        const ctxCount = document.getElementById('dailyCountChart').getContext('2d');
        const dailyCountChart = new Chart(ctxCount, {
            type: 'bar',
            data: {
                labels: baseDailyLabels,
                datasets: [{
                    label: 'Jumlah Order',
                    data: baseDailyCount,
                    backgroundColor: '#111111',
                    borderRadius: 8,
                    borderSkipped: false,
                    maxBarThickness: 16
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(17,17,17,0.08)' }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });

        function applyDailyFilter() {
            const startVal = startInput.value;
            const endVal = endInput.value;
            if (!startVal || !endVal) return;

            let startDay = Number(startVal.split('-')[2]);
            let endDay = Number(endVal.split('-')[2]);
            if (startDay > endDay) {
                [startDay, endDay] = [endDay, startDay];
            }

            const filteredLabels = [];
            const filteredIncome = [];
            const filteredCount = [];
            for (let i = 0; i < baseDailyLabels.length; i++) {
                const day = Number(baseDailyLabels[i]);
                if (day >= startDay && day <= endDay) {
                    filteredLabels.push(day);
                    filteredIncome.push(baseDailyIncome[i]);
                    filteredCount.push(baseDailyCount[i]);
                }
            }

            dailyIncomeChart.data.labels = filteredLabels;
            dailyIncomeChart.data.datasets[0].data = filteredIncome;
            dailyIncomeChart.update();

            dailyCountChart.data.labels = filteredLabels;
            dailyCountChart.data.datasets[0].data = filteredCount;
            dailyCountChart.update();
        }

        applyDailyFilterBtn.addEventListener('click', applyDailyFilter);

        // JS for deleted charts removed
    </script>
    <script src="{{ $chartCos->cdn() }}"></script>
    {!! $chartCos->script() !!}
    <script src="{{ $chart->cdn() }}"></script>
    {!! $chart->script() !!}

    <script>
        // ===== Kalender mini di halaman utama: ambil deadline dari endpoint kalender =====
        const calDataUrl = @json(route('kalender.data'));
        const calMonthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const calStatusLabel = { sudah: 'Selesai', pembayaran: 'Bayar', proses: 'Proses', belum: 'Belum' };
        const calStatusClass = { sudah: 'sudah', pembayaran: 'pembayaran', proses: 'proses', belum: 'belum' };
        const calToday = new Date();
        const calTodayKey = [calToday.getFullYear(), String(calToday.getMonth() + 1).padStart(2, '0'), String(calToday.getDate()).padStart(2, '0')].join('-');
        const calState = { bulan: calToday.getMonth() + 1, tahun: calToday.getFullYear(), events: [], selected: calTodayKey };

        function calKey(e) {
            return String(e.tanggal || '').slice(0, 10);
        }

        function calEl(tag, cls, text) {
            const node = document.createElement(tag);
            if (cls) node.className = cls;
            if (text !== undefined) node.textContent = text;
            return node;
        }

        function renderCal() {
            const title = document.getElementById('homeCalTitle');
            const grid = document.getElementById('homeCalGrid');
            title.textContent = `${calMonthNames[calState.bulan - 1]} ${calState.tahun}`;
            grid.innerHTML = '';

            ['S', 'S', 'R', 'K', 'J', 'S', 'M'].forEach(h => grid.appendChild(calEl('div', 'home-cal-head', h)));

            const first = new Date(calState.tahun, calState.bulan - 1, 1);
            const offset = (first.getDay() + 6) % 7; // Senin = 0
            const days = new Date(calState.tahun, calState.bulan, 0).getDate();
            const counts = {};
            calState.events.forEach(e => { const k = calKey(e); counts[k] = (counts[k] || 0) + 1; });

            for (let i = 0; i < offset; i++) grid.appendChild(calEl('span', 'home-cal-blank'));

            for (let d = 1; d <= days; d++) {
                const key = [calState.tahun, String(calState.bulan).padStart(2, '0'), String(d).padStart(2, '0')].join('-');
                const btn = calEl('button', 'home-cal-day' + (key === calState.selected ? ' is-selected' : '') + (key === calTodayKey ? ' is-today' : ''), String(d));
                btn.type = 'button';
                if (counts[key]) {
                    btn.appendChild(calEl('span', 'home-cal-dot'));
                    btn.title = `${counts[key]} deadline`;
                }
                btn.addEventListener('click', () => { calState.selected = key; renderCal(); renderAgenda(); });
                grid.appendChild(btn);
            }
        }

        function renderAgenda() {
            const title = document.getElementById('homeAgendaTitle');
            const list = document.getElementById('homeAgendaList');
            const [y, m, d] = calState.selected.split('-').map(Number);
            title.textContent = `${d} ${calMonthNames[m - 1]} ${y}`;
            list.innerHTML = '';

            const items = calState.events.filter(e => calKey(e) === calState.selected);
            if (items.length === 0) {
                list.appendChild(calEl('div', 'home-agenda-empty', 'Tidak ada deadline di tanggal ini'));
                return;
            }
            items.forEach(e => {
                const row = calEl('div', 'home-agenda-item home-agenda-item--' + (calStatusClass[e.selesaikan] || 'belum'));
                row.appendChild(calEl('div', 'home-agenda-time', String(e.waktu || '').slice(0, 5)));
                const body = calEl('div', 'flex-grow-1');
                body.style.minWidth = '0';
                body.appendChild(calEl('div', 'fw-semibold text-truncate', e.nama));
                body.appendChild(calEl('div', 'small', `${e.nama_metode} · #${e.id_costomer}`));
                row.appendChild(body);
                row.appendChild(calEl('span', 'status-pill status-pill--' + (calStatusClass[e.selesaikan] || 'belum'), calStatusLabel[e.selesaikan] || e.selesaikan));
                list.appendChild(row);
            });
        }

        // Feed deadline bulan ini: daftar terurut tanggal dan jam, dari data kalender
        function renderFeed() {
            const list = document.getElementById('homeFeedList');
            const count = document.getElementById('homeFeedCount');
            const tones = ['#DFD8F9', '#D2EFFA', '#FCF1C8', '#D6E2C3'];
            list.innerHTML = '';

            const sorted = calState.events.slice().sort((a, b) => {
                const ka = calKey(a) + ' ' + String(a.waktu || '');
                const kb = calKey(b) + ' ' + String(b.waktu || '');
                return ka < kb ? -1 : ka > kb ? 1 : 0;
            });
            count.textContent = sorted.length;

            if (sorted.length === 0) {
                list.appendChild(calEl('div', 'home-agenda-empty', 'Belum ada deadline bulan ini'));
                return;
            }

            sorted.slice(0, 12).forEach(e => {
                const row = calEl('div', 'home-feed-item');
                const av = calEl('span', 'home-avatar', String(e.nama || '?').charAt(0));
                av.style.background = tones[Number(e.id_costomer) % tones.length];
                row.appendChild(av);

                const body = calEl('div', 'flex-grow-1');
                body.style.minWidth = '0';
                body.appendChild(calEl('div', 'fw-semibold text-truncate', e.nama));
                const [, m, d] = calKey(e).split('-').map(Number);
                body.appendChild(calEl('div', 'small', `${d} ${calMonthNames[m - 1].slice(0, 3)} · ${String(e.waktu || '').slice(0, 5)}`));
                row.appendChild(body);

                row.appendChild(calEl('span', 'status-pill status-pill--' + (calStatusClass[e.selesaikan] || 'belum'), calStatusLabel[e.selesaikan] || e.selesaikan));
                list.appendChild(row);
            });
        }

        async function loadCal(bulan, tahun) {
            try {
                const res = await fetch(`${calDataUrl}?bulan=${bulan}&tahun=${tahun}`, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
                calState.events = res.ok ? await res.json() : [];
            } catch (err) {
                calState.events = [];
            }
            calState.bulan = bulan;
            calState.tahun = tahun;
            if (!calState.selected.startsWith(`${tahun}-${String(bulan).padStart(2, '0')}`)) {
                calState.selected = `${tahun}-${String(bulan).padStart(2, '0')}-01`;
            }
            renderCal();
            renderAgenda();
            renderFeed();
        }

        document.getElementById('homeCalPrev').addEventListener('click', () => {
            let b = calState.bulan - 1, t = calState.tahun;
            if (b < 1) { b = 12; t -= 1; }
            loadCal(b, t);
        });
        document.getElementById('homeCalNext').addEventListener('click', () => {
            let b = calState.bulan + 1, t = calState.tahun;
            if (b > 12) { b = 1; t += 1; }
            loadCal(b, t);
        });

        loadCal(calState.bulan, calState.tahun);
    </script>

    <!-- Rekap dinamis (filter tahun & bulan) -->
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
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#F2F3F6' }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });
        const monthChart = new Chart(monthCtx, {
            type: 'bar',
            data: { labels: ['Pendapatan', 'Pengeluaran', 'Bersih'], datasets: [{ data: [0, 0, 0], backgroundColor: ['#111111', '#D9A21B', '#5E9E4A'], borderRadius: 10, borderSkipped: false, maxBarThickness: 46 }] },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#F2F3F6' }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
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
                { label: 'Pendapatan', data: monthlyIncome, borderColor: '#111111', backgroundColor: '#111111', fill: false, tension: 0.3, pointRadius: 3, borderWidth: 2 },
                { label: 'Pengeluaran', data: monthlyExpense, borderColor: '#D9A21B', backgroundColor: '#D9A21B', fill: false, tension: 0.3, pointRadius: 3, borderWidth: 2 }
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

    <style>
        /* ===== Tiga kartu statistik gaya referensi: angka besar di tengah, warna solid (tanpa gradien) ===== */
        .home-tile {
            border-radius: 28px;
            padding: 26px 22px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--ink);
        }

        .home-tile--dark { background: var(--ink); color: #FFFFFF; }
        .home-tile--lav { background: var(--lav); }
        .home-tile--sky { background: var(--sky); }

        .home-tile-num {
            font-size: 2.6rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .home-tile-num--sm { font-size: 1.7rem; }

        .home-tile-label {
            font-weight: 500;
            margin-top: 6px;
        }

        .home-tile-sub {
            font-size: 0.82rem;
            opacity: 0.7;
            margin-top: 2px;
        }

        /* Lonceng bulat; titik kuning muncul bila ada pesanan menunggu diproses */
        .home-bell {
            position: relative;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--panel);
            color: var(--ink);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .home-bell-dot {
            position: absolute;
            top: 9px;
            right: 10px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #F5B841;
            border: 2px solid #FFFFFF;
        }

        /* Daftar pelanggan: baris abu muda, avatar bulat di kiri */
        .home-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .home-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            background: var(--panel);
            border-radius: 18px;
        }

        .home-row-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }

        .home-input {
            background: var(--panel);
        }

        .home-progress {
            height: 10px;
            border-radius: 999px;
            background: var(--panel);
            overflow: hidden;
        }

        .home-progress span {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: var(--ink);
        }

        .home-mini {
            background: var(--panel);
            border-radius: 16px;
            padding: 10px 14px;
        }

        .home-mini-label {
            font-size: 0.75rem;
            color: var(--ink-2);
            margin-bottom: 2px;
        }

        .home-mini-value {
            font-size: 1.25rem;
            font-weight: 600;
        }

        /* Kalender mini */
        .home-cal-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 4px;
        }

        .home-cal-head {
            text-align: center;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--muted);
            padding: 2px 0 6px;
        }

        .home-cal-blank {
            display: block;
        }

        .home-cal-day {
            position: relative;
            aspect-ratio: 1 / 1;
            border: 0;
            border-radius: 50%;
            background: transparent;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s ease;
        }

        .home-cal-day:hover {
            background: var(--panel);
        }

        .home-cal-day.is-today {
            background: var(--sky);
        }

        .home-cal-day.is-selected {
            background: var(--lav);
            box-shadow: inset 0 0 0 1.5px var(--accent);
        }

        .home-cal-dot {
            position: absolute;
            bottom: 4px;
            left: 50%;
            transform: translateX(-50%);
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
        }

        /* Agenda deadline */
        /* Blok agenda pastel per status (gaya Schedule) */
        .home-agenda-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 10px;
            border-radius: 18px;
            background: var(--panel);
        }

        .home-agenda-item--sudah { background: var(--pill-green); }
        .home-agenda-item--pembayaran { background: var(--yellow); }
        .home-agenda-item--proses { background: var(--sky); }
        .home-agenda-item--belum { background: var(--lav); }

        .home-agenda-time {
            min-width: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--ink-2);
            padding-top: 2px;
        }

        .home-agenda-empty {
            text-align: center;
            padding: 18px 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .status-pill {
            font-size: 0.72rem;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 999px;
            white-space: nowrap;
            color: var(--ink);
        }

        .status-pill--sudah { background: var(--pill-green); }
        .status-pill--pembayaran { background: var(--yellow); }
        .status-pill--proses { background: var(--sky); }
        .status-pill--belum { background: #ECEEF2; }

        .home-feed-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-top: 1px solid var(--line);
        }

        .home-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--ink);
            flex-shrink: 0;
        }
    </style>

@endsection
