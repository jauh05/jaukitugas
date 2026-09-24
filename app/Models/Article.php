<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'author',
        'status',
        'source',
        'seo_title',
        'seo_description',
        'published_at',
        'scheduled_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    // Scopes for easy querying
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    /**
     * Get the normalized public URL for the featured image.
     */
    public function getFeaturedImageUrlAttribute()
    {
        $path = $this->featured_image;

        if (empty($path)) {
            return null;
        }

        // Jika sudah URL external lengkap
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // Jika diawali dengan /storage/, kita hapus agar aman dipass ke Storage::url atau cukup gunakan asset()
        if (\Illuminate\Support\Str::startsWith($path, '/storage/')) {
            $path = substr($path, 9); // hapus '/storage/'
        }
        
        if (\Illuminate\Support\Str::startsWith($path, 'storage/')) {
            $path = substr($path, 8); // hapus 'storage/'
        }

        // Return full public URL
        return url(\Illuminate\Support\Facades\Storage::url($path));
    }
}
