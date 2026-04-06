<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
    </style>
    <title>Afrodite — Registros</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

<x-phone-frame>

    {{-- ───── NAVBAR ───── --}}
    <x-slot name="navbar">
        <nav class="w-full bg-[#720026] flex justify-around items-center py-3">

            <a href="{{ route('dashboard') }}"
               class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Início</span>
                <img src="{{ asset('icons/casa.svg') }}" class="w-6 h-6">
            </a>

            <a href="{{ route('registros.index') }}"
               class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Registros</span>
                <img src="{{ asset('icons/registro.svg') }}" class="w-6 h-6">
            </a>

            <a href="{{ route('artigos.index') }}"
               class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Artigos</span>
                <img src="{{ asset('icons/artigos.svg') }}" class="w-6 h-6">
            </a>

            <a href="{{ route('profile.edit') }}"
               class="relative group flex flex-col items-center active:scale-90 transition">
                <span class="absolute -top-8 bg-[#E8A8B5] text-[#5a0018] text-[10px] tracking-wide px-2 py-0.5 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">Perfil</span>
                <img src="{{ asset('icons/perfil.svg') }}" class="w-6 h-6">
            </a>

        </nav>
    </x-slot>

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-6 pt-9 pb-28">

        {{-- Header --}}
        <div class="mb-4">
            <p class="text-[#E8A8B5] text-xs tracking-[0.2em] uppercase font-medium mb-1">Histórico</p>
            <h1 class="font-display text-white text-2xl leading-tight">Registros</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-4"></div>

        {{-- Tabela de registros --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl">

            <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Todos os registros</h2>

            {{-- Cabeçalho --}}
            <div class="grid grid-cols-2 mb-2 px-1">
                <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium">Data</span>
                <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium">Tipo</span>
            </div>

            {{-- Linhas --}}
            <div class="flex flex-col gap-2">

                @forelse ($events as $event)

                    <div class="grid grid-cols-2 items-center
                                bg-white/5 hover:bg-white/10
                                rounded-xl px-3 py-2.5
                                transition-colors duration-150">

                        {{-- Data --}}
                        <span class="text-sm text-white/80 font-light">
                            {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                        </span>

                        {{-- Tipo com badge colorido --}}
                        <span class="flex items-center gap-1.5">
                            @php
                                $tipo = $event->title;
                                $dot = match(true) {
                                    str_contains($tipo, 'Menstrua') => 'bg-[#f87171]',
                                    str_contains($tipo, 'Ovula')    => 'bg-[#a78bfa]',
                                    str_contains($tipo, 'fértil')   => 'bg-[#fbbf24]',
                                    default                         => 'bg-white/40',
                                };
                            @endphp
                            <span class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ $dot }}"></span>
                            <span class="text-sm text-white/80 font-light">{{ $tipo }}</span>
                        </span>

                    </div>

                @empty

                    <div class="text-center text-sm text-white/50 py-6">
                        Nenhum registro encontrado.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</x-phone-frame>

</body>
</html>