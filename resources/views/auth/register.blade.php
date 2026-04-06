<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }
    </style>
    <title>Afrodite — Criar conta</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

<x-phone-frame>

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col items-center justify-center px-4 py-10">

        {{-- Logo --}}
        <div class="mb-6">
            <img
                src="{{ asset('images/logo-afrodite.jpeg') }}"
                alt="Afrodite"
                class="w-28 h-auto object-contain"
            >
        </div>

        {{-- Card --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-5 shadow-xl text-white">

            <h1 class="font-display text-2xl text-center mb-5">Criar conta</h1>

            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                @csrf

                {{-- Nome --}}
                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-[10px] tracking-widest uppercase text-white/40">
                        Nome de usuário
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required autofocus autocomplete="name"
                        placeholder="Seu nome"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                    >
                    <x-input-error :messages="$errors->get('name')" class="text-[#E8A8B5] text-xs" />
                </div>

                {{-- Email --}}
                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-[10px] tracking-widest uppercase text-white/40">
                        E-mail
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autocomplete="username"
                        placeholder="seu@email.com"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                    >
                    <x-input-error :messages="$errors->get('email')" class="text-[#E8A8B5] text-xs" />
                </div>

                {{-- Senha --}}
                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-[10px] tracking-widest uppercase text-white/40">
                        Senha
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                    >
                    <x-input-error :messages="$errors->get('password')" class="text-[#E8A8B5] text-xs" />
                </div>

                {{-- Confirmar senha --}}
                <div class="flex flex-col gap-1.5">
                    <label for="password_confirmation" class="text-[10px] tracking-widest uppercase text-white/40">
                        Confirmar senha
                    </label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                    >
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-[#E8A8B5] text-xs" />
                </div>

                {{-- Botão --}}
                <button
                    type="submit"
                    class="font-display w-full
                           bg-[#E8A8B5] hover:bg-[#f2bec8] text-[#5a0018]
                           text-sm tracking-wider
                           py-3.5 rounded-xl
                           active:scale-95 transition-all mt-1"
                >
                    Criar conta
                </button>

                {{-- Já tem conta --}}
                <a
                    href="{{ route('login') }}"
                    class="text-center text-xs text-white/50 hover:text-[#E8A8B5] transition underline underline-offset-2"
                >
                    Já tem uma conta? Entrar
                </a>

            </form>
        </div>

        <p class="text-white/20 text-[10px] tracking-widest uppercase mt-6">
            Afrodite &copy; {{ date('Y') }}
        </p>

    </div>

</x-phone-frame>

</body>
</html>