@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle de la Compra</h1>
@stop

@section('content')
    <x-adminlte-card>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Producto" text="{{ $compra->producto->nombre ?? 'Producto eliminado' }}" icon="fas fa-box" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Empleado" text="{{ $compra->empleado->nombre ?? 'Empleado no asignado' }}" icon="fas fa-user-tie" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Unidades" text="{{ $compra->unidades }}" icon="fas fa-box" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Precio por Unidad" text="${{ number_format($compra->precio, 2) }}" icon="fas fa-money-bill-wave" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Total" text="${{ number_format($compra->total, 2) }}" icon="fas fa-calculator" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Fecha de Compra" text="{{ $compra->fecha_compra->format('d/m/Y H:i') }}" icon="fas fa-calendar-alt" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Registrado por" text="{{ $compra->registrado_por ? $compra->empleado->nombre : 'No registrado' }}" icon="fas fa-user-tie" theme="info" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <a class="btn btn-secondary" href="{{ route('productoscomprados.index') }}"><i class="fas fa-undo"></i> Regresar</a>
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
