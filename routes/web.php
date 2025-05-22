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
use App\Http\Controllers\EmplController;

Route::resource('cargos', CargoController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('detalles-producto', DetalleProductoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('empleados', EmpleadoController::class);

// Rutas para ADMINISTRADORES
Route::middleware(['auth', 'rol:administrador'])->group(function () {

    //dashboard admin
    Route::get('/admin/productos/dashboard', [AdminController::class, 'index'])->name('admin.empleados.index');
    // Rutas para Admin

    Route::get('/admin/productos/reporte-pdf', [AdminController::class, 'generarReportePDF'])->name('admin.productos.reporte-pdf');

    Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos');
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');

Route::prefix('admin')->group(function () {
    Route::get('/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('admin.productos.store'); 
});

Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');

Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index');

Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

// Rutas para GERENTES
Route::middleware(['auth', 'rol:gerente'])->group(function () {
    Route::get('/gerente/productos', [GerenteController::class, 'index'])->name('gerente.productos');

    // Dashboard Gerente
    Route::get('/gerente/dashboard', [GerenteController::class, 'index'])->name('gerente.dashboard');

    // Rutas para gerente
Route::get('/gerente/productos', [ProductoController::class, 'gerenteIndex'])->name('gerente.productos');
Route::put('/productos/{id}/actualizar-stock', [ProductoController::class, 'actualizarStock'])->name('productos.actualizarStock');
Route::get('/gerente/productos', [ProductoController::class, 'indexgerente'])->name('gerente.productos.index');
});

// Rutas para EMPLEADOS
Route::middleware(['auth', 'rol:empleado'])->group(function () {
    Route::get('/empleado/productos', [EmplController::class, 'index'])->name('empleado.productos');

// Dashboard Empleado
    Route::get('/empleado/dashboard', [EmplController::class, 'index'])
         ->name('empleado.dashboard');

    // Rutas para empleado
Route::get('/empleado/productos', [ProductoController::class, 'empleadoIndex'])->name('empleado.productos');
Route::put('/productos/{id}/reducir-stock', [ProductoController::class, 'reducirStock'])->name('productos.reducirStock');
Route::get('/empleado/productos', [ProductoController::class, 'indexempleado'])->name('empleado.productos.index');

});


Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout(); // Desloguear al usuario si vuelve a la raíz
        return redirect()->route('login')->with('message', 'Sesión cerrada automáticamente.');
    }
    return redirect()->route('login');
})->name('root');

Route::get('/login', function () {
    if (Auth::check()) {
        Auth::logout(); // Desloguear al usuario si vuelve al login
        return redirect()->route('login')->with('message', 'Sesión cerrada automáticamente.');
    }
    return view('auth.login');
})->name('login');


Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
