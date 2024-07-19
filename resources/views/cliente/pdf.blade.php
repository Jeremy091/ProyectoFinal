<!DOCTYPE html>
<html>
<head>
    <title>Lista de Clientes</title>
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
        <h1>Lista de Clientes</h1>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No.</th>
                    <th style="width: 10%">Cliente Id</th>
                    <th style="width: 15%">Nombre</th>
                    <th style="width: 15%">Apellido</th>
                    <th style="width: 20%">Dirección</th>
                    <th style="width: 10%">Teléfono</th>
                    <th style="width: 25%">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $index => $cliente)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cliente->cliente_id }}</td>
                        <td>{{ $cliente->nombre_cliente }}</td>
                        <td>{{ $cliente->apellido_cliente }}</td>
                        <td>{{ $cliente->direccion_cliente }}</td>
                        <td>{{ $cliente->telefono_cliente }}</td>
                        <td>{{ $cliente->email_cliente }}</td>
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
