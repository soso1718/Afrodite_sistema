<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ler artigo</title>
</head>
<body>
    <x-app-layout>
    
    <h1>{{ $artigo->titulo }}</h1>

    <p>
        {{ $artigo->conteudo }}
    </p>

    <p>
        <a href="{{ route('artigos.index') }}">
            Voltar
        </a>
    </p>

    </x-app-layout>
</body>
</html>