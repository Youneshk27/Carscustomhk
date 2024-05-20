@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px; width: 100%; max-width: 600px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">{{ $cita->taller->nombre }}</h1>
        <p><strong>Fecha y hora:</strong> {{ $cita->fecha_hora }}</p>
        <p><strong>Descripción:</strong> {{ $cita->descripcion }}</p>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning mx-2" style="border-radius: 8px; padding: 10px 20px;">Editar</a>
            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-2" style="border-radius: 8px; padding: 10px 20px;">Eliminar</button>
            </form>
            <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
        </div>
    </div>
</div>
@endsection
