import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            locale: 'pt-br',

            // ✅ Toolbar compacta — sem botão "today" pra economizar espaço
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },

            events: '/events',
            editable: true,
            selectable: true,
            dayMaxEvents: true,
            weekends: true,
            height: 'auto',
            fixedWeekCount: false, // ✅ Remove semanas vazias do final do mês

            // ✅ Estiliza cada dia ao renderizar
            dayCellDidMount: function(info) {
                const cell = info.el;

                // Estilo base da célula
                cell.style.transition = 'background 0.2s ease';

                // Hover via JS
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
                        calendar.addEvent({
                            start: dataSelecionada,
                            display: 'background',
                            color: '#f87171'
                        });

                        // ✅ Animação de feedback no clique
                        const dayEl = info.dayEl;
                        dayEl.style.transform = 'scale(0.92)';
                        dayEl.style.transition = 'transform 0.15s ease';
                        setTimeout(() => {
                            dayEl.style.transform = 'scale(1)';
                        }, 150);
                    }
                })
                .catch(error => console.error('Erro:', error));
            }
        });

        calendar.render();

        // ✅ Aplica estilos nos botões e título após renderizar
        setTimeout(() => {
            // Título
            const title = calendarEl.querySelector('.fc-toolbar-title');
            if (title) {
                title.style.fontFamily = "'Sansita One', cursive";
                title.style.color = '#E8A8B5';
                title.style.fontSize = '15px';
            }

            // Botões prev/next
            calendarEl.querySelectorAll('.fc-button').forEach(btn => {
                btn.style.background = 'rgba(255,255,255,0.1)';
                btn.style.border = '1px solid rgba(255,255,255,0.15)';
                btn.style.color = 'white';
                btn.style.borderRadius = '8px';
                btn.style.boxShadow = 'none';
                btn.style.fontSize = '13px';
                btn.style.padding = '4px 10px';
            });

            // Cabeçalho dos dias (Dom, Seg...)
            calendarEl.querySelectorAll('.fc-col-header-cell-cushion').forEach(el => {
                el.style.color = 'rgba(255,255,255,0.45)';
                el.style.fontSize = '10px';
                el.style.textTransform = 'uppercase';
                el.style.letterSpacing = '1px';
            });

            // Números dos dias
            calendarEl.querySelectorAll('.fc-daygrid-day-number').forEach(el => {
                el.style.color = 'rgba(255,255,255,0.8)';
                el.style.fontSize = '12px';
            });
        }, 50);
    }
});