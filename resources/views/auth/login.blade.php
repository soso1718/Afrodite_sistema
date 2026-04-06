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
        input[type="checkbox"] { accent-color: #E8A8B5; }
    </style>
    <title>Afrodite — Login</title>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

<x-phone-frame>

    <div class="w-full min-w-[320px] max-w-sm min-h-screen overflow-x-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]
                flex flex-col items-center justify-center px-4 py-10">

            {{-- Logo --}}
            <div class="mb-8 flex flex-col items-center gap-2">

                <img
                    src="{{ asset('images/logo-afrodite.jpeg') }}"
                    alt="Afrodite"
                    class="w-32 h-32 rounded-full object-cover shadow-xl"
                >

            </div>

        {{-- Card --}}
        <div class="w-full bg-[#B23A48] rounded-2xl p-5 shadow-xl text-white">

            <h1 class="font-display text-2xl text-center mb-1">Bem-vindo!</h1>
            <p class="text-center text-xs text-white/60 mb-5">
                Não tem uma conta?
                <a href="{{ route('register') }}"
                   class="text-[#E8A8B5] hover:text-white transition underline underline-offset-2">
                    Registre-se
                </a>
            </p>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4 text-xs text-[#E8A8B5]" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                @csrf

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
                        required autofocus autocomplete="username"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                        placeholder="seu@email.com"
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
                        required autocomplete="current-password"
                        class="w-full rounded-xl px-4 py-3
                               bg-white/10 border border-white/20
                               text-white text-sm placeholder-white/30
                               focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                        placeholder="••••••••"
                    >
                    <x-input-error :messages="$errors->get('password')" class="text-[#E8A8B5] text-xs" />
                </div>

                {{-- Lembre-me --}}
                <label class="flex items-center gap-2 text-sm text-white/70 cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-white/30 shrink-0"
                    >
                    Lembre-me
                </label>

                {{-- Botão --}}
                <button
                    type="submit"
                    class="font-display w-full
                           bg-[#E8A8B5] hover:bg-[#f2bec8] text-[#5a0018]
                           text-sm tracking-wider
                           py-3.5 rounded-xl
                           active:scale-95 transition-all mt-1"
                >
                    Entrar
                </button>

                {{-- Esqueceu a senha --}}
                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-center text-xs text-white/50 hover:text-[#E8A8B5] transition underline underline-offset-2"
                    >
                        Esqueceu sua senha?
                    </a>
                @endif

            </form>
        </div>

        <p class="text-white/20 text-[10px] tracking-widest uppercase mt-6">
            Afrodite &copy; {{ date('Y') }}
        </p>

    </div>

</x-phone-frame>

</body>
</html>