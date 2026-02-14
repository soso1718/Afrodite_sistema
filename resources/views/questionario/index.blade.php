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

    <p>Seu ciclo menstrual é regular? (Ocorre a cada 21 a 35 dias, com sangramento de 3 a 7 dias)</p>
        <label>
            <input type="radio" name="respostas[cicloRegular]" value="sim"> Sim
        </label>

        <label>
            <input type="radio" name="respostas[cicloRegular]" value="nao"> Não
        </label>

        <label>
            <input type="radio" name="respostas[cicloRegular]" value="asVezes"> Às vezes
        </label>

        <label>
            <input type="radio" name="respostas[cicloRegular]" value="nao_sei"> Não sei
        </label>

    <br><br>

    <p>Quando foi o primeiro dia da sua última menstruação?</p>
        <input type="date" name="respostas[dataUltimaMenstruacao]">

        <label>
            <input type="checkbox" name="respostas[dataUltimaMenstruacao]" value="nao_sei"> Não sei
        </label>

    <br><br>

    <p>Qual seu principal objetivo com o app?</p>
        <label>
            <input type="checkbox" name="respostas[objetivo][]" value="acompanhar">
            Acompanhar menstruação
        </label>

        <label>
            <input type="checkbox" name="respostas[objetivo][]" value="fertilidade">
            Monitorar fertilidade
        </label>

        <label>
            <input type="checkbox" name="respostas[objetivo][]" value="sintomas">
            Entender sintomas do corpo
        </label>

        <label>
            <input type="checkbox" name="respostas[objetivo][]" value="hormonal">
            Organizar saúde hormonal
        </label>

        <p>Outro:</p>
            <input type="text" name="respostas[objetivoOutro]">

<br> <br>

    <p>Há algo de importante sobre sua saúde que deveríamos considerar? (Ex.:SOP, endometriose, disforia de gênero, etc.)</p>
        <input type="text" name="respostas[saudeImportante]">

        <label>
            <input type="checkbox" name="respostas[saudeImportante]" value="nada"> Não há nada
        </label>

    <br><br>

    <p>Você está atualmente em uso de hormônios que afetam o ciclo menstrual? (Ex.:Testosterona, anticoncepcionais, etc.)</p>
        <label>
            <input type="radio" name="respostas[hormonios]" value="sim"> Sim
        </label>

        <label>
            <input type="radio" name="respostas[hormonios]" value="nao"> Não
        </label>

        <label>
            <input type="radio" name="respostas[hormonios]" value="nao_sei"> Não sei
        </label>

    <br><br>

    <p>Se sim, qual o tipo de hormônio ou método contraceptivo você utiliza?</p>
        <input type="text" name="respostas[hormoniosTipo]">

        <label>
            <input type="checkbox" name="respostas[hormoniosTipo]" value="nenhum"> Não utilizo nenhum hormônio ou método contraceptivo
        </label>
    <br><br>



    <button type="submit">Iniciar</button>
</form>
</form>
</body>
</html>