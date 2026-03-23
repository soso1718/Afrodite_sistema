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

        <div class="flex items-center gap-3 pt-1">
            <button
                type="submit"
                class="flex-1 bg-[#E8A8B5] hover:bg-[#f2bec8] text-[#5a0018] text-sm tracking-wide
                       py-3 rounded-lg active:scale-95 transition-all"
                style="font-family:'Sansita One',cursive;"
            >
                {{ __('Salvar') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs text-[#E8A8B5]"
                >{{ __('Salvo!') }}</p>
            @endif
        </div>

    </form>

</section>