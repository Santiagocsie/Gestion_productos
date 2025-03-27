@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Administración de Productos (Gerencial)</h2>

    <!-- Tabla de productos -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Modificar Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
    <td>{{ $producto->Codigo_prod }}</td>
    <td>{{ $producto->Nombre }}</td>
    <td>{{ $producto->stock }}</td>

    <td>

        <!-- Formulario para actualizar stock -->
       <!-- Formulario para modificar stock -->
       <form action="{{ route('productos.actualizarStock', $producto->Producto_id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="number" name="stock" value="{{ $producto->stock }}" min="0" class="form-control" required>
                <button type="submit" class="btn btn-warning btn-sm mt-1">Actualizar Stock</button>
            </form>
    </td>
</tr>

            @endforeach
        </tbody>
    </table>

    <!-- Modal para Agregar Producto -->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Validación de errores -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="Codigo_prod" class="form-label">Código</label>
                            <input type="text" name="Codigo_prod" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input type="text" name="Nombre" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
