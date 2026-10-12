@extends('dashboard')
@section('tabel')
    @php
        \Carbon\Carbon::setLocale('id');

        $hariIni = now()->toDateString();
        $eventsByDate = $events->groupBy(fn ($e) => \Carbon\Carbon::parse($e->tanggal)->toDateString());

        // Tanggal yang dipilih: dari URL, atau hari ini (jika bulan ini), atau tanggal 1
        $pilih = request('tanggal');
        if (!$pilih || \Carbon\Carbon::parse($pilih)->format('Y-m') !== $awal->format('Y-m')) {
            $pilih = $awal->format('Y-m') === now()->format('Y-m') ? $hariIni : $awal->toDateString();
        }

        $statusMeta = [
            'sudah' => ['label' => 'Selesai', 'class' => 'sudah'],
            'pembayaran' => ['label' => 'Bayar', 'class' => 'pembayaran'],
            'proses' => ['label' => 'Proses', 'class' => 'proses'],
            'belum' => ['label' => 'Belum', 'class' => 'belum'],
        ];
        $avatarTones = ['#DFD8F9', '#D2EFFA', '#FCF1C8', '#D6E2C3'];

        // Agenda hari terpilih, diurutkan jam
        $agenda = $eventsByDate->get($pilih, collect())->sortBy('waktu')->values();
        $jamMin = min(8, $agenda->map(fn ($e) => (int) substr($e->waktu, 0, 2))->min() ?? 8);
        $jamMax = max(17, $agenda->map(fn ($e) => (int) substr($e->waktu, 0, 2))->max() ?? 17);
        $selTanggal = \Carbon\Carbon::parse($pilih);

        $hitungSelesai = $agenda->where('selesaikan', 'sudah')->count();
        $hitungBelum = $agenda->whereIn('selesaikan', ['belum', 'proses', 'pembayaran'])->count();
        $persenAgenda = $agenda->count() > 0 ? round(($hitungSelesai / $agenda->count()) * 100) : 0;

        // Feed deadline bulan ini (mendatang dulu)
        $feed = $events->sortBy([['tanggal', 'asc'], ['waktu', 'asc']])->values()->take(8);

        $jumlahHari = $awal->daysInMonth;
    @endphp

    <!-- Judul & aksi -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="cal-title m-0">Kalender</h2>
            <div class="card-sub">Deadline = tanggal target customer dari Jadwal (kanban) atau Data Customer</div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="{{ route('costomer.jadwal') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-kanban me-1"></i>Buka Jadwal</a>
            <a href="{{ route('costomer.jadwal') }}" class="btn btn-warning btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Jadwal</a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Kolom utama: bulan, tanggal, timeline -->
        <div class="col-xl-8">
            <!-- Strip bulan -->
            <div class="month-strip mb-3">
                @foreach (range(1, 12) as $m)
                    @php $tgBulan = \Carbon\Carbon::create($awal->year, $m, 1); @endphp
                    <a href="{{ route('kalender.index', ['bulan' => $m, 'tahun' => $awal->year]) }}"
                        class="{{ $m === $awal->month ? 'is-active' : '' }}">{{ $tgBulan->translatedFormat('F') }}</a>
                @endforeach
            </div>

            <!-- Strip tanggal -->
            <div class="date-strip mb-2">
                @for ($d = 1; $d <= $jumlahHari; $d++)
                    @php
                        $tg = $awal->copy()->day($d);
                        $key = $tg->toDateString();
                        $adaDeadline = $eventsByDate->has($key);
                    @endphp
                    <a href="{{ route('kalender.index', ['bulan' => $awal->month, 'tahun' => $awal->year, 'tanggal' => $key]) }}"
                        class="date-pill {{ $adaDeadline ? 'has-event' : '' }} {{ $key === $pilih ? 'is-sel' : '' }}">
                        <span class="date-wd">{{ $tg->translatedFormat('D') }}</span>
                        <span class="date-num {{ $key === $hariIni ? 'is-today' : '' }}">{{ $d }}</span>
                    </a>
                @endfor
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('kalender.index', ['bulan' => $awal->copy()->subMonth()->month, 'tahun' => $awal->copy()->subMonth()->year]) }}"
                        class="btn btn-light btn-icon" title="Bulan sebelumnya"><i class="bi bi-chevron-left"></i></a>
                    <a href="{{ route('kalender.index', ['bulan' => $awal->copy()->addMonth()->month, 'tahun' => $awal->copy()->addMonth()->year]) }}"
                        class="btn btn-light btn-icon" title="Bulan berikutnya"><i class="bi bi-chevron-right"></i></a>
                </div>
                <div class="fw-semibold" style="color: var(--ink-2);">{{ $selTanggal->translatedFormat('l, d F Y') }}</div>
                <a href="{{ route('kalender.index') }}" class="btn btn-sm btn-outline-primary">Hari ini</a>
            </div>

            <!-- Timeline per jam -->
            <div class="timeline">
                @for ($jam = $jamMin; $jam <= $jamMax; $jam++)
                    @php
                        $slot = $agenda->filter(fn ($e) => (int) substr($e->waktu, 0, 2) === $jam)->values();
                    @endphp
                    <div class="tl-row">
                        <div class="tl-hour">{{ sprintf('%02d:00', $jam) }}</div>
                        <div class="tl-slot">
                            @foreach ($slot as $i => $ev)
                                @php $meta = $statusMeta[$ev->selesaikan] ?? $statusMeta['belum']; @endphp
                                <a href="{{ route('costomer.jadwal') }}" class="tl-event tl-event--{{ $meta['class'] }}">
                                    <span class="tl-icon"><i class="bi bi-person-workspace"></i></span>
                                    <span class="flex-grow-1" style="min-width: 0;">
                                        <span class="tl-title d-block text-truncate">{{ $ev->nama }}</span>
                                        <span class="tl-meta d-block">{{ substr($ev->waktu, 0, 5) }} · {{ $ev->nama_metode }}@if(!empty($ev->label_custom)) · {{ $ev->label_custom }}@endif</span>
                                    </span>
                                    <span class="tl-avatar" style="background: {{ $avatarTones[$ev->id_costomer % count($avatarTones)] }};">{{ substr($ev->nama, 0, 1) }}</span>
                                    <span class="tl-status">{{ $meta['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Kolom kanan: ringkasan dan feed -->
        <div class="col-xl-4">
            <div class="glass-card mb-4">
                <div class="card-sub text-uppercase fw-semibold" style="letter-spacing: 0.08em;">Ringkasan hari terpilih</div>
                <div class="d-flex align-items-end justify-content-between mt-2 mb-3">
                    <div class="cal-stat cal-stat--yellow">
                        <div class="cal-stat-label">Deadline</div>
                        <div class="cal-stat-value">{{ $agenda->count() }}</div>
                    </div>
                    <div class="cal-stat cal-stat--sky">
                        <div class="cal-stat-label">Selesai</div>
                        <div class="cal-stat-value">{{ $hitungSelesai }}</div>
                    </div>
                    <div class="cal-stat cal-stat--grey">
                        <div class="cal-stat-label">Belum</div>
                        <div class="cal-stat-value">{{ $hitungBelum }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between small mb-1" style="color: var(--muted);">
                    <span>Progres selesai</span><span>{{ $persenAgenda }}%</span>
                </div>
                <div class="cal-progress"><span style="width: {{ $persenAgenda }}%;"></span></div>
            </div>

            <div class="glass-card mb-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-semibold m-0" style="font-size: 1.05rem;">Deadline bulan ini</h5>
                    <span class="chip">{{ $events->count() }}</span>
                </div>

                @forelse ($feed as $ev)
                    @php $meta = $statusMeta[$ev->selesaikan] ?? $statusMeta['belum']; @endphp
                    <a href="{{ route('costomer.jadwal') }}" class="feed-item text-decoration-none">
                        <span class="tl-avatar" style="background: {{ $avatarTones[$ev->id_costomer % count($avatarTones)] }};">{{ substr($ev->nama, 0, 1) }}</span>
                        <div class="flex-grow-1" style="min-width: 0;">
                            <div class="fw-semibold text-truncate" style="color: var(--ink);">{{ $ev->nama }}</div>
                            <div class="small" style="color: var(--muted);">{{ \Carbon\Carbon::parse($ev->tanggal)->translatedFormat('d M') }} · {{ substr($ev->waktu, 0, 5) }}</div>
                        </div>
                        <span class="status-pill status-pill--{{ $meta['class'] }}">{{ $meta['label'] }}</span>
                    </a>
                @empty
                    <div class="text-center py-4" style="color: var(--muted);">Belum ada deadline bulan ini</div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .cal-title {
            font-size: 2.1rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        /* Strip bulan: aktif tebal hitam, lainnya abu */
        .month-strip {
            display: flex;
            gap: 22px;
            overflow-x: auto;
            padding: 4px 2px 6px;
            scrollbar-width: none;
        }

        .month-strip a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.98rem;
            white-space: nowrap;
            transition: color 0.15s ease;
        }

        .month-strip a:hover {
            color: var(--ink-2);
        }

        .month-strip a.is-active {
            color: var(--ink);
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Strip tanggal: lingkaran, hari ada deadline kuning, terpilih hitam */
        .date-strip {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding: 6px 2px 10px;
            scrollbar-width: none;
        }

        .date-pill {
            min-width: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: var(--ink-2);
            font-size: 0.72rem;
            flex-shrink: 0;
        }

        .date-wd {
            text-transform: capitalize;
        }

        .date-num {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--ink);
            transition: background 0.15s ease;
        }

        .date-pill.has-event .date-num {
            background: var(--yellow);
        }

        .date-pill.is-sel .date-num {
            background: var(--ink);
            color: #FFFFFF;
        }

        .date-pill.is-sel.has-event .date-num {
            background: var(--ink);
        }

        .date-num.is-today {
            box-shadow: inset 0 -3px 0 var(--accent);
        }

        .date-pill.is-sel .date-num.is-today {
            box-shadow: none;
        }

        /* Timeline */
        .timeline {
            border-top: 1px solid var(--line);
        }

        .tl-row {
            display: grid;
            grid-template-columns: 58px 1fr;
            gap: 14px;
            min-height: 58px;
            border-bottom: 1px dashed var(--line);
            padding: 8px 0;
        }

        .tl-hour {
            font-size: 0.75rem;
            color: var(--muted);
            padding-top: 2px;
        }

        .tl-slot {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .tl-event {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 18px;
            background: var(--panel);
            color: var(--ink);
            text-decoration: none;
            border: 1px solid transparent;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .tl-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(17, 17, 17, 0.07);
            color: var(--ink);
        }

        .tl-event--sudah {
            background: #F2F3F6;
            color: var(--muted);
        }

        .tl-event--pembayaran {
            background: var(--yellow);
        }

        .tl-event--proses {
            background: var(--sky);
        }

        .tl-event--belum {
            background: #FFFFFF;
            border-color: var(--line);
        }

        .tl-icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ink);
        }

        .tl-event--sudah .tl-icon {
            color: var(--muted);
        }

        .tl-title {
            font-size: 0.92rem;
            font-weight: 600;
        }

        .tl-meta {
            font-size: 0.75rem;
            color: var(--ink-2);
        }

        .tl-event--sudah .tl-meta {
            color: var(--muted);
        }

        .tl-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ink);
            flex-shrink: 0;
        }

        .tl-status {
            font-size: 0.7rem;
            font-weight: 500;
            padding: 3px 9px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.7);
            color: var(--ink);
            white-space: nowrap;
        }

        /* Ringkasan kanan */
        .cal-stat {
            flex: 1;
            padding: 10px 12px 10px 14px;
            border-left: 3px solid var(--accent);
            margin-right: 10px;
        }

        .cal-stat--yellow { border-left-color: var(--warning); }
        .cal-stat--sky { border-left-color: var(--accent); }
        .cal-stat--grey { border-left-color: #C9CDD6; }

        .cal-stat-label {
            font-size: 0.75rem;
            color: var(--muted);
        }

        .cal-stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.2;
        }

        .cal-progress {
            height: 8px;
            border-radius: 999px;
            background: var(--panel);
            overflow: hidden;
        }

        .cal-progress span {
            display: block;
            height: 100%;
            background: var(--ink);
            border-radius: 999px;
        }

        .feed-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-top: 1px solid var(--line);
        }

        .feed-item:first-of-type {
            border-top: 0;
        }

        .status-pill {
            font-size: 0.7rem;
            font-weight: 500;
            padding: 3px 9px;
            border-radius: 999px;
            white-space: nowrap;
            color: var(--ink);
        }

        .status-pill--sudah { background: var(--pill-green); }
        .status-pill--pembayaran { background: var(--yellow); }
        .status-pill--proses { background: var(--sky); }
        .status-pill--belum { background: var(--grey); }

        @media (max-width: 576px) {
            .cal-title {
                font-size: 1.6rem;
            }

            .tl-row {
                grid-template-columns: 46px 1fr;
                gap: 8px;
            }

            .tl-status {
                display: none;
            }
        }
    </style>
@endsection
