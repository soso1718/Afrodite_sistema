<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ __('Calendar') }}</h3>
                    <div id="calendar" class="min-h-[600px] border-2 border-gray-200 rounded-lg p-4">
                        <!-- Calendar will be rendered here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Full Calendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.20/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.20/main.min.css" rel="stylesheet">
</x-app-layout>
