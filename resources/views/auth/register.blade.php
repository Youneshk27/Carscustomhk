@extends('layouts.app')

@section('content')
<div class="container-fluid position-relative d-flex justify-content-center align-items-center min-vh-100 p-0" style="overflow: hidden;">
    <!-- Video de fondo -->
    <video autoplay muted loop class="position-absolute w-100 h-100" style="object-fit: cover;">
        <source src="{{ asset('storage/fotos/fondo1.mp4') }}" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>

    <!-- Tarjeta de registro -->
    <div class="card p-4 shadow-lg position-relative" style="background-color: rgba(10, 14, 39, 0.6); color: #fff; border-radius: 15px; width: 100%; max-width: 600px;">
        <div class="card-header text-center mb-4" style="border-bottom: none;">
            <img src="{{ asset('storage/fotos/logo.png') }}" alt="Car Workshop Logo" style="width: 80px;">
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-4">
                    <label for="name" class="form-label" style="color: #bbb;">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="email" class="form-label" style="color: #bbb;">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="form-label" style="color: #bbb;">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password-confirm" class="form-label" style="color: #bbb;">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
                </div>

                <div class="form-group mb-4">
                    <label for="role" class="form-label" style="color: #bbb;">Role</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required style="background-color: rgba(28, 35, 54, 0.6); color: #fff; border: 1px solid #555; border-radius: 8px; padding: 10px;">
                        <option value="user">User</option>
                        <option value="taller">Taller</option>
                    </select>

                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn neon-button">
                            {{ __('Register') }}
                        </button>
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
