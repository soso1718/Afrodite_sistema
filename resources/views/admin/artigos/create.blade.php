<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
    </style>
    <title>Afrodite — Criar Artigo</title>
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
                flex flex-col px-4 pt-6 pb-28">

        {{-- Header --}}
        <div class="mb-5">
            <p class="text-[#E8A8B5] text-xs tracking-[0.2em] uppercase font-medium mb-1">Administração</p>
            <h1 class="font-display text-white text-2xl leading-tight">Criar artigo</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-5"></div>

        {{-- Card --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">

            {{-- Erros --}}
            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-400/30 text-red-200 p-3 rounded-xl mb-4 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.artigos.store') }}" class="flex flex-col gap-5">
                @csrf

                {{-- Título --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] tracking-widest uppercase text-white/40">Título</label>
                    <input
                        type="text"
                        name="titulo"
                        value="{{ old('titulo') }}"
                        placeholder="Título do artigo"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                    >
                </div>

                {{-- Conteúdo --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] tracking-widest uppercase text-white/40">Conteúdo</label>
                    <textarea
                        name="conteudo"
                        rows="8"
                        placeholder="Escreva o conteúdo do artigo..."
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]
                               resize-none leading-relaxed"
                    >{{ old('conteudo') }}</textarea>
                </div>

                {{-- Botões --}}
                <div class="flex gap-3 pt-1">
                    <a
                        href="{{ route('artigos.index') }}"
                        class="font-display flex-1 text-center
                               bg-white/10 border border-white/20
                               text-white/80 text-sm tracking-wide
                               py-3 rounded-lg
                               active:scale-95 transition-transform flex items-center justify-center"
                    >
                        Cancelar
                    </a>
                    <button
                        type="submit"
                        class="font-display flex-1
                               bg-[#E8A8B5] text-[#5a0018]
                               text-sm tracking-wide
                               py-3 rounded-lg
                               active:scale-95 transition-transform"
                    >
                        Salvar
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-phone-frame>

</body>
</html>