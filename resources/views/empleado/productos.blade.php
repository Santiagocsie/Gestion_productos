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

    h2, h4 {
        text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }
</style>

<div class="container mt-4">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">🛠️ Productos - Vista de Empleado</h4>
        </div>
        <div class="card-body" style="background-color:rgba(129, 198, 247, 0.87);">

            <!-- Barra de búsqueda -->
            <form action="{{ route('empleado.productos.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Buscar producto..." value="{{ request('search') }}">
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
                    <button type="submit" class="btn btn-primary me-2 w-100">Buscar</button>
                    <a href="{{ route('empleado.productos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                </div>
            </form>

            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Reducir Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->Codigo_prod }}</td>
                            <td>{{ $producto->Nombre }}</td>
                            <td>
                                @foreach ($producto->categorias as $categoria)
                                    <span class="badge bg-primary">{{ $categoria->Nombre_categoria }}</span>
                                @endforeach
                            </td>
                            <td class="{{ $producto->stock < 20 ? 'text-danger fw-bold' : '' }}">
                                {{ $producto->stock }}
                                @if($producto->stock < 20)
                                    <span class="badge bg-warning">¡Stock bajo!</span>
                                @endif
                            </td>
                            <td>
                                @if($producto->stock > 0)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">Agotado</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('productos.reducirStock', $producto->Producto_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="stock" value="1" min="1" max="{{ $producto->stock }}" class="form-control" required {{ $producto->stock == 0 ? 'disabled' : '' }}>
                                    <button type="submit" class="btn btn-danger btn-sm mt-1" {{ $producto->stock == 0 ? 'disabled' : '' }}>Reducir Stock</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
            @endif

        </div> <!-- card-body -->
    </div> <!-- card -->
</div> <!-- container -->

@endsection
