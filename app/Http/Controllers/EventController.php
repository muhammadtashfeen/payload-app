<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEvent;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'type' => ['required', 'string', 'max:100'],
            'payload' => ['required', 'array'],
        ]);

        $event = Event::create($data);

        ProcessEvent::dispatch($event->id);

        return response()->json(['id' => $event->id], 202);
    }
}
