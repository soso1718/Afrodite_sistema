<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+One&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Sansita One', cursive; }

        .slide { display: none; flex-direction: column; align-items: center; justify-content: center; padding: 0 2rem 2rem; gap: 1.5rem; opacity: 0; transform: translateX(60px); transition: all 0.5s cubic-bezier(0.4,0,0.2,1); }
        .slide.active { display: flex; opacity: 1; transform: translateX(0); }
        .slide.saindo { opacity: 0; transform: translateX(-60px); }

        @keyframes flutuar {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }
        @keyframes pulsar {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.05); opacity: 0.85; }
        }
        @keyframes aparecer {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .flutuar { animation: flutuar 3s ease-in-out infinite; }
        .pulsar   { animation: pulsar 2s ease-in-out infinite; }
        .aparecer { animation: aparecer 0.6s ease forwards; }

        .dot-nav { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.3); transition: all 0.3s ease; cursor: pointer; }
        .dot-nav.ativo { background: #E8A8B5; width: 24px; border-radius: 4px; }
    </style>
</head>

<body class="flex justify-center bg-[#1a0009] min-h-screen">

{{-- MOBILE --}}
<div class="sm:hidden w-full min-h-screen flex flex-col
            bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]">

    <div class="flex justify-end px-6 pt-8 pb-2">
        <a href="{{ route('login') }}" class="btn-pular text-white/40 text-xs tracking-widest uppercase">Pular</a>
    </div>

    <div class="flex-1 flex flex-col slides-wrapper">

        <div class="slide active">
            <div class="flutuar">
                <img src="{{ asset('images/logo-afrodite.jpeg') }}" class="w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-white/20">
            </div>
            <div class="text-center aparecer">
                <h1 class="font-display text-white text-3xl mb-3">Bem-vinda ao Afrodite</h1>
                <p class="text-white/60 text-sm leading-relaxed">O aplicativo feito com carinho para você acompanhar e entender melhor o seu ciclo menstrual.</p>
            </div>
        </div>

        <div class="slide">
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
                <p class="text-white/60 text-sm leading-relaxed">Toque em qualquer dia do calendário para registrar o início da sua menstruação. É simples assim!</p>
            </div>
        </div>

        <div class="slide">
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
                <p class="text-white/60 text-sm leading-relaxed">O Afrodite calcula automaticamente seu período fértil e ovulação com base no seu ciclo.</p>
            </div>
        </div>

        <div class="slide">
            <div class="flutuar">
                <div class="w-36 h-36 rounded-3xl bg-white/10 border border-white/20 flex items-center justify-center shadow-2xl">
                    <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="#E8A8B5" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="text-center aparecer">
                <h1 class="font-display text-white text-3xl mb-3">Seu histórico</h1>
                <p class="text-white/60 text-sm leading-relaxed">Acesse seus registros a qualquer momento, edite ou exclua datas e acompanhe seu histórico mês a mês.</p>
            </div>
        </div>

        <div class="slide">
            <div class="pulsar">
                <img src="{{ asset('images/logo-afrodite.jpeg') }}" class="w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-[#E8A8B5]/40">
            </div>
            <div class="text-center aparecer">
                <h1 class="font-display text-white text-3xl mb-3">Pronta para começar?</h1>
                <p class="text-white/60 text-sm leading-relaxed mb-4">Crie sua conta gratuitamente e comece a cuidar de você hoje mesmo.</p>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('register') }}" class="font-display w-full text-center bg-[#E8A8B5] text-[#5a0018] text-sm tracking-wider py-4 rounded-xl active:scale-95 transition-all">Criar conta</a>
                    <a href="{{ route('login') }}" class="font-display w-full text-center bg-white/10 border border-white/20 text-white text-sm tracking-wider py-4 rounded-xl active:scale-95 transition-all">Já tenho conta</a>
                </div>
            </div>
        </div>

    </div>

    <div class="px-8 pb-10 flex flex-col gap-4">
        <div class="flex justify-center gap-2 dots-wrapper"></div>
        <div class="flex gap-3">
            <button class="btn-anterior font-display flex-1 bg-white/10 border border-white/20
                        text-white text-sm tracking-wider py-4 rounded-xl
                        active:scale-95 transition-all"
                    style="display:none;">
                Voltar
            </button>
            <button class="btn-proximo font-display flex-1 bg-[#E8A8B5] text-[#5a0018]
                        text-sm tracking-wider py-4 rounded-xl
                        active:scale-95 transition-all">
                Próximo
            </button>
        </div>
    </div>
</div>

{{-- DESKTOP --}}
<div class="hidden sm:flex min-h-screen w-full items-center justify-center bg-[#1a0009]">
    <div class="relative flex flex-col w-[390px] h-[844px] rounded-[50px] border-[8px] border-[#2a2a2a] shadow-2xl overflow-hidden
                bg-gradient-to-b from-[#720026] via-[#900131] to-[#D80048]">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-6 bg-[#2a2a2a] rounded-b-2xl z-[99999] pointer-events-none"></div>

        <div class="flex justify-end px-6 pt-10 pb-2">
            <a href="{{ route('login') }}" class="btn-pular text-white/40 text-xs tracking-widest uppercase">Pular</a>
        </div>

        <div class="flex-1 flex flex-col slides-wrapper overflow-hidden">

            <div class="slide active">
                <div class="flutuar">
                    <img src="{{ asset('images/logo-afrodite.jpeg') }}" class="w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-white/20">
                </div>
                <div class="text-center aparecer">
                    <h1 class="font-display text-white text-3xl mb-3">Bem-vindo ao Afrodite</h1>
                    <p class="text-white/60 text-sm leading-relaxed">O aplicativo feito com carinho para você acompanhar e entender melhor o seu ciclo menstrual.</p>
                </div>
            </div>

            <div class="slide">
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
                    <p class="text-white/60 text-sm leading-relaxed">Toque em qualquer dia do calendário para registrar o início da sua menstruação. É simples assim!</p>
                </div>
            </div>

            <div class="slide">
                <div class="flutuar">
                    <div class="w-36 h-36 rounded-3xl bg-white/10 border border-white/20 flex flex-col items-center justify-center gap-3 shadow-2xl">
                        <div class="flex gap-2 items-center">
                            <div class="w-3 h-3 rounded-full bg-[#e42615]" style="box-shadow:0 0 8px #f08c8c"></div>
                            <span class="text-white/70 text-xs">Ovulação</span>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="w-3 h-3 rounded-full bg-[#fc5849]" style="box-shadow:0 0 8px #f08c8c"></div>
                            <span class="text-white/70 text-xs">Período fértil</span>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="w-3 h-3 rounded-full bg-[#f08c8c]" style="box-shadow:0 0 8px #f08c8c"></div>
                            <span class="text-white/70 text-xs">Menstruação</span>
                        </div>
                    </div>
                </div>
                <div class="text-center aparecer">
                    <h1 class="font-display text-white text-3xl mb-3">Conheça seu corpo</h1>
                    <p class="text-white/60 text-sm leading-relaxed">O Afrodite calcula automaticamente seu período fértil e ovulação com base no seu ciclo.</p>
                </div>
            </div>

            <div class="slide">
                <div class="flutuar">
                    <div class="w-36 h-36 rounded-3xl bg-white/10 border border-white/20 flex items-center justify-center shadow-2xl">
                        <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="#E8A8B5" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-center aparecer">
                    <h1 class="font-display text-white text-3xl mb-3">Artigos relevantes</h1>
                        <p class="text-white/60 text-sm leading-relaxed">Acesse artigos selecionados sobre saúde menstrual, fertilidade e bem-estar feminino — tudo em um só lugar.
                        </p>
                </div>
            </div>

            <div class="slide">
                <div class="pulsar">
                    <img src="{{ asset('images/logo-afrodite.jpeg') }}" class="w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-[#E8A8B5]/40">
                </div>
                <div class="text-center aparecer">
                    <h1 class="font-display text-white text-3xl mb-3">Pronto para começar?</h1>
                    <p class="text-white/60 text-sm leading-relaxed mb-4">Crie sua conta gratuitamente e comece a cuidar de você hoje mesmo.</p>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('register') }}" class="font-display w-full text-center bg-[#E8A8B5] text-[#5a0018] text-sm tracking-wider py-4 rounded-xl active:scale-95 transition-all">Criar conta</a>
                        <a href="{{ route('login') }}" class="font-display w-full text-center bg-white/10 border border-white/20 text-white text-sm tracking-wider py-4 rounded-xl active:scale-95 transition-all">Já tenho conta</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="px-8 pb-10 flex flex-col gap-4">
            <div class="flex justify-center gap-2 dots-wrapper"></div>
            <div class="flex gap-3">
                <button class="btn-anterior font-display flex-1 bg-white/10 border border-white/20
                            text-white text-sm tracking-wider py-4 rounded-xl
                            active:scale-95 transition-all"
                        style="display:none;">
                    Voltar
                </button>
                <button class="btn-proximo font-display flex-1 bg-[#E8A8B5] text-[#5a0018]
                            text-sm tracking-wider py-4 rounded-xl
                            active:scale-95 transition-all">
                    Próximo
                </button>
            </div>
            {{-- ✅ Loader DESKTOP aqui dentro --}}
            <div id="loader-desktop-onboarding"
                style="display:none; position:absolute; inset:0; z-index:9999; border-radius:42px;
                        background: linear-gradient(to bottom, #720026, #900131 50%, #D80048);
                        flex-direction:column; align-items:center; justify-content:center; gap:20px;">
                <img src="{{ asset('images/logo-afrodite.jpeg') }}"
                    style="width:80px; height:80px; border-radius:50%; object-fit:cover;
                            animation: pulsar-load 1.2s ease-in-out infinite;">
                <p style="font-family:'Sansita One',cursive; color:#E8A8B5; font-size:14px; letter-spacing:2px;">
                    Carregando...
                </p>
            </div>
        </div>

    </div>
</div>

{{-- Loader MOBILE --}}
<div id="loader-mobile-onboarding"
     style="display:none; position:fixed; inset:0; z-index:99999;
            background: linear-gradient(to bottom, #720026, #900131 50%, #D80048);
            flex-direction:column; align-items:center; justify-content:center; gap:20px;">
    <style>
        @keyframes pulsar-load {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.08); opacity: 0.7; }
        }
    </style>
    <img src="{{ asset('images/logo-afrodite.jpeg') }}"
         style="width:80px; height:80px; border-radius:50%; object-fit:cover;
                animation: pulsar-load 1.2s ease-in-out infinite;">
    <p style="font-family:'Sansita One',cursive; color:#E8A8B5; font-size:14px; letter-spacing:2px;">
        Carregando...
    </p>
</div>

<script>
    // ✅ Loader correto por tamanho de tela
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href && !link.href.startsWith('#')) {
            const loader = window.innerWidth >= 640
                ? document.getElementById('loader-desktop-onboarding')
                : document.getElementById('loader-mobile-onboarding');
            if (loader) loader.style.display = 'flex';
        }
    });

    window.addEventListener('pageshow', function() {
        document.getElementById('loader-mobile-onboarding').style.display = 'none';
        document.getElementById('loader-desktop-onboarding').style.display = 'none';
    });
    document.querySelectorAll('.slides-wrapper').forEach(wrapper => {
        const slides = wrapper.querySelectorAll('.slide');
        const container = wrapper.closest('.sm\\:hidden, .hidden');
        const dotsWrapper = container.querySelector('.dots-wrapper');
        const btnProximo = container.querySelector('.btn-proximo');
        const btnAnterior = container.querySelector('.btn-anterior'); // ✅ adicionado
        const btnPular = container.querySelector('.btn-pular');
        let atual = 0;

        // Cria dots
        slides.forEach((_, i) => {
            const dot = document.createElement('div');
            dot.className = 'dot-nav' + (i === 0 ? ' ativo' : '');
            dot.addEventListener('click', () => irPara(i));
            dotsWrapper.appendChild(dot);
        });

        function irPara(index) {
            slides[atual].classList.add('saindo');
            setTimeout(() => {
                slides[atual].classList.remove('active', 'saindo');
                atual = index;
                slides[atual].classList.add('active');

                dotsWrapper.querySelectorAll('.dot-nav').forEach((d, i) => {
                    d.classList.toggle('ativo', i === atual);
                });

                // ✅ Mostra/esconde botões conforme o slide
                if (atual === slides.length - 1) {
                    btnProximo.style.display = 'none';
                    btnAnterior.style.display = 'block';
                    if (btnPular) btnPular.style.display = 'none';
                } else if (atual === 0) {
                    btnProximo.style.display = 'block';
                    btnAnterior.style.display = 'none';
                    if (btnPular) btnPular.style.display = 'block';
                } else {
                    btnProximo.style.display = 'block';
                    btnAnterior.style.display = 'block';
                    if (btnPular) btnPular.style.display = 'block';
                }
            }, 300);
        }

        btnProximo.addEventListener('click', () => {
            if (atual < slides.length - 1) irPara(atual + 1);
        });

        // ✅ Botão voltar
        btnAnterior.addEventListener('click', () => {
            if (atual > 0) irPara(atual - 1);
        });

        // Swipe mobile
        let touchStartX = 0;
        wrapper.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; });
        wrapper.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                if (diff > 0 && atual < slides.length - 1) irPara(atual + 1);
                if (diff < 0 && atual > 0) irPara(atual - 1);
            }
        });
    });
</script>

</body>
</html>