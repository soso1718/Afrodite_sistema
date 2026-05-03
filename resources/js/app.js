import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {

    // Pega o #calendar dentro do container visível
    // (o phone-frame renderiza o slot duas vezes: mobile e desktop)
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

            // ✅ async/await para garantir ordem correta das chamadas
            dateClick: async function(info) {
                const dataSelecionada = info.dateStr;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Animação de feedback imediata
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

                    if (!dataCiclo.success) return;

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

                    // 3. Só recarrega após AMBAS as chamadas terminarem
                    calendar.refetchEvents();

                } catch (error) {
                    console.error('Erro ao salvar eventos:', error);
                }
            }
        });

        calendar.render();

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