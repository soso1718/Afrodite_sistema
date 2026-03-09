import './bootstrap';

import Alpine from 'alpinejs';

// Import Full Calendar
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;

Alpine.start();

// Initialize Full Calendar
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            events: '/events',
            editable: true,
            selectable: true,
            dayMaxEvents: true,
            weekends: true,
            height: 'auto',

            // ✅ ADICIONE ISSO — detecta o clique no dia
            dateClick: function(info) {
                var dataSelecionada = info.dateStr; // ex: "2025-03-08"

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
                        // Marca o dia de vermelho sem recarregar a página
                        calendar.addEvent({
                            start: dataSelecionada,
                            display: 'background',
                            color: '#f87171'
                        });
                    }
                })
                .catch(error => console.error('Erro:', error));
            }
        });
        
        calendar.render();
    }
});