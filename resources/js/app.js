import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;
Alpine.start();

// ─── Loader do calendário ───
function mostrarLoaderCalendario(calendarEl, texto = 'Salvando...') {
    if (calendarEl.querySelector('.cal-loader')) return;

    const loader = document.createElement('div');
    loader.className = 'cal-loader';
    loader.style.cssText = `
        position: absolute;
        inset: 0;
        z-index: 100;
        background: rgba(114, 0, 38, 0.75);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        backdrop-filter: blur(2px);
    `;
    loader.innerHTML = `
        <style>
            @keyframes girar-cal {
                from { transform: rotate(0deg); }
                to   { transform: rotate(360deg); }
            }
        </style>
        <svg style="width:28px; height:28px; animation: girar-cal 0.8s linear infinite;"
             viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10"
                    stroke="#E8A8B5"
                    stroke-width="3"
                    stroke-dasharray="40"
                    stroke-dashoffset="10"/>
        </svg>
        <p style="font-family:'Sansita One',cursive; color:#E8A8B5; font-size:12px; letter-spacing:1px; margin:0;">
            ${texto}
        </p>
    `;

    calendarEl.style.position = 'relative';
    calendarEl.appendChild(loader);
}

function esconderLoaderCalendario(calendarEl) {
    const loader = calendarEl.querySelector('.cal-loader');
    if (loader) loader.remove();
}

