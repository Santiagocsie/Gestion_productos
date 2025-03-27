<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoAuthController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DetalleProductoController;

Route::resource('cargos', CargoController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('detalles-producto', DetalleProductoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('empleados', EmpleadoController::class);

Route::get('/empleado/login', [EmpleadoAuthController::class, 'showLoginForm'])->name('empleado.login');
Route::post('/empleado/login', [EmpleadoAuthController::class, 'login']);
Route::post('/empleado/logout', [EmpleadoAuthController::class, 'logout'])->name('empleado.logout');


Route::get('/', function () {
     return redirect()->route('login');
});

// Rutas protegidas para empleados autenticados
Route::middleware('auth:empleado')->group(function () {
    Route::get('/empleado/dashboard', function () {
        return view('empleado.dashboard'); // Asegúrate de que esta vista existe
    })->name('empleado.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
