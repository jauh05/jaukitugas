<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternalArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    protected function formatResponse(bool $success, string $message, $data = null, int $code = 200)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        
        if ($data !== null) {
            if ($success) {
                $response['data'] = reset($data) === false && count($data) === 1 ? $data[0] : $data;
            } else {
                $response['errors'] = reset($data) === false && count($data) === 1 ? $data[0] : $data;
            }
        }

        return response()->json($response, $code);
    }
    
    protected function formatArticle(Article $article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'slug' => $article->slug,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'category' => $article->category,
            'tags' => $article->tags,
            'status' => $article->status,
            'source' => $article->source,
            'featured_image' => $article->featured_image ? url(Storage::url($article->featured_image)) : null,
            'seo_title' => $article->seo_title,
            'seo_description' => $article->seo_description,
            'published_at' => $article->published_at ? $article->published_at->toDateTimeString() : null,
            'scheduled_at' => $article->scheduled_at ? $article->scheduled_at->toDateTimeString() : null,
            'url' => route('artikel.show', $article->slug),
        ];
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'status' => 'required|in:draft,review,scheduled,published',
            'scheduled_at' => 'required_if:status,scheduled|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->formatResponse(false, 'Validation failed', $validator->errors(), 422);
        }

        try {
            $article = $this->articleService->createArticle(
                $request->except('featured_image'),
                $request->file('featured_image'),
                'telegram'
            );

            return $this->formatResponse(true, 'Article created successfully', $this->formatArticle($article), 201);
        } catch (\Exception $e) {
            return $this->formatResponse(false, 'Failed to create article: ' . $e->getMessage(), null, 500);
        }
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->formatResponse(false, 'Article not found', null, 404);
        }

        return $this->formatResponse(true, 'Article retrieved successfully', $this->formatArticle($article), 200);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->formatResponse(false, 'Article not found', null, 404);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'status' => 'nullable|in:draft,review,scheduled,published',
            'scheduled_at' => 'required_if:status,scheduled|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->formatResponse(false, 'Validation failed', $validator->errors(), 422);
        }

        try {
            $article = $this->articleService->updateArticle(
                $article,
                $request->except('featured_image'),
                $request->file('featured_image')
            );

            return $this->formatResponse(true, 'Article updated successfully', $this->formatArticle($article), 200);
        } catch (\Exception $e) {
            return $this->formatResponse(false, 'Failed to update article: ' . $e->getMessage(), null, 500);
        }
    }

    public function publish($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->formatResponse(false, 'Article not found', null, 404);
        }

        try {
            $article = $this->articleService->publishArticle($article);
            return $this->formatResponse(true, 'Article published successfully', $this->formatArticle($article), 200);
        } catch (\Exception $e) {
            return $this->formatResponse(false, 'Failed to publish article: ' . $e->getMessage(), null, 500);
        }
    }

    public function schedule(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->formatResponse(false, 'Article not found', null, 404);
        }

        $validator = \Validator::make($request->all(), [
            'scheduled_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->formatResponse(false, 'Validation failed', $validator->errors(), 422);
        }

        try {
            $article = $this->articleService->scheduleArticle($article, $request->scheduled_at);
            return $this->formatResponse(true, 'Article scheduled successfully', $this->formatArticle($article), 200);
        } catch (\Exception $e) {
            return $this->formatResponse(false, 'Failed to schedule article: ' . $e->getMessage(), null, 500);
        }
    }
}
