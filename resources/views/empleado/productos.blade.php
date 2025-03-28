@extends('layouts.app')  

@section('content') 
<div class="container mt-4">     
    <h2>Productos - Vista de Empleado</h2>       

    <!-- Barra de búsqueda -->      
    <form action="{{ route('empleado.productos.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar producto..." value="{{ request('search') }}">
        
        @if(isset($categorias) && $categorias->count() > 0)    
            <select name="categoria" class="form-control me-2">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->Categoria_id }}" {{ request('categoria') == $categoria->Categoria_id ? 'selected' : '' }}>
                        {{ $categoria->Nombre_categoria }}
                    </option>
                @endforeach
            </select> 
        @endif        

        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="{{ route('empleado.productos.index') }}" class="btn btn-secondary ms-2">Limpiar</a>     
    </form>      

    <!-- Tabla de productos -->     
<!-- Tabla de productos -->     
<table class="table table-bordered">         
    <thead class="table-dark">             
        <tr>                 
            <th>Código</th>                 
            <th>Nombre</th>                 
            <th>Categoría</th>                 
            <th>Stock</th>                 
            <th>Estado</th> <!-- Nueva columna Estado -->
            <th>Reducir Stock</th>             
        </tr>         
    </thead>         
    <tbody>             
        @foreach ($productos as $producto)             
        <tr>                 
            <td>{{ $producto->Codigo_prod }}</td>                 
            <td>{{ $producto->Nombre }}</td>                 
            <td>                     
                @foreach ($producto->categorias as $categoria)                         
                    <span class="badge bg-primary">{{ $categoria->Nombre_categoria }}</span>                     
                @endforeach                 
            </td>                 
            <td class="{{ $producto->stock < 20 ? 'text-danger fw-bold' : '' }}"> 
                {{ $producto->stock }}                     
                @if($producto->stock < 20)                         
                    <span class="badge bg-warning">¡Stock bajo!</span>                     
                @endif                 
            </td>  
            <td>
                @if($producto->stock > 0)
                    <span class="badge bg-success">Disponible</span>
                @else
                    <span class="badge bg-danger">Agotado</span>
                @endif
            </td>               
            <td>                     
                <!-- Formulario para reducir stock -->                     
                <form action="{{ route('productos.reducirStock', $producto->Producto_id) }}" method="POST">                         
                    @csrf                         
                    @method('PUT')                         
                    <input type="number" name="stock" value="1" min="1" max="{{ $producto->stock }}" class="form-control" required {{ $producto->stock == 0 ? 'disabled' : '' }}>                         
                    <button type="submit" class="btn btn-danger btn-sm mt-1" {{ $producto->stock == 0 ? 'disabled' : '' }}>Reducir Stock</button>                     
                </form>                 
            </td>             
        </tr>             
        @endforeach         
    </tbody>     
</table> 

</div> 

@endsection  

@if(session('success'))     
    <div class="alert alert-success">         
        {{ session('success') }}     
    </div> 
@endif  

@if(session('error'))     
    <div class="alert alert-danger">         
        {{ session('error') }}     
    </div> 
@endif  
