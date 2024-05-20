<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cars & Customs HK</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* TailwindCSS v3.4.1 comprimido */
            *, ::after, ::before { box-sizing: border-box; }
            html { line-height: 1.5; -webkit-text-size-adjust: 100%; -moz-tab-size: 4; tab-size: 4; font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji; }
            body { margin: 0; line-height: inherit; background-color: #000; color: #fff; }
            .container { position: relative; min-height: 100vh; display: flex; justify-content: center; align-items: center; }
            .background-video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; }
            .card { background-color: rgba(10, 14, 39, 0.8); padding: 2rem; border-radius: 15px; text-align: center; max-width: 400px; width: 100%; }
            .card h1 { font-size: 2rem; font-weight: 600; margin-bottom: 1rem; }
            .card p { font-size: 1.2rem; margin-bottom: 1.5rem; }
            .neon-button { 
                background-color: #00aaff; 
                border: none; 
                border-radius: 8px; 
                padding: 10px 20px; 
                margin: 0.5rem 0; 
                font-size: 1rem; 
                color: #fff; 
                cursor: pointer; 
                box-shadow: 0 0 5px #00aaff, 0 0 20px #00aaff, 0 0 40px #00aaff, 0 0 80px #00aaff; 
                transition: 0.2s;
            }
            .neon-button:hover { 
                box-shadow: 0 0 10px #00aaff, 0 0 40px #00aaff, 0 0 80px #00aaff, 0 0 160px #00aaff; 
                background-color: #005f99; 
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Video de fondo -->
            <video autoplay muted loop class="background-video">
                <source src="{{ asset('storage/fotos/welcome.mp4') }}" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>

            <!-- Tarjeta centrada -->
            <div class="card">
                <h1>CARS & CUSTOMS HK</h1>
                <p>Excellence in Auto Repairs & Customization</p>
                <a href="{{ route('register') }}"><button class="neon-button">Register</button></a>
                <a href="{{ route('login') }}"><button class="neon-button">Login</button></a>
            </div>
        </div>
    </body>
</html>
