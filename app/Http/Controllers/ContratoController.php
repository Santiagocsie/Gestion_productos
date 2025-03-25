<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index()
    {
        return Contrato::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Empleado_id' => 'required|exists:empleados,Empleado_id',
            'Cargo_id' => 'required|exists:cargos,Cargo_id',
            'Tipo_contrato' => 'required|in:Indefinido,Definido,Por obra',
            'Fecha_inicio' => 'required|date',
            'Fecha_fin' => 'nullable|date|after_or_equal:Fecha_inicio',
            'Salario' => 'required|numeric|min:0',
        ]);

        return Contrato::create($request->all());
    }

    public function show($id)
    {
        return Contrato::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->update($request->all());
        return $contrato;
    }

    public function destroy($id)
    {
        return Contrato::destroy($id);
    }
}
