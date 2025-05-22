<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_categoria' => 'required|string|max:100',
        ]);

        return Categoria::create($request->all());
    }

    public function show($id)
    {
        return Categoria::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return $categoria;
    }

    public function destroy($id)
    {
        return Categoria::destroy($id);
    }

    // Listar todas las categorías
    public function indexcrud()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    // Crear nueva categoría
    public function storecrud(Request $request)
    {
        $request->validate(['Nombre_categoria' => 'required|max:255']);
        $cat = Categoria::create($request->only('Nombre_categoria'));
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    // Actualizar categoría existente
    public function updatecrud(Request $request, $id)
    {
        $request->validate(['Nombre_categoria' => 'required|max:255']);
        $cat = Categoria::findOrFail($id);
        $cat->update($request->only('Nombre_categoria'));
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar categoría
    public function destroycrud($id)
    {
        Categoria::destroy($id);
        return redirect()->route('admin.categorias.index');

    }
    public function editcrud($id)
{
    $categoria = Categoria::findOrFail($id);
    return view('admin.categorias.edit', compact('categoria'));
}


}
