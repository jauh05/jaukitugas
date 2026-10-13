@extends('dashboard')
@section('tabel')
    <!-- Header -->
    <div class="card-head">
        <div>
            <h5 class="card-title-lg"><i class="bi bi-wallet2 me-2"></i>Metode Pembayaran</h5>
            <div class="card-sub">Kelola jenis metode pembayaran yang tersedia</div>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-1"></i>Tambah Metode
        </button>
    </div>

    <!-- Alert -->
    @if (session('pesan_berhasil'))
        <script>
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Berhasil!",
                text: "{{ session('pesan_berhasil') }}",
                showConfirmButton: false,
                timer: 2000
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

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table align-middle mb-0" id="glassTable">
            <thead>
                <tr>
                    <th class="ps-3">No</th>
                    <th>ID Metode</th>
                    <th>Nama Metode</th>
                    <th class="pe-3 text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($metode as $key => $value)
                    <tr>
                        <td class="ps-3 fw-semibold" style="color: var(--muted);">{{ $key + 1 }}</td>
                        <td><span class="chip">#{{ $value['id_metode'] }}</span></td>
                        <td class="fw-semibold">{{ $value['nama_metode'] }}</td>
                        <td class="pe-3 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('metode/' . $value['id_metode'] . '/edit') }}" class="btn btn-light btn-icon" title="Edit Metode">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ url('metode/delete/' . $value['id_metode']) }}" method="post" class="d-inline deleteForm">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn btn-outline-danger btn-icon deleteButton" title="Hapus Metode">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4" style="color: var(--muted);">Belum ada metode pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold">Tambah Metode Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('metodepembayaran/tambah/data') }}" method="post">
                        @csrf
                        <label class="form-label small fw-semibold" style="color: var(--ink-2);" for="metodeBaru">Nama Metode</label>
                        <input type="text" name="metode" id="metodeBaru" class="form-control mb-4"
                            placeholder="Contoh: Transfer BCA, DANA, dll..." required>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan Metode</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
