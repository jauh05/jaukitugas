<?php

namespace App\Console\Commands;

use App\Models\OfficeContentItem;
use App\Services\OfficeRegistry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportOfficeKonten extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'office:import-konten
        {file : Path file JSON berisi daftar konten}
        {--platform=instagram : Platform tujuan: instagram atau tiktok}
        {--agent=jauki-social : agent_id yang terdaftar di OfficeRegistry}
        {--content-type=reel : Jenis konten, misalnya reel}
        {--dry-run : Cek dan tampilkan ringkasan tanpa menyimpan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor konten (overlay, caption, hashtags) ke Living AI Office. Aman diulang tanpa duplikat.';

    private const PLATFORMS = ['instagram', 'tiktok'];

    private const REQUIRED_KEYS = ['topic', 'overlay', 'caption', 'hashtags', 'mood'];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $platform = strtolower((string) $this->option('platform'));
        $agent = (string) $this->option('agent');
        $contentType = (string) $this->option('content-type');
        $path = (string) $this->argument('file');

        if (! in_array($platform, self::PLATFORMS, true)) {
            $this->error('Platform harus instagram atau tiktok.');
            return 1;
        }

        if (! array_key_exists($agent, OfficeRegistry::agents())) {
            $this->error("agent_id {$agent} tidak terdaftar di OfficeRegistry.");
            return 1;
        }

        if (! is_file($path)) {
            $this->error("File tidak ditemukan: {$path}");
            return 1;
        }

        $rows = json_decode((string) file_get_contents($path), true);
        if (! is_array($rows) || ! array_is_list($rows)) {
            $this->error('File harus berupa daftar JSON (array di level teratas).');
            return 1;
        }

        $errors = $this->validateRows($rows);
        if ($errors) {
            foreach (array_slice($errors, 0, 10) as $error) {
                $this->error($error);
            }
            $this->error(count($errors).' kesalahan. Tidak ada yang disimpan.');
            return 1;
        }

        $source = basename($path);
        $created = 0;
        $updated = 0;

        $save = function () use ($rows, $platform, $agent, $contentType, $source, &$created, &$updated) {
            foreach ($rows as $row) {
                $title = trim($row['overlay']);
                $text = trim($row['caption'])."\n\n".implode(' ', $row['hashtags']);
                $key = $this->deduplicationKey($agent, $platform, $contentType, $title, $text);

                $item = OfficeContentItem::firstOrNew(['deduplication_key' => $key]);
                $isNew = ! $item->exists;

                if ($this->option('dry-run')) {
                    $isNew ? $created++ : $updated++;
                    continue;
                }

                $item->fill([
                    'agent_id' => $agent,
                    'platform' => $platform,
                    'content_type' => $contentType,
                    'title' => $title,
                    'text' => $text,
                    'status' => $item->status ?? 'generated',
                    'metadata' => [
                        'topic' => $row['topic'],
                        'mood' => $row['mood'],
                        'hashtags' => $row['hashtags'],
                        'source' => $source,
                    ],
                    'generated_at' => $item->generated_at ?? now(),
                ]);
                $item->save();

                $isNew ? $created++ : $updated++;
            }
        };

        if ($this->option('dry-run')) {
            $save();
        } else {
            DB::transaction($save);
        }

        $this->table(['Item', 'Nilai'], [
            ['Platform', $platform],
            ['Agent', $agent],
            ['Content type', $contentType],
            ['Total item di file', count($rows)],
            ['Baru', $created],
            ['Sudah ada (diperbarui)', $updated],
            ['Mode', $this->option('dry-run') ? 'dry-run (tidak disimpan)' : 'tersimpan'],
        ]);

        if ($platform === 'tiktok') {
            $this->warn('Filter Living Office belum mengenal tiktok. Konten ini hanya muncul di tampilan "semua".');
        }

        return 0;
    }

    /**
     * Kumpulkan kesalahan validasi tanpa menyimpan apa pun.
     */
    private function validateRows(array $rows): array
    {
        $errors = [];

        foreach ($rows as $i => $row) {
            $n = $i + 1;

            if (! is_array($row)) {
                $errors[] = "item {$n}: bukan objek JSON";
                continue;
            }

            foreach (self::REQUIRED_KEYS as $key) {
                if (! array_key_exists($key, $row)) {
                    $errors[] = "item {$n}: field {$key} tidak ada";
                }
            }

            if (isset($row['overlay']) && (! is_string($row['overlay']) || trim($row['overlay']) === '')) {
                $errors[] = "item {$n}: overlay kosong";
            } elseif (isset($row['overlay']) && mb_strlen($row['overlay']) > 255) {
                $errors[] = "item {$n}: overlay lebih dari 255 karakter (batas kolom title)";
            }

            if (isset($row['caption']) && (! is_string($row['caption']) || trim($row['caption']) === '')) {
                $errors[] = "item {$n}: caption kosong";
            }

            if (isset($row['hashtags']) && (! is_array($row['hashtags']) || ! array_is_list($row['hashtags']))) {
                $errors[] = "item {$n}: hashtags harus berupa daftar";
            }
        }

        return $errors;
    }

    /**
     * Rumus sama dengan OfficeEventService, supaya impor dan webhook saling mengenali duplikat.
     */
    private function deduplicationKey(string $agent, string $platform, string $contentType, string $title, string $text): string
    {
        return hash('sha256', implode('|', [$agent, $platform, $contentType, '', $title, $text, '']));
    }
}
