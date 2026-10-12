{{-- Cover artikel buatan sendiri (SVG) dipakai saat artikel belum punya featured_image --}}
@php
    $coverColors = [
        'Skripsi' => '#F3C75F',
        'Statistik' => '#46A375',
        'Akademik' => '#7CB1EB',
        'Teknologi' => '#E07540',
    ];
    $coverBg = $coverColors[$article->category ?? ''] ?? '#F4A6B8';
@endphp
<svg viewBox="0 0 400 300" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $article->title }}" class="d-block w-100 h-100">
    <rect width="400" height="300" fill="{{ $coverBg }}"/>
    <circle cx="330" cy="70" r="62" fill="#FFFFFF" opacity="0.25"/>
    <path d="M-30 300 A130 130 0 0 1 230 300 Z" fill="#532923"/>
    <circle cx="96" cy="110" r="24" fill="none" stroke="#FFFFFF" stroke-width="12"/>
    <rect x="170" y="150" width="200" height="34" rx="17" fill="#FEF4EB"/>
    <rect x="250" y="206" width="110" height="26" rx="13" fill="#FFFFFF" opacity="0.6"/>
</svg>
