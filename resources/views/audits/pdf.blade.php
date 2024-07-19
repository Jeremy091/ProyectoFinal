<!DOCTYPE html>
<html>

<head>
    <title>Auditorías</title>
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
        <h1>Auditorías</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Evento</th>
                    <th>Modelo</th>
                    <th>ID del Modelo</th>
                    <th>Valores Anteriores</th>
                    <th>Valores Nuevos</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audits as $audit)
                    <tr>
                        <td>{{ $audit->id }}</td>
                        <td>{{ optional($audit->user)->name }}</td>
                        <td>{{ $audit->event }}</td>
                        <td>{{ class_basename($audit->auditable_type) }}</td>
                        <td>{{ $audit->auditable_id }}</td>
                        <td>
                            @foreach ($audit->old_values as $key => $value)
                                <strong>{{ $key }}:</strong> {{ $value }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($audit->new_values as $key => $value)
                                <strong>{{ $key }}:</strong> {{ $value }}<br>
                            @endforeach
                        </td>
                        <td>{{ $audit->created_at }}</td>
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
