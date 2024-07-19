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
        table th, table td {
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
                    <th>#</th>
                    <th>Transaccion Id</th>
                    <th>Cliente</th>
                    <th>Fecha Transaccion</th>
                    <th>Total Transaccion</th>
                    <th>Metodo Pago</th>
                    <th>Tipo Transaccion</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaccions as $transaccion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaccion->transaccion_id }}</td>
                        <td>{{ $transaccion->cliente->nombre_cliente }} {{ $transaccion->cliente->apellido_cliente }}</td>
                        <td>{{ $transaccion->fecha_transaccion }}</td>
                        <td>{{ $transaccion->total_transaccion }}</td>
                        <td>{{ $transaccion->metodo_pago }}</td>
                        <td>{{ $transaccion->tipo_transaccion }}</td>
                        <td>
                            <ul>
                                @foreach($transaccion->productos as $producto)
                                    <li>{{ $producto->nombre_producto }} ({{ $producto->pivot->cantidad }} x ${{ $producto->precio_unitario }})</li>
                                @endforeach
                            </ul>
                        </td>
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
