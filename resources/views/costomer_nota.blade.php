@extends('dashboard')
@section('info')
    <div class="container mt-5">
        @if (session('pesan_berhasil'))
            <script>
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Berhasil",
                    text: "{{ session('pesan_berhasil') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    background: '#fff',
                    color: '#2d3436'
                });
            </script>
        @endif

        <!-- Action Buttons -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 d-flex justify-content-between">
                <a href="{{ url('dashboard/costomer') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                <div class="d-flex gap-2">
                    <button class="btn btn-info rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#editDiskonModal">
                        <i class="bi bi-percent me-2"></i>Set Diskon
                    </button>
                     <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addItemModal">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Item
                    </button>
                    <button class="btn btn-dark rounded-pill px-4" id="btnCapture">
                        <i class="bi bi-download me-2"></i>Download JPG
                    </button>
                </div>
            </div>
        </div>

        <!-- Professional Invoice Card -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white shadow-lg p-0" id="notaCard" style="min-height: 800px; position: relative;">

                    <!-- Ribbon Decoration -->
                    <div class="position-absolute top-0 start-0 w-100" style="height: 6px; background: linear-gradient(90deg, #4834d4, #686de0);"></div>

                    <div class="p-5">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-start mb-5">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="50">
                                    <h2 class="fw-bold m-0" style="color: #4834d4; letter-spacing: -1px;">JAUKI TUGAS</h2>
                                </div>
                                <p class="text-muted small mb-0">Solusi Akademik Terpercaya</p>
                                <p class="text-muted small">0851-8477-1744 | @jaukitugas</p>
                            </div>
                            <div class="text-end">
                                <h1 class="fw-bold text-light-gray display-6" style="color: #dfe6e9;">INVOICE</h1>
                                <p class="fw-bold mb-1">#INV-{{ str_pad($costomer['id_costomer'], 4, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-muted small">{{ \Carbon\Carbon::parse($costomer['created_at'])->format('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Bill To Info -->
                        <div class="row mb-5">
                            <div class="col-6">
                                <h6 class="text-uppercase text-muted small fw-bold mb-3">Tagihan Untuk:</h6>
                                <h4 class="fw-bold mb-1">{{ $costomer['nama'] }}</h4>
                                <p class="text-muted mb-0">ID: #{{ $costomer['id_costomer'] }}</p>
                                <p class="text-muted mb-0">Metode: <span class="badge bg-primary bg-opacity-10 text-primary">{{ $costomer['nama_metode'] ?? 'Transfer Update' }}</span></p>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-borderless">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th class="py-3 ps-4 text-uppercase small text-muted">Deskripsi Item</th>
                                        <th class="py-3 text-center text-uppercase small text-muted">Qty</th>
                                        <th class="py-3 text-center text-uppercase small text-muted">Harga Satuan</th>
                                        <th class="py-3 pe-4 text-end text-uppercase small text-muted">Total</th>
                                        <th class="py-3 text-uppercase small text-muted"></th> <!-- Aksi -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nota as $item)
                                        <tr class="border-bottom">
                                            <td class="ps-4 py-3 fw-medium">{{ $item['nama_produk'] }}</td>
                                            <td class="text-center py-3">{{ $item['jumlah'] }}</td>
                                            <td class="text-center py-3">Rp {{ number_format($item['harga']) }}</td>
                                            <td class="pe-4 text-end py-3 fw-bold">Rp {{ number_format($item['total_harga']) }}</td>
                                            <td class="py-3 text-end action-cell">
                                                <form action="{{ url('costomer/' . $costomer['id_costomer'] . '/hapus/harga/' . $item['id_nota']) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-link text-danger p-0 delete-btn"><i class="bi bi-x-circle"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Total Section -->
                        <div class="row justify-content-end">
                            <div class="col-md-5">
                                <div class="bg-light p-4 rounded-3">
                                    @php
                                        // Menghitung subtotal langsung dari data nota untuk akurasi
                                        $subtotal = $nota->sum('total_harga') ?: ($costomer->total ?? 0);
                                        $persen_diskon = intval($costomer->diskon ?? 0);
                                        $nominal_diskon = ($persen_diskon / 100) * $subtotal;
                                        $total_akhir = $subtotal - $nominal_diskon;
                                    @endphp
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">Subtotal</span>
                                        <span class="fw-bold">Rp {{ number_format($subtotal) }}</span>
                                    </div>

                                    @if($persen_diskon > 0)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">Diskon ({{ $persen_diskon }}%)</span>
                                        <span class="text-danger fw-bold">- Rp {{ number_format($nominal_diskon) }}</span>
                                    </div>
                                    @endif
                                    
                                    <div class="border-top my-2"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold fs-5 text-primary">Total Harus Dibayar</span>
                                        <span class="fw-bold fs-4 text-primary">Rp {{ number_format($total_akhir) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mt-5 pt-5 text-center text-muted small">
                            <p class="mb-1">Terima kasih telah mempercayakan tugas Anda kepada Jauki Tugas.</p>
                            <p>Harap lakukan pembayaran secepatnya agar pesanan dapat segera diproses.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Tambah Item Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                     <form action="{{ url('tambah/harga/' . $costomer['id_costomer']) }}" method="post" id="addItemForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Layanan/Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Bab 1-3 Skripsi" required>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                 <label class="form-label small fw-bold text-muted">Jumlah</label>
                                 <input type="number" name="jumlah" class="form-control" value="1" id="inputQty" required>
                            </div>
                            <div class="col-8">
                                 <label class="form-label small fw-bold text-muted">Harga Satuan</label>
                                 <input type="number" name="harga" class="form-control" id="inputHarga" required>
                            </div>
                        </div>
                        <div class="mt-3 p-3 bg-light rounded text-center">
                            <small class="text-muted d-block">Est. Total</small>
                            <h4 class="fw-bold m-0 text-primary" id="estTotal">Rp 0</h4>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4 rounded-pill py-2">Tambahkan ke Nota</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Diskon Modal -->
    <div class="modal fade" id="editDiskonModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Atur Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                     <form action="{{ url('update/diskon/' . $costomer->id_costomer) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Diskon (%)</label>
                            <div class="input-group">
                                <input type="number" name="diskon" class="form-control" value="{{ $costomer['diskon'] }}" min="0" max="100" required>
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="text-muted">Masukkan angka 0-100</small>
                        </div>
                        <button type="submit" class="btn btn-info w-100 mt-2 rounded-pill py-2 text-white">Simpan Diskon</button>
                     </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        // Live Calculation for Modal
        const qty = document.getElementById('inputQty');
        const harga = document.getElementById('inputHarga');
        const totalDisplay = document.getElementById('estTotal');

        function calcTotal() {
            let q = qty.value || 0;
            let p = harga.value || 0;
            let t = q * p;
            totalDisplay.innerText = "Rp " + t.toLocaleString('id-ID');
        }

        qty.addEventListener('input', calcTotal);
        harga.addEventListener('input', calcTotal);

        // Capture & Download
        document.getElementById("btnCapture").addEventListener("click", function() {
            let cardElement = document.getElementById("notaCard");

            // Hide delete buttons before capture
            document.querySelectorAll('.action-cell').forEach(el => el.style.display = 'none');

            html2canvas(cardElement, {
                scale: 2, 
                useCORS: true,
                backgroundColor: "#ffffff"
            }).then(canvas => {
                let link = document.createElement("a");
                link.href = canvas.toDataURL("image/jpeg", 0.9);
                link.download = "Invoice_{{ $costomer['nama'] }}.jpg";
                link.click();

                // Show buttons again
                document.querySelectorAll('.action-cell').forEach(el => el.style.display = '');
            });
        });
    </script>
@endsection
