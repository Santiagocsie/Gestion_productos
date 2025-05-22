@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')

<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url("https://mdbootstrap.com/img/new/textures/full/171.jpg") no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .card {
        background-color: rgba(241, 196, 243, 0.85);
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        border-radius: 15px;
        padding: 20px;
        color: #2c3e50;
    }

    label {
        font-weight: 600;
    }

    .btn-primary {
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card mx-auto" style="max-width: 800px;">
        <h2 class="mb-4 text-center" style="color: #6f42c1; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">✏️ Editar Empleado</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.empleados.update', $empleado->Empleado_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" id="Nombre" name="Nombre" class="form-control" value="{{ old('Nombre', $empleado->Nombre) }}" required>
            </div>

            <div class="mb-3">
                <label for="Email" class="form-label">Correo electrónico</label>
                <input type="email" id="Email" name="Email" class="form-control" value="{{ old('Email', $empleado->Email) }}" required>
            </div>

            <div class="mb-3">
                <label for="Contrasena" class="form-label">Contraseña (opcional)</label>
                <input type="password" id="Contrasena" name="Contrasena" class="form-control" placeholder="Dejar en blanco para no cambiar">
            </div>

            <div class="mb-3">
                <label for="Telefono" class="form-label">Teléfono</label>
                <input type="text" id="Telefono" name="Telefono" class="form-control" value="{{ old('Telefono', $empleado->Telefono) }}">
            </div>

            <div class="mb-3">
                <label for="Direccion" class="form-label">Dirección</label>
                <input type="text" id="Direccion" name="Direccion" class="form-control" value="{{ old('Direccion', $empleado->Direccion) }}">
            </div>

            @if($empleado->Fecha_nacimiento)
    <div class="mb-3">
        <label class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="Fecha_nacimiento" class="form-control" value="{{ old('Fecha_nacimiento', $empleado->Fecha_nacimiento) }}">
    </div>
@endif


            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="Genero" class="form-control">
                    <option value="Masculino" {{ old('Genero', $empleado->Genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('Genero', $empleado->Genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ old('Genero', $empleado->Genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            @if($empleado->contratoActual)
                <hr>
                <h5 class="mt-4">📄 Contrato</h5>

                <div class="mb-3">
                    <label for="Cargo_id" class="form-label">Cargo</label>
                    <select name="Cargo_id" class="form-control" required>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->Cargo_id }}" {{ $cargo->Cargo_id == $empleado->contratoActual->Cargo_id ? 'selected' : '' }}>
                                {{ $cargo->Nombre }} ({{ $cargo->Rol }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Tipo_contrato" class="form-label">Tipo de Contrato</label>
                    <input type="text" name="Tipo_contrato" class="form-control" value="{{ old('Tipo_contrato', $empleado->contratoActual->Tipo_contrato) }}">
                </div>

                <div class="mb-3">
                    <label for="Fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" name="Fecha_inicio" class="form-control" value="{{ old('Fecha_inicio', $empleado->contratoActual->Fecha_inicio) }}">
                </div>

                <div class="mb-3">
                    <label for="Fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" name="Fecha_fin" class="form-control" value="{{ old('Fecha_fin', $empleado->contratoActual->Fecha_fin) }}">
                </div>

                <div class="mb-3">
                    <label for="Salario" class="form-label">Salario</label>
                    <input type="number" name="Salario" class="form-control" step="0.01" value="{{ old('Salario', $empleado->contratoActual->Salario) }}">
                </div>
            @endif

            <button type="submit" class="btn btn-primary w-100">Actualizar Empleado</button>
            <p></p>
            <a href="{{ route('admin.empleados.index') }}" class="btn btn-outline-light w-100">
                🏠 Volver a la gestión de empleados
            </a>
        </form>
    </div>
</div>

@endsection
