@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

{{-- Fondo decorativo para todo el contenido --}}
<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url("https://mdbootstrap.com/img/new/textures/full/171.jpg") no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .card {
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        border-radius: 15px;
    }

    .btn-outline-success, .btn-outline-primary, .btn-outline-info {
        font-weight: bold;
    }

    h1, h3, h4 {
        text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-4">Bienvenido al Panel de Administrador</h1>
    <h3 class="text-center">Hola, {{ $empleado->Nombre }}</h3>

    @if($empleado->cargo)
        <p class="text-center">Tu rol es: <strong>{{ $empleado->cargo->Rol }}</strong></p>
    @else
        <p class="text-center">No tienes un rol asignado.</p>
    @endif

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header">👥 Empleados</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $totalEmpleados }}</h5>
                    <p class="card-text text-center">Total de empleados</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">🛒 Productos</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $totalProductos }}</h5>
                    <p class="card-text text-center">Total de productos</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-header">📂 Categorías</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $totalCategorias }}</h5>
                    <p class="card-text text-center">Total de categorías</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-header">✅ Disponibles</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $productosActivos }}</h5>
                    <p class="card-text text-center">De {{ $totalProductos }} productos</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Navegación rápida --}}
    <div class="text-center mt-5">
        <h4>Navegación rápida</h4>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-success me-2">🛒 Gestión de Productos</a>
        {{-- Agrega más botones aquí si tienes más rutas --}}
    </div>
</div>

@endsection
