<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Cargo;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        // Obtener el contrato del usuario autenticado
        $contrato = Contrato::where('Empleado_id', $user->Empleado_id)->first();
    
        if ($contrato) {
            $cargo = Cargo::where('Cargo_id', $contrato->Cargo_id)->first();
    
            if ($cargo) {
                // Redirigir según el rol
                if ($cargo->Rol === 'administrador') {
                    return redirect()->route('admin.empleados.index');
                } elseif ($cargo->Rol === 'gerente') {
                    return redirect()->route('gerente.dashboard');
                } elseif ($cargo->Rol === 'empleado') {
                    return redirect()->route('empleado.dashboard');
                }
            }
        }
    
        // Si no tiene un rol válido, redirigir a la página por defecto
        //return redirect('/');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    
}
