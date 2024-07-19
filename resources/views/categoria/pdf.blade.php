<!DOCTYPE html>
<html>

<head>
    <title>Lista de Categorias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            /* Reducir el tamaño de la fuente */
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
            /* Reducir el tamaño de la fuente de la tabla */
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            /* Incrementar el espacio interno de las celdas */
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
        <h1>Lista de Categorias</h1>
        <table>
            <thead>
                <tr>
                    <th>Categoria Id</th>
                    <th>Nombre Categoria</th>
                    <th>Descripcion Categoria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoria as $index => $categoria)
                    <tr>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $categoria->categoria_id }}</td>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $categoria->nombre_categoria }}</td>
                        <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $categoria->descripcion_categoria }}
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
