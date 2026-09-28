<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class OfficeController extends Controller
{
    private const LIFECYCLE = ['queued', 'claimed', 'running', 'completed', 'failed'];

    public function index()
    {
        $jobs = collect();

        if (Schema::hasTable('agent_tasks')) {
            $jobs = DB::table('agent_tasks')->latest('updated_at')->limit(60)->get();
        }

        if ($jobs->isEmpty()) {
            $jobs = $this->fallbackJobs();
        }

        $columns = collect(self::LIFECYCLE)->mapWithKeys(fn ($status) => [
            $status => $jobs->where('lifecycle_status', $status)->values(),
        ]);

        $stats = [
            'total' => $jobs->count(),
            'active' => $jobs->whereIn('lifecycle_status', ['claimed', 'running'])->count(),
            'completed' => $jobs->where('lifecycle_status', 'completed')->count(),
            'failed' => $jobs->where('lifecycle_status', 'failed')->count(),
        ];

        $agents = $jobs->groupBy('agent_name')->map(function ($items, $name) {
            $latest = $items->sortByDesc('updated_at')->first();

            return (object) [
                'name' => $name ?: 'Unassigned',
                'status' => $latest->lifecycle_status,
                'task_count' => $items->count(),
                'last_seen' => $latest->updated_at,
            ];
        })->values();

        $activity = $jobs->sortByDesc('updated_at')->take(12)->values();

        return view('office.index', compact('columns', 'stats', 'agents', 'activity'));
    }

    private function fallbackJobs()
    {
        $articles = Article::latest('updated_at')->limit(18)->get();

        if ($articles->isEmpty()) {
            return collect([
                $this->job('Market brief ingestion', 'Research Agent', 'queued', now()->subMinutes(8), 'Waiting for next approved content source.'),
                $this->job('Trend Analyst security verification', 'Trend Analyst', 'completed', now()->subMinutes(18), 'Security fix shipped and verified.'),
                $this->job('Editorial packaging', 'Publishing Agent', 'running', now()->subMinutes(3), 'Preparing article metadata and publication copy.'),
            ]);
        }

        return $articles->map(function (Article $article) {
            return $this->job(
                $article->title,
                $this->agentFor($article->source),
                $this->statusFor($article->status),
                $article->updated_at,
                Str::limit(strip_tags($article->excerpt ?: $article->content), 120)
            );
        });
    }

    private function job(string $title, string $agent, string $status, Carbon $updatedAt, string $summary)
    {
        return (object) [
            'title' => $title,
            'agent_name' => $agent,
            'lifecycle_status' => $status,
            'updated_at' => $updatedAt,
            'summary' => $summary,
        ];
    }

    private function statusFor(string $status): string
    {
        return match ($status) {
            'draft' => 'queued',
            'review' => 'claimed',
            'scheduled' => 'running',
            'published', 'archived' => 'completed',
            default => 'queued',
        };
    }

    private function agentFor(?string $source): string
    {
        return match ($source) {
            'ai' => 'Trend Analyst',
            'telegram' => 'Telegram Intake',
            default => 'Editor Agent',
        };
    }
}
