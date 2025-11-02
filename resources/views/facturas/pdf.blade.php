<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Factura {{ $factura->numero_factura }}</title>
  <style>
    body { font-family: DejaVu Sans, Arial, sans-serif; font-size:12px; color:#222; }
    .header { margin-bottom:20px; }
    .flex { display:flex; justify-content:space-between; align-items:flex-start; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { padding:6px 8px; border:1px solid #ddd; }
    th { background:#f5f5f5; text-align:left; }
    .text-right { text-align:right; }
    .small { font-size:11px; color:#666; }
  </style>
</head>
<body>
  <div class="header">
    <div class="flex">
      <div>
        <h2>Empresa / Hotel</h2>
      </div>
      <div class="text-right">
        <h3>Factura</h3>
        <div><strong># {{ $factura->numero_factura }}</strong></div>
        <div class="small">Emitida: {{ optional($factura->fecha_emision)->format('d/m/Y H:i') ?? optional($factura->created_at)->format('d/m/Y') }}</div>
      </div>
    </div>
  </div>

  <div>
    <strong>Cliente</strong><br>
    {{ optional($factura->cliente)->nombre ?? '—' }}<br>
    <span class="small">{{ optional($factura->cliente)->documento ?? '' }} · {{ optional($factura->cliente)->telefono ?? '' }}</span>
  </div>

  <table>
    <thead>
      <tr>
        <th>Producto</th>
        <th style="width:80px;" class="text-right">Cantidad</th>
        <th style="width:120px;" class="text-right">Precio unitario</th>
        <th style="width:120px;" class="text-right">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($factura->detalles as $detalle)
        <tr>
          <td>{{ optional($detalle->producto)->nombre ?? 'Item' }}</td>
          <td class="text-right">{{ $detalle->cantidad }}</td>
          <td class="text-right">{{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
          <td class="text-right">{{ number_format($detalle->total_linea, 2, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3" class="text-right">Subtotal</th>
        <th class="text-right">{{ number_format($factura->subtotal, 2, ',', '.') }}</th>
      </tr>
      <tr>
        <th colspan="3" class="text-right">IVA</th>
        <th class="text-right">{{ number_format($factura->iva, 2, ',', '.') }}</th>
      </tr>
      <tr>
        <th colspan="3" class="text-right">Total</th>
        <th class="text-right">{{ number_format($factura->total, 2, ',', '.') }}</th>
      </tr>
    </tfoot>
  </table>

  <div style="margin-top:18px;" class="small">
    Generado por: {{ optional($factura->user)->name ?? auth()->user()->name ?? 'Sistema' }}
  </div>
</body>
</html>