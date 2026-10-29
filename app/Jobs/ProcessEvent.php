<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessEvent implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $eventId)
    {
    }

    public function handle(): void
    {
        $event = Event::find($this->eventId);

        if ($event === null) {
            return;
        }

        $event->update(['processed_at' => now()]);

        Log::info('Processed event', ['id' => $event->id, 'type' => $event->type]);
    }
}
