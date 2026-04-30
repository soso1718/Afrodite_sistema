<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $month = $request->input('month', now()->format('Y-m'));
        $date = \Carbon\Carbon::createFromFormat('Y-m', $month);

        // Busca eventos do mês atual
        $events = Event::where('user_id', auth()->id())
            ->whereMonth('date', $date->month)
            ->whereYear('date', $date->year)
            ->orderBy('date', 'desc')
            ->get();

        // Calcula meses anterior e seguinte (sempre ativos)
        $prevMonth = $date->copy()->subMonth()->format('Y-m');
        $nextMonth = $date->copy()->addMonth()->format('Y-m');

        return view('registros.index', compact('events', 'date', 'prevMonth', 'nextMonth'));
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
        //
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
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        return view('registros.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $event = Event::where('user_id', auth()->id())->findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'date'  => 'required|date',
    ]);

    $event->update($request->only('title','date'));

    // envia mensagem para o componente
    return redirect()->route('registros.index')
                     ->with('toast', 'Registro atualizado com sucesso!');
}

public function destroy(string $id)
{
    $event = Event::where('user_id', auth()->id())->findOrFail($id);
    $event->delete();

    // envia mensagem para o componente
    return redirect()->route('registros.index')
                     ->with('toast', 'Registro excluído com sucesso!');
}

}
