<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionário Afrodite</title>
</head>
<body>
    <h1>Conhecendo seu ciclo</h1>
    <form method="POST" action="{{ route('questionario.store') }}">
    @csrf

<label>Idade</label>
    <input type="text" name="respostas[idade]">
<br><br>

<p>Seu ciclo menstrual é regular? (Ocorre a cada 24 à 35 dias, com sangramento de 3 à 7 dias)</p>
    <input type="radio" name="respostas[cicloRegular]" value="sim"> Sim
    <input type="radio" name="respostas[cicloRegular]" value="nao"> Não
    <input type="radio" name="respostas[cicloRegular]" value="asVezes"> Às vezes
    <input type="radio" name="respostas[cicloRegular]" value="nao_sei"> Não sei
<br><br>

<p>Quando foi a data da sua última menstruação?</p>
    <input type="date" name="respostas[dataUltimaMenstruacao]">
    <input type="checkbox" name="respostas[dataUltimaMenstruacaoNaoSei]" value="1"> Não sei
<br><br>

<p>Qual seu objetivo com nosso app?</p>
    <input type="checkbox" name="respostas[objetivo][]" value="acompanhar"> Acompanhar ciclo menstrual
    <input type="checkbox" name="respostas[objetivo][]" value="fertilidade"> Monitorar fertilidade
    <input type="checkbox" name="respostas[objetivo][]" value="sintomas"> Entender os sintomas do corpo
    <input type="checkbox" name="respostas[objetivo][]" value="hormonal"> Organizar saúde hormonal
    <br>
    <label>Outro objetivo (especifique):
        <input type="text" name="respostas[objetivoOutro]"> 
    </label>
    
<br><br>

<p>Há algo de importante que devemos considerar sobre sua saúde? (Ex.:SOP, endometriose, disforia de gênero etc)</p>
    <input type="text" name="respostas[saudeImportante]">
    <input type="checkbox" name="respostas[saudeNada]" value="1"> Não há nada de importante a considerar
<br><br>

<p>Você está atualmente em uso de hormônios que afetam o ciclo menstrual? (Ex.: testosterona, anticonsepcionais etc)?</p>
    <input type="radio" name="respostas[hormonios]" value="sim"> Sim
    <input type="radio" name="respostas[hormonios]" value="nao"> Não
    <input type="radio" name="respostas[hormonios]" value="nao_sei"> Não sei
<br><br>

<p>Se sim, qual o tipo de hormônio ou método contraceptivo você utiliza?</p>
    <input type="text" name="respostas[hormoniosTipo][]">
    <input type="checkbox" name="respostas[hormoniosTipo][]" value="nenhum"> Não utilizo nenhum hormônio ou método contraceptivo
<br><br>

<button type="submit">Iniciar</button>
</form>

</body>
</html>