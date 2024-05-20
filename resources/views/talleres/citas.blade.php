@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">Citas para {{ $taller->nombre }}</h1>
        @if($citas->isEmpty())
            <p class="text-center" style="color: #ccc;">No hay citas reservadas en este momento.</p>
        @else
            <div id="calendar"></div>
        @endif
        <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
    </div>
    
</div>

<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.0/main.min.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.0/main.min.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.11.0/main.min.css' rel='stylesheet' />

<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.0/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.0/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.11.0/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.0/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridDay',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridDay,timeGridWeek,dayGridMonth'
        },
        events: [
            @foreach($citas as $cita)
            {
                title: '{{ $cita->user->name }} - {{ $cita->servicio->nombre }}',
                start: '{{ $cita->fecha_hora }}',
                end: '{{ (new DateTime($cita->fecha_hora))->modify("+1 hour")->format("Y-m-d H:i:s") }}',
                backgroundColor: '#00aaff',
                borderColor: '#00aaff',
            },
            @endforeach
        ],
        slotMinTime: '00:00:00',
        slotMaxTime: '24:00:00',
        hiddenDays: [], // No hide any days
        locale: 'es', // Set to Spanish
        editable: false,
        eventClick: function(info) {
            alert('Cita: ' + info.event.title + '\nCliente: ' + info.event.extendedProps.cliente + '\nDescripción: ' + info.event.extendedProps.description + '\nFecha y Hora: ' + info.event.start.toISOString());
        }
    });
    calendar.render();
});
</script>
@endsection
