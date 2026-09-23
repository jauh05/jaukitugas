@extends('dashboard')

@section('tabel')
<div class="glass-card mb-4 bg-white bg-opacity-50 mt-5 p-4 rounded-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold m-0 text-primary"><i class="bi bi-journal-text me-2"></i>Manajemen Artikel</h4>
            <small class="text-muted">Kelola konten artikel dan insight untuk website</small>
        </div>
        <div>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-premium px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center gap-2 text-white" style="background: linear-gradient(45deg, #4834d4, #686de0);">
                <i class="bi bi-plus-circle"></i> Tulis Artikel Baru
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('admin.articles.index') }}" method="GET" class="row mb-4 g-3 align-items-center">
        <div class="col-md-5">
            <div class="position-relative">
                <input type="text" name="search" class="form-control border-0 bg-white py-2 ps-5 shadow-sm rounded-pill"
                    placeholder="Cari judul atau slug..." value="{{ request('search') }}"
                    style="border: 1px solid rgba(72, 52, 212, 0.1) !important;">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            </div>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select border-0 bg-white py-2 shadow-sm rounded-pill" style="border: 1px solid rgba(72, 52, 212, 0.1) !important;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Review</option>
                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Filter</button>
        </div>
        @if(request('search') || request('status'))
        <div class="col-md-2">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-light rounded-pill w-100">Reset</a>
        </div>
        @endif
    </form>

    <div class="table-responsive rounded-4 shadow-sm bg-white p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="text-secondary fw-semibold">Judul & Kategori</th>
                    <th scope="col" class="text-secondary fw-semibold">Status</th>
                    <th scope="col" class="text-secondary fw-semibold">Source</th>
                    <th scope="col" class="text-secondary fw-semibold">Tgl Publish</th>
                    <th scope="col" class="text-secondary fw-semibold text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-dark">{{ Str::limit($article->title, 50) }}</span>
                            <small class="text-muted">{{ $article->category ?? 'Tanpa Kategori' }}</small>
                        </div>
                    </td>
                    <td>
                        @if($article->status == 'published')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Published</span>
                        @elseif($article->status == 'draft')
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">Draft</span>
                        @elseif($article->status == 'scheduled')
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Scheduled</span>
                        @else
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">{{ ucfirst($article->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">{{ ucfirst($article->source) }}</span>
                    </td>
                    <td>
                        <small class="text-muted">
                            {{ $article->published_at ? $article->published_at->format('d/m/Y H:i') : '-' }}
                        </small>
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('artikel.show', $article->slug) }}" target="_blank" class="btn btn-sm btn-light rounded-circle" title="Lihat Artikel">
                                <i class="bi bi-eye text-primary"></i>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-light rounded-circle" title="Edit Artikel">
                                <i class="bi bi-pencil text-warning"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light rounded-circle" title="Hapus Artikel">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-2 mb-2 d-block"></i>
                        Belum ada artikel.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4 d-flex justify-content-end">
        {{ $articles->links() }}
    </div>
</div>
@endsection
