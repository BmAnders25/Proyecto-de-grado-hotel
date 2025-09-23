@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Paciente</h1>
@stop

@section('content')
    <x-adminlte-card>

        {{-- Datos de identificación --}}
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Tipo de Documento" text="{{ $paciente->tipo_documento }}" icon="fas fa-id-card" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Número de Documento" text="{{ $paciente->numero }}" icon="fas fa-id-card" theme="info" />
            </div>
        </div>

        {{-- Nombres y apellidos --}}
        <div class="row">
            <div class="col-md-3">
                <x-adminlte-info-box title="Primer Nombre" text="{{ $paciente->primer_nombre }}" icon="fas fa-user" theme="info" />
            </div>
            <div class="col-md-3">
                <x-adminlte-info-box title="Segundo Nombre" text="{{ $paciente->segundo_nombre }}" icon="fas fa-user" theme="info" />
            </div>
            <div class="col-md-3">
                <x-adminlte-info-box title="Primer Apellido" text="{{ $paciente->primer_apellido }}" icon="fas fa-user" theme="info" />
            </div>
            <div class="col-md-3">
                <x-adminlte-info-box title="Segundo Apellido" text="{{ $paciente->segundo_apellido }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        {{-- Fecha de nacimiento y edad --}}
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Fecha de Nacimiento"
                    text="{{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('Y-m-d') : '' }}"
                    icon="fas fa-birthday-cake" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Edad" text="{{ $paciente->edad }}" icon="fas fa-hourglass-half" theme="info" />
            </div>
        </div>

        {{-- Otros datos personales --}}
        <div class="row">
            <div class="col-md-4">
                <x-adminlte-info-box title="Lugar de Nacimiento" text="{{ $paciente->lugar_nacimiento }}" icon="fas fa-map-marker-alt" theme="info" />
            </div>
            <div class="col-md-4">
                <x-adminlte-info-box title="Nacionalidad" text="{{ $paciente->nacionalidad }}" icon="fas fa-flag" theme="info" />
            </div>
            <div class="col-md-4">
                <x-adminlte-info-box title="Responsable" text="{{ $paciente->responsable }}" icon="fas fa-user-shield" theme="info" />
            </div>
        </div>

        {{-- Información adicional --}}
        <div class="row">
            <div class="col-md-3">
                <x-adminlte-info-box title="Género" text="{{ $paciente->genero }}" icon="fas fa-venus-mars" theme="info" />
            </div>
            <div class="col-md-3">
                <x-adminlte-info-box title="RH" text="{{ $paciente->rh }}" icon="fas fa-tint" theme="info" />
            </div>
            <div class="col-md-3">
                <x-adminlte-info-box title="Estado Civil" text="{{ $paciente->estado_civil }}" icon="fas fa-heart" theme="info" />
            </div>
            <div class="col-md-3">
                <x-adminlte-info-box title="Nivel Educativo" text="{{ $paciente->nivel_educativo }}" icon="fas fa-graduation-cap" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <x-adminlte-info-box title="Último Año Cursado" text="{{ $paciente->ultimo_año }}" icon="fas fa-school" theme="info" />
            </div>
            <div class="col-md-5">
                <x-adminlte-info-box title="Dirección" text="{{ $paciente->direccion }}" icon="fas fa-home" theme="info" />
            </div>
            <div class="col-md-2">
                <x-adminlte-info-box title="Estrato" text="{{ $paciente->estrato }}" icon="fas fa-layer-group" theme="info" />
            </div>
            <div class="col-md-2">
                <x-adminlte-info-box title="Zona" text="{{ $paciente->zona }}" icon="fas fa-map" theme="info" />
            </div>
        </div>

        {{-- Contacto --}}
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Celular" text="{{ $paciente->celular }}" icon="fas fa-phone" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Correo Electrónico" text="{{ $paciente->email }}" icon="fas fa-envelope" theme="info" />
            </div>
        </div>

        {{-- Estado --}}
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box
                    title="Estado"
                    text="{{ $paciente->estado }}"
                    :icon="$paciente->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'"
                    :theme="$paciente->estado === 'Activo' ? 'success' : 'danger'" />
            </div>
        </div>

        {{-- Botón regresar --}}
        <div class="row">
            <div class="form-group col-md-6">
                <a class="btn btn-secondary" href="{{ route('pacientes.index') }}">
                    <i class="fas fa-undo"></i> Regresar
                </a>
            </div>
        </div>

    </x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p>
            <img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom">
            © {{ date('Y') }} Fralgóm Ingeniería Informática. Todos los derechos reservados.
        </p>
    </footer>
@stop
