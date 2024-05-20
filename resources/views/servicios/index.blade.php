@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Servicios</h1>
    <a href="{{ route('servicios.create') }}" class="btn btn-primary">Crear Servicio</a>
    @if($servicios->isEmpty())
        <p>No hay servicios disponibles.</p>
    @else
        <ul class="list-group">
            @foreach($servicios as $servicio)
                <li class="list-group-item">
                    <h5>{{ $servicio->nombre }}</h5>
                    <p>Precio: ${{ $servicio->precio }}</p>
                    <a href="{{ route('servicios.show', $servicio->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('servicios.edit', $servicio->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection