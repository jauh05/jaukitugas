@extends('dashboard')
@section('info')
    @php
        $subtotal = $nota->sum('total_harga') ?: ($costomer->total ?? 0);
        $persen_diskon = intval($costomer->diskon ?? 0);
        $nominal_diskon = ($persen_diskon / 100) * $subtotal;
        $total_akhir = $subtotal - $nominal_diskon;
    @endphp

    <div class="col-12">
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
                    color: '#111111'
                });
            </script>
        @endif

        <!-- Bilah aksi -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('dashboard/costomer') }}" class="btn btn-light d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <span class="chip chip--lav"><i class="bi bi-receipt"></i> Nota #INV-{{ str_pad($costomer['id_costomer'], 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button class="btn btn-info d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#editDiskonModal">
                    <i class="bi bi-percent"></i> Set Diskon
                </button>
                <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    <i class="bi bi-plus-lg"></i> Tambah Item
                </button>
                <button class="btn btn-premium d-flex align-items-center gap-2" id="btnCapture">
                    <i class="bi bi-download"></i> Download JPG
                </button>
            </div>
        </div>
    </div>

    <!-- Kartu invoice -->
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                <div class="invoice-card" id="notaCard">
                    <!-- Pita warna -->
                    <div class="invoice-stripe">
                        <span style="background: #D9D2F1;"></span>
                        <span style="background: #D2EFFA;"></span>
                        <span style="background: #D6E2C3;"></span>
                        <span style="background: #FCF1C8;"></span>
                    </div>

                    <div class="invoice-body">
                        <!-- Header -->
                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-4 mb-5">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <span class="bubble" style="background: var(--panel);">
                                        <img src="{{ asset('asset/jlogo.svg') }}" alt="Logo" width="26">
                                    </span>
                                    <h2 class="fw-semibold m-0" style="letter-spacing: -0.5px;">JAUKI TUGAS</h2>
                                </div>
                                <p class="small mb-0" style="color: var(--muted);">Solusi Akademik Terpercaya</p>
                                <p class="small" style="color: var(--muted);">0851-8477-1744 | @jaukitugas</p>
                            </div>
                            <div class="text-end">
                                <div class="invoice-title">INVOICE</div>
                                <p class="fw-semibold mb-1">#INV-{{ str_pad($costomer['id_costomer'], 4, '0', STR_PAD_LEFT) }}</p>
                                <p class="small" style="color: var(--muted);">{{ \Carbon\Carbon::parse($costomer['created_at'])->format('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Tagihan untuk -->
                        <div class="invoice-bill mb-4">
                            <div class="card-sub text-uppercase fw-semibold mb-2" style="letter-spacing: 0.08em;">Tagihan untuk</div>
                            <h4 class="fw-semibold mb-1">{{ $costomer['nama'] }}</h4>
                            <p class="mb-2" style="color: var(--muted);">ID: #{{ $costomer['id_costomer'] }}</p>
                            <span class="chip chip--sky"><i class="bi bi-credit-card"></i> {{ $costomer['nama_metode'] ?? 'Transfer Update' }}</span>
                        </div>

                        <!-- Tabel item -->
                        <div class="table-responsive mb-4">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Deskripsi Item</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Harga Satuan</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end pe-3" style="width: 60px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nota as $item)
                                        <tr>
                                            <td class="ps-3 fw-semibold">{{ $item['nama_produk'] }}</td>
                                            <td class="text-center"><span class="chip">{{ $item['jumlah'] }}</span></td>
                                            <td class="text-center">Rp {{ number_format($item['harga']) }}</td>
                                            <td class="text-end fw-semibold">Rp {{ number_format($item['total_harga']) }}</td>
                                            <td class="text-end pe-3 action-cell">
                                                <form action="{{ url('costomer/' . $costomer['id_costomer'] . '/hapus/harga/' . $item['id_nota']) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-icon delete-btn" title="Hapus item"><i class="bi bi-x-lg"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Total -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5">
                                <div class="invoice-total">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span style="color: var(--ink-2);">Subtotal</span>
                                        <span class="fw-semibold">Rp {{ number_format($subtotal) }}</span>
                                    </div>

                                    @if($persen_diskon > 0)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span style="color: var(--ink-2);">Diskon ({{ $persen_diskon }}%)</span>
                                            <span class="fw-semibold" style="color: var(--danger);">- Rp {{ number_format($nominal_diskon) }}</span>
                                        </div>
                                    @endif

                                    <div class="my-3" style="border-top: 1px dashed var(--line);"></div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">Total Harus Dibayar</span>
                                        <span class="invoice-grand">Rp {{ number_format($total_akhir) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="text-center mt-5 pt-4" style="border-top: 1px solid var(--line); color: var(--muted);">
                            <p class="small mb-1">Terima kasih telah mempercayakan tugas Anda kepada Jauki Tugas.</p>
                            <p class="small mb-0">Harap lakukan pembayaran secepatnya agar pesanan dapat segera diproses.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Tambah Item Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                     <form action="{{ url('tambah/harga/' . $costomer['id_costomer']) }}" method="post" id="addItemForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan/Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Bab 1-3 Skripsi" required>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                 <label class="form-label">Jumlah</label>
                                 <input type="number" name="jumlah" class="form-control" value="1" id="inputQty" required>
                            </div>
                            <div class="col-8">
                                 <label class="form-label">Harga Satuan</label>
                                 <input type="number" name="harga" class="form-control" id="inputHarga" required>
                            </div>
                        </div>
                        <div class="mt-3 p-3 rounded-4 text-center" style="background: var(--lav);">
                            <small class="d-block" style="color: var(--ink-2);">Est. Total</small>
                            <h4 class="fw-semibold m-0" id="estTotal">Rp 0</h4>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4 py-2">Tambahkan ke Nota</button>
                     </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Diskon Modal -->
    <div class="modal fade" id="editDiskonModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header pb-0">
                    <h5 class="modal-title fw-semibold">Atur Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                     <form action="{{ route('update.diskon', $costomer->id_costomer) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Diskon (%)</label>
                            <div class="input-group">
                                <input type="number" name="diskon" class="form-control" value="{{ $costomer['diskon'] }}" min="0" max="100" required>
                                <span class="input-group-text rounded-end-4 border-0" style="background: var(--panel);">%</span>
                            </div>
                            <small style="color: var(--muted);">Masukkan angka 0-100</small>
                        </div>
                        <button type="submit" class="btn btn-info w-100 mt-2 py-2">Simpan Diskon</button>
                     </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .invoice-card {
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(17, 17, 17, 0.05);
        }

        .invoice-stripe {
            display: flex;
            height: 8px;
        }

        .invoice-stripe span {
            flex: 1;
        }

        .invoice-body {
            padding: 40px 44px;
        }

        .invoice-title {
            font-size: 2.2rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: var(--lav);
            line-height: 1;
            margin-bottom: 8px;
        }

        .invoice-bill {
            background: var(--panel);
            border-radius: 20px;
            padding: 18px 22px;
            display: inline-block;
            min-width: 280px;
        }

        .invoice-total {
            background: var(--panel);
            border-radius: 22px;
            padding: 20px 22px;
        }

        .invoice-grand {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--ink);
        }

        #notaCard .table thead th {
            background: transparent;
        }

        @media (max-width: 576px) {
            .invoice-body {
                padding: 24px 20px;
            }

            .invoice-title {
                font-size: 1.6rem;
            }
        }
    </style>

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
