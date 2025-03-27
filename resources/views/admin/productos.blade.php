@extends('layouts.app')

@section('content')

<script>
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function() {
        history.go(0);
    };
</script>

<div class="container">
    <h2>Lista de Productos</h2>

    <!-- Barra de búsqueda -->
    <form action="{{ route('admin.productos.index') }}" method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Buscar producto..." value="{{ request('search') }}">

    @if(isset($categorias) && $categorias->count() > 0)
    <select name="categoria" class="form-control">
        <option value="">Todas las categorías</option>
        @foreach ($categorias as $categoria)
        <option value="{{ $categoria->Categoria_id }}" {{ request('categoria') == $categoria->Categoria_id ? 'selected' : '' }}>
                {{ $categoria->Nombre_categoria }}
            </option>
        @endforeach
    </select>
@endif


    <button type="submit" class="btn btn-primary">Buscar</button>
    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary ms-2">Limpiar</a>
</form>


    <a href="{{ url('/admin/productos/create') }}" class="btn btn-primary">Agregar Producto</a>

    <table class="table table-striped">
        <thead>
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
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->Codigo_prod }}</td>
                    <td>{{ $producto->Nombre }}</td>
                    <td>{{ $producto->Estado }}</td>
                    <td>${{ number_format($producto->Precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        @foreach ($producto->categorias as $categoria)
                            <span class="badge bg-primary">{{ $categoria->Nombre_categoria }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.productos.edit', $producto->Producto_id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.productos.destroy', $producto->Producto_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
