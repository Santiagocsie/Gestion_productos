@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login Empleado</h2>
    <form action="{{ route('empleado.login') }}" method="POST">
        @csrf
        <input type="email" name="Correo" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>
@endsection