document.addEventListener('DOMContentLoaded', function() {

    function getCalendarVisivel() {
        const todos = document.querySelectorAll('#calendar');
        for (const el of todos) {
            if (el.offsetParent !== null) return el;
        }
        return todos[0];
    }

    const calendarEl = getCalendarVisivel();

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            locale: 'pt-br',
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: '/events',
            editable: false,
            selectable: true,
            dayMaxEvents: true,
            weekends: true,
            height: 'auto',
            fixedWeekCount: false,

            // ✅ Loader de carregamento inicial
            loading: function(isLoading) {
                if (isLoading) {
                    mostrarLoaderCalendario(calendarEl, 'Carregando...');
                } else {
                    esconderLoaderCalendario(calendarEl);
                }
            },

            eventDidMount: function(info) {
                const color = info.event.backgroundColor;
                const el = info.el;
                const isProjecao = info.event.extendedProps?.isProjecao;

                el.style.borderRadius = '4px';
                el.style.border = 'none';
                el.style.opacity = isProjecao ? '0.4' : '1';

                const titleEl = el.querySelector('.fc-event-title');
                if (titleEl) titleEl.style.display = 'none';

                const timeEl = el.querySelector('.fc-event-time');
                if (timeEl) timeEl.style.display = 'none';

                const dayEl = info.el.closest('.fc-daygrid-day');
                if (dayEl && !dayEl.querySelector('.ciclo-dot')) {
                    const dot = document.createElement('div');
                    dot.className = 'ciclo-dot';
                    dot.style.cssText = `
                        width: 6px;
                        height: 6px;
                        border-radius: 50%;
                        background: ${color};
                        margin: 0 auto 3px;
                        box-shadow: 0 0 6px ${color};
                        opacity: ${isProjecao ? '0.4' : '1'};
                    `;
                    dayEl.querySelector('.fc-daygrid-day-frame').appendChild(dot);
                }
            },

            dayCellDidMount: function(info) {
                const cell = info.el;
                cell.style.transition = 'background 0.2s ease';

                cell.addEventListener('mouseenter', () => {
                    if (!cell.classList.contains('fc-day-today')) {
                        cell.style.background = 'rgba(232, 168, 181, 0.12)';
                        cell.style.cursor = 'pointer';
                    }
                });
                cell.addEventListener('mouseleave', () => {
                    if (!cell.classList.contains('fc-day-today')) {
                        cell.style.background = '';
                    }
                });
            },

            // ✅ async/await do colega + loader + dots da sua versão
            dateClick: async function(info) {
                const dataSelecionada = info.dateStr;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Loader aparece imediatamente
                mostrarLoaderCalendario(calendarEl, 'Salvando...');

                // Animação de feedback no dia clicado
                const dayEl = info.dayEl;
                dayEl.style.transform = 'scale(0.92)';
                dayEl.style.transition = 'transform 0.15s ease';
                setTimeout(() => { dayEl.style.transform = 'scale(1)'; }, 150);

                try {
                    // 1. Salva o ciclo atual no banco
                    const resCiclo = await fetch('/events', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ date: dataSelecionada })
                    });
                    const dataCiclo = await resCiclo.json();

                    if (!dataCiclo.success) {
                        esconderLoaderCalendario(calendarEl);
                        return;
                    }

                    // 2. Salva as projeções futuras no banco
                    await fetch('/events/projecoes', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            date: dataSelecionada,
                            duracao_ciclo: 28,
                            meses: 6
                        })
                    });

                    // 3. Adiciona dots visualmente
                    const inicio = new Date(dataSelecionada);

                    for (let i = 0; i < 7; i++) {
                        let d = new Date(inicio);
                        d.setDate(d.getDate() + i);
                        adicionarDot(calendar, d.toISOString().split('T')[0], '#f08c8c');
                    }

                    let ovulacao = new Date(inicio);
                    ovulacao.setDate(ovulacao.getDate() + 14);
                    adicionarDot(calendar, ovulacao.toISOString().split('T')[0], '#e42615');

                    for (let i = -3; i <= 3; i++) {
                        if (i === 0) continue;
                        let d = new Date(ovulacao);
                        d.setDate(d.getDate() + i);
                        adicionarDot(calendar, d.toISOString().split('T')[0], '#fc5849');
                    }

                    // 4. Recarrega os eventos do banco para garantir sincronização
                    calendar.refetchEvents();

                } catch (error) {
                    console.error('Erro ao salvar eventos:', error);
                } finally {
                    // ✅ Esconde o loader sempre, mesmo se der erro
                    esconderLoaderCalendario(calendarEl);
                }
            }
        });

        calendar.render();

        // ✅ Loader imediato ao entrar na tela
        mostrarLoaderCalendario(calendarEl, 'Carregando...');

        setTimeout(() => {
            calendarEl.querySelectorAll('.fc-button').forEach(btn => {
                btn.style.background = 'rgba(255,255,255,0.1)';
                btn.style.border = '1px solid rgba(255,255,255,0.15)';
                btn.style.color = 'white';
                btn.style.borderRadius = '8px';
                btn.style.boxShadow = 'none';
                btn.style.fontSize = '13px';
                btn.style.padding = '4px 10px';
            });

            calendarEl.querySelectorAll('.fc-col-header-cell-cushion').forEach(el => {
                el.style.color = 'rgba(255,255,255,0.45)';
                el.style.fontSize = '10px';
                el.style.textTransform = 'uppercase';
                el.style.letterSpacing = '1px';
            });

            calendarEl.querySelectorAll('.fc-daygrid-day-number').forEach(el => {
                el.style.color = 'rgba(255,255,255,0.8)';
                el.style.fontSize = '12px';
            });
        }, 50);
    }
});

function adicionarDot(calendar, dateStr, color) {
    calendar.addEvent({
        start: dateStr,
        display: 'background',
        backgroundColor: color,
        borderColor: color,
    });

    setTimeout(() => {
        const dayEls = document.querySelectorAll('.fc-daygrid-day');
        dayEls.forEach(dayEl => {
            if (dayEl.getAttribute('data-date') === dateStr && !dayEl.querySelector('.ciclo-dot')) {
                const dot = document.createElement('div');
                dot.className = 'ciclo-dot';
                dot.style.cssText = `
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    background: ${color};
                    margin: 0 auto 3px;
                    box-shadow: 0 0 6px ${color};
                `;
                dayEl.querySelector('.fc-daygrid-day-frame').appendChild(dot);
            }
        });
    }, 30);
}