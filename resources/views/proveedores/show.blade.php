@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Proveedor</h1>
@stop

@section('content')
    <x-adminlte-card>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Nit" text="{{ $proveedor->nit }}" icon="fas fa-user" theme="info" />
            </div>
        <div class="col-md-6">
                <x-adminlte-info-box title="Nombre" text="{{ $proveedor->nombre }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Direccion" text="{{ $proveedor->direccion }}" icon="fas fa-user" theme="info" />
            </div>

        <div class="col-md-6">
                <x-adminlte-info-box title="Telefono" text="{{ $proveedor->telefono }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

    
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box title="Email" text="{{ $proveedor->email }}" icon="fas fa-user" theme="info" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-adminlte-info-box
        title="Estado"
        text="{{ $proveedor->estado }}"
        :icon="$proveedor->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'"
        :theme="$proveedor->estado === 'Activo' ? 'success' : 'danger'" />
            </div>
        </div>
       
        
        <div class="row">
            <div class="form-group col-md-6">
                <a class="btn btn-secondary" href="{{ route('proveedores.index') }}"><i
                        class="fas fa-undo"></i> Regresar</a>
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop