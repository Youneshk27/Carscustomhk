@if($taller->calificaciones->isEmpty())
    <p>No hay calificaciones ni comentarios.</p>
@else
    <ul class="list-group mt-3">
        @foreach($taller->calificaciones as $calificacion)
            <li class="list-group-item">
                <p><strong>Calificación:</strong> {{ $calificacion->rating }}</p>
                <p><strong>Comentario:</strong> {{ $calificacion->comentario }}</p>
                <p><strong>Usuario:</strong> {{ $calificacion->user->name }}</p>
            </li>
        @endforeach
    </ul>
@endif