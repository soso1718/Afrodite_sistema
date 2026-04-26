@props(['navbar' => null, 'toast' => null])

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    @keyframes pulsar {
        0%, 100% { transform: scale(1); opacity: 1; }
        50%       { transform: scale(1.08); opacity: 0.7; }
    }
</style>

{{-- MOBILE: tela cheia normal --}}
<div class="sm:hidden flex flex-col min-h-screen relative">
    @if($toast)
        <div class="sticky top-0 z-50">{{ $toast }}</div>
    @endif
    <div class="flex-1 overflow-y-auto overflow-x-hidden scrollbar-hide">
        {{ $slot }}
    </div>
    @if($navbar)
        <div class="shrink-0">{{ $navbar }}</div>
    @endif

    {{-- Loader mobile --}}
    <div id="loader-mobile"
         style="display:none; position:fixed; inset:0; z-index:9999;
                background: linear-gradient(to bottom, #720026, #900131 50%, #D80048);
                flex-direction:column; align-items:center; justify-content:center; gap:20px;">
        <img src="{{ asset('images/logo-afrodite.jpeg') }}"
             style="width:80px; height:80px; border-radius:50%; object-fit:cover;
                    animation: pulsar 1.2s ease-in-out infinite;">
        <p style="font-family:'Sansita One',cursive; color:#E8A8B5; font-size:14px; letter-spacing:2px;">
            Carregando...
        </p>
    </div>
</div>

{{-- DESKTOP: moldura de celular --}}
<div class="hidden sm:flex min-h-screen w-full items-center justify-center bg-[#1a0009]">

    {{-- ✅ moldura com position:relative para o loader ficar dentro --}}
    <div class="relative flex flex-col w-[390px] h-[844px] rounded-[50px] border-[8px] border-[#2a2a2a] shadow-2xl overflow-hidden bg-[#1a0009]">

        {{-- Notch --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-6 bg-[#2a2a2a] rounded-b-2xl z-[99999] pointer-events-none"></div>

        @if($toast)
            <div x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 10000)"
                class="absolute top-8 left-3 right-3 z-50">
                {{ $toast }}
            </div>
        @endif

        <div class="flex-1 overflow-y-auto overflow-x-hidden scrollbar-hide">
            {{ $slot }}
        </div>

        @if($navbar)
            <div class="shrink-0 z-40">{{ $navbar }}</div>
        @endif

        {{-- ✅ Loader desktop — absolute fica dentro da moldura --}}
        <div id="loader-desktop"
             style="display:none; position:absolute; inset:0; z-index:9999;
                    background: linear-gradient(to bottom, #720026, #900131 50%, #D80048);
                    flex-direction:column; align-items:center; justify-content:center; gap:20px;
                    border-radius: 42px; padding-top: 24px;">
            <img src="{{ asset('images/logo-afrodite.jpeg') }}"
                 style="width:80px; height:80px; border-radius:50%; object-fit:cover;
                        animation: pulsar 1.2s ease-in-out infinite;">
            <p style="font-family:'Sansita One',cursive; color:#E8A8B5; font-size:14px; letter-spacing:2px;">
                Carregando...
            </p>
        </div>

    </div>
</div>

<script>
    function getLoader() {
        return window.innerWidth >= 640
            ? document.getElementById('loader-desktop')
            : document.getElementById('loader-mobile');
    }

    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href && !link.href.startsWith('#') && link.target !== '_blank') {
            const loader = getLoader();
            if (loader) loader.style.display = 'flex';
        }
    });

    document.addEventListener('submit', function() {
        const loader = getLoader();
        if (loader) loader.style.display = 'flex';
    });

    window.addEventListener('pageshow', function() {
        const loaderD = document.getElementById('loader-desktop');
        const loaderM = document.getElementById('loader-mobile');
        if (loaderD) loaderD.style.display = 'none';
        if (loaderM) loaderM.style.display = 'none';
    });
</script>