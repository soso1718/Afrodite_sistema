<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $firstDay = Event::where('user_id', $userId)
            ->where('title', 'Menstruação')
            ->orderBy('date', 'asc')
            ->first();

        $events = collect();

        if ($firstDay) {
            $inicio = Carbon::parse($firstDay->date)->startOfDay();
            $events = $this->gerarProjecoes($inicio, $userId);
            $events->prepend([
                'id'              => $firstDay->id,
                'title'           => '',
                'start'           => $firstDay->date,
                'display'         => 'background',
                'backgroundColor' => '#f08c8c',
                'borderColor'     => '#f08c8c',
                'extendedProps'   => ['isProjecao' => false],
            ]);
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate(['date' => 'required|date']);

    $userId = auth()->id();
    $data = Carbon::parse($request->date)->toDateString();

    // Verifica se já existe esse dia como real
    $exists = Event::where('user_id', $userId)
        ->where('date', $data)
        ->where('title', 'Menstruação')
        ->exists();

    if (!$exists) {
        Event::create([
            'user_id' => $userId,
            'date'    => $data,
            'title'   => 'Menstruação'
        ]);
    }

    return response()->json(['success' => true]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate(['date' => 'required|date']);
        $event = Event::findOrFail($id);

        $event->update([
            'date' => Carbon::parse($request->date)->toDateString()
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['success' => true]);
    }

    private function gerarProjecoes(Carbon $dum, $userId, $duracaoCiclo = 28, $meses = 6)
    {
        $eventos = collect();

        // Menstruação projetada (dias seguintes)
        for ($i = 1; $i < 7; $i++) {
            $eventos->push([
                'id'              => uniqid(),
                'title'           => '',
                'start'           => $dum->copy()->addDays($i)->toDateString(),
                'display'         => 'background',
                'backgroundColor' => '#f08c8c',
                'borderColor'     => '#f08c8c',
                'extendedProps'   => ['isProjecao' => true],
            ]);
        }

        // Ovulação
        $ovulacao = $dum->copy()->addDays(14);
        $eventos->push([
            'id'              => uniqid(),
            'title'           => '',
            'start'           => $ovulacao->toDateString(),
            'display'         => 'background',
            'backgroundColor' => '#e42615',
            'borderColor'     => '#e42615',
            'extendedProps'   => ['isProjecao' => true],
        ]);

        // Período fértil
        for ($i = -3; $i <= 3; $i++) {
            if ($i === 0) continue;
            $eventos->push([
                'id'              => uniqid(),
                'title'           => '',
                'start'           => $ovulacao->copy()->addDays($i)->toDateString(),
                'display'         => 'background',
                'backgroundColor' => '#fc5849',
                'borderColor'     => '#fc5849',
                'extendedProps'   => ['isProjecao' => true],
            ]);
        }

        // Meses seguintes
        for ($ciclo = 1; $ciclo <= $meses; $ciclo++) {
            $proxMens = $dum->copy()->addDays($duracaoCiclo * $ciclo);
            $ovulacaoProj = $proxMens->copy()->subDays(14);

            for ($d = 0; $d < 7; $d++) {
                $eventos->push([
                    'id'              => uniqid(),
                    'title'           => '',
                    'start'           => $proxMens->copy()->addDays($d)->toDateString(),
                    'display'         => 'background',
                    'backgroundColor' => '#f08c8c',
                    'borderColor'     => '#f08c8c',
                    'extendedProps'   => ['isProjecao' => true],
                ]);
            }

            $eventos->push([
                'id'              => uniqid(),
                'title'           => '',
                'start'           => $ovulacaoProj->toDateString(),
                'display'         => 'background',
                'backgroundColor' => '#e42615',
                'borderColor'     => '#e42615',
                'extendedProps'   => ['isProjecao' => true],
            ]);

            for ($j = -3; $j <= 3; $j++) {
                if ($j === 0) continue;
                $eventos->push([
                    'id'              => uniqid(),
                    'title'           => '',
                    'start'           => $ovulacaoProj->copy()->addDays($j)->toDateString(),
                    'display'         => 'background',
                    'backgroundColor' => '#fc5849',
                    'borderColor'     => '#fc5849',
                    'extendedProps'   => ['isProjecao' => true],
                ]);
            }
        }

        return $eventos;
    }
}
