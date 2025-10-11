@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Producto</h1>
@stop

@section('content')
    <x-adminlte-card>
     <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Id Producto" text="{{ $producto->producto_id }}" icon="fas fa-barcode" theme="info" />
        </div>
        <div class="col-md-6">
            <x-adminlte-info-box title="Nombre" text="{{ $producto->nombre }}" icon="fas fa-tag" theme="info" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Precio" text="${{ number_format($producto->precio, 2) }}" icon="fas fa-money-bill-wave" theme="info" />
        </div>
        <div class="col-md-6">
            <x-adminlte-info-box title="Unidades" text="{{ $producto->unidades }}" icon="fas fa-box" theme="info" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Stock" text="{{ $producto->stock }}" icon="fas fa-warehouse" theme="info" />
        </div>
        <div class="col-md-6">
    <x-adminlte-info-box
        title="Estado"
        text="{{ $producto->estado }}"
        :icon="$producto->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'"
        :theme="$producto->estado === 'Activo' ? 'success' : 'danger'" />
</div>

    <div class="row">
        <div class="form-group col-md-6">
            <a class="btn btn-secondary" href="{{ route('productos.index') }}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
</x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop

