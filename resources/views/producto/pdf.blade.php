<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px; /* Reducir el tamaño de la fuente */
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
            font-size: 10px; /* Reducir el tamaño de la fuente de la tabla */
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px; /* Incrementar el espacio interno de las celdas */
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
        <h1>Lista de Productos</h1>
        <table>
            <thead>
                <tr>
                    <th>Producto Id</th>
                    <th>Nombre Producto</th>
                    <th>Descripcion Producto</th>
                    <th>Precio Unitario</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $index => $producto)
                    <tr>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $producto->producto_id }}</td>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $producto->nombre_producto }}</td>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $producto->descripcion_producto }}</td>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $producto->precio_unitario }}</td>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $producto->categoria->nombre_categoria }}</td>
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
