@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-primary"><i class="bi bi-chat-quote-fill me-2"></i>Data Komentar</h4>
                <small class="text-muted">Kelola testimoni dan komentar dari pelanggan</small>
            </div>
        </div>

        <!-- Glass Table -->
        <div class="table-responsive rounded-4 shadow-sm bg-white border-0">
            <table class="table table-borderless align-middle mb-0" id="glassTable">
                <thead class="bg-light border-bottom">
                    <tr class="text-secondary text-uppercase fs-7 fw-bold">
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Tentang</th>
                        <th class="py-3" style="width: 30%;">Isi Komentar</th>
                        <th class="py-3">Waktu</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark fw-medium">
                    @foreach ($komentar as $key => $value)
                        <tr class="border-bottom h-hover transition-all">
                            <td class="ps-4 text-muted">{{ $key + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3 bg-primary bg-gradient">
                                        {{ substr($value['nama'], 0, 1) }}
                                    </div>
                                    <div class="fw-bold text-dark">{{ $value['nama'] }}</div>
                                </div>
                            </td>
                            <td><span
                                    class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill">{{ $value['tentang'] }}</span>
                            </td>
                            <td><small class="text-muted d-block text-truncate"
                                    style="max-width: 250px;">{{ $value['komentar'] }}</small></td>
                            <td>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>{{ $value['created_at']->format('d M Y') }}
                                </small>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ url('dashboard/' . $value['id_komentar'] . '/edit')}}"
                                        class="btn btn-sm btn-outline-info rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                        style="width: 38px; height: 38px;" title="Edit Komentar">
                                        <i class="bi bi-pencil-fill fs-6"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ url("komentar/" . $value['id_komentar']) }}" method="post"
                                        class="d-inline deleteForm">
                                        @method('delete')
                                        @csrf
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center deleteButton"
                                            style="width: 38px; height: 38px;" title="Hapus Komentar">
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

    <style>
        /* Custom Styles for this Page */
        .fs-7 {
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 1rem;
        }

        .h-hover:hover {
            background-color: rgba(72, 52, 212, 0.02) !important;
            transform: translateY(-1px);
        }

        .transition-all {
            transition: all 0.2s ease;
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