@extends('dashboard')
@section('tabel')
    <div class="card-head">
        <div>
            <h5 class="card-title-lg"><i class="bi bi-plus-circle me-2"></i>Tambah Metode Pembayaran</h5>
            <div class="card-sub">Nama metode ini akan muncul sebagai pilihan pembayaran</div>
        </div>
    </div>

    <form action="{{ url('metodepembayaran/tambah/data') }}" method="post" class="row g-3" style="max-width: 560px;">
        @csrf
        <div class="col-12">
            <label class="form-label small fw-semibold" style="color: var(--ink-2);" for="metode">Nama Metode</label>
            <input type="text" name="metode" id="metode" class="form-control" placeholder="Contoh: Transfer BCA, DANA, dll..." required>
        </div>
        <div class="col-12 d-flex gap-2">
            <a href="{{ url('metodepembayaran') }}" class="btn btn-light rounded-pill px-4">Kembali</a>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Metode</button>
        </div>
    </form>
@endsection
