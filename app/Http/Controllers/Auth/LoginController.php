<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class LoginController extends Controller
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    /**
     * Redirección después del login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crea una nueva instancia del controlador.
     */
    public function __construct()
    {
        $this->middleware('guest:empleado')->except('logout'); // Corregido
    }

    /**
     * Sobrescribe el método de autenticación para usar 'Correo' en lugar de 'email'.
     */
    public function username()
    {
        return 'Correo';
    }

    /**
     * Maneja el proceso de login.
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'Correo' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Intentar autenticación con 'Contrasena'
        if (Auth::guard('empleado')->attempt(['Correo' => $request->Correo, 'Contrasena' => $request->password])) {
            session(['guard' => 'empleado']); // Forzar el guard en la sesión
            return redirect()->intended('/dashboard');
        }
    
        return back()->withErrors(['Correo' => 'Las credenciales no son correctas']);
    }
    

    /**
     * Cierra sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::guard('empleado')->logout(); // Corregido
        return redirect('/login');
    }
}
