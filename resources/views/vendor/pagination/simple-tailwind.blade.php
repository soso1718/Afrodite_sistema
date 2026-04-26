@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4 gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded-lg bg-white/10 text-white/40">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="px-3 py-1 rounded-lg bg-white/20 text-white hover:bg-white/30 transition">
                ←
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 rounded-lg bg-white/10 text-white/40">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded-lg bg-white/40 text-white font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1 rounded-lg bg-white/20 text-white hover:bg-white/30 transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="px-3 py-1 rounded-lg bg-white/20 text-white hover:bg-white/30 transition">
                →
            </a>
        @else
            <span class="px-3 py-1 rounded-lg bg-white/10 text-white/40">→</span>
        @endif
    </nav>
@endif
