<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Artigos</title>
</head>
<body>
    <x-app-layout>

    <h1>Artigos (Admin)</h1>

    <p>
        <a href="{{ route('artigos.create') }}">
            Criar novo artigo
        </a>
    </p>

    @forelse ($artigos as $artigo)
        <hr>

        <h2>{{ $artigo->titulo }}</h2>

        <p>
            {{ \Illuminate\Support\Str::limit($artigo->conteudo, 200) }}
        </p>

        <p>
            <a href="{{ route('artigos.show', $artigo->id) }}">
                Ver
            </a>
            |
            <a href="{{ route('artigos.edit', $artigo->id) }}">
                Editar
            </a>
            |
            <form
                action="{{ route('artigos.destroy', $artigo->id) }}"
                method="POST"
                onsubmit="return confirm('Tem certeza que deseja excluir este artigo?')">
                @csrf
                @method('DELETE')

                <button type="submit">Excluir</button>
            </form>

            </form>
        </p>

    @empty
        <p>Não há artigos cadastrados.</p>
    @endforelse

</x-app-layout>

</body>
</html>