@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <!-- Header & Add Button -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-primary"><i class="bi bi-people-fill me-2"></i>Data Customer</h4>
                <small class="text-muted">Kelola data pelanggan, status, dan pembayaran</small>
            </div>
            <div>
                <button class="btn btn-premium px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-person-plus-fill"></i> Tambah Customer
                </button>
            </div>
        </div>

        <!-- Custom Search Bar & Bulk Actions -->
        <div class="row mb-4 g-3 align-items-center">
            <div class="col-md">
                <div class="position-relative">
                    <input type="text" id="customSearch" class="form-control border-0 bg-white py-3 ps-5 shadow-sm rounded-4"
                        placeholder="Ketik untuk mencari (Nama, ID, Metode, Tahun)..."
                        style="border: 1px solid rgba(72, 52, 212, 0.1) !important;">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5"></i>
                </div>
            </div>
            <div class="col-md-auto" id="bulkActionContainer" style="display: none;">
                <div class="glass-card p-2 bg-white d-flex align-items-center gap-3 shadow-sm" style="border-radius: 15px;">
                    <span class="small fw-bold text-primary ps-2"><span id="selectedCount">0</span> Terpilih</span>
                    <form action="{{ route('costomer.bulkUpdate') }}" method="POST" id="bulkUpdateForm" class="d-flex gap-2 align-items-center">
                        @csrf
                        <div id="selectedIdsContainer"></div>
                        <select name="status" class="form-select form-select-sm border-0 bg-light rounded-pill fw-bold" style="min-width: 120px;" required>
                            <option value="">Update Status...</option>
                            <option value="sudah">✅ Selesai</option>
                            <option value="pembayaran">💰 Bayar</option>
                            <option value="proses">⏳ Proses</option>
                            <option value="belum">⛔ Belum</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('pesan_berhasil'))
            <script>
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Berhasil!",
                    text: "{{ session('pesan_berhasil') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#fff',
                    color: '#2d3436'
                });
            </script>
        @endif
        @if (session('pesan_gagal'))
            <script>
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Gagal!",
                    text: "{{ session('pesan_gagal') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        @php
            $statusBoards = [
                'belum' => ['title' => '⛔ Belum', 'class' => 'secondary'],
                'proses' => ['title' => '⏳ Proses', 'class' => 'primary'],
                'pembayaran' => ['title' => '💰 Bayar', 'class' => 'danger'],
                'sudah' => ['title' => '✅ Selesai', 'class' => 'success'],
            ];
        @endphp

        <div class="mb-4">
            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-kanban-fill me-2"></i>Board Pengerjaan</h5>
            <div class="row g-3" id="trelloBoard">
                @foreach ($statusBoards as $statusKey => $statusInfo)
                    <div class="col-lg-3 col-md-6">
                        <div class="board-column h-100" data-status="{{ $statusKey }}">
                            <div
                                class="board-header bg-{{ $statusInfo['class'] }} bg-opacity-10 text-{{ $statusInfo['class'] }}">
                                <span>{{ $statusInfo['title'] }}</span>
                                <span class="badge rounded-pill bg-light text-dark board-count"
                                    data-count-for="{{ $statusKey }}">0</span>
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
                                                class="badge rounded-pill bg-warning bg-opacity-25 text-dark border border-warning">{{ $value['label_custom'] }}</span>
                                        @else
                                            <span class="badge rounded-pill bg-light text-muted border">Tanpa label</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Glass Table -->
        <div class="table-responsive rounded-4 shadow-sm bg-white border-0">
            <table class="table table-borderless align-middle mb-0" id="glassTable">
                <thead class="bg-light border-bottom">
                    <tr class="text-secondary text-uppercase fs-7 fw-bold">
                        <th class="ps-4 py-3" style="width: 50px;">
                            <div class="form-check">
                                <input class="form-check-input select-all-checkbox" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th class="py-3">No</th>
                        <th class="py-3">Info Customer</th>
                        <th class="py-3">Waktu</th>
                        <th class="py-3">Metode</th>
                        <th class="py-3">Total</th>
                        <th class="py-3">Status Pengerjaan</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark fw-medium">
                    @foreach ($costomer as $key => $value)
                                <tr class="searchable-row border-bottom h-hover transition-all">
                                    <td class="ps-4">
                                        <div class="form-check">
                                            <input class="form-check-input customer-checkbox" type="checkbox" value="{{ $value['id_costomer'] }}">
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3" style="background: {{ 
                                                                                            $value['selesaikan'] == 'sudah' ? 'linear-gradient(135deg, #198754, #20c997)' :
                        ($value['selesaikan'] == 'pembayaran' ? 'linear-gradient(135deg, #dc3545, #ff6b6b)' :
                            ($value['selesaikan'] == 'proses' ? 'linear-gradient(135deg, #0d6efd, #0dcaf0)' :
                                'linear-gradient(135deg, #6c757d, #adb5bd)')) 
                                                                                         }};">
                                                {{ substr($value['nama'], 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $value['nama'] }}</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">ID:
                                                    #{{ $value['id_costomer'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark small"><i
                                                    class="bi bi-calendar-event me-1"></i>{{ $value['tanggal'] }}</span>
                                            <span class="text-muted small"><i class="bi bi-clock me-1"></i>{{ $value['waktu'] }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3">
                                            {{ $value['nama_metode'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $final_total = $value['total'] - (($value['diskon'] ?? 0) / 100 * $value['total']);
                                        @endphp
                                        <span class="fw-bold text-success">Rp {{ number_format($final_total) }}</span>
                                        @if(($value['diskon'] ?? 0) > 0)
                                            <div class="small text-muted" style="font-size: 0.65rem;">Disc. {{ $value['diskon'] }}%</div>
                                        @endif
                                    </td>
                                    <td style="min-width: 200px;">
                                        <form action="{{ url('selesaikan/' . $value['id_costomer']) }}" method="post"
                                            class="status-form">
                                            @method('put')
                                            @csrf
                                            <div class="d-flex gap-2">
                                                <input type="hidden" name="metode" value="{{ $value['id_metode'] }}">
                                                <select name="selesaikan"
                                                    class="form-select form-select-sm border-0 shadow-sm rounded-pill fw-bold cursor-pointer status-select
                                                                                                                                        @if($value['selesaikan'] == 'sudah') bg-success bg-opacity-10 text-success
                                                                                                                                        @elseif($value['selesaikan'] == 'pembayaran') bg-danger bg-opacity-10 text-danger
                                                                                                                                        @elseif($value['selesaikan'] == 'proses') bg-primary bg-opacity-10 text-primary
                                                                                                                                        @else bg-secondary bg-opacity-10 text-secondary
                                                                                                                                        @endif"
                                                    onchange="this.form.submit()">
                                                    <option value="sudah" @selected($value['selesaikan'] == 'sudah')>✅ Selesai</option>
                                                    <option value="pembayaran" @selected($value['selesaikan'] == 'pembayaran')>💰 Bayar
                                                    </option>
                                                    <option value="proses" @selected($value['selesaikan'] == 'proses')>⏳ Proses</option>
                                                    <option value="belum" @selected($value['selesaikan'] == 'belum')>⛔ Belum</option>
                                                </select>

                                                <!-- Metode Dropdown (Optional) -->
                                                <!-- Keep it hidden or minimal if you want the Edit Modal to handle major changes -->
                                            </div>
                                        </form>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Print Button -->
                                            <a href="{{ url('costomer/' . $value['id_costomer'] . '/nota') }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                style="width: 38px; height: 38px;" title="Cetak Nota">
                                                <i class="bi bi-printer-fill fs-6"></i>
                                            </a>

                                            <!-- Edit Button (Triggers Modal) -->
                                            <button type="button"
                                                class="btn btn-sm btn-outline-info rounded-circle shadow-sm d-flex align-items-center justify-content-center edit-btn"
                                                style="width: 38px; height: 38px;" title="Edit Data Lengkap"
                                                data-id="{{ $value['id_costomer'] }}" data-nama="{{ $value['nama'] }}"
                                                data-tanggal="{{ $value['tanggal'] }}" data-waktu="{{ $value['waktu'] }}"
                                                data-metode="{{ $value['id_metode'] }}" data-selesaikan="{{ $value['selesaikan'] }}"
                                                data-label-custom="{{ $value['label_custom'] ?? '' }}"
                                                data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="bi bi-pencil-fill fs-6"></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <form method="post" action="{{ url('hapus/' . $value['id_costomer']) }}"
                                                class="d-inline deleteForm">
                                                @method('delete')
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center deleteButton"
                                                    style="width: 38px; height: 38px;" title="Hapus Customer">
                                                    <i class="bi bi-trash-fill fs-6"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div id="noResults" class="text-center py-5 d-none">
            <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                <i class="bi bi-search fs-1 text-muted opacity-50"></i>
            </div>
            <h5 class="text-muted">Tidak ditemukan data</h5>
            <small class="text-muted opacity-75">Coba kata kunci lain</small>
        </div>
    </div>

    <!-- Modals moved completely outside the Glass Card -->

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="background-color: #fff;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Customer Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="{{ url('dashboard/costomer/tambah/data') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Customer</label>
                            <input type="text" name="nama_costomer" class="form-control rounded-3 py-2 bg-light border-0"
                                placeholder="Masukkan nama..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Metode Pembayaran</label>
                            <select name="metode" class="form-select rounded-3 py-2 bg-light border-0" required>
                                @foreach($metode as $m)
                                    <option value="{{ $m['id_metode'] }}">{{ $m['nama_metode'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Label Custom</label>
                            <input type="text" name="label_custom" class="form-control rounded-3 py-2 bg-light border-0"
                                placeholder="Contoh: Prioritas Tinggi">
                        </div>
                        <div class="alert alert-info d-flex align-items-center small py-2">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <div>Waktu & Tanggal akan terisi otomatis saat ini.</div>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 rounded-pill py-2 fw-bold">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="background-color: #fff;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Edit Data Lengkap</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Customer</label>
                            <input type="text" id="editNama" name="nama_costomer"
                                class="form-control rounded-3 py-2 bg-light border-0" required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Tanggal</label>
                                <input type="date" id="editTanggal" name="tanggal_costomer"
                                    class="form-control rounded-3 py-2 bg-light border-0" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Waktu</label>
                                <input type="time" id="editWaktu" name="waktu_costomer"
                                    class="form-control rounded-3 py-2 bg-light border-0" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Metode</label>
                                <select name="metode" id="editMetode" class="form-select rounded-3 py-2 bg-light border-0"
                                    required>
                                    @foreach($metode as $m)
                                        <option value="{{ $m['id_metode'] }}">{{ $m['nama_metode'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                                <select name="selesaikan" id="editStatus"
                                    class="form-select rounded-3 py-2 bg-light border-0" required>
                                    <option value="sudah">✅ Selesai</option>
                                    <option value="pembayaran">💰 Bayar</option>
                                    <option value="proses">⏳ Proses</option>
                                    <option value="belum">⛔ Belum</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Label Custom</label>
                            <input type="text" id="editLabelCustom" name="label_custom"
                                class="form-control rounded-3 py-2 bg-light border-0"
                                placeholder="Contoh: revisi desain">
                        </div>

                        <button type="submit"
                            class="btn btn-primary w-100 rounded-pill py-2 fw-bold bg-gradient border-0">Update
                            Lengkap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for this Page */
        .fs-7 {
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(72, 52, 212, 0.2);
        }

        .h-hover:hover {
            background-color: rgba(72, 52, 212, 0.02) !important;
            transform: translateY(-1px);
        }

        .transition-all {
            transition: all 0.2s ease;
        }

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

        .cursor-pointer {
            cursor: pointer;
        }

        .board-column {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(72, 52, 212, 0.08);
            min-height: 320px;
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
            min-height: 260px;
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

        /* Search Input Focus */
        #customSearch:focus {
            box-shadow: 0 0 0 4px rgba(72, 52, 212, 0.1);
            border-color: var(--primary-accent) !important;
        }

        /* Modal Fix */
        .modal-backdrop {
            z-index: 1040;
        }

        .modal {
            z-index: 1050;
        }
    </style>

    <script>
        // Real-time Search Function
        document.getElementById('customSearch').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let tableRows = document.querySelectorAll('.searchable-row');
            let hasResults = false;

            tableRows.forEach(row => {
                let rowText = row.innerText.toLowerCase();
                if (rowText.includes(searchValue)) {
                    row.style.display = '';
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                }
            });

            const noResults = document.getElementById('noResults');
            const glassTable = document.getElementById('glassTable');

            if (!hasResults) {
                noResults.classList.remove('d-none');
                glassTable.classList.add('d-none');
            } else {
                noResults.classList.add('d-none');
                glassTable.classList.remove('d-none');
            }
        });

        // Populate Edit Modal
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');
                let nama = this.getAttribute('data-nama');
                let tanggal = this.getAttribute('data-tanggal');
                let waktu = this.getAttribute('data-waktu');
                let metode = this.getAttribute('data-metode');
                let status = this.getAttribute('data-selesaikan');
                let labelCustom = this.getAttribute('data-label-custom');

                document.getElementById('editNama').value = nama;
                document.getElementById('editTanggal').value = tanggal;
                document.getElementById('editWaktu').value = waktu;

                // Select values for dropdowns
                document.getElementById('editMetode').value = metode;
                document.getElementById('editStatus').value = status;
                document.getElementById('editLabelCustom').value = labelCustom ?? '';
                // Note: If values don't match exactly, default will show. Ensure Controller returns standard values.

                // Update Form Action
                document.getElementById('editForm').action = "{{ url('update/data') }}/" + id;
            });
        });

        // Bulk Selection Logic
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.customer-checkbox');
        const bulkActionContainer = document.getElementById('bulkActionContainer');
        const selectedCountLabel = document.getElementById('selectedCount');
        const selectedIdsContainer = document.getElementById('selectedIdsContainer');

        function updateBulkUI() {
            const checkedCheckboxes = document.querySelectorAll('.customer-checkbox:checked');
            const count = checkedCheckboxes.length;
            
            selectedCountLabel.innerText = count;
            
            if (count > 0) {
                bulkActionContainer.style.display = 'block';
                // Clear and repopulate hidden inputs for the form
                selectedIdsContainer.innerHTML = '';
                checkedCheckboxes.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = cb.value;
                    selectedIdsContainer.appendChild(input);
                });
            } else {
                bulkActionContainer.style.display = 'none';
            }
        }

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            updateBulkUI();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const total = checkboxes.length;
                const checked = document.querySelectorAll('.customer-checkbox:checked').length;
                
                selectAll.checked = total === checked;
                selectAll.indeterminate = checked > 0 && checked < total;
                
                updateBulkUI();
            });
        });

        // Trello-like drag and drop
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

        // Custom label update from board card
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
                    const labelEl = parentCard.querySelector('.badge');
                    if (labelValue) {
                        labelEl.className = 'badge rounded-pill bg-warning bg-opacity-25 text-dark border border-warning';
                        labelEl.textContent = labelValue;
                    } else {
                        labelEl.className = 'badge rounded-pill bg-light text-muted border';
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