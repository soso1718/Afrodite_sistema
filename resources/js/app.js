import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
console.log('Inicializando CKEditor...');
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/pt-br';


window.Alpine = Alpine;
Alpine.start();

// ─── Loader do calendário ───
// app.js - Calendar UI logic para o fluxo Menstruação + projeções
// Requisitos: FullCalendar (v5/v6) + native fetch (ou ajuste para axios se preferir)

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
        <svg style="width:28px; height:28px; animation:girar-cal 0.8s linear infinite;"
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
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

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
            editable: true,
            selectable: true,
            dayMaxEvents: true,
            weekends: true,
            height: 'auto',
            fixedWeekCount: false,

            // Loader
            loading: function(isLoading) {
                if (isLoading) {
                    mostrarLoaderCalendario(calendarEl, 'Carregando...');
                } else {
                    esconderLoaderCalendario(calendarEl);
                }
            },

           
    eventDidMount: function(info) {
    const el = info.el;
    const isProjecao = info.event.extendedProps?.isProjecao;
    const title = info.event.title;

    // Define cores por tipo de evento
    let corBase;
    switch (title) {
        case 'Menstruação':
            corBase = '#f08c8c'; // vermelho suave
            break;
        case 'Período fértil':
            corBase = '#fc5849'; // laranja vivo
            break;
        case 'Ovulação':
            corBase = '#e42615'; // vermelho intenso
            break;
        default:
            corBase = '#f08c8c';
    }

    // Ajuste visual para projeções vs reais
    el.style.borderRadius = '6px';
    el.style.border = 'none';
    el.style.backgroundColor = corBase;
    el.style.opacity = isProjecao ? '0.5' : '1';
    el.style.boxShadow = isProjecao ? 'none' : `0 0 6px ${corBase}`;

    // Remove título e horário
    const titleEl = el.querySelector('.fc-event-title');
    if (titleEl) titleEl.style.display = 'none';
    const timeEl = el.querySelector('.fc-event-time');
    if (timeEl) timeEl.style.display = 'none';

    // Adiciona marcador (dot) no dia
    const dayEl = el.closest('.fc-daygrid-day');
    if (dayEl && !dayEl.querySelector('.ciclo-dot')) {
        const dot = document.createElement('div');
        dot.className = 'ciclo-dot';
        dot.style.cssText = `
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: ${corBase};
            margin: 0 auto 3px;
            box-shadow: ${isProjecao ? 'none' : `0 0 6px ${corBase}`};
            opacity: ${isProjecao ? '0.5' : '1'};
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

            // Novo fluxo: salva só o primeiro dia real e gera projeções
            dateClick: async function(info) {
                const dataSelecionada = info.dateStr;

                mostrarLoaderCalendario(calendarEl, 'Salvando...');

                const dayEl = info.dayEl;
                dayEl.style.transform = 'scale(0.92)';
                dayEl.style.transition = 'transform 0.15s ease';
                setTimeout(() => { dayEl.style.transform = 'scale(1)'; }, 150);

                try {
                    const res = await fetch('/events', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ date: dataSelecionada })
                    });

                    const data = await res.json();

                    if (!data.success) {
                        esconderLoaderCalendario(calendarEl);
                        return;
                    }

                    // Recarrega os eventos (primeiro dia real + projeções)
                    calendar.refetchEvents();

                } catch (error) {
                    console.error('Erro ao salvar ciclo e projeções:', error);
                } finally {
                    esconderLoaderCalendario(calendarEl);
                }
            },

            // Editar ou apagar evento → recalcula projeções
            eventClick: async function(info) {
    const eventId = info.event.id;
    const isProjecao = !!info.event.extendedProps?.isProjecao;

    if (isProjecao) {
    if (confirm('Registrar este dia como real?')) {
        try {
            const res = await fetch('/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ date: info.event.startStr })
            });
            const data = await res.json();
            if (data.success) calendar.refetchEvents();
        } catch (error) {
            console.error('Erro ao registrar dia real:', error);
        }
    }
}},

            // Drag/Drop: permitir apenas mover o primeiro dia real
            eventDrop: async function(info) {
                const isProjecao = !!info.event.extendedProps?.isProjecao;
                if (isProjecao) {
                    // Não permitir mover projeções
                    info.revert();
                    alert('Não é possível mover projeções. O primeiro dia deve ser movido para atualizar o ciclo.');
                    return;
                }

                const eventId = info.event.id;
                const novaData = info.event.startStr;

                mostrarLoaderCalendario(calendarEl, 'Atualizando...');

                try {
                    const res = await fetch(`/events/${eventId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ date: novaData })
                    });

                    const data = await res.json();

                    if (data.success) calendar.refetchEvents();
                } catch (error) {
                    console.error('Erro ao mover o evento:', error);
                    info.revert();
                } finally {
                    esconderLoaderCalendario(calendarEl);
                }
            },
        });

        calendar.render();

        // Carrega inicial
        mostrarLoaderCalendario(calendarEl, 'Carregando...');
        // Opção: você pode ajustar o tempo para esconder o loader após o render iniciar
        setTimeout(() => esconderLoaderCalendario(calendarEl), 800);

        // Personalizações de estilo (opcional)
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

   document.querySelectorAll('.ckeditor').forEach((element) => {
        ClassicEditor.create(element, {
            language: 'pt-br',
        }).then(editor => {
            const scrollContainer = document.querySelector('.overflow-y-auto');
            if (scrollContainer) {
                editor.ui.viewportOffset = { top: 60 };
                editor.editing.view.document.on('layoutChanged', () => {
                    editor.ui.update();
                });
                scrollContainer.addEventListener('scroll', () => {
                    editor.ui.update();
                });
            }
        }).catch(error => console.error(error));
    });

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
