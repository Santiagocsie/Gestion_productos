<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contrato;
use App\Models\Cargo;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, $rol)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $user = Auth::user();

        // Obtener el contrato del usuario autenticado
        $contrato = Contrato::where('Empleado_id', $user->Empleado_id)->first();

        if ($contrato) {
            // Obtener el cargo del usuario
            $cargo = Cargo::where('Cargo_id', $contrato->Cargo_id)->first();
            if ($cargo && $cargo->Rol === $rol) {
                return $next($request);
            }
        }

        // Enviar un mensaje de error sin redirigir
        return response()->view('errors.403', ['mensaje' => 'No tienes permiso para acceder a esta página.'], 403);
    }
}

