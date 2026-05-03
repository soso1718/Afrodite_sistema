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
                    'Menstruação'               => '#f08c8c',
                    'Ovulação'                  => '#e42615',
                    'Período fértil'            => '#fc5849',
                    'Menstruação (projeção)'    => '#f08c8c',
                    'Ovulação (projeção)'       => '#e42615',
                    'Período fértil (projeção)' => '#fc5849',
                    default                     => '#f08c8c',
                };

                $isProjecao = str_contains($event->title, 'projeção');

                return [
                    'id'              => $event->id,
                    'title'           => '',
                    'start'           => $event->date,
                    'display'         => 'background',
                    'backgroundColor' => $color,
                    'borderColor'     => $color,
                    'extendedProps'   => ['isProjecao' => $isProjecao],
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

        // Período fértil — pula o dia da ovulação
        for ($i = -3; $i <= 3; $i++) {
            if ($i === 0) continue;
            Event::create([
                'user_id' => $userId,
                'date'    => $ovulacao->copy()->addDays($i)->toDateString(),
                'title'   => 'Período fértil'
            ]);
        }

        return response()->json(['success' => true]);
    }

    // ─────────────────────────────────────────────────────────
    // Salva projeções futuras no banco
    // Usa offset em dias a partir da DUM para evitar mutação do Carbon
    // ─────────────────────────────────────────────────────────
    public function storeProjecoes(Request $request)
    {
        $request->validate([
            'date'          => 'required|date',
            'duracao_ciclo' => 'integer|min:21|max:35',
            'meses'         => 'integer|min:1|max:12',
        ]);

        $userId       = auth()->id();
        $duracaoCiclo = (int) $request->input('duracao_ciclo', 28);
        $meses        = (int) $request->input('meses', 6);

        // Data base fixa — nunca mutada
        $dum = Carbon::parse($request->date)->startOfDay();

        // Remove projeções antigas para não duplicar
        Event::where('user_id', $userId)
            ->where('title', 'like', '%(projeção)%')
            ->delete();

        // Busca todos os dias que já têm evento real (não projeção)
        // para evitar sobrescrever com projeção
        $diasReais = Event::where('user_id', $userId)
            ->where('title', 'not like', '%(projeção)%')
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        for ($ciclo = 1; $ciclo <= $meses; $ciclo++) {
            // Offset total em dias para esta iteração
            $offsetMens = $duracaoCiclo * $ciclo;

            // Próxima menstruação projetada
            $proxMens = $dum->copy()->addDays($offsetMens);

            // Ovulação = próxima menstruação - 14 dias
            $ovulacao = $proxMens->copy()->subDays(14);

            // Menstruação projetada — 7 dias
            for ($d = 0; $d < 7; $d++) {
                $dia = $proxMens->copy()->addDays($d)->toDateString();
                if (!in_array($dia, $diasReais)) {
                    Event::create([
                        'user_id' => $userId,
                        'date'    => $dia,
                        'title'   => 'Menstruação (projeção)',
                    ]);
                }
            }

            // Ovulação projetada
            $diaOvulacao = $ovulacao->toDateString();
            if (!in_array($diaOvulacao, $diasReais)) {
                Event::create([
                    'user_id' => $userId,
                    'date'    => $diaOvulacao,
                    'title'   => 'Ovulação (projeção)',
                ]);
            }

            // Período fértil projetado — pula o dia da ovulação
            for ($j = -3; $j <= 3; $j++) {
                if ($j === 0) continue;
                $dia = $ovulacao->copy()->addDays($j)->toDateString();
                if (!in_array($dia, $diasReais)) {
                    Event::create([
                        'user_id' => $userId,
                        'date'    => $dia,
                        'title'   => 'Período fértil (projeção)',
                    ]);
                }
            }
        }

        return response()->json(['success' => true]);
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}