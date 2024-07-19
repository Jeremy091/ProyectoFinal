<!DOCTYPE html>
<html>

<head>
    <title>Transacciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            padding: 20px 0;
            background-color: #007bff;
            color: #fff;
            margin-top: 0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #007bff;
            color: #fff;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Transacciones</h1>
        <table>
            <thead>
                <tr>
                    <th>Stock</th>
                    <th>Fecha Ingreso</th>
                    <th>Fecha Movimiento</th>
                    {{-- <th>Tipo Movimiento</th> --}}
                    <th>Producto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventario as $inventario)
                    <tr>
                        <td>{{ $inventario->stock }}</td>
                        <td>{{ $inventario->fecha_ingreso }}</td>
                        <td>{{ $inventario->fecha_movimiento }}</td>
                        {{-- <td>{{ $inventario->tipo_movimiento }}</td> --}}
                        <td>{{ $inventario->producto->nombre_producto }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            Fecha de generación: {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</body>

</html>
