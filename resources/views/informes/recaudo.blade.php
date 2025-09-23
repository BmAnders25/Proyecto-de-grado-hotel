<!DOCTYPE html>
<html>

<head>
    <title>Recibo de Recaudo</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 20px;
    }

    .container {
        width: 100%;
        margin: auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: nowrap;
        /* Evita que los elementos se vayan a una nueva línea */
    }

    .header h1,
    .header h2,
    .header p {
        margin: 0;
    }

    .content {
        margin-bottom: 10px;
    }

    .footer {
        text-align: center;
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th,
    td {
        padding: 5px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 10px;
        /* Reducir el tamaño de fuente en la tabla */
    }

    th {
        background-color: #f2f2f2;
    }

    .label {
        font-weight: bold;
    }

    .section-title {
        font-size: 14px;
        /* Tamaño de título más pequeño */
        font-weight: bold;
        margin-bottom: 5px;
        text-decoration: underline;
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .col {
        flex: 1;
        padding-right: 5px;
    }

    p {
        margin: 0;
        /* Reducir los márgenes de los párrafos */
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <!-- Columna de la imagen -->
                    <td width="30%" style="vertical-align: top; text-align: right;">
                        <img src="{{ asset('vendor/adminlte/dist/img/logo.jpeg') }}" alt="Logo Cooperativa"
                            style="max-width: 100%; height: auto;">
                    </td>

                    <!-- Columna de la información -->
                    <td width="70%" style="vertical-align: top; text-align: center; padding-left: 20px;">
                        <h2>{{ $configuracion->nombre }}</h2>
                        <h2>Nit {{ $configuracion->nit }}</h2>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content">
            <div class="section-title">Recibo de Recaudo</div>
            <p>Fecha del Recaudo: {{ $recaudo['fecha_recaudo'] }}</p>
            <p>ID del Asociado: {{ $recaudo['asociado_id'] }}</p>
            <p>Nombre del Asociado: {{ $asociado->nombre }} {{ $asociado->primer_apellido }} {{ $asociado->segundo_apellido }}</p>
            <p>Valor del Recaudo: {{ $recaudo['valor_recaudo'] }}</p>
        </div>
        <!-- Footer -->
        <div class="footer">
            <hr>
            <p>Dirección {{ $configuracion->direccion }} - Telefono {{ $configuracion->telefono }} - Email
                {{ $configuracion->email }} Fecha impresión {{ date('Y-m-d') }}</p>
        </div>
    </div>
</body>

</html>