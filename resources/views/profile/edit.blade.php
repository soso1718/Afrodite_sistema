<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <h2>Respostas do Questionário</h2>

    @foreach($respostas as $resposta)
        <div class="resposta">
            <p><strong>Idade:</strong> {{ $resposta->idade }}</p>
            <p><strong>Ciclo Regular:</strong> {{ $resposta->cicloRegular }}</p>
            <p><strong>Data da Última Menstruação:</strong> {{ $resposta->dataUltimaMenstruacao }}</p>
            <p><strong>Objetivo:</strong> {{ implode(', ', $resposta->objetivo) }}</p>
            <p><strong>Saúde Importante:</strong> {{ $resposta->saudeImportante }}</p>
            <p><strong>Uso de Hormônios:</strong> {{ implode(', ', $resposta->hormoniosTipo) }}</p>
        </div>
    @endforeach             
</x-app-layout>
