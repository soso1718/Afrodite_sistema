<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
    </style>
    <title>Afrodite — Perfil</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-8 pt-9 pb-20">

        {{-- Header --}}
        <div class="mb-5">
            <p class="text-[#E8A8B5] text-xs tracking-[0.2em] uppercase font-medium mb-1">Minha conta</p>
            <h1 class="font-display text-white text-2xl leading-tight">Perfil</h1>
        </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-5"></div>

        <div class="flex flex-col gap-4">

            {{-- Informações do perfil --}}
            <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">
                <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Informações pessoais</h2>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Senha --}}
            <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">
                <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Senha</h2>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Respostas do questionário --}}
            <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">

                <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-4">Respostas do questionário</h2>

                <div class="flex flex-col gap-3">

                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10px] tracking-widest uppercase text-white/40">Idade</span>
                        <span class="text-sm text-white">{{ $resposta->idade }} anos</span>
                    </div>

                    <div class="w-full h-px bg-white/10"></div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10px] tracking-widest uppercase text-white/40">Ciclo menstrual</span>
                        <span class="text-sm text-white">
                            @switch($resposta->ciclo_regular)
                                @case('sim') Regular @break
                                @case('nao') Irregular @break
                                @case('asVezes') Às vezes regular @break
                                @default Não informado
                            @endswitch
                        </span>
                    </div>

                    <div class="w-full h-px bg-white/10"></div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10px] tracking-widest uppercase text-white/40">Última menstruação</span>
                        <span class="text-sm text-white">
                            @if($resposta->data_ultima_menstruacao === 'nao_sei')
                                Não soube informar
                            @elseif($resposta->data_ultima_menstruacao)
                                {{ \Carbon\Carbon::parse($resposta->data_ultima_menstruacao)->format('d/m/Y') }}
                            @else
                                —
                            @endif
                        </span>
                    </div>

                    <div class="w-full h-px bg-white/10"></div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10px] tracking-widest uppercase text-white/40">Objetivo principal</span>
                        <span class="text-sm text-white">
                            {{ $resposta->objetivo
                                ? collect($resposta->objetivo)->map(fn($o) => match ($o) {
                                    'acompanhar' => 'Acompanhar menstruação',
                                    'fertilidade' => 'Monitorar fertilidade',
                                    'sintomas' => 'Entender sintomas do corpo',
                                    'hormonal' => 'Organizar saúde hormonal',
                                    default => $o,
                                })->join(', ')
                                : '—'
                            }}
                        </span>
                    </div>

                    <div class="w-full h-px bg-white/10"></div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10px] tracking-widests uppercase text-white/40">Saúde</span>
                        <span class="text-sm text-white">{{ $resposta->saude_importante ?: 'Nada relevante informado' }}</span>
                    </div>

                    <div class="w-full h-px bg-white/10"></div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10px] tracking-widest uppercase text-white/40">Uso de hormônios</span>
                        <span class="text-sm text-white">
                            @switch($resposta->hormonios)
                                @case('sim') Sim @break
                                @case('nao') Não @break
                                @case('nao_sei') Não soube informar @break
                                @default —
                            @endswitch
                        </span>
                    </div>

                </div>

                <a
                    href="{{ route('questionario.edit') }}"
                    class="font-display mt-4 w-full block text-center
                           bg-[#E8A8B5] text-[#5a0018]
                           py-3 rounded-lg text-sm tracking-wide
                           active:scale-95 transition-transform"
                >
                    Editar Respostas
                </a>

            </div>

            {{-- Deletar conta --}}
            <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">
                <h2 class="text-[10px] tracking-[0.12em] uppercase text-white/50 mb-3">Zona de perigo</h2>
                @include('profile.partials.delete-user-form')
                

                <div class="w-full h-px bg-white/10 my-4"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="font-display w-full block text-center
                                bg-white/10 hover:bg-white/20
                                border border-white/20
                                text-white/80 hover:text-white
                                py-3 rounded-lg text-sm tracking-wide
                                active:scale-95 transition-all duration-200">
                            Sair da conta
                        </button>
                    </form>
                </div>
                
            </div>

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

    <a href="{{ route('questionario.edit') }}"
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
        ">Questionário</span>
        <img src="{{ asset('icons/questionario.svg') }}" class="w-6 h-6">
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

</body>
</html>