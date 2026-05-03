<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.4s ease both; }
    </style>
    <title>Afrodite — Respostas</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

<x-phone-frame>

@php
    function fmt($val) {
        $map = [
                'sim'         => 'Sim',
                'nao'         => 'Não',
                'nao_sei'     => 'Não sei',
                'asVezes'     => 'Às vezes',
                'as_vezes'    => 'Às vezes',
                'acompanhar'  => 'Acompanhar ciclo',
                'fertilidade' => 'Fertilidade',
                'sintomas'    => 'Entender sintomas',
                'hormonal'    => 'Saúde hormonal',
            ];
        return $map[$val] ?? ucfirst(str_replace('_', ' ', $val));
    }
@endphp

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-5 pt-9 pb-24 gap-3">

        <div class="flex items-center gap-3 mb-1">
            <a href="{{ route('admin.dashboard') }}" class="text-[#E8A8B5]/70 hover:text-[#E8A8B5] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                </svg>
            </a>
            <div>
                <p class="text-[#E8A8B5] text-[15px] tracking-[0.2em] uppercase font-medium">Painel Admin</p>
                <h1 class="font-display text-white text-3xl leading-tight">Questionários</h1>
            </div>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="grid grid-cols-2 gap-2 fade-up" style="animation-delay:0.05s">
            <div class="bg-[#B23A48] rounded-2xl p-3 text-center">
                <div class="font-display text-white text-3xl leading-none mb-0.5">{{ $total_respostas }}</div>
                <div class="text-[13px] text-white/70 uppercase tracking-wider">Total</div>
            </div>
            <div class="bg-[#B23A48] rounded-2xl p-3 text-center">
                <div class="font-display text-white text-3xl leading-none mb-0.5">{{ $esta_semana }}</div>
                <div class="text-[13px] text-white/70 uppercase tracking-wider">Esta semana</div>
            </div>
        </div>

        @if($por_objetivo->isNotEmpty())
        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.10s">
            <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80 mb-3">Objetivos</h2>
            @php $maxObj = $por_objetivo->max('total') ?: 1; @endphp
            <div class="flex flex-col gap-2.5">
                @foreach($por_objetivo as $item)
                @php $pct = round(($item['total'] / $maxObj) * 100); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[15px] text-white/90 truncate max-w-[200px]">{{ fmt($item['label']) }}</span>
                        <span class="text-[15px] text-white/60 shrink-0 ml-2">{{ $item['total'] }}</span>
                    </div>
                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#D80048] to-[#E8A8B5] rounded-full"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.15s">
            <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80 mb-3">Ciclo Regular</h2>
            @php $maxCiclo = $ciclo_regular->max('total') ?: 1; @endphp
            <div class="flex flex-col gap-2.5">
                @forelse($ciclo_regular as $item)
                @php $pct = round(($item->total / $maxCiclo) * 100); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[15px] text-white/90">{{ fmt($item->ciclo_regular ?? 'Não informado') }}</span>
                        <span class="text-[15px] text-white/60">{{ $item->total }}</span>
                    </div>
                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#D80048] to-[#E8A8B5] rounded-full"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @empty
                <span class="text-[15px] text-white/50">Sem dados</span>
                @endforelse
            </div>
        </div>

        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.20s">
            <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80 mb-3">Usa Hormônios</h2>
            @php $maxHorm = $hormonios->max('total') ?: 1; @endphp
            <div class="flex flex-col gap-2.5">
                @forelse($hormonios as $item)
                @php $pct = round(($item->total / $maxHorm) * 100); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[15px] text-white/90">{{ fmt($item->hormonios ?? 'Não informado') }}</span>
                        <span class="text-[15px] text-white/60">{{ $item->total }}</span>
                    </div>
                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#D80048] to-[#E8A8B5] rounded-full"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @empty
                <span class="text-[15px] text-white/50">Sem dados</span>
                @endforelse
            </div>
        </div>

        @if($saude_recentes->isNotEmpty())
        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.25s">
            <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80 mb-3">Condições de saúde relatadas</h2>
            @php
                $condicoes = collect($saude_recentes)
                    ->pluck('saude_importante')
                    ->filter()
                    ->countBy(fn($v) => trim($v))
                    ->sortDesc();
                $maxSaude = $condicoes->max() ?: 1;
            @endphp
            <div class="flex flex-col gap-2.5">
                @forelse($condicoes as $condicao => $total)
                @php $pct = round(($total / $maxSaude) * 100); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[15px] text-white/90 truncate max-w-[200px]">{{ $condicao }}</span>
                        <span class="text-[15px] text-white/60 shrink-0 ml-2">{{ $total }}</span>
                    </div>
                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#D80048] to-[#E8A8B5] rounded-full"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @empty
                <span class="text-[15px] text-white/50">Sem dados</span>
                @endforelse
            </div>
        </div>
        @endif

    </div>

    <x-slot name="navbar">
        <nav class="w-full bg-[#720026] flex justify-around items-center py-3">
            <a href="{{ route('dashboard') }}" class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Início</span>
                <img src="{{ asset('icons/casa.svg') }}" class="w-6 h-6">
            </a>
            <a href="{{ route('registros.index') }}" class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Registros</span>
                <img src="{{ asset('icons/registro.svg') }}" class="w-6 h-6">
            </a>
            <a href="{{ route('artigos.index') }}" class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Artigos</span>
                <img src="{{ asset('icons/artigos.svg') }}" class="w-6 h-6">
            </a>
            <a href="{{ route('profile.edit') }}" class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Perfil</span>
                <img src="{{ asset('icons/perfil.svg') }}" class="w-6 h-6">
            </a>
        </nav>
    </x-slot>

</x-phone-frame>

</body>
</html>