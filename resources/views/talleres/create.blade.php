@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">Crear Taller</h1>
        <form action="{{ route('talleres.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre" style="color: #00aaff;">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="direccion" style="color: #00aaff;">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contacto" style="color: #00aaff;">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion" style="color: #00aaff;">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="ciudad" style="color: #00aaff;">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="form-control">
            </div>
            <div class="form-group">
                <label for="lat" style="color: #00aaff;">Latitud</label>
                <input type="text" name="lat" id="lat" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lng" style="color: #00aaff;">Longitud</label>
                <input type="text" name="lng" id="lng" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="horario_apertura" style="color: #00aaff;">Horario de Apertura</label>
                <input type="time" name="horario_apertura" id="horario_apertura" class="form-control">
            </div>
            <div class="form-group">
                <label for="horario_cierre" style="color: #00aaff;">Horario de Cierre</label>
                <input type="time" name="horario_cierre" id="horario_cierre" class="form-control">
            </div>
            <div class="form-group">
                <label for="dias_laborables" style="color: #00aaff;">Días Laborables</label>
                <select name="dias_laborables[]" id="dias_laborables" class="form-control" multiple>
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miércoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sábado</option>
                    <option value="0">Domingo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto" style="color: #00aaff;">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3" style="background-color: #00aaff; border: none;">Crear Taller</button>
        </form>
        <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
    </div>
</div>
@endsection
