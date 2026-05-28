@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-primary"><i class="bi bi-cash-coin me-2"></i>Data Pengeluaran</h4>
                <small class="text-muted">Catat pengeluaran harian dengan tanggal otomatis atau manual</small>
            </div>
            <button class="btn btn-premium px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#addPengeluaranModal">
                <i class="bi bi-plus-circle-fill"></i> Tambah Pengeluaran
            </button>
        </div>

        <div class="table-responsive rounded-4 shadow-sm bg-white border-0">
            <table class="table table-borderless align-middle mb-0">
                <thead class="bg-light border-bottom">
                    <tr class="text-secondary text-uppercase fs-7 fw-bold">
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Keterangan</th>
                        <th class="py-3">Nominal</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengeluaran as $key => $item)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $key + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d M Y') }}</td>
                            <td>{{ $item['keterangan'] }}</td>
                            <td class="fw-bold text-danger">Rp {{ number_format($item['nominal']) }}</td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-info rounded-circle shadow-sm d-flex align-items-center justify-content-center edit-btn"
                                        style="width: 38px; height: 38px;" data-id="{{ $item['id_pengeluaran'] }}"
                                        data-tanggal="{{ $item['tanggal'] }}" data-keterangan="{{ $item['keterangan'] }}"
                                        data-nominal="{{ $item['nominal'] }}" data-bs-toggle="modal"
                                        data-bs-target="#editPengeluaranModal">
                                        <i class="bi bi-pencil-fill fs-6"></i>
                                    </button>
                                    <form action="{{ route('pengeluaran.delete', $item['id_pengeluaran']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center deleteButton"
                                            style="width: 38px; height: 38px;">
                                            <i class="bi bi-trash-fill fs-6"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">Belum ada data pengeluaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addPengeluaranModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="{{ route('pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control rounded-3 py-2 bg-light border-0"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nominal</label>
                            <input type="number" min="0" name="nominal"
                                class="form-control rounded-3 py-2 bg-light border-0" required>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="manualDateCheck">
                            <label class="form-check-label" for="manualDateCheck">Pilih tanggal manual</label>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tanggal</label>
                            <input type="date" id="manualDateInput" name="tanggal"
                                class="form-control rounded-3 py-2 bg-light border-0" disabled>
                            <small class="text-muted">Jika kosong, otomatis pakai tanggal hari ini.</small>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 rounded-pill py-2 fw-bold">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPengeluaranModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Edit Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <form id="editPengeluaranForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Keterangan</label>
                            <input type="text" id="editKeterangan" name="keterangan"
                                class="form-control rounded-3 py-2 bg-light border-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nominal</label>
                            <input type="number" min="0" id="editNominal" name="nominal"
                                class="form-control rounded-3 py-2 bg-light border-0" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tanggal</label>
                            <input type="date" id="editTanggal" name="tanggal"
                                class="form-control rounded-3 py-2 bg-light border-0" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const manualDateCheck = document.getElementById('manualDateCheck');
        const manualDateInput = document.getElementById('manualDateInput');
        manualDateCheck?.addEventListener('change', function() {
            manualDateInput.disabled = !this.checked;
            if (!this.checked) manualDateInput.value = '';
        });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('editKeterangan').value = this.getAttribute('data-keterangan');
                document.getElementById('editNominal').value = this.getAttribute('data-nominal');
                document.getElementById('editTanggal').value = this.getAttribute('data-tanggal');
                document.getElementById('editPengeluaranForm').action = `{{ url('dashboard/pengeluaran') }}/${id}`;
            });
        });
    </script>
@endsection

