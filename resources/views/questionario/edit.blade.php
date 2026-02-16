<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Questionário Afrodite</title>
</head>
<body>
    <h1>Editar respostas do seu ciclo</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('questionario.update') }}">
        @csrf
        @method('PUT') {{-- Essencial para o Laravel entender que é uma edição --}}

        <label>Idade</label>
        <input type="text" name="respostas[idade]" value="{{ old('respostas.idade', $resposta->idade) }}">
        <br><br>

        <p>Seu ciclo menstrual é regular?</p>
        @foreach(['sim' => 'Sim', 'nao' => 'Não', 'asVezes' => 'Às vezes', 'nao_sei' => 'Não sei'] as $val => $label)
            <input type="radio" name="respostas[cicloRegular]" value="{{ $val }}" 
                {{ old('respostas.cicloRegular', $resposta->ciclo_regular) == $val ? 'checked' : '' }}> {{ $label }}
        @endforeach
        <br><br>

        <p>Quando foi a data da sua última menstruação?</p>
        <input type="date" name="respostas[dataUltimaMenstruacao]" 
            value="{{ $resposta->data_ultima_menstruacao !== 'nao_sei' ? old('respostas.dataUltimaMenstruacao', $resposta->data_ultima_menstruacao) : '' }}">
        
        <input type="checkbox" name="respostas[dataUltimaMenstruacaoNaoSei]" value="1" 
            {{ old('respostas.dataUltimaMenstruacaoNaoSei', $resposta->data_ultima_menstruacao == 'nao_sei') ? 'checked' : '' }}> Não sei
        <br><br>

        <p>Qual seu objetivo com nosso app?</p>
        @php $objetivosSalvos = old('respostas.objetivo', $resposta->objetivo ?? []); @endphp
        
        <input type="checkbox" name="respostas[objetivo][]" value="acompanhar" {{ in_array('acompanhar', $objetivosSalvos) ? 'checked' : '' }}> Acompanhar ciclo menstrual
        <input type="checkbox" name="respostas[objetivo][]" value="fertilidade" {{ in_array('fertilidade', $objetivosSalvos) ? 'checked' : '' }}> Monitorar fertilidade
        <input type="checkbox" name="respostas[objetivo][]" value="sintomas" {{ in_array('sintomas', $objetivosSalvos) ? 'checked' : '' }}> Entender os sintomas do corpo
        <input type="checkbox" name="respostas[objetivo][]" value="hormonal" {{ in_array('hormonal', $objetivosSalvos) ? 'checked' : '' }}> Organizar saúde hormonal
        <br>
        <label>Outro objetivo (especifique):
            <input type="text" name="respostas[objetivoOutro]" value="{{ old('respostas.objetivoOutro', $resposta->objetivo_outro) }}"> 
        </label>
        <br><br>

        <p>Há algo de importante que devemos considerar sobre sua saúde?</p>
        <input type="text" name="respostas[saudeImportante]" value="{{ old('respostas.saudeImportante', $resposta->saude_importante) }}">
        <br><br>

        <p>Você está atualmente em uso de hormônios?</p>
        @foreach(['sim' => 'Sim', 'nao' => 'Não', 'nao_sei' => 'Não sei'] as $val => $label)
            <input type="radio" name="respostas[hormonios]" value="{{ $val }}" 
                {{ old('respostas.hormonios', $resposta->hormonios) == $val ? 'checked' : '' }}> {{ $label }}
        @endforeach
        <br><br>

        <p>Se sim, qual o tipo de hormônio?</p>
        @php $hormoniosSalvos = old('respostas.hormoniosTipo', $resposta->hormonios_tipo ?? []); @endphp
        
        {{-- Pegando o valor de texto caso exista no array --}}
        <input type="text" name="respostas[hormoniosTipo][]" value="{{ is_array($hormoniosSalvos) ? ($hormoniosSalvos[0] ?? '') : '' }}">
        
        <input type="checkbox" name="respostas[hormoniosTipo][]" value="nenhum" {{ in_array('nenhum', $hormoniosSalvos) ? 'checked' : '' }}> Não utilizo nenhum
        <br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="{{ route('dashboard') }}">Cancelar</a>
    </form>
</body>
</html>