@extends('layouts.app')
@section('title', 'Login')  
@section('content')
<section class="vh-100" style="background-color:rgba(129, 198, 247, 0.87);">
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                         alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">


                    
                        <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
    <h1 class="fw-bold m-0">{{ config('app.name') }}</h1>
    </div>


    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicia sesion con tu cuenta</h5>

    <!-- EMAIL -->
    <div class="form-outline mb-4">
        <label for="email" class="form-label">{{ __('Correo electronico') }}</label>
        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- PASSWORD -->
    <div class="form-outline mb-4">
        <label for="password" class="form-label">{{ __('Constraseña') }}</label>
        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">
        @error('password')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- SUBMIT BUTTON -->
    <div class="mb-4">
        <button type="submit" class="btn btn-dark btn-lg w-100">
            {{ __('Login') }}
        </button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
