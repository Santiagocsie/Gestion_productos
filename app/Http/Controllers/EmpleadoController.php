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
            'Contrasena' => 'required|string|min:6',
            'Telefono' => 'nullable|string|max:20',
            'Direccion' => 'nullable|string',
            'Fecha_nacimiento' => 'required|date',
            'Genero' => 'required|in:M,F',
        ]);

        $empleadoData = $request->all();
        $empleadoData['Contrasena'] = bcrypt($empleadoData['Contrasena']);

        $empleado = Empleado::create($empleadoData);
        return $empleado;
    }

    public function show($id)
    {
        return Empleado::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'Nombre' => 'sometimes|string|max:100',
            'Email' => 'sometimes|email|unique:empleados,Email,' . $id,
            'Contrasena' => 'sometimes|string|min:6',
            'Telefono' => 'nullable|string|max:20',
            'Direccion' => 'nullable|string',
            'Fecha_nacimiento' => 'sometimes|date',
            'Genero' => 'sometimes|in:M,F',
        ]);

        $empleadoData = $request->all();

        if (!empty($empleadoData['Contrasena'])) {
            $empleadoData['Contrasena'] = bcrypt($empleadoData['Contrasena']);
        } else {
            unset($empleadoData['Contrasena']);
        }

        $empleado->update($empleadoData);
        return $empleado;
    }

    public function destroy($id)
    {
        return Empleado::destroy($id);
    }
}