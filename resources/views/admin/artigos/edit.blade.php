<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar artigo</title>
</head>
<body>
    <x-app-layout>

    <h1>Editar artigo</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    <form method="POST" action="{{ route('artigos.update', $artigo->id) }}">
        @csrf
        @method('PUT')

        <p>
            <label>Título</label><br>
            <input type="text" name="titulo" value="{{ $artigo->titulo }}">
        </p>

        <p>
            <label>Conteúdo</label><br>
            <textarea name="conteudo" rows="6">{{ $artigo->conteudo }}</textarea>
        </p>

        <button type="submit">Atualizar</button>
    </form>

</x-app-layout>

</body>
</html>