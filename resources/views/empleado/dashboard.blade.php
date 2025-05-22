@extends('layouts.app')

@section('title', 'Gestión Empleado')

@section('content')

{{-- Fondo decorativo --}}
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
    h1, h3, h4 {
        text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }
    .btn-outline-primary, .btn-outline-success {
        font-weight: bold;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-4">👨‍💼 Panel de Empleado</h1>
    <h3 class="text-center">Hola, {{ $empleado->Nombre }}</h3>

    @if($empleado->cargo)
        <p class="text-center">Tu rol es: <strong>{{ $empleado->cargo->Rol }}</strong></p>
    @else
        <p class="text-center">No tienes un rol asignado.</p>
    @endif

    <div class="row mt-4 g-4">
        {{-- Ejemplo de métricas para Empleado --}}
        <div class="row mt-4 justify-content-center g-4">
        <div class="col-md-4 col-lg-3">
            <div class="card bg-success text-white mb-3">
                <div class="card-header">🛒 Productos</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $totalProductos }}</h5>
                    <p class="card-text text-center">Total de productos</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card bg-warning text-dark mb-3">
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
        <h4>Accesos Rápidos</h4>
        <a href="{{ route('empleado.productos.index') }}" class="btn btn-outline-primary me-2">🛒 Ver Productos</a>
    </div>
</div>

@endsection
