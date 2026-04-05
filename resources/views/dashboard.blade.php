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

        .fc .fc-toolbar-title { font-family: 'Sansita One', cursive !important; color: #E8A8B5 !important; font-size: 15px !important; }
        .fc .fc-button { background: rgba(255,255,255,0.1) !important; border: 1px solid rgba(255,255,255,0.15) !important; color: white !important; border-radius: 6px !important; font-size: 11px !important; padding: 3px 8px !important; box-shadow: none !important; }
        .fc .fc-button:hover { background: rgba(232,168,181,0.25) !important; }
        .fc .fc-col-header-cell-cushion { color: rgba(255,255,255,0.45) !important; font-size: 10px !important; text-transform: uppercase; letter-spacing: 1px; }
        .fc .fc-daygrid-day-number { color: rgba(255,255,255,0.8) !important; font-size: 12px !important; }
        .fc .fc-daygrid-day:hover { background: rgba(232,168,181,0.1) !important; cursor: pointer; }
        .fc .fc-day-today { background: rgba(232,168,181,0.18) !important; }
        .fc .fc-day-today .fc-daygrid-day-number { color: #E8A8B5 !important; font-weight: 500; }
        .fc-theme-standard td, .fc-theme-standard th { border-color: rgba(255,255,255,0.07) !important; }
        .fc-theme-standard .fc-scrollgrid { border-color: rgba(255,255,255,0.07) !important; }
    </style>
    <title>Afrodite — Calendário</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-6 pt-9 pb-24">

        {{-- Header --}}
        <div class="mb-4">
            <p class="text-[#E8A8B5] text-xs tracking-[0.2em] uppercase font-medium mb-1">Calendário</p>
            <h1 class="font-display text-white text-2xl leading-tight">Meu Ciclo</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-4"></div>

        {{-- Legenda --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl mb-3">
            <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Legenda</h2>
            <div class="flex gap-3 flex-wrap">
                <div class="flex items-center gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-[#f87171]"></div>
                    <span class="text-xs text-white/60">Menstruação</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-[#fbbf24]"></div>
                    <span class="text-xs text-white/60">Período fértil</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-[#a78bfa]"></div>
                    <span class="text-xs text-white/60">Ovulação</span>
                </div>
            </div>
        </div>

        {{-- Calendário --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl">
            <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Marque os dias</h2>
            <div id="calendar"></div>
        </div>

    </div>

        {{-- Navbar --}}
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2
                w-full min-w-[320px] max-w-sm
                bg-[#720026]
                flex justify-around items-center
                py-3 z-50">

        <a href="{{ route('dashboard') }}"
        class="relative group flex flex-col items-center active:scale-90 transition">
            <span class="
                absolute -top-8
                bg-[#E8A8B5] text-[#5a0018]
                text-[10px] tracking-wide
                px-2 py-0.5 rounded-md
                whitespace-nowrap
                opacity-0 group-hover:opacity-100
                transition-opacity duration-200
                pointer-events-none
            ">Início</span>
            <img src="{{ asset('icons/casa.svg') }}" class="w-6 h-6">
        </a>

        <a href="{{ route('registros.index') }}"
        class="relative group flex flex-col items-center active:scale-90 transition">
            <span class="
                absolute -top-8
                bg-[#E8A8B5] text-[#5a0018]
                text-[10px] tracking-wide
                px-2 py-0.5 rounded-md
                whitespace-nowrap
                opacity-0 group-hover:opacity-100
                transition-opacity duration-200
                pointer-events-none
            ">Registros</span>
            <img src="{{ asset('icons/registro.svg') }}" class="w-6 h-6">
        </a>

        <a href="{{ route('artigos.index') }}"
        class="relative group flex flex-col items-center active:scale-90 transition">
            <span class="
                absolute -top-8
                bg-[#E8A8B5] text-[#5a0018]
                text-[10px] tracking-wide
                px-2 py-0.5 rounded-md
                whitespace-nowrap
                opacity-0 group-hover:opacity-100
                transition-opacity duration-200
                pointer-events-none
            ">Artigos</span>
            <img src="{{ asset('icons/artigos.svg') }}" class="w-6 h-6">
        </a>

        <a href="{{ route('profile.edit') }}"
        class="relative group flex flex-col items-center active:scale-90 transition">
            <span class="
                absolute -top-8
                bg-[#E8A8B5] text-[#5a0018]
                text-[10px] tracking-wide
                px-2 py-0.5 rounded-md
                whitespace-nowrap
                opacity-0 group-hover:opacity-100
                transition-opacity duration-200
                pointer-events-none
            ">Perfil</span>
            <img src="{{ asset('icons/perfil.svg') }}" class="w-6 h-6">
        </a>

    </nav>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</body>
</html>