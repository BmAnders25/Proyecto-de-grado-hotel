<!DOCTYPE html>
<html>

<head>
    <title>Recibo de Liquidación de crédito</title>
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
                        <img src={{ asset('vendor/adminlte/dist/img/logo.jpeg') }} alt="Logo Cooperativa"
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

        <!-- Información del crédito -->
        <div class="content">
            <div class="section-title">Información del Crédito {{ $credito->estado }}</div>
            <table>
                <thead style="display: none;">
                    <tr>
                        <th style="width: 30%;"></th>
                        <th style="width: 70%;"></th>
                        <th style="width: 30%;"></th>
                        <th style="width: 70%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Número de Crédito</span></td>
                        <td>{{ $credito->id }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Fecha de la Solicitud</span></td>
                        <td>{{ $credito->fecha_credito }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Cédula del Asociado</span></td>
                        <td>{{ $credito->asociado->cedula }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Nombre del Asociado</span></td>
                        <td>{{ $credito->asociado->nombre }} {{ $credito->asociado->primer_apellido }}
                            {{ $credito->asociado->segundo_apellido }}
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Línea de Crédito</span></td>
                        <td>{{ $credito->lineacredito->nombre }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Valor del Crédito</span></td>
                        <td>{{ number_format($credito->valor_credito, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Interés Anual (%)</span></td>
                        <td>{{ number_format($credito->interes_anual, 2, ',', '.') }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Interés Mensual (%)</span></td>
                        <td>{{ number_format($credito->interes_credito, 3, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Seguro Vida Deudor</span></td>
                        <td>{{ number_format($credito->seguro_deudor, 2, ',', '.') }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Seguro de Crédito</span></td>
                        <td>{{ number_format($credito->seguro_credito, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Plazo del Crédito (meses)</span></td>
                        <td>{{ $credito->plazo_credito }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Valor de la Cuota</span></td>
                        <td>{{ number_format($credito->valor_cuota, 2, ',', '.') }}</td>
                    </tr>
                    @if ($credito && $credito->estado === 'Aprobado')
                    <tr>
                        <td style="background-color: #f0f0f0;"><span class="label">Fecha de Aprobación</span></td>
                        <td>{{ $credito->fecha_aprobado }}</td>
                        <td style="background-color: #f0f0f0;"><span class="label">Número de Pagaré</span></td>
                        <td>{{ $credito->pagare }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Amortización -->
        <div class="content">
    <div class="section-title">Amortización del Crédito</div>
    <table>
        <thead>
            <tr>
                <th>Número de Cuota</th>
                <th>Fecha de Pago</th>
                <th>Valor de la Cuota</th>
                <th>Interés Pagado</th>
                <th>Capital</th>
                <th>Seguro Vida Deudor</th>
                <th>Seguro Crédito</th>
                <th>Saldo del Crédito</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalInteres = 0;
                $totalCapital = 0;
            @endphp
            @foreach ($credito->movimientos as $movimiento)
            @php
                $totalInteres += $movimiento->interes;
                $totalCapital += $movimiento->capital;
            @endphp
            <tr>
                <td>{{ $movimiento->cuota }}</td>
                <td>{{ $movimiento->fecha_corte }}</td>
                <td>{{ number_format($movimiento->valor_cuota, 2, ',', '.') }}</td>
                <td>{{ number_format($movimiento->interes, 2, ',', '.') }}</td>
                <td>{{ number_format($movimiento->capital, 2, ',', '.') }}</td>
                <td>{{ number_format($movimiento->seguro_deudor, 2, ',', '.') }}</td>
                <td>{{ number_format($movimiento->seguro_credito, 2, ',', '.') }}</td>
                <td>{{ number_format($movimiento->valor_saldo, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>{{ number_format($totalInteres, 2, ',', '.') }}</th>
                <th>{{ number_format($totalCapital, 2, ',', '.') }}</th>
                <th colspan="3"></th>
            </tr>
        </tfoot>
    </table>
</div>

        
        <!-- Footer -->
        <div class="footer">
            <hr>
            <p>Dirección {{ $configuracion->direccion }} - Telefono {{ $configuracion->telefono }} - Email
                {{ $configuracion->email }} Fecha impresión {{ date('Y-m-d') }}
            </p>
        </div>
    </div>
</body>

</html>