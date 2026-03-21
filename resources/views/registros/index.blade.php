<h1>Registros</h1>

<table border="1">
    <tr>
        <th>Data</th>
        <th>Tipo</th>
    </tr>

    @forelse ($events as $event)
        <tr>
            <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
            <td>{{ $event->title }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="2">Nenhum registro</td>
        </tr>
    @endforelse
</table>