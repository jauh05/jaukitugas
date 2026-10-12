@extends('material.dash')

@section('temp')
<!-- SEO Meta Tags -->
@section('meta_title', $article->seo_title ?? $article->title)
@section('meta_description', $article->seo_description ?? Str::limit(strip_tags($article->excerpt), 150))
@section('meta_image', $article->featured_image ? $article->featured_image_url : asset('asset/jlogo.svg'))

<main class="container py-5 mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}" class="text-decoration-none text-muted">Artikel</a></li>
            @if($article->category)
            <li class="breadcrumb-item"><a href="{{ route('artikel.index', ['category' => $article->category]) }}" class="text-decoration-none text-muted">{{ $article->category }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 30) }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Article Header -->
            <header class="mb-4">
                @if($article->category)
                <span class="jt-chip py-1 mb-3">{{ $article->category }}</span>
                @endif
                <h1 class="fw-bold mb-3 lh-base" style="font-size: 2.5rem; color: var(--jt-brown);">{{ $article->title }}</h1>

                <div class="d-flex align-items-center text-muted flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-jt-brown text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-person"></i>
                        </div>
                        <span class="fw-semibold text-jt-brown">{{ $article->author ?? 'Admin' }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar3 me-2"></i> {{ $article->published_at->format('d F Y') }}
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock me-2"></i> {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                    </div>

                    <!-- Share Actions -->
                    <div class="ms-auto d-flex gap-2">
                        <button onclick="copyLink()" class="btn btn-light rounded-circle shadow-sm" title="Copy Link"><i class="bi bi-link-45deg"></i></button>
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" class="btn btn-light rounded-circle shadow-sm text-success" title="Share WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <div class="mb-5 rounded-5 overflow-hidden shadow-sm" style="height: 420px;">
                @if($article->featured_image)
                    <img src="{{ $article->featured_image_url }}" class="w-100 h-100 object-fit-cover" alt="{{ $article->title }}">
                @else
                    @include('partials.article-cover', ['article' => $article])
                @endif
            </div>

            <!-- Article Content -->
            <article class="article-content" style="font-size: 1.1rem; line-height: 1.8; color: #5C3F36;">
                {!! $article->content !!}
            </article>

            <!-- Tags -->
            @if($article->tags)
            <div class="mt-5 pt-4 border-top">
                <h6 class="fw-bold mb-3"><i class="bi bi-tags me-2"></i> Tags:</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($article->tags as $tag)
                        <span class="jt-chip py-1">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- CTA Section -->
            <div class="jt-banner mt-5 p-4 p-md-5 text-center">
                <div class="jt-shape jt-shape--semi" style="--c: #46A375; top: -18px; right: 12%;"></div>
                <div class="jt-shape jt-shape--dot" style="--c: #F3C75F; bottom: 28px; left: 24px;"></div>
                <div class="jt-content">
                    <h3 class="fw-bold mb-3">Butuh bantuan mengerjakan tugas akademik atau analisis data?</h3>
                    <p class="mb-4">Jauki Tugas siap membantu Anda menyelesaikan berbagai tugas dengan cepat, tepat, dan terpercaya.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-premium rounded-pill px-4 py-2 fw-bold"><i class="bi bi-whatsapp me-2"></i> Konsultasi Sekarang</a>
                        <a href="/pricelist" class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold">Lihat Layanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <div class="row justify-content-center mt-5 pt-5 border-top">
        <div class="col-lg-10">
            <h4 class="fw-bold mb-4">Artikel Terkait</h4>
            <div class="row g-4">
                @foreach($relatedArticles as $rel)
                <div class="col-md-4">
                    <div class="glass-card h-100 overflow-hidden article-card">
                        <div class="p-3 pb-0">
                            <div class="jt-arch" style="height: 160px;">
                                @if($rel->featured_image)
                                    <img src="{{ $rel->featured_image_url }}" class="jt-cover" alt="{{ $rel->title }}">
                                @else
                                    @include('partials.article-cover', ['article' => $rel])
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="card-title fw-bold mb-2">
                                <a href="{{ route('artikel.show', $rel->slug) }}" class="text-decoration-none text-jt-brown">{{ Str::limit($rel->title, 50) }}</a>
                            </h6>
                            <small class="text-muted mb-0 mt-auto"><i class="bi bi-calendar3 me-1"></i> {{ $rel->published_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</main>

<style>
    .article-content h2, .article-content h3, .article-content h4 {
        color: var(--jt-brown);
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 1rem;
        margin: 1.5rem 0;
    }
    .article-content a {
        color: var(--jt-orange);
        text-decoration: none;
    }
    .article-content a:hover {
        text-decoration: underline;
    }
    .article-content blockquote {
        border-left: 4px solid var(--jt-orange);
        padding-left: 1.5rem;
        font-style: italic;
        color: #7D5F54;
        background: var(--jt-cream-light);
        padding: 1.5rem;
        border-radius: 0 1rem 1rem 0;
    }
    .article-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .article-card:hover {
        transform: translateY(-6px);
    }
</style>

<script>
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link artikel berhasil disalin!');
        });
    }
</script>
@endsection
