@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-primary"><i class="bi bi-kanban-fill me-2"></i>Jadwal Pengerjaan</h4>
                <small class="text-muted">Drag & drop status customer seperti Trello</small>
            </div>
            <button class="btn btn-premium px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#addJadwalModal">
                <i class="bi bi-plus-circle-fill"></i> Tambah Jadwal
            </button>
        </div>

        @php
            $statusBoards = [
                'belum' => ['title' => '⛔ Belum', 'class' => 'secondary'],
                'proses' => ['title' => '⏳ Proses', 'class' => 'primary'],
                'pembayaran' => ['title' => '💰 Bayar', 'class' => 'danger'],
                'sudah' => ['title' => '✅ Selesai', 'class' => 'success'],
            ];
        @endphp

        <div class="row g-3" id="trelloBoard">
            @foreach ($statusBoards as $statusKey => $statusInfo)
                @php
                    $boardItems = $costomer->where('selesaikan', $statusKey);
                    if ($statusKey === 'belum') {
                        $boardItems = $boardItems->sortBy(function ($item) {
                            return $item['tanggal'] . ' ' . $item['waktu'];
                        });
                    }
                @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="board-column h-100" data-status="{{ $statusKey }}">
                        <div class="board-header bg-{{ $statusInfo['class'] }} bg-opacity-10 text-{{ $statusInfo['class'] }}">
                            <span>{{ $statusInfo['title'] }}</span>
                            <span class="badge rounded-pill bg-light text-dark board-count"
                                data-count-for="{{ $statusKey }}">{{ $boardItems->count() }}</span>
                        </div>
                        <div class="board-dropzone" data-status="{{ $statusKey }}">
                            @foreach ($boardItems as $value)
                                @php
                                    $tanggalWaktu = \Carbon\Carbon::parse($value['tanggal'] . ' ' . $value['waktu']);
                                    $sisaHari = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($value['tanggal']), false);
                                @endphp
                                <div class="board-card" draggable="true" data-id="{{ $value['id_costomer'] }}"
                                    data-status="{{ $value['selesaikan'] }}" data-nama="{{ $value['nama'] }}"
                                    data-tanggal="{{ $value['tanggal'] }}" data-waktu="{{ $value['waktu'] }}"
                                    data-nota-url="{{ url('costomer/' . $value['id_costomer'] . '/nota') }}">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <div class="fw-bold text-dark board-nama" title="{{ $value['nama'] }}">
                                                {{ $value['nama'] }}
                                            </div>
                                            <small class="text-muted">#{{ $value['id_costomer'] }}</small>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <button type="button"
                                                class="btn btn-sm btn-light border rounded-pill px-2 py-0 board-action-trigger"
                                                title="Aksi" draggable="false">
                                                <i class="bi bi-three-dots text-secondary"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="small text-muted mb-1 board-tanggal-text">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $tanggalWaktu->translatedFormat('l, d M Y') }}
                                    </div>
                                    <div class="small text-muted mb-2 board-waktu-text">
                                        <i class="bi bi-clock me-1"></i>{{ $tanggalWaktu->format('H:i') }}
                                    </div>
                                    <div class="small text-dark mb-2">
                                        <i class="bi bi-credit-card me-1"></i>{{ $value['nama_metode'] }}
                                    </div>
                                    <div class="mb-2">
                                        @if ($statusKey === 'sudah')
                                            @if ($sisaHari < 0)
                                                <span class="badge rounded-pill text-bg-success board-deadline-text">✅ Sudah clear {{ abs($sisaHari) }} hari lalu</span>
                                            @elseif ($sisaHari === 0)
                                                <span class="badge rounded-pill text-bg-success board-deadline-text">✅ Sudah clear hari ini</span>
                                            @else
                                                <span class="badge rounded-pill text-bg-success board-deadline-text">✅ Sudah clear lebih awal {{ $sisaHari }} hari</span>
                                            @endif
                                        @elseif ($statusKey === 'pembayaran')
                                            @if ($sisaHari < 0)
                                                <span class="badge rounded-pill text-bg-danger board-deadline-text">💸 Utang {{ abs($sisaHari) }} hari lalu</span>
                                            @elseif ($sisaHari === 0)
                                                <span class="badge rounded-pill text-bg-danger board-deadline-text">💸 Utang hari ini</span>
                                            @else
                                                <span class="badge rounded-pill text-bg-warning board-deadline-text">💸 Jatuh tempo {{ $sisaHari }} hari lagi</span>
                                            @endif
                                        @elseif ($sisaHari === 0)
                                            <span class="badge rounded-pill text-bg-primary board-deadline-text">🔥 Kerjakan hari ini</span>
                                        @elseif ($sisaHari > 0)
                                            <span class="badge rounded-pill text-bg-warning board-deadline-text">⏰ {{ $sisaHari }} hari lagi</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger board-deadline-text">⚠️ Lewat {{ abs($sisaHari) }} hari</span>
                                        @endif
                                    </div>
                                    @if (!empty($value['label_custom']))
                                        <span
                                            class="badge rounded-pill bg-warning bg-opacity-25 text-dark border border-warning board-label">{{ $value['label_custom'] }}</span>
                                    @else
                                        <span class="badge rounded-pill bg-light text-muted border board-label">Tanpa label</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="addJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="background-color: #fff;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Jadwal Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="{{ url('dashboard/costomer/tambah/data') }}" method="POST">
                        @csrf
                        <input type="hidden" name="redirect_to" value="jadwal">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Customer</label>
                            <input type="text" name="nama_costomer" class="form-control rounded-3 py-2 bg-light border-0"
                                placeholder="Masukkan nama..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Metode Pembayaran</label>
                            <select name="metode" class="form-select rounded-3 py-2 bg-light border-0" required>
                                @foreach ($metode as $m)
                                    <option value="{{ $m['id_metode'] }}">{{ $m['nama_metode'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-7 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Tanggal Target</label>
                                <input type="date" name="tanggal_costomer"
                                    class="form-control rounded-3 py-2 bg-light border-0" required>
                            </div>
                            <div class="col-5 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Jam</label>
                                <input type="time" name="waktu_costomer"
                                    class="form-control rounded-3 py-2 bg-light border-0" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Label Custom</label>
                            <input type="text" name="label_custom" class="form-control rounded-3 py-2 bg-light border-0"
                                placeholder="Contoh: desain urgent">
                        </div>

                        <button type="submit" class="btn btn-premium w-100 rounded-pill py-2 fw-bold">Simpan Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNotaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Nota dari Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <form id="addNotaForm" method="POST">
                        @csrf
                        <div class="alert alert-info small" id="addNotaCustomerInfo"></div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control rounded-3 py-2 bg-light border-0"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Jumlah</label>
                                <input type="number" min="1" name="jumlah"
                                    class="form-control rounded-3 py-2 bg-light border-0" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Harga</label>
                                <input type="number" min="0" name="harga"
                                    class="form-control rounded-3 py-2 bg-light border-0" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 rounded-pill py-2 fw-bold">Simpan Nota</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cardActionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Aksi Customer Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="mb-3 small text-muted" id="cardActionInfo"></div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary rounded-pill" id="actionEditJadwalBtn">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                        </button>
                        <button type="button" class="btn btn-outline-warning rounded-pill" id="actionEditLabelBtn">
                            <i class="bi bi-tag-fill me-2"></i>Label
                        </button>
                        <button type="button" class="btn btn-outline-danger rounded-pill" id="actionDeleteBtn">
                            <i class="bi bi-trash-fill me-2"></i>Hapus
                        </button>
                        <button type="button" class="btn btn-outline-success rounded-pill" id="actionPrintNotaBtn">
                            <i class="bi bi-printer-fill me-2"></i>Nota
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
        .btn-premium {
            background: linear-gradient(135deg, #4834d4, #686de0);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            box-shadow: 0 8px 20px rgba(72, 52, 212, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        .board-column {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(72, 52, 212, 0.08);
            min-height: 420px;
            display: flex;
            flex-direction: column;
        }

        .board-header {
            padding: 0.75rem 1rem;
            border-radius: 16px 16px 0 0;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .board-dropzone {
            padding: 0.75rem;
            min-height: 340px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .board-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(72, 52, 212, 0.08);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            padding: 0.75rem;
            cursor: grab;
        }

        .board-nama {
            display: inline-block;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .board-card.dragging {
            opacity: 0.6;
            transform: rotate(1deg);
        }

        .board-dropzone.drag-over {
            background: rgba(72, 52, 212, 0.08);
            border-radius: 12px;
        }
    </style>

    <script>
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
            if (status !== 'belum' && status !== 'proses') return;

            const cards = Array.from(dropzone.querySelectorAll('.board-card'));
            cards.sort((a, b) => {
                const dateA = `${a.getAttribute('data-tanggal')} ${a.getAttribute('data-waktu')}`;
                const dateB = `${b.getAttribute('data-tanggal')} ${b.getAttribute('data-waktu')}`;
                return new Date(dateA) - new Date(dateB);
            });

            cards.forEach(card => dropzone.appendChild(card));
        }

        async function updateBoardData(id, payload) {
            const response = await fetch(`{{ url('dashboard/costomer') }}/${id}/board`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT',
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
            card.addEventListener('dragstart', function() {
                draggedCard = this;
                this.classList.add('dragging');
            });

            card.addEventListener('dragend', function() {
                this.classList.remove('dragging');
                draggedCard = null;
            });
        });

        dropzones.forEach(zone => {
            zone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('drag-over');
            });

            zone.addEventListener('dragleave', function() {
                this.classList.remove('drag-over');
            });

            zone.addEventListener('drop', async function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                if (!draggedCard) return;

                const targetStatus = this.getAttribute('data-status');
                const id = draggedCard.getAttribute('data-id');
                const currentStatus = draggedCard.getAttribute('data-status');
                if (targetStatus === currentStatus) return;

                this.appendChild(draggedCard);
                draggedCard.setAttribute('data-status', targetStatus);
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
                    labelEl.className = 'badge rounded-pill bg-warning bg-opacity-25 text-dark border border-warning board-label';
                    labelEl.textContent = labelValue;
                } else {
                    labelEl.className = 'badge rounded-pill bg-light text-muted border board-label';
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

        updateBoardCounts();
    </script>
@endsection
