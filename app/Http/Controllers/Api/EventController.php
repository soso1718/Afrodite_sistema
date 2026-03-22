<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::where('user_id', $request->user()->id)
            ->get()
            ->map(function ($event) {
                return [
                    'start'   => $event->date,
                    'display' => 'background',
                    'color'   => '#f87171',
                ];
            });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $jaExiste = Event::where('user_id', $request->user()->id)
                         ->where('date', $request->date)
                         ->exists();

        if ($jaExiste) {
            return response()->json(['success' => false, 'message' => 'Data já marcada!']);
        }

        $event = Event::create([
            'date'    => $request->date,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['success' => true, 'event' => $event]);
    }
}