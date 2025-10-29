@extends('adminlte::page')

@section('title', 'Crear Factura')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1 class="m-0 text-dark">Crear Factura</h1>
  <a href="{{ route('facturas.index') }}" class="btn btn-sm btn-light">
    <i class="fas fa-arrow-left mr-1"></i> Volver
  </a>
</div>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('facturas.store') }}" method="POST" id="form-factura">
      @csrf

      <div class="row">
        <div class="col-md-4 form-group">
          <label for="cliente_id">Cliente</label>
          <select name="cliente_id" id="cliente_id" class="form-control" required>
            <option value="">Seleccione cliente</option>
            @foreach($clientes as $cliente)
              <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                {{ $cliente->nombre }} {{ $cliente->documento ? '- ' . $cliente->documento : '' }}
              </option>
            @endforeach
          </select>
          @error('cliente_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-4 form-group">
          <label for="habitacion_id">Habitación</label>
          <select name="habitacion_id" id="habitacion_id" class="form-control" required>
            <option value="">Seleccione habitación</option>
            @foreach($habitaciones as $habitacion)
              <option value="{{ $habitacion->id }}" {{ old('habitacion_id') == $habitacion->id ? 'selected' : '' }}>
                {{ $habitacion->numero ?? $habitacion->nombre }}
              </option>
            @endforeach
          </select>
          @error('habitacion_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-4 form-group">
          <label for="fecha_emision">Fecha emisión</label>
          <input type="datetime-local" name="fecha_emision" id="fecha_emision" class="form-control" value="{{ old('fecha_emision', now()->format('Y-m-d\TH:i')) }}" required>
          @error('fecha_emision') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 form-group">
          <label for="numero_factura">Número de factura</label>
          <input type="text" name="numero_factura" id="numero_factura" class="form-control" value="{{ old('numero_factura') }}" required>
          @error('numero_factura') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
      </div>

      <hr>

      <h5 class="mb-3">Detalles</h5>

      <div class="table-responsive">
        <table class="table table-sm table-bordered" id="tabla-detalles">
          <thead class="thead-light">
            <tr>
              <th style="width:40%;">Producto</th>
              <th style="width:15%;" class="text-center">Cantidad</th>
              <th style="width:20%;" class="text-right">Precio unitario</th>
              <th style="width:20%;" class="text-right">Total</th>
              <th style="width:5%;"></th>
            </tr>
          </thead>
          <tbody>
            @if(old('detalles'))
              @foreach(old('detalles') as $i => $oldDetalle)
                <tr>
                  <td>
                    <select name="detalles[{{ $i }}][producto_id]" class="form-control producto-select" required>
                      <option value="">Seleccione</option>
                      @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" {{ ($oldDetalle['producto_id'] ?? '') == $producto->id ? 'selected' : '' }}>
                          {{ $producto->nombre }}
                        </option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="number" name="detalles[{{ $i }}][cantidad]" class="form-control text-center cantidad" min="1" value="{{ $oldDetalle['cantidad'] ?? 1 }}" required></td>
                  <td><input type="number" step="0.01" name="detalles[{{ $i }}][precio_unitario]" class="form-control text-right precio" min="0" value="{{ $oldDetalle['precio_unitario'] ?? 0 }}"></td>
                  <td class="text-right total-linea">{{ number_format((($oldDetalle['cantidad'] ?? 0) * ($oldDetalle['precio_unitario'] ?? 0)), 2, ',', '.') }}</td>
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger btn-quitar">&times;</button>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td>
                <select name="detalles[0][producto_id]" class="form-control producto-select" required>
                    <option value="">Seleccione</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ number_format($producto->precio ?? 0, 2, '.', '') }}">
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                        </select>
</td>
<td>
  <input type="number" name="detalles[0][cantidad]" class="form-control text-center cantidad" min="1" value="1" required>
</td>
<td>
  <input type="number" step="0.01" name="detalles[0][precio_unitario]" class="form-control text-right precio" min="0" value="0.00" required>
</td>
<td class="text-right total-linea">0,00</td>
<td class="text-center">
  <button type="button" class="btn btn-sm btn-danger btn-quitar">&times;</button>
