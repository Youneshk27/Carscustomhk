@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $taller->nombre }}</h1>
    <p><strong>Dirección:</strong> {{ $taller->direccion }}</p>
    <p><strong>Contacto:</strong> {{ $taller->contacto }}</p>
    <p><strong>Descripción:</strong> {{ $taller->descripcion }}</p>
    <a href="{{ route('talleres.edit', $taller->id) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('talleres.destroy', $taller->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <h2 class="mt-4">Servicios Ofrecidos</h2>
    <a href="{{ route('servicios.create') }}" class="btn btn-primary">Añadir Servicio</a>
    @if($taller->servicios->isEmpty())
        <p>No hay servicios disponibles en este momento.</p>
    @else
        <ul class="list-group mt-3">
            @foreach($taller->servicios as $servicio)
                <li class="list-group-item">
                    @if($servicio->imagen)
                        <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}" style="max-width: 200px;">
                    @endif
                    <h5>{{ $servicio->nombre }}</h5>
                    <p>{{ $servicio->descripcion }}</p>
                    <p>Precio: ${{ $servicio->precio }}</p>
                    
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection