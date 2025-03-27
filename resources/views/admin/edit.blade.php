@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>
    <form action="{{ route('admin.productos.update', $producto->Producto_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="Codigo_prod" class="form-control" value="{{ $producto->Codigo_prod }}" required>
        </div>
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="Nombre" class="form-control" value="{{ $producto->Nombre }}" required>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="Estado" class="form-control" required>
                <option value="Disponible" {{ $producto->Estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Agotado" {{ $producto->Estado == 'Agotado' ? 'selected' : '' }}>Agotado</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="Precio" step="0.01" class="form-control" value="{{ $producto->Precio }}" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="Descripcion" class="form-control">{{ $producto->Descripcion }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
