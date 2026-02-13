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

    <label>Seu ciclo menstrual é regulado? Ocorre a cada 21 a 35 dias, com sangramento de 3 a 7 dias</label>
    <select name="respostas[duracaoCiclo]">
        <option value="sim">Sim</option>
        <option value="nao">Não</option>
        <option value="asVezes">Às vezes</option>
        <option value="naoSei">Não Sei</option>
    </select>

    <br><br>

    <button type="submit">Enviar</button>
</form>
</form>
</body>
</html>