@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Productos - Vista de Empleado</h2>

     <!-- Barra de búsqueda -->
     <form action="{{ route('empleado.productos.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Buscar producto..." value="{{ request('search') }}">
    </form>

    <!-- Tabla de productos -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Reducir Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->Codigo_prod }}</td>
                <td>{{ $producto->Nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <!-- Formulario para reducir stock -->
                    <form action="{{ route('productos.reducirStock', $producto->Producto_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="stock" value="1" min="1" max="{{ $producto->stock }}" class="form-control" required>
                        <button type="submit" class="btn btn-danger btn-sm mt-1">Reducir Stock</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
