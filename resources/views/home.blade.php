@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #00aaff;">Lista de Talleres</h1>
    
    @if(Auth::check() && Auth::user()->role === 'usuario')
        <!-- Formulario de Búsqueda -->
        <form action="{{ route('home') }}" method="GET" class="mb-4">
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
            <button type="submit" class="btn neon-button">Buscar</button>
        </form>
    @endif

    @if(Auth::check() && Auth::user()->role === 'taller')
        <div class="text-center mb-4">
            <a href="{{ route('talleres.create') }}" class="btn neon-button">Crear Taller</a>
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary" style="background-color: #00aaff; border: none; border-radius: 8px; padding: 10px 20px;">Subir Foto de Proyecto</a>
        </div>
    @endif

    <div class="row">
        @foreach ($talleres as $taller)
            <div class="col-12 mb-3">
                <div class="card shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px;">
                    @if($taller->foto)
                        <img src="{{ asset('storage/' . $taller->foto) }}" class="card-img-top" alt="{{ $taller->nombre }}" style="border-radius: 15px 15px 0 0;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Imagen predeterminada" style="border-radius: 15px 15px 0 0;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title neon-text" style="color: #00aaff;">{{ $taller->nombre }}</h5>
                        <a href="{{ route('talleres.show', $taller->id) }}" class="btn btn-primary" style="border-radius: 8px; padding: 5px 15px;">Ver Detalles</a>
                        @if(Auth::check() && Auth::id() == $taller->user_id)
                            <a href="{{ route('talleres.edit', $taller->id) }}" class="btn btn-warning" style="border-radius: 8px; padding: 5px 15px;">Editar</a>
                            <form action="{{ route('talleres.destroy', $taller->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="border-radius: 8px; padding: 5px 15px;">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .neon-button {
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
        background: #00aaff;
        box-shadow: 0 0 5px #00aaff, 0 0 15px #00aaff, 0 0 30px #00aaff, 0 0 45px #00aaff;
        transition: 0.2s;
    }

    .neon-button:hover {
        box-shadow: 0 0 10px #00aaff, 0 0 30px #00aaff, 0 0 60px #00aaff, 0 0 90px #00aaff;
        background: #005f99;
    }

    .neon-text {
        color: #00aaff;
        text-shadow: 0 0 3px #00aaff, 0 0 6px #00aaff, 0 0 9px #00aaff;
    }
</style>
@endsection
