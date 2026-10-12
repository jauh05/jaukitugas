@extends('material.dash')

@section('temp')
<header class="container py-4 mt-2 position-relative overflow-hidden">
    <div class="row align-items-center g-lg-5 g-4 py-lg-4 py-2">
        <div class="col-lg-12 text-center">
            <span class="jt-eyebrow mb-2">Blog & Update</span>
            <h1 class="display-4 fw-bold mb-3 text-premium-dark">Artikel & <span class="text-jt-orange">Insight</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Temukan tips akademik, panduan penelitian, tutorial statistik, hingga perkembangan teknologi terkini.
            </p>

            <form action="{{ route('artikel.index') }}" method="GET" class="mx-auto mt-4" style="max-width: 500px;">
                <div class="input-group glass-card p-1">
                    <input type="text" name="search" class="form-control border-0 bg-transparent rounded-start-pill py-3 px-4 shadow-none" placeholder="Cari artikel..." value="{{ request('search') }}">
                    <button class="btn btn-premium rounded-pill px-4" type="submit"><i class="bi bi-search"></i></button>
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
    <div class="glass-card overflow-hidden mb-5 p-0">
        <div class="row g-0">
            <div class="col-md-7">
                <div style="min-height: 340px; height: 100%;">
                    @if($featuredArticle->featured_image)
                        <img src="{{ $featuredArticle->featured_image_url }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $featuredArticle->title }}" style="min-height: 340px;">
                    @else
                        @include('partials.article-cover', ['article' => $featuredArticle])
                    @endif
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5">
                    <div class="mb-2">
                        <span class="jt-chip py-1">{{ $featuredArticle->category ?? 'Umum' }}</span>
                        <small class="text-muted ms-2"><i class="bi bi-calendar3 me-1"></i> {{ $featuredArticle->published_at->format('d M Y') }}</small>
                    </div>
                    <h2 class="card-title fw-bold mt-3 mb-3">
                        <a href="{{ route('artikel.show', $featuredArticle->slug) }}" class="text-decoration-none text-jt-brown">{{ $featuredArticle->title }}</a>
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
                <div class="glass-card h-100 overflow-hidden article-card">
                    <div class="position-relative p-3 pb-0">
                        <div class="jt-arch" style="height: 210px;">
                            @if($article->featured_image)
                                <img src="{{ $article->featured_image_url }}" class="jt-cover" alt="{{ $article->title }}">
                            @else
                                @include('partials.article-cover', ['article' => $article])
                            @endif
                        </div>
                        <div class="position-absolute top-0 end-0 m-4">
                            <span class="jt-chip">{{ $article->category ?? 'Umum' }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-2 text-muted small">
                            <i class="bi bi-calendar3 me-1"></i> {{ $article->published_at->format('d M Y') }} &bull;
                            <i class="bi bi-clock me-1"></i> {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                        </div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="{{ route('artikel.show', $article->slug) }}" class="text-decoration-none text-jt-brown">{{ Str::limit($article->title, 60) }}</a>
                        </h5>
                        <p class="card-text text-muted mb-4 flex-grow-1">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 90) }}</p>
                        <a href="{{ route('artikel.show', $article->slug) }}" class="text-jt-orange fw-semibold text-decoration-none d-inline-flex align-items-center mt-auto">
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
        transform: translateY(-6px);
    }
</style>
@endsection
