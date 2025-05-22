@extends('layouts.app')
@section('title', 'Registrar Empleado')

@section('content')

<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url("https://mdbootstrap.com/img/new/textures/full/171.jpg") no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .card {
        background-color: rgba(241, 196, 243, 0.85); /* rosa pastel transparente */
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        border-radius: 15px;
        padding: 20px;
        color: #2c3e50;
    }

    label {
        font-weight: 600;
    }

    .btn-success {
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card mx-auto" style="max-width: 800px;">
        <h2 class="mb-4 text-center" style="color: #6f42c1; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">🧑‍💼 Registrar Nuevo Empleado</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.empleados.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="Nombre" class="form-control" value="{{ old('Nombre') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="Email" class="form-control" value="{{ old('Email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="Contrasena" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="Telefono" class="form-control" value="{{ old('Telefono') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="Direccion" class="form-control" value="{{ old('Direccion') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="Fecha_nacimiento" class="form-control" value="{{ old('Fecha_nacimiento') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="Genero" class="form-control" required>
                    <option value="Masculino" {{ old('Genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('Genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ old('Genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <hr>
            <h5 class="mt-4">📄 Contrato</h5>

            <div class="mb-3">
                <label class="form-label">Cargo</label>
                <select name="Cargo_id" class="form-control" required>
                    @foreach($cargo as $cargo)
                        <option value="{{ $cargo->Cargo_id }}" {{ old('Cargo_id') == $cargo->Cargo_id ? 'selected' : '' }}>
                            {{ $cargo->Nombre }} ({{ $cargo->Rol }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Contrato</label>
                <input type="text" name="Tipo_contrato" class="form-control" value="{{ old('Tipo_contrato') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" name="Fecha_inicio" class="form-control" value="{{ old('Fecha_inicio') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Fin</label>
                <input type="date" name="Fecha_fin" class="form-control" value="{{ old('Fecha_fin') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Salario</label>
                <input type="number" name="Salario" class="form-control" step="0.01" value="{{ old('Salario') }}" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Registrar empleado</button>
            <p></p>
            <a href="{{ route('admin.empleados.index') }}" class="btn btn-outline-light w-100">
                🏠 Volver a la gestión de empleados
            </a>

        </form>
    </div>
</div>

@endsection
