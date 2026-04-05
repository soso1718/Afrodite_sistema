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
    <title>Questionário Afrodite</title>
</head>

<body class=" flex justify-center bg-[#1a0009]">

    {{--
        Shell mobile:
        - min-w-[320px] → menor celular suportado (iPhone SE, Galaxy A01)
        - max-w-sm (384px) → não cresce além de mobile
        - overflow-x-hidden → nada vaza lateralmente
    --}}
    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col px-8 pt-9 pb-20">

        {{-- Card --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-4 shadow-xl text-white">

            <h1 class="text-xl text-center mb-4">Conhecendo seu ciclo</h1>

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
                action="{{ route('questionario.store') }}"
                class="flex flex-col gap-4"
            >
                @csrf

                <div class="w-full h-px bg-white/10"></div>

                {{-- IDADE --}}
                <label class="text-sm">Idade</label>
                <input
                    type="number"
                    name="respostas[idade]"
                    placeholder="Ex: 28"
                    value="{{ old('respostas.idade') }}"
                    min="10" max="99"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >

                <div class="w-full h-px bg-white/10"></div>

                {{-- CICLO --}}
                <p class="text-sm">Seu ciclo menstrual é regular?</p>
                <div class="flex flex-col gap-2">
                    @foreach(['sim' => 'Sim', 'nao' => 'Não', 'asVezes' => 'Às vezes', 'nao_sei' => 'Não sei'] as $val => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="respostas[cicloRegular]" value="{{ $val }}"
                                {{ old('respostas.cicloRegular') === $val ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>

                <div class="w-full h-px bg-white/10"></div>

                {{-- DATA --}}
                <p class="text-sm">Quando foi sua última menstruação?</p>
                <input
                    type="date"
                    name="respostas[dataUltimaMenstruacao]"
                    value="{{ old('respostas.dataUltimaMenstruacao') }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="respostas[dataUltimaMenstruacaoNaoSei]" value="1"
                        {{ old('respostas.dataUltimaMenstruacaoNaoSei') ? 'checked' : '' }}>
                    Não sei
                </label>

                <div class="w-full h-px bg-white/10"></div>

                {{-- OBJETIVO --}}
                <p class="text-sm">Qual seu objetivo com nosso app?</p>
                <div class="flex flex-col gap-2">
                    @foreach([
                        'acompanhar' => 'Acompanhar ciclo',
                        'fertilidade'=> 'Fertilidade',
                        'sintomas'   => 'Entender sintomas',
                        'hormonal'   => 'Saúde hormonal',
                    ] as $val => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="respostas[objetivo][]" value="{{ $val }}"
                                {{ in_array($val, old('respostas.objetivo', [])) ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                <input
                    type="text"
                    name="respostas[objetivoOutro]"
                    placeholder="Outro objetivo"
                    value="{{ old('respostas.objetivoOutro') }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >

                <div class="w-full h-px bg-white/10"></div>

                {{-- SAÚDE --}}
                <p class="text-sm">Há algo de importante sobre sua saúde?</p>
                <input
                    type="text"
                    name="respostas[saudeImportante]"
                    placeholder="Ex: SOP, endometriose..."
                    value="{{ old('respostas.saudeImportante') }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="respostas[saudeNada]" value="1"
                        {{ old('respostas.saudeNada') ? 'checked' : '' }}>
                    Não há nada
                </label>

                <div class="w-full h-px bg-white/10"></div>

                {{-- HORMÔNIOS --}}
                <p class="text-sm">Você está em uso de hormônios?</p>
                <div class="flex flex-col gap-2">
                    @foreach(['sim' => 'Sim', 'nao' => 'Não', 'nao_sei' => 'Não sei'] as $val => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="respostas[hormonios]" value="{{ $val }}"
                                {{ old('respostas.hormonios') === $val ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>

                {{-- TIPO --}}
                <p class="text-sm">Se sim, qual o tipo de hormônio(s)?</p>
                <input
                    type="text"
                    name="respostas[hormoniosTipo]"
                    placeholder="Ex: pílula, DIU hormonal..."
                    value="{{ old('respostas.hormoniosTipo') }}"
                    class="w-full rounded-md p-2 text-black text-sm focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="respostas[hormoniosTipoNenhum]" value="1"
                        {{ old('respostas.hormoniosTipoNenhum') ? 'checked' : '' }}>
                    Nenhum
                </label>

                <div class="w-full h-px bg-white/10"></div>

                {{-- BOTÃO --}}
                <button
                    type="submit"
                    class="w-full bg-[#E8A8B5] text-white py-3 rounded-lg mt-2 text-sm tracking-wide active:scale-95 transition-transform"
                >
                    Iniciar
                </button>

            </form>
        </div>

    </div>

</body>
</html>