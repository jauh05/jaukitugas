@extends('material.dash')

@section('temp')
<header class="container py-4 mt-2 position-relative overflow-hidden">
    <div class="row align-items-center flex-column-reverse flex-lg-row g-lg-5 g-4 py-lg-4 py-2">
        <div class="col-lg-12 text-center">
            <h1 class="display-4 fw-bold mb-3 text-premium-dark">Artikel & <span class="text-primary">Insight</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Temukan tips akademik, panduan penelitian, tutorial statistik, hingga perkembangan teknologi terkini.
            </p>
            
            <form action="{{ route('artikel.index') }}" method="GET" class="mx-auto mt-4" style="max-width: 500px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control rounded-start-pill py-2 px-4 shadow-sm border-0" placeholder="Cari artikel..." value="{{ request('search') }}">
                    <button class="btn btn-primary rounded-end-pill px-4 shadow-sm" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</header>

<main class="container py-5">
    
    <!-- Category Filter -->
    <div class="d-flex overflow-auto pb-3 mb-4 gap-2 no-scrollbar" style="white-space: nowrap;">
        <a href="{{ route('artikel.index') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-secondary bg-white' }} rounded-pill px-4 shadow-sm">Semua</a>
        @foreach($categories as $cat)
            <a href="{{ route('artikel.index', ['category' => $cat]) }}" class="btn {{ request('category') == $cat ? 'btn-primary' : 'btn-outline-secondary bg-white' }} rounded-pill px-4 shadow-sm">{{ $cat }}</a>
        @endforeach
    </div>

    <!-- Featured Article -->
    @if($featuredArticle && !request('page') && !request('search') && !request('category'))
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="row g-0">
            <div class="col-md-7">
                @if($featuredArticle->featured_image)
                    <img src="{{ Storage::url($featuredArticle->featured_image) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $featuredArticle->title }}" style="min-height: 300px;">
                @else
                    <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                        <i class="bi bi-image text-muted fs-1"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5">
                    <div class="mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $featuredArticle->category ?? 'Umum' }}</span>
                        <small class="text-muted ms-2"><i class="bi bi-calendar3 me-1"></i> {{ $featuredArticle->published_at->format('d M Y') }}</small>
                    </div>
                    <h2 class="card-title fw-bold mt-3 mb-3">
                        <a href="{{ route('artikel.show', $featuredArticle->slug) }}" class="text-decoration-none text-dark">{{ $featuredArticle->title }}</a>
                    </h2>
                    <p class="card-text text-muted mb-4">{{ Str::limit($featuredArticle->excerpt ?? strip_tags($featuredArticle->content), 120) }}</p>
                    <a href="{{ route('artikel.show', $featuredArticle->slug) }}" class="btn btn-outline-primary rounded-pill px-4">Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Articles Grid -->
    <div class="row g-4">
        @forelse($articles as $article)
            <!-- Skip featured article in list if we are on page 1 without search/category -->
            @if(isset($featuredArticle) && $featuredArticle->id == $article->id && !request('page') && !request('search') && !request('category'))
                @continue
            @endif
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden article-card transition-hover">
                    <div class="position-relative" style="height: 200px;">
                        @if($article->featured_image)
                            <img src="{{ Storage::url($article->featured_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $article->title }}">
                        @else
                            <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">{{ $article->category ?? 'Umum' }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small">
                            <i class="bi bi-calendar3 me-1"></i> {{ $article->published_at->format('d M Y') }} &bull; 
                            <i class="bi bi-clock me-1"></i> {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                        </div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="{{ route('artikel.show', $article->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($article->title, 60) }}</a>
                        </h5>
                        <p class="card-text text-muted mb-4 flex-grow-1">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 90) }}</p>
                        <a href="{{ route('artikel.show', $article->slug) }}" class="text-primary fw-semibold text-decoration-none d-inline-flex align-items-center mt-auto">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-journal-x display-1 text-muted mb-3 d-block"></i>
                <h4 class="text-muted">Tidak ada artikel ditemukan.</h4>
                <a href="{{ route('artikel.index') }}" class="btn btn-primary rounded-pill px-4 mt-3">Kembali</a>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $articles->links() }}
    </div>
</main>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .article-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
