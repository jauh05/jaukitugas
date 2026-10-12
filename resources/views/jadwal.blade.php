@extends('dashboard')
@section('tabel')
    @php
        $statusBoards = [
            'belum' => ['title' => 'Belum', 'tone' => 'grey', 'hint' => 'menunggu'],
            'proses' => ['title' => 'Proses', 'tone' => 'grey', 'hint' => 'dikerjakan'],
            'pembayaran' => ['title' => 'Bayar', 'tone' => 'grey', 'hint' => 'bayar dulu'],
            'sudah' => ['title' => 'Selesai', 'tone' => 'green', 'hint' => 'lunas'],
        ];
        $avatarTones = ['#DFD8F9', '#D2EFFA', '#FCF1C8', '#D6E2C3'];

        // Ringkasan untuk strip statistik di atas papan
        $hariIniTgl = now()->toDateString();
        $statAktif = $costomer->whereIn('selesaikan', ['belum', 'proses', 'pembayaran'])->count();
        $statHariIni = $costomer->filter(fn ($c) => $c['selesaikan'] !== 'sudah' && \Carbon\Carbon::parse($c['tanggal'])->toDateString() === $hariIniTgl)->count();
        $statLewat = $costomer->filter(fn ($c) => $c['selesaikan'] !== 'sudah' && \Carbon\Carbon::parse($c['tanggal'])->lt(today()))->count();
        $statSelesai = $costomer->where('selesaikan', 'sudah')->count();
    @endphp

    <!-- Header papan -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <span class="bubble" style="background: var(--sky);"><i class="bi bi-kanban"></i></span>
            <div>
                <h4 class="fw-semibold m-0" style="font-size: 1.35rem;">Jadwal Pengerjaan</h4>
                <div class="card-sub">Drag & drop status customer seperti Trello</div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3" style="color: var(--muted);"></i>
                <input type="search" id="boardSearch" class="form-control rounded-pill ps-5" placeholder="Cari customer atau ID..." style="min-width: 240px;">
            </div>
            <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addJadwalModal">
                <i class="bi bi-plus-lg"></i> Tambah Jadwal
            </button>
        </div>
    </div>

    <!-- Strip statistik -->
    <div class="kb-stats mb-3">
        <div class="kb-stat">
            <span class="kb-stat-icon" style="background: var(--lav);"><i class="bi bi-people"></i></span>
            <div>
                <div class="kb-stat-label">Pesanan aktif</div>
                <div class="kb-stat-value">{{ $statAktif }} <span class="kb-stat-unit">customer</span></div>
            </div>
        </div>
        <div class="kb-stat">
            <span class="kb-stat-icon" style="background: var(--yellow);"><i class="bi bi-calendar-event"></i></span>
            <div>
                <div class="kb-stat-label">Deadline hari ini</div>
                <div class="kb-stat-value">{{ $statHariIni }}</div>
            </div>
            @if ($statHariIni > 0)
                <span class="kb-tag kb-tag--yellow">hari ini</span>
            @endif
        </div>
        <div class="kb-stat">
            <span class="kb-stat-icon" style="background: var(--danger-soft);"><i class="bi bi-exclamation-circle" style="color: #C9363B;"></i></span>
            <div>
                <div class="kb-stat-label">Lewat deadline</div>
                <div class="kb-stat-value">{{ $statLewat }}</div>
            </div>
            @if ($statLewat > 0)
                <span class="kb-tag kb-tag--red">breach</span>
            @endif
        </div>
        <div class="kb-stat">
            <span class="kb-stat-icon" style="background: var(--pill-green);"><i class="bi bi-check2-circle"></i></span>
            <div>
                <div class="kb-stat-label">Selesai</div>
                <div class="kb-stat-value">{{ $statSelesai }}</div>
            </div>
            <span class="kb-tag kb-tag--green">lunas</span>
        </div>
    </div>

    <!-- Filter pill -->
    <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
        <button type="button" class="kb-chip is-active" data-board-filter="all">Semua</button>
        <button type="button" class="kb-chip" data-board-filter="today"><i class="bi bi-calendar-day"></i> Deadline hari ini <span class="kb-chip-count">{{ $statHariIni }}</span></button>
        <button type="button" class="kb-chip" data-board-filter="late"><i class="bi bi-exclamation-triangle"></i> Lewat deadline <span class="kb-chip-count">{{ $statLewat }}</span></button>
        <button type="button" class="kb-chip" data-board-filter="nolabel"><i class="bi bi-tag"></i> Tanpa label</button>
        <span class="ms-auto small" id="boardShowing" style="color: var(--muted);"></span>
    </div>

    <div class="row g-3" id="trelloBoard">
        @foreach ($statusBoards as $statusKey => $statusInfo)
            @php
                $boardItems = $costomer->where('selesaikan', $statusKey);
                if (in_array($statusKey, ['pembayaran', 'sudah'])) {
                    $boardItems = $boardItems->sortByDesc(function ($item) {
                        return $item['tanggal'] . ' ' . $item['waktu'];
                    });
                } else {
                    $boardItems = $boardItems->sortBy(function ($item) {
                        return $item['tanggal'] . ' ' . $item['waktu'];
                    });
                }
            @endphp
            <div class="col-lg-3 col-md-6">
                <div class="board-column h-100 board-tone-{{ $statusInfo['tone'] }}" data-status="{{ $statusKey }}">
                    <div class="board-header">
                        <div class="d-flex align-items-center gap-2">
                            <span class="board-title">{{ $statusInfo['title'] }}</span>
                            <span class="board-count-pill board-count" data-count-for="{{ $statusKey }}">{{ $boardItems->count() }}</span>
                        </div>
                        <span class="board-hint">{{ $statusInfo['hint'] }}</span>
                    </div>

                    <div class="board-dropzone" data-status="{{ $statusKey }}">
                        @foreach ($boardItems as $value)
                            @php
                                $tanggalWaktu = \Carbon\Carbon::parse($value['tanggal'] . ' ' . $value['waktu']);
                                $sisaHari = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($value['tanggal']), false);
                                $flags = [];
                                if ($sisaHari === 0 && $statusKey !== 'sudah') { $flags[] = 'today'; }
                                if ($sisaHari < 0 && $statusKey !== 'sudah') { $flags[] = 'late'; }
                                if (empty($value['label_custom'])) { $flags[] = 'nolabel'; }
                                $avatarBg = $avatarTones[$value['id_costomer'] % count($avatarTones)];
                            @endphp
                            <div class="board-card" draggable="true" data-id="{{ $value['id_costomer'] }}"
                                data-status="{{ $value['selesaikan'] }}" data-nama="{{ $value['nama'] }}"
                                data-tanggal="{{ $value['tanggal'] }}" data-waktu="{{ $value['waktu'] }}"
                                data-flags="{{ implode(' ', $flags) }}"
                                data-nota-url="{{ url('costomer/' . $value['id_costomer'] . '/nota') }}">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="board-avatar" style="background: {{ $avatarBg }};">{{ substr($value['nama'], 0, 1) }}</span>
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <div class="board-nama" title="{{ $value['nama'] }}">{{ \Illuminate\Support\Str::limit($value['nama'], 16, '...') }}</div>
                                        <div class="board-sub">{{ $value['nama_metode'] }} · #{{ $value['id_costomer'] }}</div>
                                    </div>
                                    <button type="button" class="board-action-trigger" title="Aksi" draggable="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                </div>

                                <div class="board-pill-row">
                                    <span class="board-tanggal-text"><i class="bi bi-calendar3"></i>{{ $tanggalWaktu->translatedFormat('d M Y') }}</span>
                                    <span class="board-waktu-text"><i class="bi bi-clock"></i>{{ $tanggalWaktu->format('H:i') }}</span>
                                    @if ($statusKey === 'sudah')
                                        @if ($sisaHari < 0)
                                            <span class="board-deadline-text board-dl board-dl--green">Clear {{ abs($sisaHari) }} hari lalu</span>
                                        @elseif ($sisaHari === 0)
                                            <span class="board-deadline-text board-dl board-dl--green">Clear hari ini</span>
                                        @else
                                            <span class="board-deadline-text board-dl board-dl--green">Clear {{ $sisaHari }} hari lebih awal</span>
                                        @endif
                                    @elseif ($statusKey === 'pembayaran')
                                        @if ($sisaHari < 0)
                                            <span class="board-deadline-text board-dl board-dl--red">Utang {{ abs($sisaHari) }} hari lalu</span>
                                        @elseif ($sisaHari === 0)
                                            <span class="board-deadline-text board-dl board-dl--red">Utang hari ini</span>
                                        @else
                                            <span class="board-deadline-text board-dl board-dl--yellow">Jatuh tempo {{ $sisaHari }} hari lagi</span>
                                        @endif
                                    @elseif ($sisaHari === 0)
                                        <span class="board-deadline-text board-dl board-dl--sky">Kerjakan hari ini</span>
                                    @elseif ($sisaHari > 0)
                                        <span class="board-deadline-text board-dl board-dl--yellow">{{ $sisaHari }} hari lagi</span>
                                    @else
                                        <span class="board-deadline-text board-dl board-dl--red">Lewat {{ abs($sisaHari) }} hari</span>
                                    @endif
                                </div>

                                @if (!empty($value['label_custom']))
                                    <div class="board-label board-tag">{{ $value['label_custom'] }}</div>
                                @else
                                    <div class="board-label board-tag board-tag--muted">Tanpa label</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="board-add" data-bs-toggle="modal" data-bs-target="#addJadwalModal">
                        <i class="bi bi-plus"></i> Tambah jadwal
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="addJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Tambah Jadwal Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="{{ url('dashboard/costomer/tambah/data') }}" method="POST">
                        @csrf
                        <input type="hidden" name="redirect_to" value="jadwal">

                        <div class="mb-3">
                            <label class="form-label">Nama Customer</label>
                            <input type="text" name="nama_costomer" class="form-control" placeholder="Masukkan nama..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode" class="form-select" required>
                                @foreach ($metode as $m)
                                    <option value="{{ $m['id_metode'] }}">{{ $m['nama_metode'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-7 mb-3">
                                <label class="form-label">Tanggal Target</label>
                                <input type="date" name="tanggal_costomer" class="form-control" required>
                            </div>
                            <div class="col-5 mb-3">
                                <label class="form-label">Jam</label>
                                <input type="time" name="waktu_costomer" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Label Custom</label>
                            <input type="text" name="label_custom" class="form-control" placeholder="Contoh: desain urgent">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Simpan Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNotaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Tambah Nota dari Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <form id="addNotaForm" method="POST">
                        @csrf
                        <div class="alert small border-0 rounded-4" style="background: var(--sky);" id="addNotaCustomerInfo"></div>
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" min="1" name="jumlah" class="form-control" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" min="0" name="harga" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Simpan Nota</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cardActionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Aksi Customer Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="mb-3 small" style="color: var(--muted);" id="cardActionInfo"></div>
                    <div class="action-grid">
                        <button type="button" class="action-box action-box--sky" id="actionEditJadwalBtn">
                            <i class="bi bi-pencil"></i>
                            <span>Edit</span>
                        </button>
                        <button type="button" class="action-box action-box--yellow" id="actionEditLabelBtn">
                            <i class="bi bi-tag"></i>
                            <span>Label</span>
                        </button>
                        <button type="button" class="action-box action-box--red" id="actionDeleteBtn">
                            <i class="bi bi-trash"></i>
                            <span>Hapus</span>
                        </button>
                        <button type="button" class="action-box action-box--lav" id="actionPrintNotaBtn">
                            <i class="bi bi-printer"></i>
                            <span>Nota</span>
                        </button>
                    </div>
                    <form id="deleteCustomerForm" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ===== Strip statistik (gaya "Patient Flow") ===== */
        .kb-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 18px;
        }

        .kb-stat {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-right: 1px solid var(--line);
            position: relative;
        }

        .kb-stat:last-child {
            border-right: 0;
        }

        .kb-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .kb-stat-label {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .kb-stat-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.2;
        }

        .kb-stat-unit {
            font-size: 0.8rem;
            font-weight: 400;
            color: var(--muted);
        }

        .kb-tag {
            margin-left: auto;
            font-size: 0.7rem;
            font-weight: 500;
            padding: 3px 9px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .kb-tag--yellow { background: var(--yellow); color: var(--ink); }
        .kb-tag--red { background: var(--danger-soft); color: #A8282D; }
        .kb-tag--green { background: var(--pill-green); color: var(--ink); }

        /* ===== Filter pill ===== */
        .kb-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--line);
            background: #FFFFFF;
            color: var(--ink-2);
            border-radius: 999px;
            padding: 6px 13px;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.15s ease;
        }

        .kb-chip:hover {
            background: var(--panel);
        }

        .kb-chip.is-active {
            background: var(--ink);
            border-color: var(--ink);
            color: #FFFFFF;
        }

        .kb-chip-count {
            font-size: 0.7rem;
            background: var(--panel);
            color: var(--ink-2);
            border-radius: 999px;
            padding: 1px 7px;
        }

        .kb-chip.is-active .kb-chip-count {
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
        }

        /* ===== Kolom papan: abu halus, hijau untuk Selesai ===== */
        .board-column {
            background: #F2F3F6;
            border-radius: 18px;
            padding: 10px;
            min-height: 460px;
            display: flex;
            flex-direction: column;
            border: 0;
        }

        .board-column.board-tone-green {
            background: #E4EDD8;
        }

        .board-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 6px 10px;
        }

        .board-title {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--ink);
        }

        .board-count-pill {
            min-width: 24px;
            height: 22px;
            padding: 0 7px;
            border-radius: 999px;
            background: #FFFFFF;
            color: var(--ink-2);
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .board-hint {
            font-size: 0.72rem;
            color: var(--muted);
        }

        .board-dropzone {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-height: 360px;
            border-radius: 14px;
            transition: background 0.15s ease;
        }

        .board-dropzone.drag-over {
            background: rgba(120, 159, 236, 0.12);
            outline: 2px dashed rgba(120, 159, 236, 0.5);
            outline-offset: -4px;
        }

        /* ===== Kartu: putih, sudut 14px, pill ringkas ===== */
        .board-card {
            background: #FFFFFF;
            border-radius: 14px;
            border: 1px solid #EEF0F3;
            box-shadow: 0 1px 2px rgba(17, 17, 17, 0.04);
            padding: 12px;
            cursor: grab;
            transition: box-shadow 0.15s ease, transform 0.15s ease;
        }

        .board-card:hover {
            box-shadow: 0 6px 16px rgba(17, 17, 17, 0.07);
        }

        .board-card.dragging {
            opacity: 0.5;
            transform: rotate(1.2deg);
        }

        .board-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--ink);
            flex-shrink: 0;
        }

        .board-nama {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--ink);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .board-sub {
            font-size: 0.72rem;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .board-action-trigger {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 0;
            background: transparent;
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .board-action-trigger:hover {
            background: var(--panel);
            color: var(--ink);
        }

        .board-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 10px;
        }

        .board-tanggal-text,
        .board-waktu-text,
        .board-deadline-text {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 0.7rem;
            background: var(--panel);
            color: var(--ink-2);
            white-space: nowrap;
        }

        .board-tanggal-text i,
        .board-waktu-text i {
            font-size: 0.75rem;
            color: var(--muted);
        }

        /* Badge deadline pastel: hijau (aman), kuning (dekat), merah (lewat), biru (hari ini) */
        .board-dl--green { background: var(--pill-green); color: var(--ink); }
        .board-dl--yellow { background: var(--yellow); color: var(--ink); }
        .board-dl--red { background: var(--danger-soft); color: #A8282D; }
        .board-dl--sky { background: var(--sky); color: var(--ink); }

        /* Catatan kuning di bawah kartu (label custom) */
        .board-label {
            margin-top: 10px;
            font-size: 0.75rem;
            padding: 7px 10px;
            border-radius: 10px;
            background: var(--yellow);
            color: var(--ink);
            line-height: 1.35;
        }

        .board-label.board-tag--muted {
            background: transparent;
            color: var(--muted);
            padding: 0;
            font-size: 0.72rem;
        }

        .board-add {
            margin-top: 8px;
            width: 100%;
            border: 0;
            background: transparent;
            color: var(--ink-2);
            font-size: 0.8rem;
            padding: 8px;
            border-radius: 12px;
        }

        .board-add:hover {
            background: rgba(255, 255, 255, 0.7);
            color: var(--ink);
        }

        /* ===== Aksi dalam modal ===== */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
        }

        .action-box {
            border: 0;
            border-radius: 22px;
            height: 92px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            color: var(--ink);
            transition: all 0.2s ease;
        }

        .action-box i {
            font-size: 1.25rem;
        }

        .action-box span {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .action-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(17, 17, 17, 0.1);
        }

        .action-box--sky { background: var(--sky); }
        .action-box--yellow { background: var(--yellow); }
        .action-box--lav { background: var(--lav); }
        .action-box--red { background: var(--danger-soft); color: #A8282D; }

        @media (max-width: 992px) {
            .kb-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .kb-stat:nth-child(2) {
                border-right: 0;
            }

            .kb-stat:nth-child(-n+2) {
                border-bottom: 1px solid var(--line);
            }
        }
    </style>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
        const boardCards = document.querySelectorAll('.board-card');
        const dropzones = document.querySelectorAll('.board-dropzone');
        let draggedCard = null;

        function updateBoardCounts() {
            document.querySelectorAll('.board-count').forEach(counter => {
                const status = counter.getAttribute('data-count-for');
                const count = document.querySelectorAll(`.board-dropzone[data-status="${status}"] .board-card`).length;
                counter.textContent = count;
            });
        }

        function sortDropzoneBySchedule(dropzone) {
            const status = dropzone.getAttribute('data-status');
            const cards = Array.from(dropzone.querySelectorAll('.board-card'));
            cards.sort((a, b) => {
                const dateA = `${a.getAttribute('data-tanggal')} ${a.getAttribute('data-waktu')}`;
                const dateB = `${b.getAttribute('data-tanggal')} ${b.getAttribute('data-waktu')}`;
                if (status === 'pembayaran' || status === 'sudah') {
                    return new Date(dateB) - new Date(dateA);
                }
                return new Date(dateA) - new Date(dateB);
            });

            cards.forEach(card => dropzone.appendChild(card));
        }

        async function updateBoardData(id, payload) {
            const response = await fetch(`/dashboard/costomer/${id}/board`, {
                method: 'PUT',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                throw new Error('Gagal update board');
            }

            return response.json();
        }

        boardCards.forEach(card => {
            card.addEventListener('dragstart', function(e) {
                draggedCard = this;
                this.classList.add('dragging');
                if (e.dataTransfer) {
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', this.getAttribute('data-id'));
                }
            });

            card.addEventListener('dragend', function() {
                this.classList.remove('dragging');
                draggedCard = null;
            });
        });

        dropzones.forEach(zone => {
            zone.addEventListener('dragover', function(e) {
                e.preventDefault();
                if (e.dataTransfer) {
                    e.dataTransfer.dropEffect = 'move';
                }
                this.classList.add('drag-over');
            });

            zone.addEventListener('dragleave', function() {
                this.classList.remove('drag-over');
            });

            zone.addEventListener('drop', async function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');

                const transferredId = e.dataTransfer ? e.dataTransfer.getData('text/plain') : '';
                const card = draggedCard || Array.from(boardCards).find(
                    item => item.getAttribute('data-id') === transferredId
                );

                if (!card) return;

                const targetStatus = this.getAttribute('data-status');
                const id = card.getAttribute('data-id');
                const currentStatus = card.getAttribute('data-status');
                if (targetStatus === currentStatus) return;

                this.appendChild(card);
                card.setAttribute('data-status', targetStatus);
                sortDropzoneBySchedule(this);
                updateBoardCounts();

                try {
                    await updateBoardData(id, { selesaikan: targetStatus });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Gagal',
                        text: 'Status tidak berhasil dipindah. Coba lagi.'
                    });
                    location.reload();
                }
            });
        });

        document.querySelectorAll('.board-dropzone').forEach(zone => {
            sortDropzoneBySchedule(zone);
        });

        async function openEditLabelForCard(card) {
            const id = card.getAttribute('data-id');
            const status = card.getAttribute('data-status');
            const oldLabel = card.querySelector('.board-label')?.textContent === 'Tanpa label' ? '' : card.querySelector('.board-label')?.textContent || '';

            const { value: labelValue } = await Swal.fire({
                title: 'Ubah Label Custom',
                input: 'text',
                inputValue: oldLabel,
                inputPlaceholder: 'Contoh: urgent, revisi',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            });

            if (labelValue === undefined) return;

            try {
                await updateBoardData(id, {
                    selesaikan: status,
                    label_custom: labelValue
                });
                const labelEl = card.querySelector('.board-label');
                if (labelValue) {
                    labelEl.className = 'board-label board-tag';
                    labelEl.textContent = labelValue;
                } else {
                    labelEl.className = 'board-label board-tag board-tag--muted';
                    labelEl.textContent = 'Tanpa label';
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Label tidak berhasil diupdate.'
                });
            }
        }

        const addNotaModal = new bootstrap.Modal(document.getElementById('addNotaModal'));
        const cardActionModal = new bootstrap.Modal(document.getElementById('cardActionModal'));
        const cardActionInfo = document.getElementById('cardActionInfo');
        const actionPrintNotaBtn = document.getElementById('actionPrintNotaBtn');
        const actionEditLabelBtn = document.getElementById('actionEditLabelBtn');
        const actionEditJadwalBtn = document.getElementById('actionEditJadwalBtn');
        const actionDeleteBtn = document.getElementById('actionDeleteBtn');
        const deleteCustomerForm = document.getElementById('deleteCustomerForm');
        let selectedCard = null;

        function openAddNotaForCard(card) {
            const id = card.getAttribute('data-id');
            const nama = card.getAttribute('data-nama');
            document.getElementById('addNotaCustomerInfo').textContent = `Customer: ${nama} (#${id})`;
            document.getElementById('addNotaForm').action = `{{ url('dashboard/jadwal') }}/${id}/nota`;
            addNotaModal.show();
        }

        async function openEditScheduleForCard(card) {
            const id = card.getAttribute('data-id');
            const status = card.getAttribute('data-status');
            const nama = card.getAttribute('data-nama');
            const tanggal = card.getAttribute('data-tanggal');
            const waktu = card.getAttribute('data-waktu');

            const { value: formValues } = await Swal.fire({
                title: 'Edit Nama / Hari / Jam',
                html: `
                    <input id="swalNama" class="swal2-input" placeholder="Nama" value="${nama || ''}">
                    <input id="swalTanggal" type="date" class="swal2-input" value="${tanggal || ''}">
                    <input id="swalWaktu" type="time" class="swal2-input" value="${waktu || ''}">
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const namaValue = document.getElementById('swalNama').value.trim();
                    const tanggalValue = document.getElementById('swalTanggal').value;
                    const waktuValue = document.getElementById('swalWaktu').value;

                    if (!namaValue || !tanggalValue || !waktuValue) {
                        Swal.showValidationMessage('Nama, tanggal, dan jam wajib diisi');
                        return false;
                    }

                    return {
                        nama_costomer: namaValue,
                        tanggal_costomer: tanggalValue,
                        waktu_costomer: waktuValue
                    };
                }
            });

            if (!formValues) return;

            try {
                await updateBoardData(id, {
                    selesaikan: status,
                    ...formValues
                });
                card.setAttribute('data-nama', formValues.nama_costomer);
                card.setAttribute('data-tanggal', formValues.tanggal_costomer);
                card.setAttribute('data-waktu', formValues.waktu_costomer);
                location.reload();
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Nama, tanggal, atau jam tidak berhasil diupdate.'
                });
            }
        }

        function openActionModalFromButton(button) {
            selectedCard = button.closest('.board-card');
            if (!selectedCard) return;
            const id = selectedCard.getAttribute('data-id');
            const nama = selectedCard.getAttribute('data-nama');
            cardActionInfo.textContent = `#${id} - ${nama}`;
            cardActionModal.show();
        }

        document.querySelectorAll('.board-action-trigger').forEach(button => {
            button.addEventListener('mousedown', function(e) {
                e.stopPropagation();
            });
            button.addEventListener('touchstart', function(e) {
                e.stopPropagation();
            });
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openActionModalFromButton(this);
            });
        });

        actionPrintNotaBtn.addEventListener('click', function() {
            if (!selectedCard) return;
            const notaUrl = selectedCard.getAttribute('data-nota-url');
            window.location.href = notaUrl;
        });

        actionEditLabelBtn.addEventListener('click', function() {
            if (!selectedCard) return;
            cardActionModal.hide();
            openEditLabelForCard(selectedCard);
        });

        actionEditJadwalBtn.addEventListener('click', function() {
            if (!selectedCard) return;
            cardActionModal.hide();
            openEditScheduleForCard(selectedCard);
        });

        actionDeleteBtn.addEventListener('click', function() {
            if (!selectedCard) return;
            const id = selectedCard.getAttribute('data-id');
            deleteCustomerForm.action = `{{ url('hapus') }}/${id}`;
            Swal.fire({
                title: "Yakin Hapus?",
                text: "Data customer akan dihapus permanen.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteCustomerForm.submit();
                }
            });
        });

        // Filter pill dan pencarian di papan (sisi klien, tanpa mengubah data)
        const boardSearch = document.getElementById('boardSearch');
        const boardShowing = document.getElementById('boardShowing');
        const filterChips = document.querySelectorAll('[data-board-filter]');
        let activeBoardFilter = 'all';

        function applyBoardFilter() {
            const q = (boardSearch.value || '').trim().toLowerCase();
            let shown = 0;
            boardCards.forEach(card => {
                const flags = (card.getAttribute('data-flags') || '').split(' ');
                const okFilter = activeBoardFilter === 'all' || flags.includes(activeBoardFilter);
                const okSearch = !q
                    || (card.getAttribute('data-nama') || '').toLowerCase().includes(q)
                    || ('#' + card.getAttribute('data-id')).includes(q);
                const visible = okFilter && okSearch;
                card.style.display = visible ? '' : 'none';
                if (visible) shown++;
            });
            boardShowing.textContent = `Menampilkan ${shown} dari ${boardCards.length} customer`;
        }

        filterChips.forEach(chip => {
            chip.addEventListener('click', function() {
                activeBoardFilter = this.getAttribute('data-board-filter');
                filterChips.forEach(c => c.classList.toggle('is-active', c === this));
                applyBoardFilter();
            });
        });
        boardSearch.addEventListener('input', applyBoardFilter);
        applyBoardFilter();

        updateBoardCounts();
        });
    </script>
@endsection
