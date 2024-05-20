import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'timeGridWeek',
            locale: esLocale,
            events: calendarEvents,
            businessHours: {
                daysOfWeek: calendarBusinessHours.days,
                startTime: calendarBusinessHours.start,
                endTime: calendarBusinessHours.end
            },
            slotMinTime: calendarBusinessHours.start,
            slotMaxTime: calendarBusinessHours.end
        });

        calendar.render();
    }
});
