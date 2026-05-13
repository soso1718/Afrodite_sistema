<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
    </style>
    <title>Afrodite — Admin Artigos</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

{{-- ───── MODAL DE EXCLUSÃO ───── --}}
<div
    x-data="{
        show: false,
        formAction: '',
        open(action) {
            this.formAction = action;
            this.show = true;
        }
    }"
    x-on:open-delete-modal.window="open($event.detail.action)"
    x-show="show"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center px-6"
    style="display: none;"
>
    <div class="absolute inset-0 bg-black/60" x-on:click="show = false"></div>

    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        class="relative w-4/5 max-w-xs bg-[#B23A48] rounded-2xl p-5 shadow-2xl"
    >
        <h2 class="font-display text-white text-lg mb-2">Tem certeza que quer deletar este artigo?</h2>
        <p class="text-sm text-white/60 mb-5">Todos os dados serão permanentemente removidos.</p>

        <div class="flex gap-3">
            <button
                type="button"
                x-on:click="show = false"
                class="font-display flex-1 bg-white/10 border border-white/20
                       text-white text-sm py-3 rounded-xl
                       active:scale-95 transition-transform"
            >Cancelar</button>

            <form x-bind:action="formAction" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="font-display w-full bg-[#E8A8B5] text-[#5a0018]
                           text-sm py-3 rounded-xl
                           active:scale-95 transition-transform"
                >Confirmar</button>
            </form>
        </div>
    </div>
</div>

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
            <h1 class="font-display text-white text-2xl leading-tight">Artigos</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-5"></div>

        {{-- Botão novo artigo --}}
        <a
            href="{{ route('admin.artigos.create') }}"
            class="font-display w-full text-center
                   bg-[#E8A8B5] text-[#5a0018]
                   text-sm tracking-wide
                   py-3 rounded-xl mb-5
                   active:scale-95 transition-transform block"
        >
            + Criar novo artigo
        </a>

        {{-- Lista --}}
        <div class="flex flex-col gap-4">

            @forelse ($artigos as $artigo)

                <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white flex flex-col gap-3">

                    <h2 class="font-display text-base leading-snug">{{ $artigo->titulo }}</h2>

                    <p class="text-sm text-white/70 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($artigo->conteudo), 200) }}
                    </p>


                    {{-- Ações --}}
                    <div class="flex gap-2 pt-1">

                        <a
                            href="{{ route('artigos.show', $artigo->id) }}"
                            class="flex-1 text-center bg-white/10 border border-white/20
                                   text-white/80 text-xs tracking-wide
                                   py-2.5 rounded-lg
                                   active:scale-95 transition-transform"
                            style="font-family:'Sansita One',cursive;"
                        >
                            Ver
                        </a>

                        <a
                            href="{{ route('admin.artigos.edit', $artigo->id) }}"
                            class="flex-1 text-center bg-white/10 border border-white/20
                                   text-white/80 text-xs tracking-wide
                                   py-2.5 rounded-lg
                                   active:scale-95 transition-transform"
                            style="font-family:'Sansita One',cursive;"
                        >
                            Editar
                        </a>

                        <button
                            type="button"
                            x-data
                            x-on:click="$dispatch('open-delete-modal', {
                                action: '{{ route('admin.artigos.destroy', $artigo->id) }}'
                            })"
                            class="flex-1 bg-[#720026]/60 border border-[#E8A8B5]/30
                                   text-[#E8A8B5] text-xs tracking-wide
                                   py-2.5 rounded-lg
                                   active:scale-95 transition-transform"
                            style="font-family:'Sansita One',cursive;"
                        >
                            Excluir
                        </button>

                    </div>

                </div>

            @empty

                <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white text-center text-sm text-white/60">
                    Não há artigos cadastrados.
                </div>

            @endforelse

        </div>

    </div>

</x-phone-frame>

</body>
</html>