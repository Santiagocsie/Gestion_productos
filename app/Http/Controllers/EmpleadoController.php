<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Contrato;
use App\Models\Cargo;
use PDF;

use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public function buscar(Request $request)
{
    $query = Empleado::query();

    // Carga la relación de contratoActual y cargo para evitar N+1
    $query->with(['contratoActual.cargo']);

    // Filtro por búsqueda (nombre, email, teléfono)
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('Nombre', 'like', "%{$search}%")
              ->orWhere('Email', 'like', "%{$search}%")
              ->orWhere('Telefono', 'like', "%{$search}%");
        });
    }

    // Filtro por cargo (si se recibe)
    if ($request->filled('cargo')) {
        $cargoId = $request->input('cargo');
        // Aquí filtras empleados cuyo contratoActual tenga ese cargo
        $query->whereHas('contratoActual.cargo', function ($q) use ($cargoId) {
            $q->where('Cargo_id', $cargoId);
        });
    }

    // Obtener los resultados paginados (opcional)
    $empleados = $query->paginate(10)->withQueryString();

    // Para el select de cargos
    $cargos = Cargo::all();

    return view('admin.empleados.index', compact('empleados', 'cargos'));
}

public function reportePDF()
{
    // Aquí generas el PDF con la info que quieras
    // Ejemplo usando dompdf, barryvdh/laravel-dompdf o similar
    
    $empleados = Empleado::all();

    $pdf = \PDF::loadView('admin.reportes.empleados', compact('empleados'))
    ->setPaper('a4', 'landscape');

    return $pdf->download('reporte_empleados.pdf');
}


    public function index()
    {
        return Empleado::with('contrato')->get(); // Incluye contrato
    }

    public function indexcrud()
{
    // Obtener empleados con contrato y cargo relacionados
    {
    $empleado = Empleado::with(['contratoActual.cargo'])->get();
    return view('admin.empleados.index', compact('empleado'));
}
}

public function create()
{
    $cargo = Cargo::all(); // Obtén todos los cargos disponibles
    return view('admin.empleados.create', compact('cargo')); // Pasa la variable a la vista
}



    public function store(Request $request)
    {
    // Validar datos
    $validated = $request->validate([
        'Nombre' => 'required|string|max:255',
        'Email' => 'required|email|unique:empleado,Email',
        'Contrasena' => 'required|string|min:6',
        'Telefono' => 'nullable|string|max:20',
        'Direccion' => 'nullable|string|max:255',
        'Fecha_nacimiento' => 'required|date|before:today',
        'Genero' => 'required|in:Masculino,Femenino,Otro',

        // Contrato
        'Cargo_id' => 'required|exists:cargo,Cargo_id',
        'Tipo_contrato' => 'required|string|max:255',
        'Fecha_inicio' => 'required|date',
        'Fecha_fin' => 'nullable|date|after_or_equal:Fecha_inicio',
        'Salario' => 'required|numeric|min:0|max:99999999.99',
    ]);

    // Crear empleado (asegúrate de encriptar la contraseña)
    $empleado = new Empleado();
    $empleado->Nombre = $validated['Nombre'];
    $empleado->Email = $validated['Email'];
    $empleado->Contrasena = bcrypt($validated['Contrasena']);
    $empleado->Telefono = $validated['Telefono'] ?? null;
    $empleado->Direccion = $validated['Direccion'] ?? null;
    $empleado->Fecha_nacimiento = $validated['Fecha_nacimiento'];
    $empleado->Genero = $validated['Genero'];
    $empleado->save();

    // Crear contrato asociado
    $contrato = new Contrato();
    $contrato->Empleado_id = $empleado->Empleado_id; // o la PK que tengas
    $contrato->Cargo_id = $validated['Cargo_id'];
    $contrato->Tipo_contrato = $validated['Tipo_contrato'];
    $contrato->Fecha_inicio = $validated['Fecha_inicio'];
    $contrato->Fecha_fin = $validated['Fecha_fin'] ?? null;
    $contrato->Salario = $validated['Salario'];
    $contrato->save();

    return redirect()->route('admin.empleados.index')->with('success', 'Empleado registrado correctamente.');
}

public function edit($id)
{
    $empleado = Empleado::with('contratoActual')->findOrFail($id);
    $cargos = Cargo::all();
    return view('admin.empleados.edit', compact('empleado', 'cargos'));
}

    public function show($id)
    {
        return Empleado::with('contrato')->findOrFail($id); // Incluye contrato
    }

public function update(Request $request, $id)
{
    $request->validate([
        'Nombre' => 'required|string|max:255',
        'Email' => 'required|email',
        'Telefono' => 'nullable|string|max:20',
        'Direccion' => 'nullable|string|max:255',
        'Contrasena' => 'nullable|string|min:6',
        // otras validaciones
    ]);

    $empleado = Empleado::findOrFail($id);

    // Actualización de datos generales
    $empleado->Nombre = $request->Nombre;
    $empleado->Email = $request->Email;
    $empleado->Telefono = $request->Telefono;
    $empleado->Direccion = $request->Direccion;

    // Solo actualizar contraseña si se envió
    if ($request->filled('Contrasena')) {
        $empleado->Contrasena = bcrypt($request->Contrasena);
    }

    $empleado->save();

    // Actualizar contrato si aplica
    if ($empleado->contratoActual) {
        $empleado->contratoActual->update([
            'Cargo_id' => $request->Cargo_id,
            'Tipo_contrato' => $request->Tipo_contrato,
            'Fecha_inicio' => $request->Fecha_inicio,
            'Fecha_fin' => $request->Fecha_fin,
            'Salario' => $request->Salario,
        ]);
    }

    return redirect()->route('admin.empleados.index')->with('success', 'Empleado actualizado correctamente.');
}


public function destroy($id)
{
    $empleado = Empleado::findOrFail($id);
    $empleado->delete();
    return redirect()->route('admin.empleados.index')->with('success', 'Empleado eliminado correctamente.');
}
}