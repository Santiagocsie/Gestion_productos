@extends('layouts.app')

@section('title', 'Cambiar Contraseña')

@section('content')

<script>
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        history.go(0);
    };
</script>

<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url("https://mdbootstrap.com/img/new/textures/full/171.jpg") no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .card {
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        border-radius: 15px;
    }

    h2, label {
        text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }

    .form-control:focus {
        box-shadow: 0 0 5px rgba(255,255,255,0.7);
    }

    .btn-primary {
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">🔒 Cambiar Contraseña</h4>
        </div>

        <div class="card-body" style="background-color: rgba(129, 198, 247, 0.87);">

            {{-- Éxito --}}
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.custom-update') }}">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Contraseña actual</label>
                    <input id="current_password" type="password" 
                           class="form-control @error('current_password') is-invalid @enderror" 
                           name="current_password" required autofocus>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Nueva contraseña</label>
                    <input id="new_password" type="password" 
                           class="form-control @error('new_password') is-invalid @enderror" 
                           name="new_password" required>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                    <input id="new_password_confirmation" type="password" 
                           class="form-control" name="new_password_confirmation" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">🔁 Actualizar contraseña</button>
                </div>
            </form>

            <a href="{{ url()->previous() }}" class="btn btn-outline-light mt-3">🔙 Volver</a>
        </div>
    </div>
</div>

@endsection
