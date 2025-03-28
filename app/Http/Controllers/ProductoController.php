<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\DetalleProducto;
use Illuminate\Support\Facades\Auth;


class ProductoController extends Controller
{
    
  
    public function indexempleado(Request $request)
    {
        $query = Producto::with('categorias'); // Cargar categorías con los productos

        if ($request->has('search')) {
            $search = $request->search;
            
            $query->where(function ($q) use ($search) {
                $q->where('Nombre', 'LIKE', "%$search%")
                  ->orWhere('Codigo_prod', 'LIKE', "%$search%");
            })
            ->orWhereHas('categorias', function ($q) use ($search) {
                $q->where('Nombre_categoria', 'LIKE', "%$search%");
            });
        }
    
        $productos = $query->get();
        
        return view('empleado.productos', compact('productos'));
    }

    public function indexgerente(Request $request)
{
    $query = Producto::with('categorias'); // Cargar categorías con los productos

    if ($request->has('search')) {
        $search = $request->search;
        
        $query->where(function ($q) use ($search) {
            $q->where('Nombre', 'LIKE', "%$search%")
              ->orWhere('Codigo_prod', 'LIKE', "%$search%");
        })
        ->orWhereHas('categorias', function ($q) use ($search) {
            $q->where('Nombre_categoria', 'LIKE', "%$search%");
        });
    }
    $productos = $query->get();
    
    return view('gerente.productos', compact('productos'));
}
    

    
public function index(Request $request)
{
    $query = Producto::with('categorias'); // Cargar categorías con los productos

    if ($request->has('search')) {
        $search = $request->search;
        
        $query->where(function ($q) use ($search) {
            $q->where('Nombre', 'LIKE', "%$search%")
              ->orWhere('Codigo_prod', 'LIKE', "%$search%");
        })
        ->orWhereHas('categorias', function ($q) use ($search) {
            $q->where('Nombre_categoria', 'LIKE', "%$search%");
        });
    }

    $productos = $query->get();

    return view('admin.productos', compact('productos'));
}



    public function adminIndex()
    {
        $productos = Producto::all();
        return view('admin.productos', compact('productos'));
    }

    public function gerenteIndex()
    {
        $productos = Producto::all();
        return view('gerente.productos', compact('productos'));
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
    $request->validate([
        'Codigo_prod' => 'required|unique:producto,Codigo_prod',
        'Nombre' => 'required',
        'Estado' => 'required',
        'Precio' => 'required|numeric',
        'stock' => 'required|integer',
        'Descripcion' => 'nullable',
        'categorias' => 'required|array',
    ]);

    // Obtener el ID del empleado autenticado
    $empleadoId = Auth::user()->Empleado_id; // Ajusta esto si tu modelo de usuario usa otro campo

    // Crear el producto
    $producto = Producto::create([
        'Codigo_prod' => $request->Codigo_prod,
        'Nombre' => $request->Nombre,
        'Estado' => $request->Estado,
        'Precio' => $request->Precio,
        'stock' => $request->stock,
        'Descripcion' => $request->Descripcion
    ]);

    // Guardar categorías en la tabla Detalle_Producto con el Empleado_id
    foreach ($request->categorias as $categoria_id) {
        DetalleProducto::create([
            'Empleado_id' => $empleadoId, // Aquí se almacena el usuario que creó el producto
            'Producto_id' => $producto->Producto_id,
            'Categoria_id' => $categoria_id
        ]);
    }

    return redirect()->route('admin.productos.index')->with('success', 'Producto creado con éxito.');
}

    

    public function show($id)
    {
        $producto = Producto::with('detalle')->findOrFail($id);
        return view('admin.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Obtener todas las categorías
        $categoriasSeleccionadas = DetalleProducto::where('Producto_id', $id)->pluck('Categoria_id')->toArray(); // Obtener categorías asignadas al producto
        return view('admin.edit', compact('producto', 'categorias', 'categoriasSeleccionadas'));
    }
    

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'Codigo_prod' => 'required|unique:producto,Codigo_prod,' . $id . ',Producto_id',
            'Nombre' => 'required',
            'Estado' => 'required',
            'Precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'Descripcion' => 'nullable|string',
            'categorias' => 'required|array'
        ]);
        $empleadoId = Auth::user()->Empleado_id; // Ajusta esto si tu modelo de usuario usa otro campo

        $producto = Producto::findOrFail($id);
        $producto->update([
            'Codigo_prod' => $request->Codigo_prod,
            'Nombre' => $request->Nombre,
            'Estado' => $request->Estado,
            'Precio' => $request->Precio,
            'stock' => $request->stock,
            'Descripcion' => $request->Descripcion,
            'Empleado_id' => Auth::user()->Empleado_id // Asegurar que el ID del empleado se guarde
        ]);
    
        // Actualizar categorías en la tabla detalle_producto
        DetalleProducto::where('Producto_id', $id)->delete(); // Eliminar asociaciones anteriores
    
        foreach ($request->categorias as $categoria_id) {
            DetalleProducto::create([
                'Empleado_id' => $empleadoId, // Aquí se almacena el usuario que creó el producto
                'Producto_id' => $id,
                'Categoria_id' => $categoria_id
            ]);
        }
    
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }
    

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function actualizarStock(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update(['stock' => $request->input('stock')]);

        return redirect()->route('gerente.productos.index')->with('success', 'Stock actualizado correctamente');
    }

    public function reducirStock(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        // Reducir el stock
        $producto->stock -= $request->input('stock');
    
        // Verificar si el stock llegó a 0
        if ($producto->stock <= 0) {
            $producto->stock = 0;
            $producto->estado = 'Agotado';
        } else {
            $producto->estado = 'Disponible';
        }
    
        // Guardar cambios en la BD
        $producto->save();
    
        return redirect()->back()->with('success', 'Stock actualizado correctamente.');
    }
    
    
    

}
