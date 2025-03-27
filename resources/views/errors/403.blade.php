@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger">
                {{ $mensaje }}
            </div>
        </div>
    </div>
</div>
@endsection
