<section class="space-y-4">

    <header>
        <h2 class="text-sm font-medium text-white">
            {{ __('Deletar conta') }}
        </h2>
        <p class="mt-1 text-xs text-white/50">
            {{ __('Ao deletar sua conta, todos os seus dados serão permanentemente removidos. Baixe qualquer informação que deseja manter antes de continuar.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full bg-[#720026]/60 hover:bg-[#720026] border border-[#E8A8B5]/30
               text-[#E8A8B5] text-sm tracking-wide
               py-3 rounded-lg
               active:scale-95 transition-all"
        style="font-family:'Sansita One',cursive;"
    >
        {{ __('Deletar conta') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
              class="p-6 bg-[#B23A48] rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-base font-medium text-white" style="font-family:'Sansita One',cursive;">
                {{ __('Tem certeza que quer deletar sua conta?') }}
            </h2>

            <p class="mt-2 text-xs text-white/60">
                {{ __('Todos os seus dados serão permanentemente removidos. Digite sua senha para confirmar.') }}
            </p>

            <div class="mt-5">
                <x-input-label for="password" value="{{ __('Senha') }}"
                    class="sr-only" />
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Sua senha') }}"
                    class="w-full rounded-xl px-4 py-3
                           bg-white/10 border border-white/20
                           text-white text-sm placeholder-white/30
                           focus:outline-none focus:ring-2 focus:ring-[#E8A8B5]"
                >
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-[#E8A8B5] text-xs" />
            </div>

            <div class="mt-5 flex gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="flex-1 bg-white/10 hover:bg-white/20 border border-white/20
                           text-white/80 text-sm
                           py-3 rounded-lg
                           active:scale-95 transition-all"
                    style="font-family:'Sansita One',cursive;"
                >
                    {{ __('Cancelar') }}
                </button>

                <button
                    type="submit"
                    class="flex-1 bg-[#720026] hover:bg-[#900131] border border-[#E8A8B5]/20
                           text-[#E8A8B5] text-sm
                           py-3 rounded-lg
                           active:scale-95 transition-all"
                    style="font-family:'Sansita One',cursive;"
                >
                    {{ __('Confirmar') }}
                </button>

            </div>
        </form>
    </x-modal>

</section>