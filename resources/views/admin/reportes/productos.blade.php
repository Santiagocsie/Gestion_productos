<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h1>Reporte de Productos</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->Codigo_prod }}</td>
                <td>{{ $producto->Nombre }}</td>
                <td>{{ $producto->Estado }}</td>
                <td>${{ number_format($producto->Precio, 2) }}</td>
                <td>{{ $producto->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Generado el {{ date('d-m-Y H:i') }}</p>
</body>
</html>
