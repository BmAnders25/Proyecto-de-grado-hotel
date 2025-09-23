@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle de la Reserva</h1>
@stop

@section('content')
    <x-adminlte-card>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Cliente" text="{{ $reserva->cliente->nombre ?? 'Cliente eliminado' }}" icon="fas fa-user" theme="info" />
            </div>

            <div class="col-md-6">
                <x-adminlte-info-box title="Habitación" text="{{ $reserva->habitacion->numero ?? 'Habitación eliminada' }}" icon="fas fa-bed" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Piso" text="{{ $reserva->piso->nombre ?? 'Piso eliminado' }}" icon="fas fa-building" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Fecha de Entrada" text="{{ $reserva->fecha_entrada->format('d/m/Y H:i') }}" icon="fas fa-calendar-alt" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Fecha de Salida" text="{{ $reserva->fecha_salida->format('d/m/Y H:i') }}" icon="fas fa-calendar-alt" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Número de Personas" text="{{ $reserva->numero_personas }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Precio Total" text="${{ number_format($reserva->precio_total, 2) }}" icon="fas fa-calculator" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Estado" text="{{ ucfirst($reserva->estado) }}" icon="fas fa-check-circle" theme="info" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <a class="btn btn-secondary" href="{{ route('reservas.index') }}"><i class="fas fa-undo"></i> Regresar</a>
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }}
            Fralgóm Ingeniería Informática. Todos los derechos reservados.</p>
    </footer>
@stop
