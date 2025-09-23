<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta</title>
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
            <div class="section-title">Estado de Cuenta de Asociado</div>
            <p>Fecha: {{ now()->format('d/m/Y') }}</p>
            <p>ID del Asociado: {{ $asociado['id'] }} - Cedula del Asociado: {{ $asociado['cedula'] }}</p>
            <p>Nombre del Asociado: {{ $asociado->nombre }} {{ $asociado->primer_apellido }} {{ $asociado->segundo_apellido }}</p>
        </div>

        <!-- Sección Superior: Resumen general -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Resumen de Aportes y Créditos</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="table-primary">
                            <th>Descripción</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Recaudo de Aportes Realizados</td>
                            <td id="resumen-total-recaudos-aportes" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->aportes_realizados)->sum('valor_aporte'), 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Cuotas de Aportes Pendientes de Cobro</td>
                            <td id="resumen-total-recaudos-aportes" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->aportes_pendientes)->sum('total_aportes'), 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Cuotas de Créditos Pendientes de Cobro</td>
                            <td id="resumen-total-cobros-creditos" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->cuotas_credito_pendientes)->sum('total_cuotas_credito'), 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Cuotas de Créditos Pendientes de Cobro a Futuro</td>
                            <td id="resumen-total-cobros-creditos-futuro" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->cuotas_credito_pendientes_futuro)->sum('capital'), 2) }}
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Cuotas de Aportes Pendientes de Cobro</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-success">
                            <th>Periodo</th>
                            <th>Línea Aporte</th>
                            <th>Comentario</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (collect($datos->getData()->aportes_pendientes) as $recaudopendiente)
                        <tr>
                            <td>{{ $recaudopendiente->periodo_nombre }}</td>
                            <td>{{ $recaudopendiente->linea_aporte_nombre }}</td>
                            <td>{{ $recaudopendiente->comentario }}</td>
                            <td class="text-right">{{ number_format($recaudopendiente->total_aportes, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right bg-light">
                            <td colspan="3" class="text-right">Total Aportes Pendientes:</td>
                            <td id="total-recaudos-aportes" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->aportes_pendientes)->sum('total_aportes'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Cuotas de Créditos Pendientes de Cobro</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-success">
                            <th>Periodo</th>
                            <th>Línea Crédito</th>
                            <th>No. Crédito</th>
                            <th>Comentario</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (collect($datos->getData()->cuotas_credito_pendientes) as $creditopendiente)
                        <tr>
                            <td>{{ $creditopendiente->periodo_nombre }}</td>
                            <td>{{ $creditopendiente->linea_credito_nombre }}</td>
                            <td>{{ $creditopendiente->credito_id }}</td>
                            <td>{{ $creditopendiente->comentario }}</td>
                            <td class="text-right">{{ number_format($creditopendiente->total_cuotas_credito, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right bg-light">
                            <td colspan="4" class="text-right">Total Cuotas de Créditos pendientes:</td>
                            <td id="total-recaudos-aportes" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->cuotas_credito_pendientes)->sum('total_cuotas_credito'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Recaudo de Aportes Realizados</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-success">
                            <th>Periodo</th>
                            <th>Línea Aporte</th>
                            <th>Fecha</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (collect($datos->getData()->aportes_realizados) as $recaudo)
                        <tr>
                            <td>{{ $recaudo->periodo_nombre }}</td>
                            <td>{{ $recaudo->linea_aporte_nombre }}</td>
                            <td>{{ \Carbon\Carbon::parse($recaudo->fecha_recaudo)->format('d/m/Y') }}</td>
                            <td class="text-right">{{ number_format($recaudo->valor_aporte, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right bg-light">
                            <td colspan="3" class="text-right">Total Recaudo Aportes:</td>
                            <td id="total-recaudos-aportes" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->aportes_realizados)->sum('valor_aporte'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Cuotas de Créditos Pendientes de Cobro a Futuro</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-success">
                            <th>Cuota</th>
                            <th>Fecha</th>
                            <th>Línea Crédito</th>
                            <th>No. Crédito</th>
                            <th>Saldo</th>
                            <th>Interes</th>
                            <th>S. Deudor</th>
                            <th>S. Crédito</th>
                            <th class="text-right">Capital</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $subtotalCapital = 0;
                        $previousCreditoId = null;
                        @endphp

                        @foreach (collect($datos->getData()->cuotas_credito_pendientes_futuro) as $creditopendientefuturo)
                        <!-- Verifica si el credito_id cambió, y si es así, muestra el subtotal y resetea el acumulador -->
                        @if ($creditopendientefuturo->credito_id !== $previousCreditoId && $previousCreditoId !== null)
                        <tr class="font-weight-bold text-right bg-light">
                            <td colspan="8" class="text-right">Subtotal Capital del Crédito {{ $previousCreditoId }}:</td>
                            <td class="text-right">{{ number_format($subtotalCapital, 2) }}</td>
                        </tr>
                        @php
                        $subtotalCapital = 0;
                        @endphp
                        @endif

                        <!-- Fila de datos del crédito -->
                        <tr>
                            <td>{{ $creditopendientefuturo->cuota }}</td>
                            <td>{{ \Carbon\Carbon::parse($creditopendientefuturo->fecha_corte)->format('d/m/Y') }}</td>
                            <td>{{ $creditopendientefuturo->linea_credito_nombre }}</td>
                            <td>{{ $creditopendientefuturo->credito_id }}</td>
                            <td class="text-right">{{ number_format($creditopendientefuturo->valor_saldo, 2) }}</td>
                            <td class="text-right">{{ number_format($creditopendientefuturo->interes, 2) }}</td>
                            <td class="text-right">{{ number_format($creditopendientefuturo->seguro_deudor, 2) }}</td>
                            <td class="text-right">{{ number_format($creditopendientefuturo->seguro_credito, 2) }}</td>
                            <td class="text-right">{{ number_format($creditopendientefuturo->capital, 2) }}</td>
                        </tr>

                        @php
                        // Acumulando el capital para el crédito actual
                        $subtotalCapital += $creditopendientefuturo->capital;
                        $previousCreditoId = $creditopendientefuturo->credito_id; // Actualiza el crédito previo
                        @endphp
                        @endforeach

                        <!-- Muestra el subtotal final para el último crédito -->
                        @if ($previousCreditoId !== null)
                        <tr class="font-weight-bold text-right bg-light">
                            <td colspan="8" class="text-right">Subtotal Capital del Crédito {{ $previousCreditoId }}:</td>
                            <td class="text-right">{{ number_format($subtotalCapital, 2) }}</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right bg-light">
                            <td colspan="8" class="text-right">Total Valor de Créditos pendientes a Futuro:</td>
                            <td id="total-recaudos-aportes" class="text-right font-weight-bold">
                                {{ number_format(collect($datos->getData()->cuotas_credito_pendientes_futuro)->sum('capital'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
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