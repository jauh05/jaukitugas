@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-primary"><i class="bi bi-kanban-fill me-2"></i>Jadwal Pengerjaan</h4>
                <small class="text-muted">Drag & drop status customer seperti Trello</small>
            </div>
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
                <div class="col-lg-3 col-md-6">
                    <div class="board-column h-100" data-status="{{ $statusKey }}">
                        <div class="board-header bg-{{ $statusInfo['class'] }} bg-opacity-10 text-{{ $statusInfo['class'] }}">
                            <span>{{ $statusInfo['title'] }}</span>
                            <span class="badge rounded-pill bg-light text-dark board-count" data-count-for="{{ $statusKey }}">0</span>
                        </div>
                        <div class="board-dropzone" data-status="{{ $statusKey }}">
                            @foreach ($costomer->where('selesaikan', $statusKey) as $value)
                                @php
                                    $tanggalWaktu = \Carbon\Carbon::parse($value['tanggal'] . ' ' . $value['waktu']);
                                @endphp
                                <div class="board-card" draggable="true" data-id="{{ $value['id_costomer'] }}"
                                    data-status="{{ $value['selesaikan'] }}">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $value['nama'] }}</div>
                                            <small class="text-muted">#{{ $value['id_costomer'] }}</small>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light border rounded-pill px-2 py-0 edit-label-btn"
                                            data-id="{{ $value['id_costomer'] }}"
                                            data-label="{{ $value['label_custom'] ?? '' }}">
                                            <i class="bi bi-tag-fill text-warning"></i>
                                        </button>
                                    </div>
                                    <div class="small text-muted mb-1">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $tanggalWaktu->translatedFormat('l, d M Y') }}
                                    </div>
                                    <div class="small text-muted mb-2">
                                        <i class="bi bi-clock me-1"></i>{{ $tanggalWaktu->format('H:i') }}
                                    </div>
                                    <div class="small text-dark mb-2">
                                        <i class="bi bi-credit-card me-1"></i>{{ $value['nama_metode'] }}
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

    <style>
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

        document.querySelectorAll('.edit-label-btn').forEach(button => {
            button.addEventListener('click', async function() {
                const id = this.getAttribute('data-id');
                const oldLabel = this.getAttribute('data-label') || '';
                const parentCard = this.closest('.board-card');
                const status = parentCard.getAttribute('data-status');

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
                    this.setAttribute('data-label', labelValue);
                    const labelEl = parentCard.querySelector('.board-label');
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
            });
        });

        updateBoardCounts();
    </script>
@endsection
