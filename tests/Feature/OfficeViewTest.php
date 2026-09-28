<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfficeViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_office_view_renders_all_lifecycle_sections(): void
    {
        Article::create([
            'title' => 'Queued Draft',
            'slug' => 'queued-draft',
            'content' => 'Queued content',
            'status' => 'draft',
            'source' => 'ai',
        ]);

        Article::create([
            'title' => 'Running Scheduled',
            'slug' => 'running-scheduled',
            'content' => 'Running content',
            'status' => 'scheduled',
            'source' => 'telegram',
            'scheduled_at' => now()->addHour(),
        ]);

        Article::create([
            'title' => 'Completed Published',
            'slug' => 'completed-published',
            'content' => 'Completed content',
            'status' => 'published',
            'source' => 'manual',
            'published_at' => now(),
        ]);

        $this->get('/office')
            ->assertOk()
            ->assertSee('Living AI Office')
            ->assertSee('Overview')
            ->assertSee('Kanban')
            ->assertSee('Agents')
            ->assertSee('Activity')
            ->assertSee('queued')
            ->assertSee('claimed')
            ->assertSee('running')
            ->assertSee('completed')
            ->assertSee('failed')
            ->assertSee('Queued Draft')
            ->assertSee('Running Scheduled')
            ->assertSee('Completed Published');
    }
}
