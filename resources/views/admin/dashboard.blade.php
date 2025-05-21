@extends('layouts.app')
@section('title', 'Gestion Admin')
@section('content')
<div class="container">
        <h1>Bienvenido al Panel de administrador</h1>
        <h3>Bienvenido, {{ $empleado->Nombre }}</h3>
        
        @if($empleado->cargo)
            <p>Tu rol es: <strong>{{ $empleado->cargo->Rol }}</strong></p>
        @else
            <p>No tienes un rol asignado.</p>
        @endif
    </div>
@endsection
