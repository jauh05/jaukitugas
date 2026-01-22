@extends('dashboard')
@section('tabel')
    <div class="glass-card mb-4 bg-white bg-opacity-50 mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold m-0 text-danger"><i class="bi bi-clock-history me-2"></i>Customer Pending</h4>
                <small class="text-muted">Data pelanggan yang belum selesai atau belum lunas</small>
            </div>
            <div>
                <a href="{{ url('dashboard/costomer') }}" class="btn btn-outline-secondary rounded-pill shadow-sm fw-bold">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Custom Search Bar -->
        <div class="mb-4 position-relative">
            <input type="text" id="customSearch" class="form-control border-0 bg-white py-3 ps-5 shadow-sm rounded-4"
                placeholder="Cari data pending..." style="border: 1px solid rgba(220, 53, 69, 0.2) !important;">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5"></i>
        </div>

        <!-- Glass Table -->
        <div class="table-responsive rounded-4 shadow-sm bg-white border-0">
            <table class="table table-borderless align-middle mb-0" id="glassTable">
                <thead class="bg-light border-bottom">
                    <tr class="text-secondary text-uppercase fs-7 fw-bold">
                        <th class="ps-4 py-3">No</th>
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
                                    <td class="ps-4 text-muted">{{ $key + 1 }}</td>
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
                                            class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3">
                                            {{ $value['nama_metode'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold {{ $value['selesaikan'] == 'pembayaran' ? 'text-danger' : 'text-success' }}">
                                            Rp {{ number_format($value['total'])}}
                                        </span>
                                    </td>
                                    <td style="min-width: 200px;">
                                        <form action="{{ url('selesaikan/' . $value['id_costomer']) }}" method="post"
                                            class="status-form">
                                            @method('put')
                                            @csrf
                                            <div class="d-flex gap-2">
                                                <select name="selesaikan" class="form-select form-select-sm border-0 shadow-sm rounded-pill fw-bold cursor-pointer status-select
                                                                @if($value['selesaikan'] == 'sudah') bg-success bg-opacity-10 text-success
                                                                @elseif($value['selesaikan'] == 'pembayaran') bg-danger bg-opacity-10 text-danger
                                                                @elseif($value['selesaikan'] == 'proses') bg-primary bg-opacity-10 text-primary
                                                                @else bg-secondary bg-opacity-10 text-secondary
                                                                @endif" onchange="this.form.submit()">
                                                    <option value="sudah" @selected($value['selesaikan'] == 'sudah')>✅ Selesai</option>
                                                    <option value="pembayaran" @selected($value['selesaikan'] == 'pembayaran')>💰 Bayar
                                                    </option>
                                                    <option value="proses" @selected($value['selesaikan'] == 'proses')>⏳ Proses</option>
                                                    <option value="belum" @selected($value['selesaikan'] == 'belum')>⛔ Belum</option>
                                                </select>

                                                <!-- Metode Dropdown -->
                                                <select name="metode"
                                                    class="form-select form-select-sm border-0 shadow-sm rounded-pill bg-light text-muted"
                                                    style="max-width: 80px;" onchange="this.form.submit()" title="Ubah Metode">
                                                    @foreach ($metode as $item)
                                                        <option value="{{ $item['id_metode'] }}" {{ $item['id_metode'] == $value['id_metode'] ? 'selected' : '' }}>
                                                            {{ substr($item['nama_metode'], 0, 5) }}..
                                                        </option>
                                                    @endforeach
                                                </select>
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

                                            <!-- Edit Button (To trigger Edit Modal - Using same attributes as costomer.blade if needed, or link to edit page if prefer, but user said 'samakan styles') -->
                                            <!-- Since this is 'belum', we might not need the full edit modal if the user didn't ask for it specifically here, but the ICONS should match. -->
                                            <!-- I'll add the edit button with link for now as the modal isn't present in this file, or I can add the modal here too. User said "icons samakan". I'll use the button style but keep functionality as is (link to edit page if modal not copied) OR better, add the modal here too? User said "costomer_tambah.blade itu dijadikan modal ... dan untuk costomer_edit.blade juga". -->
                                            <!-- But for 'costomer_belum' they just said "tampilan di buat seperti costomer.blade". -->
                                            <!-- I will stick to the requested "icons samakan" first. -->

                                            <a href="{{ url('costomer/' . $value['id_costomer'] . '/edit') }}"
                                                class="btn btn-sm btn-outline-info rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                style="width: 38px; height: 38px;" title="Edit Data">
                                                <i class="bi bi-pencil-fill fs-6"></i>
                                            </a>

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
            <h5 class="text-muted">Tidak ditemukan data pending</h5>
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
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .h-hover:hover {
            background-color: rgba(220, 53, 69, 0.02) !important;
            transform: translateY(-1px);
        }

        .transition-all {
            transition: all 0.2s ease;
        }

        /* Search Input Focus */
        #customSearch:focus {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
            border-color: #dc3545 !important;
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