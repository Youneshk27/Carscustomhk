@extends('layouts.app')

@section('content')
<div class="container-fluid position-relative d-flex justify-content-center align-items-center min-vh-100 p-0" style="overflow: hidden;">
    <!-- Video de fondo -->
    <video autoplay muted loop class="position-absolute w-100 h-100" style="object-fit: cover;">
        <source src="{{ asset('storage/fotos/fondo1.mp4') }}" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>

    <!-- Tarjeta de login -->
    <div class="card p-4 shadow-lg position-relative" style="background-color: rgba(10, 14, 39, 0.6); color: #fff; border-radius: 15px; width: 100%; max-width: 400px;">
        <div class="card-header text-center mb-4" style="border-bottom: none;">
            <img src="{{ asset('storage/fotos/logo.png') }}" alt="Car Workshop Logo" style="width: 80px;">
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-4">
                    <label for="email" class="form-label" style="color: #bbb;">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="form-label" style="color: #bbb;">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="background-color: rgba(28, 35, 54, 0.6); border: none;">
                        <label class="form-check-label" for="remember" style="color: #bbb;">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn neon-button">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn neon-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
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
        box-shadow: 0 0 5px #00aaff, 0 0 20px #00aaff, 0 0 40px #00aaff, 0 0 80px #00aaff;
        transition: 0.2s;
    }

    .neon-button:hover {
        box-shadow: 0 0 10px #00aaff, 0 0 40px #00aaff, 0 0 80px #00aaff, 0 0 160px #00aaff;
        background: #005f99;
    }

    .neon-link {
        color: #00aaff;
        text-decoration: none;
        font-weight: bold;
        transition: 0.2s;
    }

    .neon-link:hover {
        color: #005f99;
        text-decoration: underline;
    }
</style>
@endsection
