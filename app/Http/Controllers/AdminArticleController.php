<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $articles = $query->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,review,scheduled,published,archived',
            'category' => 'nullable|string|max:100',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        
        // Ensure slug is unique if generated from title
        if (!$request->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (Article::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('articles', 'public');
        }

        // Tags parsing (comma separated to array)
        $tags = null;
        if ($request->tags) {
            $tags = array_map('trim', explode(',', $request->tags));
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content, // Cleaned/Sanitized via blade or model if necessary
            'featured_image' => $featuredImagePath,
            'category' => $request->category,
            'tags' => $tags,
            'author' => auth()->user()->name ?? 'Admin',
            'status' => $request->status,
            'source' => 'manual',
            'seo_title' => $request->seo_title ?? $request->title,
            'seo_description' => $request->seo_description ?? $request->excerpt,
            'published_at' => $request->status === 'published' ? ($request->published_at ?? now()) : null,
            'scheduled_at' => $request->status === 'scheduled' ? $request->scheduled_at : null,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,review,scheduled,published,archived',
            'category' => 'nullable|string|max:100',
        ]);

        $featuredImagePath = $article->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($featuredImagePath && Storage::disk('public')->exists($featuredImagePath)) {
                Storage::disk('public')->delete($featuredImagePath);
            }
            $featuredImagePath = $request->file('featured_image')->store('articles', 'public');
        }

        $tags = null;
        if ($request->tags) {
            $tags = array_map('trim', explode(',', $request->tags));
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $featuredImagePath,
            'category' => $request->category,
            'tags' => $tags,
            'status' => $request->status,
            'seo_title' => $request->seo_title ?? $request->title,
            'seo_description' => $request->seo_description ?? $request->excerpt,
            'published_at' => $request->status === 'published' ? ($request->published_at ?? $article->published_at ?? now()) : null,
            'scheduled_at' => $request->status === 'scheduled' ? $request->scheduled_at : null,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
            Storage::disk('public')->delete($article->featured_image);
        }
        $article->delete();
        
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
