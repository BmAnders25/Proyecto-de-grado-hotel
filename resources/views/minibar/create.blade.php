@extends('adminlte::page')

@section('title', 'Agregar Productos - Habitación ' . $habitacion->numero)

@section('content_header')
<h1>Agregar Productos - Habitación {{ $habitacion->numero }}</h1>
@stop

@section('content')
<div class="container mt-4">
@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<form action="{{ route('minibar.store') }}" method="POST">
    @csrf
    <input type="hidden" name="habitacion_id" value="{{ $habitacion->id }}">

    <div class="row g-4">
        @foreach($productos as $producto)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>{{ $producto->nombre }}</h5>
                        <p>Precio: ${{ number_format($producto->precio,0,",",".") }}</p>
                        <p>Stock disponible: {{ $producto->stock }}</p>

                        <label for="cantidad_{{ $producto->id }}">Cantidad Inicial (0 = no agregar)</label>
                        <input type="number"
                               name="cantidad[{{ $producto->id }}]"
                               id="cantidad_{{ $producto->id }}"
                               min="0"
                               max="{{ $producto->stock }}"
                               value="0"
                               class="form-control cantidad-input"
                               data-stock="{{ $producto->stock }}">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Guardar Productos</button>
    </div>
</form>
</div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.cantidad-input');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            const stockMaximo = parseInt(this.dataset.stock);
            const valor = parseInt(this.value) || 0;

            if (valor > stockMaximo) {
                Swal.fire({
                    icon: 'error',
                    title: 'Cantidad inválida',
                    text: `No puedes asignar más de ${stockMaximo} unidades disponibles.`,
                });
                this.value = stockMaximo;
            }
        });
    });
});
</script>
@stop
