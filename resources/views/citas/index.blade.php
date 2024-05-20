@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">Mis Citas</h1>
        <div class="text-center mb-4">
            <a href="{{ route('citas.create') }}" class="btn btn-primary" style="background-color: #00aaff; border: none; border-radius: 8px; padding: 10px 20px;">Crear Cita</a>
        </div>
        @if($citas->isEmpty())
            <p class="text-center" style="color: #ccc;">No tienes citas.</p>
        @else
            <ul class="list-group" style="background-color: #333; border-radius: 10px; padding: 10px;">
                @foreach($citas as $cita)
                    <li class="list-group-item mb-3" style="background-color: #444; color: #fff; border: none; border-radius: 10px;">
                        <h5 style="color: #00aaff;">{{ $cita->taller->nombre }}</h5>
                        <p>Fecha y hora: {{ $cita->fecha_hora }}</p>
                        <p>Descripción: {{ $cita->descripcion }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-info" style="border-radius: 8px; padding: 5px 15px;">Ver</a>
                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning" style="border-radius: 8px; padding: 5px 15px;">Editar</a>
                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="border-radius: 8px; padding: 5px 15px;">Eliminar</button>

                            </form>
                            <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
