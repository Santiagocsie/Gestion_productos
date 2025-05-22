@extends('layouts.app')

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

    .btn-outline-success, .btn-outline-primary, .btn-outline-info {
        font-weight: bold;
    }

    h1, h3, h4 {
        text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }
</style>

<div class="container mt-4">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">👨‍💼 Lista de Empleados</h4>
            <a href="{{ route('admin.empleados.create') }}" class="btn btn-light text-primary fw-bold">
                ➕ Agregar Empleado
            </a>
        </div>

        <div class="card-body" style="background-color:rgba(129, 198, 247, 0.87);">
            <!-- Barra de búsqueda -->
            <form action="{{ route('admin.empleados.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Buscar empleado... (Ej: nombre, email, teléfono)" value="{{ request('search') }}">
                </div>

                @if(isset($cargos) && $cargos->count() > 0)
                <div class="col-md-4">
                    <select name="cargo" class="form-select">
                        <option value="">Todos los cargos</option>
                        @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->Cargo_id }}" {{ request('cargo') == $cargo->Cargo_id ? 'selected' : '' }}>
                            {{ $cargo->Nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-success me-2 w-100">Buscar</button>
                    <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                </div>
            </form>

            <!-- Tabla de empleados -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Cargo</th>
                            <th>Tipo Contrato</th>
                            <th>Inicio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($empleados as $emp)
                        <tr>
                            <td>{{ $emp->Nombre }}</td>
                            <td>{{ $emp->Email }}</td>
                            <td>{{ $emp->Telefono }}</td>
                            <td>{{ $emp->Direccion }}</td>
                            <td>{{ $emp->contratoActual?->cargo?->Nombre ?? 'No asignado' }}</td>
                            <td>{{ $emp->contratoActual?->Tipo_contrato ?? 'No asignado' }}</td>
                            <td>{{ $emp->contratoActual?->Fecha_inicio ?? 'No asignado' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.empleados.edit', $emp->Empleado_id) }}" class="btn btn-warning btn-sm">✏️</a>

                                    <form action="{{ route('admin.empleados.destroy', $emp->Empleado_id) }}" method="POST" onsubmit="return confirm('¿Eliminar este empleado?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center">No hay empleados registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex gap-3 mb-3">
                <a href="{{ route('admin.empleados.reporte-pdf') }}" class="btn btn-danger">
                    📄 Descargar lista de empleados PDF
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                    Volver al panel
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
