@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agregar Nuevo Producto</h2>
    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Codigo_prod" class="form-label">Código:</label>
            <input type="text" name="Codigo_prod" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre:</label>
            <input type="text" name="Nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Descripcion" class="form-label">Descripción:</label>
            <textarea name="Descripcion" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="Precio" class="form-label">Precio:</label>
            <input type="number" name="Precio" class="form-control" required step="0.01">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Cantidad:</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Categoria_id" class="form-label">Categoría:</label>
            <select name="Categoria_id" class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Producto</button>
    </form>
</div>
@endsection
