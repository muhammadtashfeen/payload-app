<?php

namespace Tests\Feature;

use App\Jobs\ProcessEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_accepts_an_event_and_queues_processing(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/events', [
            'type' => 'signup',
            'payload' => ['user_id' => 1],
        ]);

        $response->assertStatus(202)->assertJsonStructure(['id']);
        $this->assertDatabaseCount('events', 1);
        Queue::assertPushed(ProcessEvent::class);
    }

    public function test_it_rejects_invalid_input(): void
    {
        $this->postJson('/api/events', [])->assertStatus(422);
    }
}
