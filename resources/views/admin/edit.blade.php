@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>
    <form action="{{ route('admin.productos.update', $producto->Producto_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="Codigo_prod" class="form-control" 
                   value="{{ $producto->Codigo_prod }}" required 
                   maxlength="255">
        </div>
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="Nombre" class="form-control" 
                   value="{{ $producto->Nombre }}" required 
                   maxlength="255">
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="Precio" class="form-control" 
                   value="{{ $producto->Precio }}" required 
                   min="0" max="99999999.99" step="0.01"
                   pattern="^\d{1,8}(\.\d{1,2})?$"
                   title="Ingrese un precio con hasta 10 dígitos enteros y 2 decimales">
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" 
                   value="{{ $producto->stock }}" required min="0">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="Descripcion" class="form-control">{{ $producto->Descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Categorías</label>
            <div>
                @foreach ($categorias as $categoria)
                    <label class="d-block">
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->Categoria_id }}"
                            {{ in_array($categoria->Categoria_id, $categoriasSeleccionadas) ? 'checked' : '' }}>
                        {{ $categoria->Nombre_categoria }}
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
