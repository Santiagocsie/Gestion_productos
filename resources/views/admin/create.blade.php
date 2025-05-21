@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Crear Nuevo Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Codigo_prod" class="form-label">Código del Producto</label>
            <input type="text" name="Codigo_prod" id="Codigo_prod" class="form-control" 
                   maxlength="255" required>
        </div>

        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre del Producto</label>
            <input type="text" name="Nombre" id="Nombre" class="form-control" 
                   maxlength="255" required>
        </div>

        <div class="mb-3">
            <label for="Precio" class="form-label">Precio</label>
            <input type="number" name="Precio" id="Precio" class="form-control" 
                   min="0" max="99999999.99" step="0.01"
                   pattern="^\d{1,8}(\.\d{1,2})?$"
                   title="Ingrese un precio con hasta 10 dígitos enteros y 2 decimales" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" 
                   min="0" required>
        </div>

        <div class="mb-3">
            <label for="Descripcion" class="form-label">Descripción</label>
            <textarea name="Descripcion" id="Descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Categorías</label>
            <div class="form-check">
                @foreach ($categorias as $categoria)
                    <div>
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->Categoria_id }}" class="form-check-input">
                        <label class="form-check-label">{{ $categoria->Nombre_categoria }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
