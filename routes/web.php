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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GerenteController;

Route::resource('cargos', CargoController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('detalles-producto', DetalleProductoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('empleados', EmpleadoController::class);


Route::middleware(['auth', 'rol:administrador'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Rutas para GERENTES
Route::middleware(['auth', 'rol:gerente'])->group(function () {
    Route::get('/gerente', [GerenteController::class, 'index'])->name('gerente.dashboard');
});

// Rutas para EMPLEADOS
Route::middleware(['auth', 'rol:empleado'])->group(function () {
    Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.dashboard');
});

Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');



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
