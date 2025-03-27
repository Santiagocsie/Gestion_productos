<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function adminIndex()
    {
        $productos = Producto::all();
        return view('admin.productos', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo_prod' => 'required|string|max:100|unique:productos',
            'Nombre' => 'required|string|max:100',
        ]);

        Producto::create($request->all());

        return redirect()->route('admin.productos')->with('success', 'Producto creado correctamente.');
    }

    public function show($id)
    {
        return Producto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('admin.productos')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        Producto::destroy($id);

        return redirect()->route('admin.productos')->with('success', 'Producto eliminado correctamente.');
    }
}
