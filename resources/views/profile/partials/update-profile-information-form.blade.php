<section class="space-y-4">

    <header>
        <h2 class="text-sm font-medium text-white">
            {{ __('Informações do perfil') }}
        </h2>
        <p class="mt-1 text-xs text-white/50">
            {{ __('Atualize seu nome e endereço de e-mail.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name"
                   class="block text-[10px] tracking-widests uppercase text-white/40 mb-1">
                {{ __('Nome') }}
            </label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required autocomplete="name"
                class="w-full rounded-xl px-4 py-3
                       bg-white/10 border border-white/20
                       text-white text-sm placeholder-white/30
                       focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
            >
            <x-input-error class="mt-1 text-[#E8A8B5] text-xs" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email"
                   class="block text-[10px] tracking-widest uppercase text-white/40 mb-1">
                {{ __('E-mail') }}
            </label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required autocomplete="username"
                class="w-full rounded-xl px-4 py-3
                       bg-white/10 border border-white/20
                       text-white text-sm placeholder-white/30
                       focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
            >
            <x-input-error class="mt-1 text-[#E8A8B5] text-xs" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-xs text-white/60">
                        {{ __('Seu e-mail não foi verificado.') }}
                        <button form="send-verification"
                                class="underline text-[#E8A8B5] text-xs hover:text-white focus:outline-none transition">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs text-[#E8A8B5]">
                            {{ __('Um novo link de verificação foi enviado para o seu e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <button
            type="submit"
            class="w-full bg-[#E8A8B5] hover:bg-[#f2bec8] text-[#5a0018] text-sm tracking-wide
                   py-3 rounded-lg active:scale-95 transition-all"
            style="font-family:'Sansita One',cursive;"
        >
            {{ __('Salvar') }}
        </button>

    </form>

</section>

{{-- Toast: perfil atualizado --}}
@if (session('status') === 'profile-updated')
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 10000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="fixed top-4 left-1/2 -translate-x-1/2
               w-[90%] max-w-sm z-50
               bg-[#E8A8B5] text-[#5a0018]
               rounded-xl px-4 py-3 shadow-xl
               flex items-center justify-between gap-3"
    >
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">Informações atualizadas com sucesso!</span>
        </div>
        <button @click="show = false" class="text-[#5a0018]/60 hover:text-[#5a0018] transition shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif