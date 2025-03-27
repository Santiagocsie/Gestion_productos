<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class GerenteController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado con su cargo
        $empleado = Empleado::with('cargo')->where('Empleado_id', Auth::id())->first();

        return view('gerente.dashboard', compact('empleado'));
    }
}

