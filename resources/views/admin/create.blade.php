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

    .btn-success {
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="card mx-auto" style="max-width: 700px;">
        <h2 class="mb-4 text-center" style="color: #6f42c1; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">Crear Nuevo Producto</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
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
                <label class="form-label">Categorías</label>
                <div class="form-check">
                    @foreach ($categorias as $categoria)
                        <div>
                            <input type="checkbox" name="categorias[]" value="{{ $categoria->Categoria_id }}" class="form-check-input" id="cat_{{ $categoria->Categoria_id }}">
                            <label for="cat_{{ $categoria->Categoria_id }}" class="form-check-label">{{ $categoria->Nombre_categoria }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Guardar</button>
            <p></p>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-primary w-100">
                    🏠 Volver a la gestión de productos
                </a>
            
        </form>
    </div>
</div>

@endsection
