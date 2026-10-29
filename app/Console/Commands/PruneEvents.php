<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PruneEvents extends Command
{
    protected $signature = 'events:prune {--days=30}';

    protected $description = 'Delete processed events older than N days';

    public function handle(): int
    {
        $deleted = \App\Models\Event::query()
            ->whereNotNull('processed_at')
            ->where('processed_at', '<', now()->subDays((int) $this->option('days')))
            ->delete();

        $this->info("Deleted {$deleted} events");

        return self::SUCCESS;
    }
}
