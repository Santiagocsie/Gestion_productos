@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Producto</h2>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="Codigo_prod" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="Nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="Estado" class="form-control" required>
                <option value="Disponible">Disponible</option>
                <option value="Agotado">Agotado</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="Precio" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
    <label>Descripción</label>
    <textarea name="Descripcion" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Categorías</label>
    <select name="categorias[]" class="form-control" multiple required>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->Categoria_id }}">{{ $categoria->Nombre_categoria }}</option>
        @endforeach
    </select>
</div>


        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
