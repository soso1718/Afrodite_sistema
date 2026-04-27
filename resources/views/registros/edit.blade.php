<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Editar Registro</title>
</head>
<body class="bg-[#1a0009] flex justify-center min-h-screen items-center">

<div class="bg-[#B23A48] p-6 rounded-xl shadow-lg w-full max-w-md">
    <h1 class="text-white text-xl mb-4">Editar Registro</h1>

    <form action="{{ route('registros.update', $event->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-white/70 text-sm mb-1">Data</label>
            <input type="date" name="date" value="{{ $event->date }}" 
                   class="w-full rounded-md px-3 py-2 text-black">
        </div>

        <div>
            <label class="block text-white/70 text-sm mb-1">Tipo</label>
            <input type="text" name="title" value="{{ $event->title }}" 
                   class="w-full rounded-md px-3 py-2 text-black">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('registros.index') }}" class="text-sm text-white/70 hover:text-white">Cancelar</a>
            <button type="submit" class="bg-[#720026] text-white px-4 py-2 rounded-md">Salvar</button>
        </div>
    </form>
</div>

<script>
    // Após salvar, atualiza o calendário
    if(session('success'))
        if (window.calendar) {
            window.calendar.refetchEvents();
        }
    endif
</script>

</body>
</html>
