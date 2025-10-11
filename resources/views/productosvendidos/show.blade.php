@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle de la Venta</h1>
@stop

@section('content')
    <x-adminlte-card>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Producto" text="{{ $venta->producto->nombre ?? 'Producto eliminado' }}" icon="fas fa-tag" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Cliente" text="{{ $venta->cliente->nombre ?? 'Cliente eliminado' }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Empleado" text="{{ $venta->empleado->nombre ?? 'Empleado eliminado' }}" icon="fas fa-user-tie" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Unidades" text="{{ $venta->unidades }}" icon="fas fa-box" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Precio" text="${{ number_format($venta->precio, 2) }}" icon="fas fa-money-bill-wave" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Total" text="${{ number_format($venta->total, 2) }}" icon="fas fa-calculator" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Fecha de Venta" text="{{ $venta->fecha_venta->format('d/m/Y H:i') }}" icon="fas fa-calendar-alt" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Habitación" text="{{ $venta->habitacion->numero ?? 'Habitación no asignada' }}" icon="fas fa-bed" theme="info" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <a class="btn btn-secondary" href="{{ route('productosvendidos.index') }}"><i class="fas fa-undo"></i> Regresar</a>
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
       <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
