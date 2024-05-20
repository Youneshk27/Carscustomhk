@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow-lg" style="background-color: #1c1c1c; color: #fff; border-radius: 15px; width: 100%; max-width: 600px;">
        <h1 class="text-center mb-4" style="color: #00aaff;">Crear Servicio</h1>
        <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="taller_id" class="form-label" style="color: #ccc;">Taller</label>
                <select name="taller_id" id="taller_id" class="form-control" style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
                    @foreach($talleres as $taller)
                        <option value="{{ $taller->id }}">{{ $taller->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="nombre" class="form-label" style="color: #ccc;">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
            </div>
            <div class="form-group mb-4">
                <label for="descripcion" class="form-label" style="color: #ccc;">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;" rows="4"></textarea>
            </div>
            <div class="form-group mb-4">
                <label for="imagen" class="form-label" style="color: #ccc;">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
            </div>
            <div class="form-group mb-4">
                <label for="precio" class="form-label" style="color: #ccc;">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required style="background-color: #333; color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="background-color: #00aaff; border: none; border-radius: 8px; padding: 10px 20px;">Crear Servicio</button>
            </div>
            <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
        </form>
    </div>
</div>
@endsection
