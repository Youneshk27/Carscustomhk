@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px; width: 100%; max-width: 600px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">Editar Cita</h1>
        <form action="{{ route('citas.update', $cita->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="taller_id" class="form-label" style="color: #ccc;">Taller</label>
                <select name="taller_id" id="taller_id" class="form-control" style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
                    @foreach($talleres as $taller)
                        <option value="{{ $taller->id }}" {{ $cita->taller_id == $taller->id ? 'selected' : '' }}>{{ $taller->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="fecha_hora" class="form-label" style="color: #ccc;">Fecha y Hora</label>
                <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" value="{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('Y-m-d\TH:i') }}" required style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
            </div>

            <div class="form-group mb-4">
                <label for="descripcion" class="form-label" style="color: #ccc;">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;" rows="4">{{ $cita->descripcion }}</textarea>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="background-color: #00aaff; border: none; border-radius: 8px; padding: 10px 20px;">Actualizar Cita</button>
            </div>
            <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
        </form>
    </div>
</div>
@endsection
