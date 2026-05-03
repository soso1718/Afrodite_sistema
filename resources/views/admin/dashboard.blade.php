<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .divide-white-7 > * + * { border-top: 1px solid rgba(255,255,255,0.07); }
    </style>
    <title>Afrodite — Admin</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

<x-phone-frame>

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-5 pt-9 pb-24 gap-3">

        <div class="mb-1">
            <p class="text-[#E8A8B5] text-[15px] tracking-[0.2em] uppercase font-medium mb-1">Painel Admin</p>
            <h1 class="font-display text-white text-3xl leading-tight">Dashboard</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="grid grid-cols-2 gap-2.5">

            <div class="bg-[#B23A48] rounded-2xl p-3 relative overflow-hidden fade-up" style="animation-delay:0.05s">
                <div class="absolute -top-3 -right-3 w-12 h-12 rounded-full bg-white/5"></div>
                <div class="flex items-start justify-between mb-2">
                    <svg class="w-6 h-6 text-[#E8A8B5] opacity-70 shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <div class="flex flex-col items-end gap-0.5">
                        <div class="font-display text-white text-4xl leading-none">{{ $total_usuarios }}</div>
                        <div class="text-[11px] text-white/80 uppercase tracking-widest">Usuários</div>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2 flex flex-col gap-1">
                    <div class="flex justify-between items-center">
                        <span class="text-[15px] text-white/70">Esta semana</span>
                        <span class="text-[15px] font-medium text-[#6ee7b7]">+{{ $novos_esta_semana }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[15px] text-white/70">Sem quest.</span>
                        <span class="text-[15px] font-medium text-white/80">{{ $sem_resposta }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-[#B23A48] rounded-2xl p-3 relative overflow-hidden fade-up" style="animation-delay:0.10s">
                <div class="absolute -top-3 -right-3 w-12 h-12 rounded-full bg-white/5"></div>
                <div class="flex items-start justify-between mb-2">
                    <svg class="w-6 h-6 text-[#E8A8B5] opacity-70 shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                        <rect x="9" y="3" width="6" height="4" rx="1"/>
                        <line x1="9" y1="12" x2="15" y2="12"/>
                        <line x1="9" y1="16" x2="13" y2="16"/>
                    </svg>
                    <div class="flex flex-col items-end gap-0.5">
                        <div class="font-display text-white text-4xl leading-none">{{ $total_respostas }}</div>
                        <div class="text-[11px] text-white/80 uppercase tracking-widest">Questionários</div>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2 flex flex-col gap-1">
                    <div class="flex justify-between items-center">
                        <span class="text-[15px] text-white/70">Preenchidos</span>
                        <span class="text-[15px] font-medium text-[#6ee7b7]">{{ $total_respostas }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[15px] text-white/70">Pendentes</span>
                        <span class="text-[15px] font-medium text-white/70">{{ $sem_resposta }}</span>
                    </div>
                </div>
                <div class="mt-2 pt-2 border-t border-white/10">
                    <a href="{{ route('admin.questionarios.respostas') }}"
                       class="flex items-center justify-between text-[15px] text-[#E8A8B5]/70 hover:text-[#E8A8B5] transition-colors">
                        <span>Ver respostas</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-span-2 bg-[#B23A48] rounded-2xl p-4 relative overflow-hidden fade-up" style="animation-delay:0.15s">
                <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full bg-white/5"></div>
                <div class="flex items-start justify-between mb-3">
                    <svg class="w-6 h-6 text-[#E8A8B5] opacity-70 shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                    <div class="flex flex-col items-end gap-0.5">
                        <div class="font-display text-white text-3xl leading-none">{{ $total_artigos }}</div>
                        <div class="text-[11px] text-white/80 uppercase tracking-widest">Artigos publicados</div>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2.5 grid grid-cols-2 gap-2">
                    <div class="flex flex-col gap-0.5">
                        <span class="text-[15px] text-white/75">Publicados</span>
                        <span class="text-[16px] font-medium text-[#6ee7b7]">{{ $artigos_publicados ?? $total_artigos }}</span>
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <span class="text-[15px] text-white/75">Este mês</span>
                        <span class="text-[16px] font-medium text-white/60">{{ $artigos_este_mes ?? '—' }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.25s">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80">Novos Cadastros — 8 Semanas</h2>
                <span class="text-[15px] font-medium text-white">{{ $cadastros_semanas->sum('total') }} total</span>
            </div>
            @php $maxCadastros = $cadastros_semanas->max('total') ?: 1; @endphp
            <div class="flex items-end gap-1.5 h-24 mt-3">
                @forelse($cadastros_semanas as $semana)
                    @php
                        $altura = max(4, round(($semana->total / $maxCadastros) * 100));
                        $isLast = $loop->last;
                    @endphp
                    <div class="flex-1 flex flex-col items-center justify-end gap-1 h-full">
                        <span class="text-[12px] font-medium {{ $isLast ? 'text-white/50' : 'text-white' }}">
                            {{ $semana->total > 0 ? $semana->total : '' }}
                        </span>
                        <div class="w-full rounded-t bg-gradient-to-t from-[#D80048] to-[#E8A8B5]"
                             style="height:{{ $altura }}%; opacity: {{ $isLast ? '0.4' : '0.85' }}">
                        </div>
                        <span class="text-[12px] {{ $isLast ? 'text-[#E8A8B5]/70' : 'text-white/70' }}">
                            {{ $semana->inicio->format('d/m') }}
                        </span>
                    </div>
                @empty
                    <span class="text-base text-white/70 self-center">Sem dados ainda</span>
                @endforelse
            </div>
            <div class="w-full h-px bg-white/10 mt-1"></div>
        </div>

        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.30s">
            <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80 mb-3">Cadastros Recentes</h2>
            <div class="flex flex-col gap-2">
                @forelse($usuarios_recentes as $usuario)
                    @php
                        $isNovo = $usuario->created_at->diffInDays(now()) <= 1;
                    @endphp
                    <div class="flex items-center gap-2.5 px-2.5 py-2 bg-white/5 rounded-xl">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#D80048] to-[#E8A8B5]
                                    flex items-center justify-center font-display text-white text-sm shrink-0">
                            {{ strtoupper(substr($usuario->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-base font-medium text-white truncate">{{ $usuario->name }}</div>
                            <div class="text-[15px] text-white/75">{{ $usuario->email }}</div>
                            <div class="text-[14px] text-white/70 mt-0.5">{{ $usuario->created_at->diffForHumans() }}</div>
                        </div>
                        @if($isNovo)
                            <span class="text-[14px] font-medium px-2 py-0.5 rounded-full bg-[#E8A8B5]/20 text-[#E8A8B5] whitespace-nowrap">Novo</span>
                        @endif
                    </div>
                @empty
                    <span class="text-base text-white/70">Nenhum cadastro ainda</span>
                @endforelse
            </div>
        </div>

        <div class="bg-[#B23A48] rounded-2xl p-4 shadow-xl fade-up" style="animation-delay:0.40s">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-[15px] tracking-[0.15em] uppercase text-white/80">Artigos</h2>
                <a href="{{ route('admin.artigos.create') }}" class="text-[16px] text-[#E8A8B5] opacity-80">+ Novo →</a>
            </div>
            <div class="flex flex-col divide-white-7">
                @forelse($artigos_recentes as $artigo)
                    <div class="py-3 first:pt-0 last:pb-0">
                        <div class="flex items-start gap-2.5 mb-2">
                            <span class="font-display text-lg text-[#E8A8B5] opacity-30 min-w-[20px] leading-none shrink-0">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="flex-1 min-w-0">
                                <div class="text-base font-medium text-white leading-snug">{{ $artigo->titulo }}</div>
                                @if($artigo->resumo ?? $artigo->conteudo ?? null)
                                    <p class="text-[15px] text-white/75 leading-relaxed mt-1 line-clamp-2">
                                        {{ $artigo->resumo ?? Str::limit(strip_tags($artigo->conteudo), 90) }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 ml-[28px]">
                            <span class="flex items-center gap-1 text-[15px] text-[#6ee7b7]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#6ee7b7] inline-block shrink-0"></span>
                                Publicado
                            </span>
                            <span class="text-[15px] text-white/70">
                                {{ $artigo->published_at ? \Carbon\Carbon::parse($artigo->published_at)->format('d/m/Y') : $artigo->created_at->format('d/m/Y') }}
                            </span>
                            @if($artigo->conteudo ?? null)
                                @php
                                    $palavras = str_word_count(strip_tags($artigo->conteudo));
                                    $minutos  = max(1, round($palavras / 200));
                                @endphp
                                <span class="text-[15px] text-white/70">{{ $minutos }} min</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-3 mt-2.5 ml-[28px]">
                            <a href="{{ route('artigos.show', $artigo->id) }}"
                               class="text-[15px] text-[#E8A8B5]/60 hover:text-[#E8A8B5] transition">
                                Ver artigo →
                            </a>
                        </div>
                    </div>
                @empty
                    <span class="text-base text-white/70">Nenhum artigo ainda</span>
                @endforelse
            </div>

            @if($total_artigos > count($artigos_recentes))
                <div class="mt-3 pt-3 border-t border-white/10 text-center">
                    <a href="{{ route('artigos.index') }}"
                       class="text-[15px] text-[#E8A8B5]/60 hover:text-[#E8A8B5] transition">
                        Ver todos os {{ $total_artigos }} artigos →
                    </a>
                </div>
            @endif
        </div>

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