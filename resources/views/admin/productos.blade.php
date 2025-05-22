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
            <h4 class="mb-0">📦 Lista de Productos</h4>
            <a href="{{ url('/admin/productos/create') }}" class="btn btn-light text-primary fw-bold">
                ➕ Agregar Producto
            </a>
            
        </div>

        <div class="card-body" style="background-color:rgba(129, 198, 247, 0.87);">
            <!-- Barra de búsqueda -->
            <form action="{{ route('admin.productos.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Buscar producto... (Ej: nombre,código,categoria)" value="{{ request('search') }}">
                </div>

                @if(isset($categorias) && $categorias->count() > 0)
                <div class="col-md-4">
                    <select name="categoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->Categoria_id }}" {{ request('categoria') == $categoria->Categoria_id ? 'selected' : '' }}>
                            {{ $categoria->Nombre_categoria }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-success me-2 w-100">Buscar</button>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                </div>
            </form>

            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                        <tr>
                            <td>{{ $producto->Codigo_prod }}</td>
                            <td>{{ $producto->Nombre }}</td>
                            <td><span class="badge bg-{{ $producto->Estado == 'Disponible' ? 'success' : 'danger' }}">{{ $producto->Estado }}</span></td>
                            <td>${{ number_format($producto->Precio, 2) }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                @foreach ($producto->categorias as $categoria)
                                <span class="badge bg-primary">{{ $categoria->Nombre_categoria }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.productos.edit', $producto->Producto_id) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('admin.productos.destroy', $producto->Producto_id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted text-center">No se encontraron productos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-3 mb-3">
    <a href="{{ route('admin.productos.reporte-pdf') }}" class="btn btn-danger">
        📄 Descargar Reporte PDF
    </a>
    <a href="{{ route('admin.empleados.index') }}" class="btn btn-outline-primary">
        🏠 Volver al Dashboard
    </a>
</div>



            <!-- Paginación -->
            
        </div>
    </div>
</div>

@endsection
