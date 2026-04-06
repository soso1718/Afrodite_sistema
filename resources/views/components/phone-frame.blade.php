@props(['navbar' => null, 'toast' => null])

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

{{-- MOBILE: tela cheia normal --}}
<div class="sm:hidden flex flex-col min-h-screen">
    @if($toast)
        <div class="sticky top-0 z-50">{{ $toast }}</div>
    @endif
    <div class="flex-1 overflow-y-auto overflow-x-hidden scrollbar-hide">
        {{ $slot }}
    </div>
    @if($navbar)
        <div class="shrink-0">{{ $navbar }}</div>
    @endif
</div>

{{-- DESKTOP: moldura de celular --}}
<div class="hidden sm:flex min-h-screen w-full items-center justify-center bg-[#1a0009]">
    <div class="relative flex flex-col w-[390px] h-[844px] rounded-[50px] border-[8px] border-[#2a2a2a] shadow-2xl overflow-hidden bg-[#1a0009]">

        {{-- Notch --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-6 bg-[#2a2a2a] rounded-b-2xl z-50 pointer-events-none"></div>

        {{-- Toast: fica fixo no topo da moldura, acima do scroll --}}
        @if($toast)
            <div x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 10000)"
                class="absolute top-8 left-3 right-3 z-50">
                {{ $toast }}
            </div>
        @endif

        {{-- Conteúdo scrollável --}}
        <div class="flex-1 overflow-y-auto overflow-x-hidden scrollbar-hide">
            {{ $slot }}
        </div>

        {{-- Navbar preso no fundo --}}
        @if($navbar)
            <div class="shrink-0 z-40">{{ $navbar }}</div>
        @endif

    </div>
</div>