<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artigo;
use App\Models\Resposta;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $dados = [
            'total_usuarios'      => User::count(),
            'novos_esta_semana'   => User::whereBetween('created_at', [now()->startOfWeek(), now()])->count(),
            'usuarios_recentes'   => User::latest()->take(5)->get(),

            'total_respostas'     => Resposta::count(),
            'sem_resposta'        => User::whereDoesntHave('respostas')->count(),
            'esta_semana'         => Resposta::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),

            'total_artigos'       => Artigo::count(),
            'artigos_recentes'    => Artigo::latest()->take(3)->get(),

            'cadastros_semanas'   => collect(range(7, 0))->map(function ($i) {
                $inicio = now()->startOfWeek()->subWeeks($i);
                $fim    = $inicio->copy()->endOfWeek();

                return (object)[
                    'total'  => User::whereBetween('created_at', [$inicio, $fim])->count(),
                    'inicio' => $inicio,
                ];
            }),
        ];

        return view('admin.dashboard', $dados);
    }

    public function respostas()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $total_respostas = Resposta::count();

        $esta_semana = Resposta::whereBetween('created_at', [
            now()->startOfWeek(), now()->endOfWeek()
        ])->count();

        $por_objetivo = Resposta::selectRaw('objetivo')->get()
            ->flatMap(fn($r) => $r->objetivo ?? [])
            ->countBy()
            ->sortDesc()
            ->map(fn($total, $label) => ['label' => $label, 'total' => $total])
            ->values();

        $ciclo_regular = Resposta::selectRaw('ciclo_regular, count(*) as total')
            ->groupBy('ciclo_regular')
            ->orderByDesc('total')
            ->get();

        $hormonios = Resposta::selectRaw('hormonios, count(*) as total')
            ->groupBy('hormonios')
            ->orderByDesc('total')
            ->get();

        $saude_recentes = Resposta::whereNotNull('saude_importante')
            ->where('saude_importante', '!=', '')
            ->latest()
            ->get();

        return view('admin.questionarios.respostas', compact(
            'total_respostas',
            'esta_semana',
            'por_objetivo',
            'ciclo_regular',
            'hormonios',
            'saude_recentes',
        ));
    }
}