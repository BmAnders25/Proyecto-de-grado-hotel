@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Empleado</h1>
@stop

@section('content')
    <x-adminlte-card>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Cedula" text="{{ $empleado->cedula }}" icon="fas fa-id-card" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Nombre" text="{{ $empleado->nombre }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Dirección" text="{{ $empleado->direccion }}" icon="fas fa-map-marker-alt" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Teléfono" text="{{ $empleado->telefono }}" icon="fas fa-phone" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Email" text="{{ $empleado->email }}" icon="fas fa-envelope" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box
        title="Estado"
        text="{{ $empleado->estado }}"
        :icon="$empleado->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'"
        :theme="$empleado->estado === 'Activo' ? 'success' : 'danger'" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <a class="btn btn-secondary" href="{{ route('empleados.index') }}"><i class="fas fa-undo"></i> Regresar</a>
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
       <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
