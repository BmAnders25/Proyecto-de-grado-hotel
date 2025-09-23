@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Cliente</h1>
@stop

@section('content')
    <x-adminlte-card>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Nit" text="{{ $cliente->nit }}" icon="fas fa-id-card" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Nombre" text="{{ $cliente->nombre }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Dirección" text="{{ $cliente->direccion }}" icon="fas fa-map-marker-alt" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box title="Teléfono" text="{{ $cliente->telefono }}" icon="fas fa-phone" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Email" text="{{ $cliente->email }}" icon="fas fa-envelope" theme="info" />
            </div>
            <div class="col-md-6">
                <x-adminlte-info-box
        title="Estado"
        text="{{ $cliente->estado }}"
        :icon="$cliente->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'"
        :theme="$cliente->estado === 'Activo' ? 'success' : 'danger'" />
            </div>
        </div>
       
        <div class="row">
            <div class="form-group col-md-6">
                <a class="btn btn-secondary" href="{{ route('clientes.index') }}"><i class="fas fa-undo"></i> Regresar</a>
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }}
            Fralgóm Ingeniería
            Informática. Todos los derechos reservados.</p>
    </footer>
@stop
