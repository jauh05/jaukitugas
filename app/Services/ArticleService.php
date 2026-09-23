<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ArticleService
{
    /**
     * Create a new article
     */
    public function createArticle(array $data, ?UploadedFile $featuredImage = null, string $source = 'manual'): Article
    {
        $data['slug'] = $this->generateUniqueSlug($data['slug'] ?? $data['title']);
        $data['source'] = $source;
        $data['author'] = $data['author'] ?? (auth()->check() ? auth()->user()->name : 'Admin');
        
        $data = $this->prepareData($data);
        
        if ($featuredImage) {
            $data['featured_image'] = $featuredImage->store('articles', 'public');
        }

        return Article::create($data);
    }

    /**
     * Update an existing article
     */
    public function updateArticle(Article $article, array $data, ?UploadedFile $featuredImage = null): Article
    {
        if (isset($data['slug']) && $data['slug'] !== $article->slug) {
            $data['slug'] = $this->generateUniqueSlug($data['slug'], $article->id);
        }

        $data = $this->prepareData($data, $article);
        
        if ($featuredImage) {
            if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $data['featured_image'] = $featuredImage->store('articles', 'public');
        }

        $article->update($data);
        
        return $article->fresh();
    }

    /**
     * Publish an article
     */
    public function publishArticle(Article $article): Article
    {
        $article->update([
            'status' => 'published',
            'published_at' => $article->published_at ?? now(),
            'scheduled_at' => null,
        ]);
        
        return $article->fresh();
    }
    
    /**
     * Schedule an article
     */
    public function scheduleArticle(Article $article, string $scheduledAt): Article
    {
        $article->update([
            'status' => 'scheduled',
            'scheduled_at' => $scheduledAt,
        ]);
        
        return $article->fresh();
    }

    /**
     * Delete an article and its featured image
     */
    public function deleteArticle(Article $article): void
    {
        if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
            Storage::disk('public')->delete($article->featured_image);
        }
        $article->delete();
    }

    /**
     * Prepare data array, format tags, statuses, sanitization etc.
     */
    protected function prepareData(array $data, ?Article $existingArticle = null): array
    {
        // Parse tags
        if (isset($data['tags'])) {
            if (is_string($data['tags'])) {
                $data['tags'] = array_map('trim', explode(',', $data['tags']));
            } elseif (is_array($data['tags'])) {
                // Keep it array
            } else {
                $data['tags'] = null;
            }
        }

        // Sanitize content
        if (isset($data['content'])) {
            $data['content'] = $this->sanitizeHtml($data['content']);
        }

        // Handle published/scheduled logic based on status
        if (isset($data['status'])) {
            if ($data['status'] === 'published') {
                $data['published_at'] = $data['published_at'] ?? ($existingArticle ? $existingArticle->published_at : null) ?? now();
                $data['scheduled_at'] = null;
            } elseif ($data['status'] === 'scheduled') {
                // scheduled_at is expected to be passed in $data
            }
        }
        
        // SEO fallbacks
        if (isset($data['title']) && empty($data['seo_title'])) {
            $data['seo_title'] = $data['title'];
        }
        if (isset($data['excerpt']) && empty($data['seo_description'])) {
            $data['seo_description'] = $data['excerpt'];
        }

        return $data;
    }

    /**
     * Generate a unique slug
     */
    protected function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        $query = Article::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
            $query = Article::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }
    
    /**
     * Clean dangerous HTML tags and attributes
     */
    public function sanitizeHtml(string $html): string
    {
        // For basic sanitization, we'll strip unallowed tags and clean out javascript: urls.
        $allowedTags = '<p><br><h1><h2><h3><h4><h5><h6><strong><b><em><i><u><ul><ol><li><blockquote><table><thead><tbody><tr><td><th><a><img>';
        
        // Strip out tags not in the allowed list
        $clean = strip_tags($html, $allowedTags);
        
        // Remove on* attributes like onload, onerror, onclick
        $clean = preg_replace('/on[a-z]+\s*=\s*(["\']).*?\1/i', '', $clean);
        
        // Remove javascript: from href or src
        $clean = preg_replace('/(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*?\2/i', '$1=""', $clean);
        
        return $clean;
    }
}
