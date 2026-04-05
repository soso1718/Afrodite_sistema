<section class="space-y-4">

    <header>
        <h2 class="text-sm font-medium text-white">
            {{ __('Atualizar senha') }}
        </h2>
        <p class="mt-1 text-xs text-white/50">
            {{ __('Use uma senha longa e aleatória para manter sua conta segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password"
                   class="block text-[10px] tracking-widest uppercase text-white/40 mb-1">
                {{ __('Senha atual') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded-xl px-4 py-3
                       bg-white/10 border border-white/20
                       text-white text-sm placeholder-white/30
                       focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
            >
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-[#E8A8B5] text-xs" />
        </div>

        <div>
            <label for="update_password_password"
                   class="block text-[10px] tracking-widest uppercase text-white/40 mb-1">
                {{ __('Nova senha') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-xl px-4 py-3
                       bg-white/10 border border-white/20
                       text-white text-sm placeholder-white/30
                       focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
            >
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-[#E8A8B5] text-xs" />
        </div>

        <div>
            <label for="update_password_password_confirmation"
                   class="block text-[10px] tracking-widest uppercase text-white/40 mb-1">
                {{ __('Confirmar senha') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-xl px-4 py-3
                       bg-white/10 border border-white/20
                       text-white text-sm placeholder-white/30
                       focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
            >
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-[#E8A8B5] text-xs" />
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

{{-- Toast: senha atualizada --}}
@if (session('status') === 'password-updated')
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
            <span class="text-sm font-medium">Senha atualizada com sucesso!</span>
        </div>
        <button @click="show = false" class="text-[#5a0018]/60 hover:text-[#5a0018] transition shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif