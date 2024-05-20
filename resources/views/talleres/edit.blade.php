<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Taller</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #00aaff;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #ccc;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 8px;
            background-color: #333;
            color: #fff;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        button {
            background-color: #00aaff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            color: #fff;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #008ecc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Taller</h1>
        <form action="{{ route('talleres.update', $taller->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="foto">Foto del Taller</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del Taller</label>
                <input type="text" id="nombre" name="nombre" value="{{ $taller->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ $taller->direccion }}" required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" class="form-control" id="ciudad" value="{{ old('ciudad', $taller->ciudad ?? '') }}">
            </div>
            <div class="form-group">
                <label for="lat">Latitud</label>
                <input type="text" name="lat" id="lat" class="form-control" value="{{ $taller->lat }}" required>
            </div>
            <div class="form-group">
                <label for="lng">Longitud</label>
                <input type="text" name="lng" id="lng" class="form-control" value="{{ $taller->lng }}" required>
            </div>
            <div class="form-group">
                <label for="contacto">Contacto</label>
                <input type="text" id="contacto" name="contacto" value="{{ $taller->contacto }}" required>
            </div>


            <div class="form-group">
                <label for="horario_apertura">Horario de Apertura</label>
                <input type="time" name="horario_apertura" id="horario_apertura" class="form-control" value="{{ $taller->horario_apertura }}" required>
            </div>

            <div class="form-group">
                <label for="horario_cierre">Horario de Cierre</label>
                <input type="time" name="horario_cierre" id="horario_cierre" class="form-control" value="{{ $taller->horario_cierre }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control">{{ $taller->descripcion }}</textarea>
            </div>
            <button type="submit">Actualizar Taller</button>
            <a href="{{ url('/home') }}" class="btn btn-primary" style="background-color: #00aaff; border: none;">Home</a>
        </form>
        
    </div>
</body>
</html>
