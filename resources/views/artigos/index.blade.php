<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos</title>
</head>
<body>
    
<x-app-layout>

    <h1>Artigos</h1>

    @forelse ($artigos as $artigo)
        <hr>

        <h2>{{ $artigo->titulo }}</h2>

        <p>
            {{ \Illuminate\Support\Str::limit($artigo->conteudo, 200) }}
        </p>

        <a href="{{ route('artigos.show', $artigo->id) }}">
            Ler artigo
        </a>

    @empty
        <p>Não há artigos cadastrados.</p>
    @endforelse

</x-app-layout>


</body>
</html>