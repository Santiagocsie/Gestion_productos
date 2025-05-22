<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\categoria;

class GerenteController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado con su cargo
        $empleado = Empleado::with('cargo')->where('Empleado_id', Auth::id())->first();
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $productosActivos = Producto::where('Estado', 'Disponible')->count();

        return view('gerente.dashboard', compact('empleado', 'totalProductos', 'totalCategorias', 'productosActivos'));
    }
}

