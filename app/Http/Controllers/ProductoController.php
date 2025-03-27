<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\DetalleProducto;

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

    public function gerenteIndex()
    {
        $productos = Producto::all();
        return view('gerente.index', compact('productos'));
    }

    public function empleadoIndex()
{
    $productos = Producto::all(); // Obtener todos los productos
    return view('empleado.productos', compact('productos'));
}


    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Codigo_prod' => 'required|unique:producto,Codigo_prod',
            'Nombre' => 'required|string|max:255',
            'Estado' => 'required|in:Disponible,Agotado',
            'Precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'Descripcion' => 'nullable|string',
        ]);
    
        // Insertar en la base de datos
        Producto::create($request->all());
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }
    

    public function show($id)
    {
        $producto = Producto::with('detalle')->findOrFail($id);
        return view('admin.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Estado' => 'required|in:Agotado,Disponible',
            'Precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'Descripcion' => 'nullable|string',
            'Categoria_id' => 'required|exists:categoria,Categoria_id',
        ]);

        $producto->update($request->only(['Nombre', 'Estado', 'Precio', 'stock', 'Descripcion']));

        $detalle = DetalleProducto::where('Producto_id', $producto->Producto_id)->first();
        if ($detalle) {
            $detalle->update(['Categoria_id' => $request->Categoria_id]);
        }

        return redirect()->route('admin.productos')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos')->with('success', 'Producto eliminado correctamente.');
    }

    public function actualizarStock(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update(['stock' => $request->input('stock')]);

        return redirect()->route('gerente.index')->with('success', 'Stock actualizado correctamente');
    }

    public function reducirStock(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        // Validar que el stock no sea menor al que se intenta restar
        $request->validate([
            'stock' => 'required|integer|min:1|max:' . $producto->stock,
        ]);
    
        // Reducir el stock
        $producto->stock -= $request->stock;
        $producto->save();
    
        return redirect()->route('empleado.productos')->with('success', 'Stock reducido correctamente.');
    }
    
    

}
