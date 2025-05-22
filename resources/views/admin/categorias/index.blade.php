 {{-- resources/views/admin/categorias/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Gestión de Categorías')

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

    h1, h4 {
        text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }

    .btn-outline-success, .btn-outline-warning, .btn-outline-danger {
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📂 Administración de Categorías (Admin)</h4>
        </div>
        <div class="card-body" style="background-color:rgba(129, 198, 247, 0.87);">

            {{-- Formulario para nueva categoría --}}
            <div class="mb-4">
                <form method="POST" action="{{ route('admin.categorias.store') }}" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-9">
                        <label for="Nombre_categoria" class="form-label">Nombre de la Categoría</label>
                        <input type="text" name="Nombre_categoria" id="Nombre_categoria" class="form-control" required maxlength="255" placeholder="Ej. Zapatos deportivos">
                    </div>
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-success mt-1">➕ Crear Categoría</button>
                    </div>
                </form>
            </div>

            {{-- Tabla de categorías --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $cat)
                        <tr>
                            <td>{{ $cat->Categoria_id }}</td>
                            <td>{{ $cat->Nombre_categoria }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.categorias.update', $cat->Categoria_id) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                <form method="POST" action="{{ route('admin.categorias.destroy', $cat->Categoria_id) }}" onsubmit="return confirm('¿Eliminar esta categoría?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">⚠️ No hay categorías registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary mt-3">
                Volver al Panel
            </a>
        </div>
    </div>
</div>

@endsection
