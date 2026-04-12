import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {

    // ✅ CORREÇÃO DEFINITIVA: pega o #calendar que está dentro do container visível
    // O phone-frame renderiza o slot duas vezes (mobile e desktop), então
    // precisamos achar o que não está dentro de um sm:hidden
    function getCalendarVisivel() {
        const todos = document.querySelectorAll('#calendar');
        for (const el of todos) {
            if (el.offsetParent !== null) return el; // offsetParent é null se o elemento estiver oculto
        }
        return todos[0]; // fallback
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

                el.style.borderRadius = '4px';
                el.style.border = 'none';
                el.style.opacity = '1';

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

            dateClick: function(info) {
                var dataSelecionada = info.dateStr;

                fetch('/events', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ date: dataSelecionada })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var inicio = new Date(dataSelecionada);

                        // Menstruação — 7 dias em vermelho
                        for (let i = 0; i < 7; i++) {
                            let d = new Date(inicio);
                            d.setDate(d.getDate() + i);
                            adicionarDot(calendar, d.toISOString().split('T')[0], '#f08c8c');
                        }

                        // Ovulação — dia 14 em roxo (prioridade)
                        let ovulacao = new Date(inicio);
                        ovulacao.setDate(ovulacao.getDate() + 14);
                        adicionarDot(calendar, ovulacao.toISOString().split('T')[0], '#e42615');

                        // Período fértil — pula o dia da ovulação (i === 0)
                        for (let i = -3; i <= 3; i++) {
                            if (i === 0) continue;
                            let d = new Date(ovulacao);
                            d.setDate(d.getDate() + i);
                            adicionarDot(calendar, d.toISOString().split('T')[0], '#fc5849');
                        }

                        // Animação de feedback
                        const dayEl = info.dayEl;
                        dayEl.style.transform = 'scale(0.92)';
                        dayEl.style.transition = 'transform 0.15s ease';
                        setTimeout(() => { dayEl.style.transform = 'scale(1)'; }, 150);
                    }
                })
                .catch(error => console.error('Erro:', error));
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