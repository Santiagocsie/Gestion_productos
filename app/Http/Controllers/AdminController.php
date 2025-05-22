<?php
// AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Categoria;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado con su cargo
        $empleado = Empleado::with('cargo')->where('Empleado_id', Auth::id())->first();

    $totalEmpleados = Empleado::count();
    $totalProductos = Producto::count();
    $totalCategorias = Categoria::count();
    $productosActivos = Producto::where('Estado', 'Disponible')->count();

    return view('admin.dashboard', compact('empleado', 'totalEmpleados', 'totalProductos', 'totalCategorias', 'productosActivos'));
    }

    public function generarReportePDF()
{
    // Obtener los productos que quieres mostrar en el reporte
    $productos = Producto::all();

    // Cargar la vista con los datos
    $pdf = PDF::loadView('admin.reportes.productos', compact('productos'));

    // Descargar el PDF
    return $pdf->download('reporte_productos.pdf');
}
}

