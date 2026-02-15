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

            <h2>Respostas do Questionário</h2>
                <p>
                    <strong>Idade:</strong>
                    {{ $resposta->idade }} anos
                </p>

                <p>
                    <strong>Ciclo menstrual:</strong>
                    @switch($resposta->ciclo_regular)
                        @case('sim') Regular @break
                        @case('nao') Irregular @break
                        @case('asVezes') Às vezes regular @break
                        @default Não informado
                    @endswitch
                </p>

                <p>
                    <strong>Última menstruação:</strong>
                    @if($resposta->data_ultima_menstruacao === 'nao_sei')
                        Não soube informar
                    @elseif($resposta->data_ultima_menstruacao)
                        {{ \Carbon\Carbon::parse($resposta->data_ultima_menstruacao)->format('d/m/Y') }}
                    @else
                        —
                    @endif
                </p>

                <p>
                    <strong>Objetivo principal:</strong>
                    {{ $resposta->objetivo
                        ? collect($resposta->objetivo)->map(fn($o) => match ($o) {
                            'acompanhar' => 'Acompanhar menstruação',
                            'fertilidade' => 'Monitorar fertilidade',
                            'sintomas' => 'Entender sintomas do corpo',
                            'hormonal' => 'Organizar saúde hormonal',
                            default => $o,
                        })->join(', ')
                        : '—'
                    }}
                </p>

                <p>
                    <strong>Saúde importante:</strong>
                    {{ $resposta->saude_importante ?: 'Nada relevante informado' }}
                </p>

                <p>
                    <strong>Uso de hormônios:</strong>
                    @switch($resposta->hormonios)
                        @case('sim') Sim @break
                        @case('nao') Não @break
                        @case('nao_sei') Não soube informar @break
                        @default —
                    @endswitch
                </p>

</div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    


                
</x-app-layout>
