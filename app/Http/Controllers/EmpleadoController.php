<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        return Empleado::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Correo' => 'required|email|unique:empleados',
            'Contraseña' => 'required|string|min:6',
            'Telefono' => 'nullable|string|max:20',
            'Direccion' => 'nullable|string',
            'Fecha_nacimiento' => 'required|date',
            'Genero' => 'required|in:M,F',
        ]);

        $empleado = Empleado::create($request->all());
        return $empleado;
    }

    public function show($id)
    {
        return Empleado::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());
        return $empleado;
    }

    public function destroy($id)
    {
        return Empleado::destroy($id);
    }
}
