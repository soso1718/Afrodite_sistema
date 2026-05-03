<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
    </style>
    <title>Afrodite — Registros</title>
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
        <h2 class="font-display text-white text-lg mb-2">Tem certeza que quer deletar este registro?</h2>
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

{{-- ───── MODAL DE EDIÇÃO ───── --}}
<div
    x-data="{
        show: false,
        eventId: null,
        eventDate: '',
        eventTitle: '',
        open(id, date, title) {
            this.eventId = id;
            this.eventDate = date;
            this.eventTitle = title;
            this.show = true;
        }
    }"
    x-on:open-edit-modal.window="open($event.detail.id, $event.detail.date, $event.detail.title)"
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
        class="relative w-full max-w-xs bg-[#B23A48] rounded-2xl p-5 shadow-2xl"
    >
        <h2 class="font-display text-white text-lg mb-4">Editar Registro</h2>

        <form x-bind:action="'/registros/' + eventId" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-1.5">
                <label class="text-[10px] tracking-widest uppercase text-white/40">Data</label>
                <input
                    type="date"
                    name="date"
                    x-model="eventDate"
                    class="w-full rounded-xl px-4 py-3
                           bg-white/10 border border-white/20
                           text-white text-sm
                           focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-[10px] tracking-widest uppercase text-white/40">Tipo</label>
                <select
                    name="title"
                    x-model="eventTitle"
                    class="w-full rounded-xl px-4 py-3
                           bg-white/10 border border-white/20
                           text-white text-sm appearance-none
                           focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                    <optgroup label="── Registros ──" class="bg-[#720026] text-white/50">
                        <option value="Menstruação" class="bg-[#720026]">Menstruação</option>
                        <option value="Período fértil" class="bg-[#720026]">Período fértil</option>
                        <option value="Ovulação" class="bg-[#720026]">Ovulação</option>
                    </optgroup>
                    <optgroup label="── Projeções ──" class="bg-[#720026] text-white/50">
                        <option value="Menstruação (projeção)" class="bg-[#720026]">Menstruação (projeção)</option>
                        <option value="Período fértil (projeção)" class="bg-[#720026]">Período fértil (projeção)</option>
                        <option value="Ovulação (projeção)" class="bg-[#720026]">Ovulação (projeção)</option>
                    </optgroup>
                </select>
            </div>

            <div class="flex gap-3 pt-1">
                <button
                    type="button"
                    x-on:click="show = false"
                    class="font-display flex-1 bg-white/10 border border-white/20
                           text-white/80 text-sm py-3 rounded-xl
                           active:scale-95 transition-transform"
                >Cancelar</button>
                <button
                    type="submit"
                    class="font-display flex-1 bg-[#E8A8B5] text-[#5a0018]
                           text-sm py-3 rounded-xl
                           active:scale-95 transition-transform"
                >Salvar</button>
            </div>
        </form>
    </div>
</div>

<x-phone-frame>

    {{-- ───── TOAST ───── --}}
    @if(session('toast'))
        <x-slot name="toast">
            <div
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="w-full bg-[#E8A8B5] text-[#5a0018]
                       rounded-xl px-4 py-3 shadow-xl
                       flex items-center justify-between gap-3"
            >
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('toast') }}</span>
                </div>
                <button @click="show = false" class="text-[#5a0018]/60 hover:text-[#5a0018] transition shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </x-slot>
    @endif

    <div class="w-full min-h-full
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-4 pt-6 pb-28">

        {{-- Header --}}
        <div class="mb-4">
            <p class="text-[#E8A8B5] text-xs tracking-[0.2em] uppercase font-medium mb-1">Histórico</p>
            <h1 class="font-display text-white text-2xl leading-tight">Registros</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-4"></div>

        {{-- Navegação de meses --}}
        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('registros.index', ['month' => $prevMonth]) }}" class="text-white/70 hover:text-white text-sm">
                ← {{ \Carbon\Carbon::createFromFormat('Y-m', $prevMonth)->translatedFormat('F Y') }}
            </a>
            <h2 class="text-white font-medium text-sm">
                {{ $date->translatedFormat('F Y') }}
            </h2>
            <a href="{{ route('registros.index', ['month' => $nextMonth]) }}" class="text-white/70 hover:text-white text-sm">
                {{ \Carbon\Carbon::createFromFormat('Y-m', $nextMonth)->translatedFormat('F Y') }} →
            </a>
        </div>

        {{-- Tabela --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl">
            <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Registros do mês</h2>

            <div class="flex mb-2 px-1">
                <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium w-16 shrink-0">Data</span>
                <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium flex-1">Tipo</span>
                <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium w-16 text-right shrink-0">Ações</span>
            </div>

            <div class="flex flex-col gap-2">
                @forelse ($events as $event)
                    @php
                        $tipo = $event->title;
                        $isProjecao = str_contains($tipo, 'projeção');
                        $dot = match(true) {
                            str_contains($tipo, 'Menstrua') => $isProjecao ? 'bg-[#f08c8c] opacity-50' : 'bg-[#f08c8c]',
                            str_contains($tipo, 'Ovula')    => $isProjecao ? 'bg-[#e42615] opacity-50' : 'bg-[#e42615]',
                            str_contains($tipo, 'fértil')   => $isProjecao ? 'bg-[#fc5849] opacity-50' : 'bg-[#fc5849]',
                            default                         => 'bg-white/40',
                        };
                    @endphp

                    <div class="flex items-center bg-white/5 hover:bg-white/10 rounded-xl px-3 py-2.5 transition-colors duration-150">

                        <span class="text-xs text-white/80 font-light w-16 shrink-0">
                            {{ \Carbon\Carbon::parse($event->date)->format('d/m') }}
                        </span>

                        <span class="flex items-center gap-1.5 flex-1 min-w-0">
                            <span class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ $dot }}"></span>
                            <span class="text-xs font-light truncate {{ $isProjecao ? 'text-white/50 italic' : 'text-white/80' }}">{{ $tipo }}</span>
                        </span>

                        <div class="flex gap-3 shrink-0 items-center w-16 justify-end">

                            {{-- Excluir --}}
                            <button
                                type="button"
                                x-data
                                x-on:click="$dispatch('open-delete-modal', {
                                    action: '{{ route('registros.destroy', $event->id) }}'
                                })"
                                class="text-red-300 hover:text-red-500 transition flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            {{-- Editar --}}
                            <button
                                type="button"
                                x-data
                                x-on:click="$dispatch('open-edit-modal', {
                                    id: '{{ $event->id }}',
                                    date: '{{ $event->date }}',
                                    title: '{{ $event->title }}'
                                })"
                                class="text-blue-300 hover:text-blue-500 transition flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                        </div>
                    </div>
                @empty
                    <div class="text-center text-sm text-white/50 py-6">
                        Nenhum registro encontrado neste mês.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Navbar --}}
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</x-phone-frame>

</body>
</html>