<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->latest('published_at');
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }
        
        $articles = $query->paginate(9);
        
        // Get categories for filter (can be grouped from DB or predefined, we'll group from DB for flexibility)
        $categories = Article::published()->select('category')->distinct()->whereNotNull('category')->pluck('category');
        
        $featuredArticle = null;
        if (!$request->has('page') || $request->page == 1) {
            $featuredArticle = Article::published()->latest('published_at')->first();
            // Exclude the featured article from the main list on the first page if desired, 
            // but for simplicity we can leave it or filter it. We will leave it for now.
        }

        return view('articles.index', compact('articles', 'categories', 'featuredArticle'));
    }

    public function show($slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();
        
        // Related articles by category
        $relatedArticles = Article::published()
                            ->where('category', $article->category)
                            ->where('id', '!=', $article->id)
                            ->latest('published_at')
                            ->take(3)
                            ->get();
                            
        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
