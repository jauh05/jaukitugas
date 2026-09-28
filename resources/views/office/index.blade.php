<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living AI Office</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="office-shell">
    @php
        $tone = [
            'queued' => 'amber',
            'claimed' => 'sky',
            'running' => 'emerald',
            'completed' => 'stone',
            'failed' => 'rose',
        ];
    @endphp

    <main class="office-page">
        <section class="office-hero" id="overview">
            <div>
                <p class="eyebrow">Living AI Office</p>
                <h1>Operations floor untuk agent lifecycle nyata.</h1>
                <p class="hero-copy">Pantau pekerjaan dari queued, claimed, running, sampai completed atau failed tanpa menyentuh credential, Nginx, Cloudflare, Kauiz, atau worker yang sudah sehat.</p>
            </div>
            <div class="hero-card">
                <span>Live backend lifecycle</span>
                <strong>{{ $stats['active'] }}</strong>
                <small>active agents now</small>
            </div>
        </section>

        <nav class="office-tabs" aria-label="Office views">
            <a href="#overview">Overview</a>
            <a href="#kanban">Kanban</a>
            <a href="#agents">Agents</a>
            <a href="#activity">Activity</a>
        </nav>

        <section class="overview-grid" aria-label="Overview metrics">
            <article><span>Total tasks</span><strong>{{ $stats['total'] }}</strong></article>
            <article><span>Active</span><strong>{{ $stats['active'] }}</strong></article>
            <article><span>Completed</span><strong>{{ $stats['completed'] }}</strong></article>
            <article><span>Failed</span><strong>{{ $stats['failed'] }}</strong></article>
        </section>

        <section class="panel" id="kanban">
            <div class="section-heading">
                <p class="eyebrow">Kanban</p>
                <h2>queued -> claimed -> running -> completed / failed</h2>
            </div>
            <div class="kanban-board">
                @foreach($columns as $status => $items)
                    <article class="kanban-column {{ $tone[$status] }}">
                        <header>
                            <span>{{ $status }}</span>
                            <strong>{{ $items->count() }}</strong>
                        </header>
                        <div class="task-stack">
                            @forelse($items as $item)
                                <div class="task-card">
                                    <div class="task-topline">
                                        <span>{{ $item->agent_name ?: 'Unassigned' }}</span>
                                        <time>{{ \Illuminate\Support\Carbon::parse($item->updated_at)->diffForHumans() }}</time>
                                    </div>
                                    <h3>{{ $item->title }}</h3>
                                    <p>{{ $item->summary ?: 'No summary available yet.' }}</p>
                                </div>
                            @empty
                                <div class="empty-card">No {{ $status }} work right now.</div>
                            @endforelse
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="two-column">
            <div class="panel" id="agents">
                <div class="section-heading">
                    <p class="eyebrow">Agents</p>
                    <h2>Agent presence</h2>
                </div>
                <div class="agent-list">
                    @foreach($agents as $agent)
                        <article>
                            <div class="agent-avatar">{{ strtoupper(substr($agent->name, 0, 2)) }}</div>
                            <div>
                                <strong>{{ $agent->name }}</strong>
                                <span>{{ $agent->task_count }} tasks - {{ $agent->status }}</span>
                            </div>
                            <time>{{ \Illuminate\Support\Carbon::parse($agent->last_seen)->diffForHumans() }}</time>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="panel" id="activity">
                <div class="section-heading">
                    <p class="eyebrow">Activity</p>
                    <h2>Recent handoffs</h2>
                </div>
                <div class="activity-list">
                    @foreach($activity as $event)
                        <article>
                            <span class="activity-dot {{ $tone[$event->lifecycle_status] }}"></span>
                            <div>
                                <strong>{{ $event->title }}</strong>
                                <p>{{ $event->agent_name ?: 'Unassigned' }} moved to {{ $event->lifecycle_status }}</p>
                            </div>
                            <time>{{ \Illuminate\Support\Carbon::parse($event->updated_at)->format('H:i') }}</time>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</body>
</html>
