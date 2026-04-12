<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::where('user_id', auth()->id())
            ->whereBetween('date', [$request->start, $request->end])
            ->get()
            ->map(function ($event) {
                $color = match($event->title) {
                    'Menstruação'    => '#f08c8c',
                    'Ovulação'       => '#e42615',
                    'Período fértil' => '#fc5849',
                    default          => '#f08c8c',
                };

                return [
                    'id'              => $event->id,
                    'title'           => '',
                    'start'           => $event->date,
                    'display'         => 'background',
                    'backgroundColor' => $color,
                    'borderColor'     => $color,
                ];
            });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $userId = auth()->id();
        $inicio = Carbon::parse($request->date)->startOfDay();

        $jaExiste = Event::where('user_id', $userId)
            ->whereDate('date', $inicio)
            ->exists();

        if ($jaExiste) {
            return response()->json([
                'success' => false,
                'message' => 'Data já marcada!'
            ]);
        }

        // Menstruação — 7 dias
        for ($i = 0; $i < 7; $i++) {
            Event::create([
                'user_id' => $userId,
                'date'    => $inicio->copy()->addDays($i)->toDateString(),
                'title'   => 'Menstruação'
            ]);
        }

        // Ovulação — dia 14
        $ovulacao = $inicio->copy()->addDays(14);
        Event::create([
            'user_id' => $userId,
            'date'    => $ovulacao->toDateString(),
            'title'   => 'Ovulação'
        ]);

        // Período fértil — pula o dia da ovulação (i === 0)
        for ($i = -3; $i <= 3; $i++) {
            if ($i === 0) continue; // ✅ ovulação tem prioridade

            Event::create([
                'user_id' => $userId,
                'date'    => $ovulacao->copy()->addDays($i)->toDateString(),
                'title'   => 'Período fértil'
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}