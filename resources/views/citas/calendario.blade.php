@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Citas para {{ $taller->nombre }}</h1>
    <div id="calendar"></div>
    <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
</div>

<!-- FullCalendar CSS -->
<link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">
<!-- FullCalendar JS -->
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($citas->map(function($cita) {
                return [
                    'title' => $cita->descripcion,
                    'start' => $cita->fecha_hora,
                    'url' => route('citas.show', $cita->id)
                ];
            })),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true
        });
        calendar.render();
    });
</script>
@endsection
