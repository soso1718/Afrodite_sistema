<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div>
        <h1 class="font-sansita font-semibold text-center text-4xl pb-4">
            Bem-vindo!
        </h1>
        <p class="font-roboto text-center text-sm pb-4">Não tem uma conta? 
            <u><a class="font-semibold hover:text-[#d48f9d]" href="{{ route('register') }}">REGISTRE-SE</a></u>
        </p>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail *')" />
            <x-text-input id="email" class="block bg-[#FFF0F3] font-roboto text-black mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha *')" />

            <x-text-input id="password" class="block bg-[#FFF0F3] font-roboto text-black mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#900131] shadow-sm focus:ring-[#900131]" name="remember">
                <span class="ms-2 font-roboto font-normal text-sm text-[#FFF0F3]">{{ __('Lembre-me') }}</span>
            </label>
        </div>

        <div class="flex items-center flex-col mt-4">
            <x-primary-button class="ms-3">
                {{ __('Login') }}
            </x-primary-button>
            @if (Route::has('password.request'))
                <a class="underline font-roboto font-normal text-sm text-[#FFF0F3] hover:text-[#d48f9d] rounded-md pt-4" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif

        </div>
    </form>
</x-guest-layout>
