@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px; width: 100%; max-width: 800px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">{{ $taller->nombre }}</h1>
        @if($taller->foto)
            <img src="{{ asset('storage/' . $taller->foto) }}" alt="{{ $taller->nombre }}" class="img-fluid mb-3" style="border-radius: 10px;">
        @endif
        <p><strong>Dirección:</strong> {{ $taller->direccion }}</p>
        <p><strong>Contacto:</strong> {{ $taller->contacto }}</p>
        <p><strong>Descripción:</strong> {{ $taller->descripcion }}</p>
        <p><strong>Horario de Apertura:</strong> {{ $taller->horario_apertura }}</p>
        <p><strong>Horario de Cierre:</strong> {{ $taller->horario_cierre }}</p>

        @if(Auth::check() && Auth::id() == $taller->user_id)
            <div class="d-flex flex-column">
                <a href="{{ route('talleres.edit', $taller->id) }}" class="btn btn-warning btn-custom mb-2">Editar</a>
                <form action="{{ route('talleres.destroy', $taller->id) }}" method="POST" class="mb-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-custom">Eliminar</button>
                </form>
                <a href="{{ route('talleres.citas', $taller->id) }}" class="btn btn-info btn-custom mb-2">Ver Citas</a>
                <a href="{{ url('/home') }}" class="btn btn-primary btn-custom" style="background-color: #00aaff; border: none;">Home</a>
            </div>
        @else
            <!-- Botón de Reservar Cita para Usuarios -->
            <a href="{{ route('citas.create', ['taller_id' => $taller->id]) }}" class="btn btn-primary btn-custom mb-3">Reservar Cita</a>
        @endif
        
        <h2 class="mt-4">Calificación Promedio</h2>
        @php
            $averageRating = $taller->calificaciones->avg('rating');
            $filledStars = floor($averageRating);
            $halfStar = ($averageRating - $filledStars) >= 0.5;
        @endphp
        <div class="rating">
            @for($i = 5; $i >= 1; $i--)
                @if($i <= $filledStars)
                    <i class="fas fa-star"></i>
                @elseif($halfStar && $i == $filledStars + 1)
                    <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
        </div>
        <style>
            .rating {
                display: flex;
                justify-content: flex-end;
                direction: rtl;
            }

            .rating .fa-star,
            .rating .fa-star-half-alt,
            .rating .far.fa-star {
                color: #f5c518; /* Color amarillo */
            }
        </style>

        <h2 class="mt-4" style="color: #00aaff;">Mapa de Ubicación</h2>
        <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>

        <h2 class="mt-4" style="color: #00aaff;">Servicios Ofrecidos</h2>
        @if(Auth::check() && Auth::id() == $taller->user_id)
            <div class="text-center mb-4">
                <a href="{{ route('servicios.create') }}" class="btn btn-primary btn-custom" style="background-color: #00aaff; border: none; border-radius: 8px; padding: 10px 20px;">Añadir Servicio</a>
            </div>
        @endif
        @if($taller->servicios->isEmpty())
            <p class="text-center" style="color: #ccc;">No hay servicios disponibles en este momento.</p>
        @else
            <div class="list-group mt-3">
                @foreach($taller->servicios as $servicio)
                    <div class="list-group-item mb-3" style="background-color: #444; color: #fff; border: none; border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            @if($servicio->imagen)
                                <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}" class="img-fluid" style="max-width: 150px; border-radius: 10px; margin-right: 20px;">
                            @endif
                            <div>
                                <h5 style="color: #00aaff;">{{ $servicio->nombre }}</h5>
                                <p>{{ $servicio->descripcion }}</p>
                                <p>Precio: ${{ $servicio->precio }}</p>
                                @if(Auth::check() && Auth::id() == $taller->user_id)
                                    <div class="d-flex">
                                        <a href="{{ route('servicios.edit', $servicio->id) }}" class="btn btn-warning btn-sm btn-custom mx-2" style="border-radius: 8px;">Editar</a>
                                        <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-custom" style="border-radius: 8px;">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 class="mt-4" style="color: #00aaff;">Calificaciones y Comentarios</h2>
        @if($taller->calificaciones->isEmpty())
            <p class="text-center" style="color: #ccc;">No hay calificaciones ni comentarios disponibles en este momento.</p>
        @else
            <div class="list-group">
                @foreach($taller->calificaciones as $calificacion)
                    <div class="list-group-item bg-dark text-light mb-3" style="border-radius: 10px; border: none;">
                        <h5 style="color: #00aaff;">{{ $calificacion->user->name }}</h5>
                        <p>Calificación: {{ $calificacion->rating }} / 5</p>
                        <p>{{ $calificacion->comentario }}</p>
                        <small class="text-muted">{{ $calificacion->created_at->format('d/m/Y') }}</small>
                    </div>
                @endforeach
            </div>
        @endif
        @if(Auth::check() && Auth::user()->isUsuario())
            @include('components.calificacion-form')
        @endif
    </div>
</div>

<!-- Agregar el script de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    function initMap() {
        var map = L.map('map').setView([{{ $taller->lat }}, {{ $taller->lng }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.marker([{{ $taller->lat }}, {{ $taller->lng }}]).addTo(map)
            .bindPopup('{{ $taller->nombre }}')
            .openPopup();
    }
    document.addEventListener('DOMContentLoaded', initMap);
</script>

<style>
    .btn-custom {
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 1rem;
        transition: background-color 0.3s ease, color 0.3s ease;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn-custom.btn-primary {
        background-color: #00aaff;
        color: #fff;
        border: none;
    }

    .btn-custom.btn-primary:hover {
        background-color: #008cdd;
    }

    .btn-custom.btn-warning {
        background-color: #ffcc00;
        color: #fff;
        border: none;
    }

    .btn-custom.btn-warning:hover {
        background-color: #e6b800;
    }

    .btn-custom.btn-danger {
        background-color: #ff4444;
        color: #fff;
        border: none;
    }

    .btn-custom.btn-danger:hover {
        background-color: #dd0000;
    }

    .btn-custom.btn-info {
        background-color: #17a2b8;
        color: #fff;
        border: none;
    }

    .btn-custom.btn-info:hover {
        background-color: #138496;
    }
</style>
@endsection
