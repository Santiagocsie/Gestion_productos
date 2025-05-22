@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url("https://mdbootstrap.com/img/new/textures/full/171.jpg") no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .card {
        background-color: rgba(241, 196, 243, 0.85); /* rosa pastel transparente */
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        border-radius: 15px;
        padding: 20px;
        color: #2c3e50;
    }

    label {
        font-weight: 600;
    }

    .btn-success, .btn-outline-primary {
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card mx-auto" style="max-width: 700px;">
        <h2 class="mb-4 text-center" style="color: #6f42c1; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
            ✏️ Editar Producto
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.productos.update', $producto->Producto_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="Codigo_prod" class="form-label">Código</label>
                <input type="text" name="Codigo_prod" id="Codigo_prod" class="form-control"
                       value="{{ $producto->Codigo_prod }}" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" name="Nombre" id="Nombre" class="form-control"
                       value="{{ $producto->Nombre }}" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="Precio" class="form-label">Precio</label>
                <input type="number" name="Precio" id="Precio" class="form-control"
                       value="{{ $producto->Precio }}" required min="0" max="99999999.99" step="0.01"
                       pattern="^\d{1,8}(\.\d{1,2})?$"
                       title="Ingrese un precio con hasta 8 dígitos enteros y 2 decimales">
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control"
                       value="{{ $producto->stock }}" required min="0">
            </div>

            <div class="mb-3">
                <label for="Descripcion" class="form-label">Descripción</label>
                <textarea name="Descripcion" id="Descripcion" class="form-control">{{ $producto->Descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Categorías</label>
                <div class="form-check">
                    @foreach ($categorias as $categoria)
                        <div>
                            <input type="checkbox" name="categorias[]" id="cat_{{ $categoria->Categoria_id }}"
                                   value="{{ $categoria->Categoria_id }}"
                                   class="form-check-input"
                                   {{ in_array($categoria->Categoria_id, $categoriasSeleccionadas) ? 'checked' : '' }}>
                            <label for="cat_{{ $categoria->Categoria_id }}" class="form-check-label">
                                {{ $categoria->Nombre_categoria }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            
                <button type="submit" class="btn btn-success w-100">Actualizar</button>
                <p></p>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-primary w-100">
                    🏠 Volver a la gestión de productos
                </a>
            
        </form>
    </div>
</div>

@endsection
