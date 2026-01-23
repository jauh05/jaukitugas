@extends('material.dash')

@section('temp')
    <div class="container py-5 mt-1">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">
                Informasi Pembayaran
            </span>
            <h1 class="display-5 fw-bold">Selesaikan Pembayaran Anda</h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Silakan lakukan transfer sesuai nominal tagihan ke salah satu metode pembayaran di bawah ini.
            </p>
        </div>

        <div class="row justify-content-center g-5">
            <!-- QRIS Section -->
            <div class="col-lg-5">
                <div class="glass-card p-0 bg-white h-100 border-0 shadow-sm overflow-hidden">
                    <!-- Mobile Toggle / Desktop Header -->
                    <button
                        class="btn w-100 text-start p-3 d-flex align-items-center justify-content-between border-0 rounded-0 bg-transparent"
                        type="button" data-bs-toggle="collapse" data-bs-target="#qrisContent" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-qr-code-scan"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">Scan QRIS</h5>
                                <small class="text-muted d-md-none">Klik untuk melihat QR Code</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-down d-md-none text-muted"></i>
                    </button>

                    <!-- Content -->
                    <div class="collapse d-md-block p-3 pt-0 text-center" id="qrisContent">
                        <hr class="d-md-none my-0 mb-4 opacity-10">
                        <div class="bg-white p-3 rounded-4 shadow-sm d-inline-block mb-3 border">
                            <img src="{{ asset('asset/qris.jpeg') }}" alt="QRIS Payment" class="img-fluid rounded-3"
                                style="max-height: 350px;">
                        </div>
                        <p class="text-muted small mb-0">Mendukung semua e-wallet & mobile banking</p>
                    </div>
                </div>
            </div>

            <!-- Bank Details Section -->
            <div class="col-lg-6">
                <div class="d-flex flex-column gap-3">
                    <!-- DANA -->
                    <div class="glass-card p-0 bg-white border-start border-4 border-primary shadow-sm overflow-hidden">
                        <!-- Mobile Toggle / Desktop Header -->
                        <button
                            class="btn w-100 text-start p-3 d-flex align-items-center justify-content-between border-0 rounded-0 bg-transparent"
                            type="button" data-bs-toggle="collapse" data-bs-target="#danaContent" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png"
                                    alt="DANA" height="25" class="me-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">E-Wallet</span>
                            </div>
                            <i class="bi bi-chevron-down d-md-none text-muted"></i>
                        </button>

                        <!-- Content -->
                        <div class="collapse d-md-block p-3 pt-0" id="danaContent">
                            <hr class="d-md-none my-0 mb-3 opacity-10">
                            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
                                <div>
                                    <h4 class="fw-bold mb-1 font-monospace text-dark">089529104230</h4>
                                    <small class="text-muted text-uppercase fw-bold letter-spacing-1">A.N JAUHAR FAUZI ULUL
                                        ALBAB</small>
                                </div>
                                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-primary shadow-sm"
                                    onclick="copyToClipboard('089529104230')">
                                    <i class="bi bi-copy me-2"></i>Salin
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- SHOPEEPAY -->
                    <div class="glass-card p-0 bg-white border-start border-4 border-warning shadow-sm overflow-hidden">
                        <button
                            class="btn w-100 text-start p-3 d-flex align-items-center justify-content-between border-0 rounded-0 bg-transparent"
                            type="button" data-bs-toggle="collapse" data-bs-target="#shopeeContent" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/2560px-Shopee.svg.png"
                                    alt="ShopeePay" height="30" class="me-3">
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">E-Wallet</span>
                            </div>
                            <i class="bi bi-chevron-down d-md-none text-muted"></i>
                        </button>

                        <div class="collapse d-md-block p-3 pt-0" id="shopeeContent">
                            <hr class="d-md-none my-0 mb-3 opacity-10">
                            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
                                <div>
                                    <h4 class="fw-bold mb-1 font-monospace text-dark">089529104230</h4>
                                    <small class="text-muted text-uppercase fw-bold letter-spacing-1">A.N JAU.ID</small>
                                </div>
                                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-warning shadow-sm"
                                    onclick="copyToClipboard('089529104230')">
                                    <i class="bi bi-copy me-2"></i>Salin
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- GOPAY -->
                    <div class="glass-card p-0 bg-white border-start border-4 border-success shadow-sm overflow-hidden">
                        <button
                            class="btn w-100 text-start p-3 d-flex align-items-center justify-content-between border-0 rounded-0 bg-transparent"
                            type="button" data-bs-toggle="collapse" data-bs-target="#gopayContent" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/2560px-Gopay_logo.svg.png"
                                    alt="Gopay" height="25" class="me-3">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">E-Wallet</span>
                            </div>
                            <i class="bi bi-chevron-down d-md-none text-muted"></i>
                        </button>

                        <div class="collapse d-md-block p-3 pt-0" id="gopayContent">
                            <hr class="d-md-none my-0 mb-3 opacity-10">
                            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
                                <div>
                                    <h4 class="fw-bold mb-1 font-monospace text-dark">0895291054230</h4>
                                    <small class="text-muted text-uppercase fw-bold letter-spacing-1">A.N JAUHAR FAUZI ULUL
                                        ALBAB</small>
                                </div>
                                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-success shadow-sm"
                                    onclick="copyToClipboard('0895291054230')">
                                    <i class="bi bi-copy me-2"></i>Salin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- keterangan -->
                <div
                    class="alert alert-primary bg-primary bg-opacity-10 border-0 rounded-4 p-4 text-primary d-flex align-items-start mt-4">
                    <i class="bi bi-info-circle-fill fs-4 me-3 mt-1"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Penting!</h5>
                        <p class="mb-0 small opacity-75">Mohon simpan bukti transfer Anda untuk konfirmasi pembayaran
                            kepada admin kami.</p>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="https://wa.me/6285184771744?text=Halo%20Admin%2C%20saya%20sudah%20melakukan%20pembayaran"
                        class="btn btn-premium w-100 py-3 rounded-pill fw-bold shadow-lg">
                        <i class="bi bi-whatsapp me-2"></i> Konfirmasi Pembayaran ke WA
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Toast for Copy -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1060">
        <div id="copyToast" class="toast align-items-center text-white bg-success border-0 rounded-4 shadow-lg p-2"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-bold">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i> Nomor berhasil disalin!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function () {
                var toastEl = document.getElementById('copyToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }, function (err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>

    <style>
        .hover-up:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .letter-spacing-1 {
            letter-spacing: 1px;
        }
    </style>
@endsection