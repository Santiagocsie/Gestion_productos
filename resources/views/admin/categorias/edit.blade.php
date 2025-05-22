{{-- resources/views/admin/categorias/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Categoría')

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
    <div class="card mx-auto" style="max-width: 600px;">
        <h2 class="mb-4 text-center" style="color: #6f42c1; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
            ✏️ Editar Categoría
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

        <form method="POST" action="{{ route('admin.categorias.update', $categoria->Categoria_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="Nombre_categoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" name="Nombre_categoria" id="Nombre_categoria" class="form-control" required maxlength="255" value="{{ $categoria->Nombre_categoria }}">
            </div>

            <button type="submit" class="btn btn-success w-100">Actualizar</button>
            <p></p>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-primary w-100">
                🏠 Volver a la gestión de categorías
            </a>
        </form>
    </div>
</div>

@endsection
