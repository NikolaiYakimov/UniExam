import './bootstrap';

// resources/js/app.js

import '../sass/app.scss'; // или където ти е основният стил
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// FullCalendar импорти
import { Calendar }            from '@fullcalendar/core';
import dayGridPlugin           from '@fullcalendar/daygrid';
import timeGridPlugin          from '@fullcalendar/timegrid';
import interactionPlugin       from '@fullcalendar/interaction';




document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendarContainer');
    if (!calendarEl) return;

    const hallSelect = document.getElementById('hall_id');

    let calendarInstance;
    function initCalendar(hallId) {
        if (calendarInstance) {
            calendarInstance.destroy();
        }
        calendarInstance = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin ],
            initialView: 'timeGridDay',
            headerToolbar: { center: 'title', right: 'timeGridDay' },
            allDaySlot: false,
            slotMinTime: '07:30:00',
            slotMaxTime: '20:00:00',
            slotDuration: '00:45:00',
            selectable: true,
            selectAllow: info => ((info.end - info.start) / (1000 * 60) === 45),
            events: `/api/hall-availability/${hallId}`,
            select: info => {
                document.getElementById('start_time').value = info.startStr;
                document.getElementById('end_time').value   = info.endStr;
            },
            eventDidMount: info => {
                info.el.style.backgroundColor = '#ef4444';
                info.el.style.cursor          = 'not-allowed';
            }
        });
        calendarInstance.render();
    }

    initCalendar(hallSelect.value);
    hallSelect.addEventListener('change', () => initCalendar(hallSelect.value));
});
