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


<x-phone-frame :toast="session('toast')">

    {{-- Header --}}
    <div class="mb-4">
        <p class="text-[#E8A8B5] text-xs tracking-[0.2em] uppercase font-medium mb-1">Histórico</p>
        <h1 class="font-display text-white text-2xl leading-tight">Registros</h1>
    </div>

    <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-4"></div>

    {{-- Navegação de meses --}}
    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('registros.index', ['month' => $prevMonth]) }}" class="text-white/70 hover:text-white">
            ← {{ \Carbon\Carbon::createFromFormat('Y-m', $prevMonth)->translatedFormat('F Y') }}
        </a>

        <h2 class="text-white font-medium">
            {{ $date->translatedFormat('F Y') }}
        </h2>

        <a href="{{ route('registros.index', ['month' => $nextMonth]) }}" class="text-white/70 hover:text-white">
            {{ \Carbon\Carbon::createFromFormat('Y-m', $nextMonth)->translatedFormat('F Y') }} →
        </a>
    </div>

    {{-- Tabela de registros --}}
    <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl">
        <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Registros do mês</h2>

        {{-- Cabeçalho --}}
        <div class="grid grid-cols-2 mb-2 px-1">
            <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium">Data</span>
            <span class="text-[10px] tracking-[0.12em] uppercase text-white/40 font-medium">Tipo</span>
        </div>

        {{-- Linhas --}}
        <div class="flex flex-col gap-2">
            @forelse ($events as $event)
                <div class="grid grid-cols-3 items-center
                        bg-white/5 hover:bg-white/10
                        rounded-xl px-3 py-2.5
                        transition-colors duration-150">
                    <span class="text-sm text-white/80 font-light">
                        {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                    </span>
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

                    {{-- Botões --}}
                    <div class="flex gap-2 justify-end">
                        <form action="{{ route('registros.destroy', $event->id) }}" method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-300 hover:text-red-500">Excluir</button>
                        </form>
                        <a href="{{ route('registros.edit', $event->id) }}" class="text-xs text-blue-300 hover:text-blue-500">Editar</a>
                    </div>
                </div>
            @empty
                <div class="text-center text-sm text-white/50 py-6">
                    Nenhum registro encontrado neste mês.
                </div>
            @endforelse
        </div>
    </div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</x-phone-frame>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.delete-form');
    forms.forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            if (!confirm('Deseja realmente excluir este registro?')) return;

            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams(new FormData(this))
            });

            if (response.ok) {
                window.location.reload();
            }
        });
    });
});
</script>

</body>
</html>