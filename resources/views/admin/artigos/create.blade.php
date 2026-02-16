<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar artigo</title>
</head>
<body>
    <x-app-layout>

    <h1>Criar artigo</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    <form method="POST" action="{{ route('artigos.store') }}">
        @csrf

        <p>
            <label>Título</label><br>
            <input type="text" name="titulo">
        </p>

        <p>
            <label>Conteúdo</label><br>
            <textarea name="conteudo" rows="6"></textarea>
        </p>

        <button type="submit">Salvar</button>
    </form>

</x-app-layout>

</body>
</html>