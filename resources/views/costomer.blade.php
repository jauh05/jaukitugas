@extends('dashboard')
@section('tabel')
    @php
        // Warna pastel per status pengerjaan (palet DR+)
        $statusTone = [
            'sudah' => ['bg' => '#D6E2C3', 'avatar' => '#D6E2C3', 'label' => 'Selesai'],
            'pembayaran' => ['bg' => '#FCF1C8', 'avatar' => '#FCF1C8', 'label' => 'Bayar'],
            'proses' => ['bg' => '#D2EFFA', 'avatar' => '#D2EFFA', 'label' => 'Proses'],
            'belum' => ['bg' => '#EEF0F3', 'avatar' => '#EEF0F3', 'label' => 'Belum'],
        ];
    @endphp

    <!-- Header & Add Button -->
    <div class="card-head mb-4">
        <div class="d-flex align-items-center gap-3">
            <span class="bubble" style="background: var(--lav);"><i class="bi bi-people-fill"></i></span>
            <div>
                <h4 class="fw-semibold m-0" style="font-size: 1.35rem;">Data Customer</h4>
                <div class="card-sub">Kelola data pelanggan, status, dan pembayaran</div>
            </div>
        </div>
        <button class="btn btn-primary d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-person-plus"></i> Tambah Customer
        </button>
    </div>

    <!-- Search & Bulk Actions -->
    <div class="row mb-4 g-3 align-items-center">
        <div class="col-md">
            <div class="position-relative">
                <input type="text" id="customSearch" class="form-control py-3 ps-5"
                    placeholder="Ketik untuk mencari (Nama, ID, Metode, Tahun)...">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 fs-5" style="color: var(--muted);"></i>
            </div>
        </div>
        <div class="col-md-auto" id="bulkActionContainer" style="display: none;">
            <div class="d-flex align-items-center gap-3 flex-wrap rounded-pill px-3 py-2" style="background: var(--panel);">
                <span class="small fw-semibold ps-1"><span id="selectedCount">0</span> Terpilih</span>
                <form action="{{ route('costomer.bulkUpdate') }}" method="POST" id="bulkUpdateForm" class="d-flex gap-2 align-items-center">
                    @csrf
                    <div id="selectedIdsContainer"></div>
                    <select name="status" class="form-select form-select-sm rounded-pill" style="min-width: 150px;" required>
                        <option value="">Update Status...</option>
                        <option value="sudah">Selesai</option>
                        <option value="pembayaran">Bayar</option>
                        <option value="proses">Proses</option>
                        <option value="belum">Belum</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
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
                color: '#111111'
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

    <!-- Daftar customer -->
    <div class="table-responsive">
        <table class="table align-middle mb-0" id="glassTable">
            <thead>
                <tr>
                    <th class="ps-3" style="width: 50px;">
                        <div class="form-check">
                            <input class="form-check-input select-all-checkbox" type="checkbox" id="selectAll">
                        </div>
                    </th>
                    <th>No</th>
                    <th>Info Customer</th>
                    <th>Waktu</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Status Pengerjaan</th>
                    <th class="pe-3 text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($costomer as $key => $value)
                    @php
                        $tone = $statusTone[$value['selesaikan']] ?? $statusTone['belum'];
                        $final_total = $value['total'] - (($value['diskon'] ?? 0) / 100 * $value['total']);
                    @endphp
                    <tr class="searchable-row">
                        <td class="ps-3">
                            <div class="form-check">
                                <input class="form-check-input customer-checkbox" type="checkbox" value="{{ $value['id_costomer'] }}">
                            </div>
                        </td>
                        <td class="fw-semibold" style="color: var(--muted);">{{ $key + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <span class="avatar-circle" style="background: {{ $tone['avatar'] }};">
                                    {{ substr($value['nama'], 0, 1) }}
                                </span>
                                <div>
                                    <div class="fw-semibold">{{ $value['nama'] }}</div>
                                    <small style="color: var(--muted);">ID #{{ $value['id_costomer'] }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="small fw-medium"><i class="bi bi-calendar3 me-1" style="color: var(--muted);"></i>{{ $value['tanggal'] }}</span>
                                <span class="small" style="color: var(--muted);"><i class="bi bi-clock me-1"></i>{{ $value['waktu'] }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="chip chip--lav">{{ $value['nama_metode'] }}</span>
                        </td>
                        <td>
                            <span class="fw-semibold">Rp {{ number_format($final_total) }}</span>
                            @if(($value['diskon'] ?? 0) > 0)
                                <div class="small" style="color: var(--muted); font-size: 0.7rem;">Disc. {{ $value['diskon'] }}%</div>
                            @endif
                        </td>
                        <td style="min-width: 190px;">
                            <form action="{{ url('selesaikan/' . $value['id_costomer']) }}" method="post" class="status-form">
                                @method('put')
                                @csrf
                                <input type="hidden" name="metode" value="{{ $value['id_metode'] }}">
                                <select name="selesaikan" class="form-select form-select-sm rounded-pill border-0 cursor-pointer status-select"
                                    style="background: {{ $tone['bg'] }}; color: var(--ink); font-weight: 500;"
                                    onchange="this.form.submit()">
                                    <option value="sudah" @selected($value['selesaikan'] == 'sudah')>Selesai</option>
                                    <option value="pembayaran" @selected($value['selesaikan'] == 'pembayaran')>Bayar</option>
                                    <option value="proses" @selected($value['selesaikan'] == 'proses')>Proses</option>
                                    <option value="belum" @selected($value['selesaikan'] == 'belum')>Belum</option>
                                </select>
                            </form>
                        </td>
                        <td class="pe-3 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('costomer/' . $value['id_costomer'] . '/nota') }}"
                                    class="btn btn-light btn-icon" title="Cetak Nota">
                                    <i class="bi bi-printer"></i>
                                </a>

                                <button type="button" class="btn btn-light btn-icon edit-btn" title="Edit Data Lengkap"
                                    data-id="{{ $value['id_costomer'] }}" data-nama="{{ $value['nama'] }}"
                                    data-tanggal="{{ $value['tanggal'] }}" data-waktu="{{ $value['waktu'] }}"
                                    data-metode="{{ $value['id_metode'] }}" data-selesaikan="{{ $value['selesaikan'] }}"
                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form method="post" action="{{ url('hapus/' . $value['id_costomer']) }}" class="d-inline deleteForm">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn btn-outline-danger btn-icon deleteButton" title="Hapus Customer">
                                        <i class="bi bi-trash"></i>
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
        <span class="bubble bubble--soft mb-3" style="width: 64px; height: 64px;"><i class="bi bi-search fs-4" style="color: var(--muted);"></i></span>
        <h5 style="color: var(--ink-2);">Tidak ditemukan data</h5>
        <small style="color: var(--muted);">Coba kata kunci lain</small>
    </div>

    <!-- Modals -->

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Tambah Customer Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="{{ url('dashboard/costomer/tambah/data') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Customer</label>
                            <input type="text" name="nama_costomer" class="form-control" placeholder="Masukkan nama..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode" class="form-select" required>
                                @foreach($metode as $m)
                                    <option value="{{ $m['id_metode'] }}">{{ $m['nama_metode'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert d-flex align-items-center small py-2 rounded-4 border-0" style="background: var(--sky);">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>Waktu & Tanggal akan terisi otomatis saat ini.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Edit Data Lengkap</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Customer</label>
                            <input type="text" id="editNama" name="nama_costomer" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="editTanggal" name="tanggal_costomer" class="form-control" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Waktu</label>
                                <input type="time" id="editWaktu" name="waktu_costomer" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Metode</label>
                                <select name="metode" id="editMetode" class="form-select" required>
                                    @foreach($metode as $m)
                                        <option value="{{ $m['id_metode'] }}">{{ $m['nama_metode'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="selesaikan" id="editStatus" class="form-select" required>
                                    <option value="sudah">Selesai</option>
                                    <option value="pembayaran">Bayar</option>
                                    <option value="proses">Proses</option>
                                    <option value="belum">Belum</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Update Lengkap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            color: var(--ink);
            flex-shrink: 0;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .status-select {
            padding-left: 0.9rem;
            padding-right: 2rem;
        }

        .status-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(120, 159, 236, 0.25);
        }

        /* Search focus */
        #customSearch:focus {
            box-shadow: 0 0 0 4px rgba(120, 159, 236, 0.18);
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

                document.getElementById('editNama').value = nama;
                document.getElementById('editTanggal').value = tanggal;
                document.getElementById('editWaktu').value = waktu;

                // Select values for dropdowns
                document.getElementById('editMetode').value = metode;
                document.getElementById('editStatus').value = status;
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

    </script>
@endsection
