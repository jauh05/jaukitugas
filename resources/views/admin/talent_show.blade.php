@extends('dashboard')

@section('halo')
    <div class="mb-4">
        <a href="{{ route('admin.talent.index') }}" class="btn btn-link text-decoration-none text-muted ps-0 mb-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
        <h2 class="mb-1">Detail Talent: {{ $talent->nama_lengkap }}</h2>
        <p class="text-muted mb-0">Terdaftar pada {{ $talent->created_at->format('d M Y, H:i') }}</p>
    </div>
@endsection

@section('edit')
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="glass-card bg-white p-4 h-100 mb-0 shadow-none border-0">
                <h5 class="mb-4 text-primary border-bottom pb-2">Informasi Pribadi</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold text-uppercase">Email</label>
                        <p class="fw-bold mb-0">{{ $talent->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold text-uppercase">Instagram</label>
                        <p class="fw-bold mb-0">@<a href="https://instagram.com/{{ $talent->instagram }}" target="_blank"
                                class="text-decoration-none">{{ $talent->instagram }}</a></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold text-uppercase">No WhatsApp</label>
                        <p class="fw-bold mb-0">{{ $talent->no_wa }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold text-uppercase">Asal Universitas</label>
                        <p class="fw-bold mb-0">{{ $talent->asal_univ }}</p>
                    </div>
                    <div class="col-md-12">
                        <label class="text-muted small fw-bold text-uppercase">Program Study & Semester</label>
                        <p class="fw-bold mb-0">{{ $talent->program_study_semester }}</p>
                    </div>
                    <div class="col-md-12">
                        <label class="text-muted small fw-bold text-uppercase">Keahlian</label>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @if(is_array($talent->keahlian))
                                @foreach($talent->keahlian as $item)
                                    <span
                                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-4 fw-normal">{{ $item }}</span>
                                @endforeach
                            @else
                                <p class="text-muted mb-0">Tidak ada data keahlian.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <h5 class="mt-5 mb-4 text-primary border-bottom pb-2">Dokumen Pendukung</h5>
                <div
                    class="d-flex align-items-center p-3 rounded-4 bg-light border border-2 border-dashed border-primary border-opacity-25">
                    <i class="bi bi-file-earmark-pdf-fill fs-1 text-danger me-3"></i>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold">Berkas Gabungan (PDF)</h6>
                        <small class="text-muted">CV, Ijazah, Transkrip, dll</small>
                    </div>
                    <a href="{{ route('admin.talent.file', $talent->id) }}" target="_blank"
                        class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-download me-2"></i> Lihat Berkas
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="glass-card bg-white p-4 mb-4 shadow-none border-0">
                <h5 class="mb-4 text-primary border-bottom pb-2">Status Pendaftaran</h5>
                <form action="{{ route('admin.talent.updateStatus', $talent->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Ubah Status</label>
                        <select name="status" class="form-select border-0 bg-light py-3 px-4 rounded-4 fw-bold">
                            <option value="pending" {{ $talent->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu
                                Review)</option>
                            <option value="verified" {{ $talent->status == 'verified' ? 'selected' : '' }}>Verified (Lolos
                                Seleksi)</option>
                            <option value="rejected" {{ $talent->status == 'rejected' ? 'selected' : '' }}>Rejected (Tidak
                                Lolos)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-premium w-100 py-3 rounded-4 fw-bold shadow-lg">Simpan
                        Perubahan</button>
                </form>
            </div>

            <div class="glass-card bg-danger bg-opacity-10 p-4 border-0 shadow-none">
                <h5 class="mb-3 text-danger">Tindakan Bahaya</h5>
                <p class="text-muted small">Menghapus pendaftaran akan menghapus seluruh data secara permanen beserta berkas
                    yang telah diupload.</p>
                <form action="{{ route('admin.talent.destroy', $talent->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100 py-3 rounded-4 fw-bold deleteButton">Hapus
                        Pendaftaran</button>
                </form>
            </div>
        </div>
    </div>
@endsection