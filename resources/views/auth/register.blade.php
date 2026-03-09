<x-guest-layout>
    <div class="text-center">
        <h1 class="font-sansita font-semibold text-center text-4xl pb-4">Criar conta</h1>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome de usuário *')" />
            <x-text-input id="name" class="block bg-[#FFF0F3] font-roboto text-black mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail *')" />
            <x-text-input id="email" class="block font-roboto bg-[#FFF0F3] text-black mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha *')" />

            <x-text-input id="password" class="block bg-[#FFF0F3] font-roboto text-black mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar senha *')" />

            <x-text-input id="password_confirmation" class="block bg-[#FFF0F3] font-roboto text-black mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center flex-col mt-4">
            <x-primary-button class="ms-4">
                {{ __('Criar') }}
            </x-primary-button>
            <a class="underline pt-4 font-roboto text-sm text-[#FFF0F3] hover:text-[#d48f9d] rounded-md" href="{{ route('login') }}">
                {{ __('Já tem uma conta?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
