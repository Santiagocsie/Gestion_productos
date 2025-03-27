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
