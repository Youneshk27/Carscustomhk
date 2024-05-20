@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #00aaff;">Lista de Talleres</h1>

    @if(Auth::check() && Auth::user()->role === 'usuario')
        <!-- Formulario de Búsqueda -->
        <form action="{{ route('talleres.index') }}" method="GET" class="mb-4">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="search" style="color: #00aaff;">Buscar por Ciudad o Nombre de Garaje</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Ciudad o Nombre de Garaje" value="{{ request('search') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="servicio_id" style="color: #00aaff;">Buscar por Servicio</label>
                    <select name="servicio_id" id="servicio_id" class="form-control">
                        <option value="">Seleccione un servicio</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}" {{ request('servicio_id') == $servicio->id ? 'selected' : '' }}>{{ $servicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #00aaff; border: none;">Buscar</button>
        </form>
    @endif

    <div class="row">
        @foreach ($talleres as $taller)
            <div class="col-md-12 mb-3">
                <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px;">
                    @if($taller->foto)
                        <img src="{{ asset('storage/' . $taller->foto) }}" class="card-img-top" alt="{{ $taller->nombre }}" style="border-radius: 10px;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Imagen predeterminada" style="border-radius: 10px;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title" style="color: #00aaff;">{{ $taller->nombre }}</h5>
                        <p>{{ $taller->direccion }}</p>
                        <p>{{ $taller->contacto }}</p>
                        <a href="{{ route('talleres.show', $taller->id) }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Ver Detalles</a>
                        @if(Auth::check() && Auth::id() == $taller->user_id)
                            <a href="{{ route('talleres.edit', $taller->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('talleres.destroy', $taller->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
