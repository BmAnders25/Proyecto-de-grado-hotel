@extends('adminlte::page')

@section('title', 'Factura ' . $factura->numero_factura)

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1 class="m-0 text-dark">Factura <small class="text-muted">#{{ $factura->numero_factura }}</small></h1>
  <div>
    @if(Route::has('facturas.pdf'))
      <a href="{{ route('facturas.pdf', $factura->id) }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-file-pdf mr-1"></i> Descargar PDF
      </a>
    @endif
    <a href="{{ route('facturas.index') }}" class="btn btn-sm btn-light">
      <i class="fas fa-arrow-left mr-1"></i> Volver
    </a>
  </div>
</div>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-sm-7">
            <h5 class="mb-1">Cliente</h5>
            <p class="mb-0">
              <strong>{{ optional($factura->cliente)->nombre ?? '—' }}</strong>
            </p>
            <p class="text-muted mb-0">{{ optional($factura->cliente)->documento ?? '' }}</p>
            <p class="text-muted mb-0">{{ optional($factura->cliente)->telefono ?? '' }}</p>
          </div>
          <div class="col-sm-5 text-sm-right">
            <h6 class="mb-1">Factura</h6>
            <p class="mb-0"><strong>#{{ $factura->numero_factura }}</strong></p>
            <p class="text-muted mb-0">Emitida: {{ optional($factura->fecha_emision)->format('d/m/Y H:i') ?? optional($factura->created_at)->format('d/m/Y') }}</p>
            <p class="text-muted mb-0">ID: {{ $factura->id }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table table-bordered mb-0">
                <thead class="thead-light">
                  <tr>
                    <th>Producto</th>
                    <th class="text-center" style="width:100px;">Cantidad</th>
                    <th class="text-right" style="width:140px;">Precio unitario</th>
                    <th class="text-right" style="width:140px;">Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($factura->detalles as $detalle)
                    <tr>
                      <td>{{ optional($detalle->producto)->nombre ?? 'Item' }}</td>
                      <td class="text-center">{{ $detalle->cantidad }}</td>
                      <td class="text-right">{{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                      <td class="text-right font-weight-bold">{{ number_format($detalle->total_linea, 2, ',', '.') }}</td>
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
                    <th class="text-right h5">{{ number_format($factura->total, 2, ',', '.') }}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 text-muted small">
            Habitacion: <strong>{{ optional($factura->habitacion)->numero ?? optional($factura->habitacion)->nombre ?? '—' }}</strong>
          </div>
          <div class="col-sm-6 text-sm-right text-muted small">
            Emitida por: <strong>{{ optional($factura->user)->name ?? auth()->user()->name ?? '—' }}</strong>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@stop