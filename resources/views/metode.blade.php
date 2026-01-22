@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-primary"><i class="bi bi-wallet2 me-2"></i>Metode Pembayaran</h4>
                <small class="text-muted">Kelola jenis metode pembayaran yang tersedia</small>
            </div>
            <div>
                <button type="button"
                    class="btn btn-premium px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-plus-lg"></i> Tambah Metode
                </button>
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

        <!-- Glass Table -->
        <div class="table-responsive rounded-4 shadow-sm bg-white border-0">
            <table class="table table-borderless align-middle mb-0" id="glassTable">
                <thead class="bg-light border-bottom">
                    <tr class="text-secondary text-uppercase fs-7 fw-bold">
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">ID Metode</th>
                        <th class="py-3">Nama Metode</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark fw-medium">
                    @foreach ($metode as $key => $value)
                        <tr class="border-bottom h-hover transition-all">
                            <td class="ps-4 text-muted">{{ $key + 1 }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $value['id_metode'] }}</span></td>
                            <td class="fw-bold">{{ $value['nama_metode'] }}</td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button (Link to Edit Page) -->
                                    <a href="{{ url('metode/' . $value['id_metode'] . '/edit') }}"
                                        class="btn btn-sm btn-outline-info rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                        style="width: 38px; height: 38px;" title="Edit Metode">
                                        <i class="bi bi-pencil-fill fs-6"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ url('metode/delete/' . $value['id_metode']) }}" method="post"
                                        class="d-inline deleteForm">
                                        @method('delete')
                                        @csrf
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center deleteButton"
                                            style="width: 38px; height: 38px;" title="Hapus Metode">
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
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 bg-white">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Metode Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="{{ url('metodepembayaran/tambah/data') }}" method="post">
                        @method('post')
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Metode</label>
                            <input type="text" name="metode" class="form-control rounded-3 py-2 bg-light border-0"
                                placeholder="Contoh: Transfer BCA, DANA, dll..." required>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 rounded-pill py-2 fw-bold">Simpan Metode</button>
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

        .modal-backdrop {
            z-index: 1040;
        }

        .modal {
            z-index: 1050;
        }
    </style>

    <script>
        // Delete Confirmation (SweetAlert)
        document.querySelectorAll('.deleteButton').forEach(button => {
            button.addEventListener('click', function () {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('.deleteForm').submit();
                    }
                })
            });
        });
    </script>
@endsection