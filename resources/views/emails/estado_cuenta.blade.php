<!DOCTYPE html>
<html>

<head>
    <title>Estado de Cuenta</title>
</head>

<body>
    <h1>Estado de Cuenta</h1>
    <p>Estimado(a) {{ $asociado->nombre }} {{ $asociado->primer_apellido }}</p>
    <p>Adjuntamos su estado de cuenta correspondiente al periodo actual.</p>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estadoCuenta as $item)
            <tr>
                <td>{{ $item['descripcion'] }}</td>
                <td>{{ number_format($item['valor'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Gracias por su atención.</p>
</body>

</html>