</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>

      <div class="form-group">
        <button type="button" id="btn-agregar" class="btn btn-sm btn-outline-primary">
          <i class="fas fa-plus mr-1"></i> Añadir línea
        </button>
      </div>

      <div class="row justify-content-end">
        <div class="col-md-4">
          <table class="table table-borderless table-sm mb-0">
            <tr>
              <th class="text-right">Subtotal</th>
              <td class="text-right" id="subtotal">0,00</td>
            </tr>
            <tr>
              <th class="text-right">IVA</th>
              <td class="text-right" id="iva">0,00</td>
            </tr>
            <tr>
              <th class="text-right">Total</th>
              <td class="text-right font-weight-bold" id="total">0,00</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Guardar factura</button>
        <a href="{{ route('facturas.index') }}" class="btn btn-light">Cancelar</a>
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tablaBody = document.querySelector('#tabla-detalles tbody');
  const btnAgregar = document.getElementById('btn-agregar');
  const productosOptionsHtml = Array.from(@json($productos->map(function($p){ return ['id'=>$p->id,'nombre'=>$p->nombre,'precio'=> (float)($p->precio ?? 0)]; }))).map(p => `<option value="${p.id}" data-precio="${p.precio.toFixed(2)}">${p.nombre}</option>`).join('');
  let contador = tablaBody.rows.length;

  function formato(num) {
    return new Intl.NumberFormat('es-CO', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(num);
  }

  function recalcularLinea(row) {
    const cantidadInput = row.querySelector('.cantidad');
    const precioInput = row.querySelector('.precio');
    const totalCell = row.querySelector('.total-linea');

    const cantidad = parseFloat(cantidadInput.value) || 0;
    const precio = parseFloat(precioInput.value) || 0;
    const total = cantidad * precio;
    totalCell.textContent = formato(total);
    recalcularTotales();
  }

  function recalcularTotales() {
    let subtotal = 0;
    tablaBody.querySelectorAll('tr').forEach(r => {
      const cantidad = parseFloat(r.querySelector('.cantidad')?.value || 0) || 0;
      const precio = parseFloat(r.querySelector('.precio')?.value || 0) || 0;
      subtotal += cantidad * precio;
    });
    const iva = +(subtotal * 0.19).toFixed(2);
    const total = +(subtotal + iva).toFixed(2);
    document.getElementById('subtotal').textContent = formato(subtotal);
    document.getElementById('iva').textContent = formato(iva);
    document.getElementById('total').textContent = formato(total);
  }

  function attachRowEvents(row) {
    const productoSelect = row.querySelector('.producto-select');
    const cantidadInput = row.querySelector('.cantidad');
    const precioInput = row.querySelector('.precio');
    const btnQuitar = row.querySelector('.btn-quitar');

    // Al cambiar producto, autocompletar precio
    productoSelect.addEventListener('change', function () {
      const selected = productoSelect.selectedOptions[0];
      const precio = parseFloat(selected?.dataset.precio || 0) || 0;
      precioInput.value = precio.toFixed(2);
      recalcularLinea(row);
    });

    cantidadInput.addEventListener('input', () => recalcularLinea(row));
    precioInput.addEventListener('input', () => recalcularLinea(row));

    btnQuitar.addEventListener('click', () => {
      row.remove();
      recalcularTotales();
    });
  }

  // Inicializar filas existentes
  tablaBody.querySelectorAll('tr').forEach(r => attachRowEvents(r));

  // Agregar nueva fila dinámica
  btnAgregar.addEventListener('click', function () {
    const index = contador++;
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        <select name="detalles[${index}][producto_id]" class="form-control producto-select" required>
          <option value="">Seleccione</option>
          ${productosOptionsHtml}
        </select>
      </td>
      <td><input type="number" name="detalles[${index}][cantidad]" class="form-control text-center cantidad" min="1" value="1" required></td>
      <td><input type="number" step="0.01" name="detalles[${index}][precio_unitario]" class="form-control text-right precio" min="0" value="0.00" required></td>
      <td class="text-right total-linea">0,00</td>
      <td class="text-center"><button type="button" class="btn btn-sm btn-danger btn-quitar">&times;</button></td>
    `;
    tablaBody.appendChild(tr);
    attachRowEvents(tr);
    recalcularTotales();
  });

  // Formato antes de enviar: asegurar punto decimal estándar
  document.getElementById('form-factura').addEventListener('submit', function () {
    tablaBody.querySelectorAll('.precio').forEach(input => {
      input.value = parseFloat(input.value || 0).toFixed(2);
    });
  });

  // Recalcular totales en carga si hay datos viejos
  recalcularTotales();
});
</script>
@endsection