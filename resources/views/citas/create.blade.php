@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">Reservar Cita en {{ $taller->nombre }}</h1>
        
        <form action="{{ route('citas.store') }}" method="POST">
            @csrf
            <input type="hidden" name="taller_id" value="{{ $taller->id }}">

            <div class="form-group">
                <label for="servicio_id" style="color: #00aaff;">Servicio</label>
                <select name="servicio_id" id="servicio_id" class="form-control" required>
                    <option value="">Seleccione un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion" style="color: #00aaff;">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_hora" style="color: #00aaff;">Fecha y Hora</label>
                <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3" style="background-color: #00aaff; border: none;">Reservar</button>
            <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
        </form>
    </div>
</div>
@endsection
