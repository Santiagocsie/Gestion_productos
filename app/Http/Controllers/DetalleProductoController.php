<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use Illuminate\Http\Request;

class DetalleProductoController extends Controller
{
    public function index()
    {
        return DetalleProducto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Empleado_id' => 'required|exists:empleados,Empleado_id',
            'Producto_id' => 'required|exists:productos,Producto_id',
            'Categoria_id' => 'required|exists:categorias,Categoria_id',
            'Descripción' => 'nullable|string',
            'Estado' => 'required|in:Agotado,Disponible',
            'Precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'Imagen_Url' => 'nullable|url',
        ]);

        return DetalleProducto::create($request->all());
    }

    public function show($id)
    {
        return DetalleProducto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleProducto::findOrFail($id);
        $detalle->update($request->all());
        return $detalle;
    }

    public function destroy($id)
    {
        return DetalleProducto::destroy($id);
    }
}
