@extends('dashboard')
@section('tabel')
    <div class="card-head">
        <div>
            <h5 class="card-title-lg"><i class="bi bi-pencil me-2"></i>Edit Metode Pembayaran</h5>
            <div class="card-sub">ID #{{ $metode['id_metode'] }}</div>
        </div>
    </div>

    <form action="{{ url('metode/edit/' . $metode['id_metode']) }}" method="post" class="row g-3" style="max-width: 560px;">
        @method('put')
        @csrf
        <div class="col-12">
            <label class="form-label small fw-semibold" style="color: var(--ink-2);" for="metodeEdit">Nama Metode</label>
            <input type="text" name="metode" id="metodeEdit" class="form-control" value="{{ $metode['nama_metode'] }}" required>
        </div>
        <div class="col-12 d-flex gap-2">
            <a href="{{ url('metodepembayaran') }}" class="btn btn-light rounded-pill px-4">Kembali</a>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
        </div>
    </form>
@endsection
