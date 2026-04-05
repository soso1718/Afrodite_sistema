<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sansita One', cursive; }
        input[type="radio"], input[type="checkbox"] { accent-color: #E8A8B5; flex-shrink: 0; }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(20%) sepia(50%) saturate(500%) hue-rotate(300deg);
        }
    </style>
    <title>Editar Questionário Afrodite</title>
</head>

<body class="flex justify-center bg-[#1a0009]">

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-8 pt-9 pb-20">

        {{-- Card --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">

            <h1 class="text-xl text-center mb-4">Editando seu ciclo</h1>

            {{-- Erros --}}
            @if ($errors->any())
                <div class="bg-red-200 text-red-800 p-2 rounded mb-4 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('questionario.update') }}"
                class="flex flex-col gap-4"
            >
                @csrf
                @method('PUT')

                {{-- IDADE --}}
                <label class="text-sm">Idade</label>
                <input
                    type="number"
                    name="respostas[idade]"
                    placeholder="Ex: 28"
                    value="{{ old('respostas.idade', $resposta->idade) }}"
                    min="10" max="99"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >

                {{-- CICLO --}}
                <p class="text-sm">Seu ciclo menstrual é regular?</p>
                <div class="flex flex-col gap-2">
                    @foreach(['sim' => 'Sim', 'nao' => 'Não', 'asVezes' => 'Às vezes', 'nao_sei' => 'Não sei'] as $val => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="respostas[cicloRegular]" value="{{ $val }}"
                                {{ old('respostas.cicloRegular', $resposta->ciclo_regular) == $val ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>

                {{-- DATA --}}
                <p class="text-sm">Quando foi sua última menstruação?</p>
                <input
                    type="date"
                    name="respostas[dataUltimaMenstruacao]"
                    value="{{ $resposta->data_ultima_menstruacao !== 'nao_sei' ? old('respostas.dataUltimaMenstruacao', $resposta->data_ultima_menstruacao) : '' }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="respostas[dataUltimaMenstruacaoNaoSei]" value="1"
                        {{ old('respostas.dataUltimaMenstruacaoNaoSei', $resposta->data_ultima_menstruacao == 'nao_sei') ? 'checked' : '' }}>
                    Não sei
                </label>

                {{-- OBJETIVO --}}
                <p class="text-sm">Qual seu objetivo com nosso app?</p>

                @php $objetivosSalvos = old('respostas.objetivo', $resposta->objetivo ?? []); @endphp

                <div class="flex flex-col gap-2">
                    @foreach([
                        'acompanhar' => 'Acompanhar ciclo',
                        'fertilidade'=> 'Monitorar fertilidade',
                        'sintomas'   => 'Entender sintomas',
                        'hormonal'   => 'Saúde hormonal',
                    ] as $val => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="respostas[objetivo][]" value="{{ $val }}"
                                {{ in_array($val, $objetivosSalvos) ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                <input
                    type="text"
                    name="respostas[objetivoOutro]"
                    placeholder="Outro objetivo"
                    value="{{ old('respostas.objetivoOutro', $resposta->objetivo_outro) }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >

                {{-- SAÚDE --}}
                <p class="text-sm">Há algo de importante sobre sua saúde?</p>
                <input
                    type="text"
                    name="respostas[saudeImportante]"
                    placeholder="Ex: SOP, endometriose..."
                    value="{{ old('respostas.saudeImportante', $resposta->saude_importante) }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >

                {{-- HORMÔNIOS --}}
                <p class="text-sm">Você está em uso de hormônios?</p>
                <div class="flex flex-col gap-2">
                    @foreach(['sim' => 'Sim', 'nao' => 'Não', 'nao_sei' => 'Não sei'] as $val => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="respostas[hormonios]" value="{{ $val }}"
                                {{ old('respostas.hormonios', $resposta->hormonios) == $val ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>

                {{-- TIPO --}}
                <p class="text-sm">Se sim, qual o tipo de hormônio(s)?</p>

                @php $hormoniosSalvos = old('respostas.hormoniosTipo', $resposta->hormonios_tipo ?? []); @endphp

                <input
                    type="text"
                    name="respostas[hormoniosTipo][]"
                    placeholder="Ex: pílula, DIU hormonal..."
                    value="{{ is_array($hormoniosSalvos) ? ($hormoniosSalvos[0] ?? '') : '' }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="respostas[hormoniosTipo][]" value="nenhum"
                        {{ is_array($hormoniosSalvos) && in_array('nenhum', $hormoniosSalvos) ? 'checked' : '' }}>
                    Não utilizo nenhum
                </label>

                {{-- BOTÕES --}}
                <div class="flex gap-3 mt-2">
                    <button
                        type="submit"
                        class="flex-1 bg-[#E8A8B5] text-white py-3 rounded-lg text-sm tracking-wide active:scale-95 transition-transform"
                    >
                        Salvar
                    </button>
                    <a
                        href="{{ route('dashboard') }}"
                        class="flex-1 text-center bg-white/20 text-white py-3 rounded-lg text-sm tracking-wide active:scale-95 transition-transform flex items-center justify-center"
                    >
                        Cancelar
                    </a>
                </div>

            </form>
        </div>

    </div>

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

</body>
</html>