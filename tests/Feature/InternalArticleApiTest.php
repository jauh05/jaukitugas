<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Article;

class InternalArticleApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set up the token
        putenv('CONTENT_BOT_TOKEN=test-token-123');
        config(['app.env' => 'testing']);
    }

    protected function getHeaders()
    {
        return [
            'Authorization' => 'Bearer test-token-123',
            'Accept' => 'application/json',
        ];
    }

    public function test_create_article_without_image()
    {
        $response = $this->postJson('/api/internal/articles', [
            'title' => 'Test Article',
            'content' => '<p>Hello</p>',
            'status' => 'draft'
        ], $this->getHeaders());

        $response->assertStatus(201)
                 ->assertJsonPath('success', true)
                 ->assertJsonPath('data.source', 'telegram');
                 
        $this->assertDatabaseHas('articles', [
            'title' => 'Test Article',
            'source' => 'telegram'
        ]);
    }

    public function test_create_article_with_valid_jpeg()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->postJson('/api/internal/articles', [
            'title' => 'Test Article JPEG',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'featured_image' => $file
        ], $this->getHeaders());

        $response->assertStatus(201);
        $article = Article::first();
        $this->assertNotNull($article->featured_image);
        Storage::disk('public')->assertExists($article->featured_image);
        
        $this->assertTrue(\Illuminate\Support\Str::contains($response->json('data.featured_image'), 'storage/articles/'));
    }

    public function test_create_article_with_valid_png()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('test.png');

        $response = $this->postJson('/api/internal/articles', [
            'title' => 'Test Article PNG',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'featured_image' => $file
        ], $this->getHeaders());

        $response->assertStatus(201);
    }

    public function test_create_article_with_invalid_file()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->postJson('/api/internal/articles', [
            'title' => 'Test Article Invalid',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'featured_image' => $file
        ], $this->getHeaders());

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['featured_image']);
    }

    public function test_create_article_with_large_image()
    {
        Storage::fake('public');

        // Create 3MB file
        $file = UploadedFile::fake()->image('large.jpg')->size(3000);

        $response = $this->postJson('/api/internal/articles', [
            'title' => 'Test Article Large',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'featured_image' => $file
        ], $this->getHeaders());

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['featured_image']);
    }

    public function test_get_article_api_image_valid_and_null_safe()
    {
        $article = Article::create([
            'title' => 'Test',
            'slug' => 'test',
            'content' => 'Test',
            'status' => 'draft',
            'source' => 'telegram',
            'featured_image' => null
        ]);

        $response = $this->getJson('/api/internal/articles/' . $article->id, $this->getHeaders());
        
        $response->assertStatus(200)
                 ->assertJsonPath('data.featured_image', null);

        $article->update(['featured_image' => 'https://example.com/external.jpg']);
        $response = $this->getJson('/api/internal/articles/' . $article->id, $this->getHeaders());
        
        $response->assertStatus(200)
                 ->assertJsonPath('data.featured_image', 'https://example.com/external.jpg');
    }

    public function test_homepage_only_shows_latest_published()
    {
        Article::create(['title' => 'Draft', 'slug' => 'draft', 'content' => 'x', 'status' => 'draft', 'published_at' => now()]);
        Article::create(['title' => 'Published 1', 'slug' => 'pub-1', 'content' => 'x', 'status' => 'published', 'published_at' => now()->subDays(1)]);
        Article::create(['title' => 'Published 2', 'slug' => 'pub-2', 'content' => 'x', 'status' => 'published', 'published_at' => now()]);
        Article::create(['title' => 'Archived', 'slug' => 'archived', 'content' => 'x', 'status' => 'archived', 'published_at' => now()]);

        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertSee('Published 1');
        $response->assertSee('Published 2');
        $response->assertDontSee('Draft');
        $response->assertDontSee('Archived');
    }
}
