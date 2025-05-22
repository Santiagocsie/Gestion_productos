@php use Illuminate\Support\Str; @endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Empleados</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td {
            border: 1px solid #444;
            padding: 5px;
            text-align: left;
            font-size: 10px;
            word-wrap: break-word;
        }
        th {
            background-color: #ddd;
        }
        td {
            max-width: 120px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Reporte de Empleados</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Cargo</th>
                <th>Tipo de Contrato</th>
                <th>Fecha Inicio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->Email }}</td>
                <td>{{ $empleado->Telefono }}</td>
                <td>{{ Str::limit($empleado->Direccion, 50) }}</td>
                <td>{{ $empleado->contratoActual?->cargo?->Nombre ?? 'No asignado' }}</td>
                <td>{{ $empleado->contratoActual?->Tipo_contrato ?? 'No asignado' }}</td>
                <td>{{ $empleado->contratoActual?->Fecha_inicio ?? 'No asignado' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Generado el {{ date('d-m-Y H:i') }}</p>
</body>
</html>
