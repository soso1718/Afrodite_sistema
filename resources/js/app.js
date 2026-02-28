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
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            events: '/events',
            editable: true,
            selectable: true,
            dayMaxEvents: true,
            weekends: true,
            height: 'auto'
        });
        
        calendar.render();
    }
});
