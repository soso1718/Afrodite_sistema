<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::where('user_id', auth()->id())
        ->whereBetween('date', [$request->start, $request->end])
        ->get()
        ->map(function ($event) {
            return [
                'id'    => $event->id,
                'title' => $event->title,   
                'start' => $event->date,   
                'color' => '#f87171',
            ];
        });

    return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    // Menstruação (7 dias)
    for ($i = 0; $i < 7; $i++) {
        Event::create([
            'user_id' => $userId,
            'date' => $inicio->copy()->addDays($i)->toDateString(),
            'title' => 'Menstruação'
        ]);
    }

    // Ovulação (+14 dias)
    $ovulacao = $inicio->copy()->addDays(14);
    Event::create([
        'user_id' => $userId,
        'date' => $ovulacao->toDateString(),
        'title' => 'Ovulação'
    ]);

    // Período fértil (-3 até +3 dias)
    for ($i = -3; $i <= 3; $i++) {
        Event::create([
            'user_id' => $userId,
            'date' => $ovulacao->copy()->addDays($i)->toDateString(),
            'title' => 'Período fértil'
        ]);
    }

    return response()->json(['success' => true]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
