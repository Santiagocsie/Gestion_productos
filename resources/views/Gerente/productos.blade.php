@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Administración de Productos (Gerencial)</h2>

    <!-- Barra de búsqueda -->
    <form action="{{ route('gerente.productos.index') }}" method="GET" class="mb-3">
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
        <a href="{{ route('gerente.productos.index') }}" class="btn btn-secondary ms-2">Limpiar</a>
    </form>

    

    <!-- Tabla de productos -->
     
    <table class="table table-bordered ">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Modificar Stock</th>
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
                <td>{{ $producto->stock }}</td>
                <td>
                    <!-- Formulario para modificar stock -->
                    <form action="{{ route('productos.actualizarStock', $producto->Producto_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="stock" value="{{ $producto->stock }}" min="0" class="form-control" required>
                        <button type="submit" class="btn btn-warning btn-sm mt-1">Actualizar Stock</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
