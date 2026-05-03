{{-- Slide 1 — Boas vindas --}}
<div class="slide flex-col items-center justify-center px-8 pb-8 gap-6">
    <div class="flutuar">
        <img src="{{ asset('images/logo-afrodite.jpeg') }}"
             alt="Afrodite"
             class="w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-white/20">
    </div>
    <div class="text-center aparecer">
        <h1 class="font-display text-white text-3xl mb-3">Bem-vinda ao Afrodite</h1>
        <p class="text-white/60 text-sm leading-relaxed">
            O aplicativo feito com carinho para você acompanhar e entender melhor o seu ciclo menstrual.
        </p>
    </div>
</div>

{{-- Slide 2 — Calendário --}}
<div class="slide flex-col items-center justify-center px-8 pb-8 gap-6">
    <div class="flutuar">
        <div class="w-36 h-36 rounded-3xl bg-white/10 border border-white/20 flex items-center justify-center shadow-2xl">
            <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke="#E8A8B5" stroke-width="1.5"/>
                <path stroke="#E8A8B5" stroke-linecap="round" stroke-width="1.5" d="M16 2v4M8 2v4M3 10h18"/>
                <circle cx="8" cy="15" r="1.5" fill="#f87171"/>
                <circle cx="12" cy="15" r="1.5" fill="#f87171"/>
                <circle cx="16" cy="15" r="1.5" fill="#f87171"/>
            </svg>
        </div>
    </div>
    <div class="text-center aparecer">
        <h1 class="font-display text-white text-3xl mb-3">Marque seus dias</h1>
        <p class="text-white/60 text-sm leading-relaxed">
            Toque em qualquer dia do calendário para registrar o início da sua menstruação. É simples assim!
        </p>
    </div>
</div>

{{-- Slide 3 — Ciclo --}}
<div class="slide flex-col items-center justify-center px-8 pb-8 gap-6">
    <div class="flutuar">
        <div class="w-36 h-36 rounded-3xl bg-white/10 border border-white/20 flex flex-col items-center justify-center gap-3 shadow-2xl">
            <div class="flex gap-2 items-center">
                <div class="w-3 h-3 rounded-full bg-[#f87171]" style="box-shadow:0 0 8px #f87171"></div>
                <span class="text-white/70 text-xs">Menstruação</span>
            </div>
            <div class="flex gap-2 items-center">
                <div class="w-3 h-3 rounded-full bg-[#fbbf24]" style="box-shadow:0 0 8px #fbbf24"></div>
                <span class="text-white/70 text-xs">Período fértil</span>
            </div>
            <div class="flex gap-2 items-center">
                <div class="w-3 h-3 rounded-full bg-[#a78bfa]" style="box-shadow:0 0 8px #a78bfa"></div>
                <span class="text-white/70 text-xs">Ovulação</span>
            </div>
        </div>
    </div>
    <div class="text-center aparecer">
        <h1 class="font-display text-white text-3xl mb-3">Conheça seu corpo</h1>
        <p class="text-white/60 text-sm leading-relaxed">
            O Afrodite calcula automaticamente seu período fértil e ovulação com base no seu ciclo.
        </p>
    </div>
</div>

{{-- Slide 4 — Registros --}}
<div class="slide flex-col items-center justify-center px-8 pb-8 gap-6">
    <div class="flutuar">
        <div class="w-36 h-36 rounded-3xl bg-white/10 border border-white/20 flex items-center justify-center shadow-2xl">
            <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="#E8A8B5" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
    </div>
    <div class="text-center aparecer">
        <h1 class="font-display text-white text-3xl mb-3">Seu histórico</h1>
        <p class="text-white/60 text-sm leading-relaxed">
            Acesse seus registros a qualquer momento, edite ou exclua datas e acompanhe seu histórico mês a mês.
        </p>
    </div>
</div>

{{-- Slide 5 — CTA --}}
<div class="slide flex-col items-center justify-center px-8 pb-8 gap-6">
    <div class="pulsar">
        <img src="{{ asset('images/logo-afrodite.jpeg') }}"
             alt="Afrodite"
             class="w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-[#E8A8B5]/40">
    </div>
    <div class="text-center aparecer">
        <h1 class="font-display text-white text-3xl mb-3">Pronta para começar?</h1>
        <p class="text-white/60 text-sm leading-relaxed mb-6">
            Crie sua conta gratuitamente e comece a cuidar de você hoje mesmo.
        </p>
        <div class="flex flex-col gap-3">
            <a href="{{ route('register') }}"
               class="font-display w-full text-center
                      bg-[#E8A8B5] hover:bg-[#f2bec8] text-[#5a0018]
                      text-sm tracking-wider py-4 rounded-xl
                      active:scale-95 transition-all">
                Criar conta
            </a>
            <a href="{{ route('login') }}"
               class="font-display w-full text-center
                      bg-white/10 border border-white/20
                      text-white text-sm tracking-wider py-4 rounded-xl
                      active:scale-95 transition-all">
                Já tenho conta
            </a>
        </div>
    </div>
</div>