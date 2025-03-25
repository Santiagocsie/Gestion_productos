<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        return Cargo::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Rol' => 'required|in:Administrador,Gerente,Empleado',
            'Descripcion' => 'nullable|string',
        ]);

        return Cargo::create($request->all());
    }

    public function show($id)
    {
        return Cargo::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->update($request->all());
        return $cargo;
    }

    public function destroy($id)
    {
        return Cargo::destroy($id);
    }
}
