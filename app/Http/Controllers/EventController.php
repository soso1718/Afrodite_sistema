<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Event::all());
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
        try {
            $events = $request->all();
            
            // Limpa eventos existentes
            \App\Models\Event::truncate();
            
            // Salva novos eventos
            foreach ($events as $eventData) {
                \App\Models\Event::create([
                    'title' => $eventData['title'],
                    'start' => $eventData['start'],
                    'end' => $eventData['end'] ?? null,
                ]);
            }
            
            return response()->json(['success' => true, 'message' => 'Eventos salvos com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
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
