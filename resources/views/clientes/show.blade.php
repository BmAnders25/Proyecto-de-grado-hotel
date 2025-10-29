@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header') <h1 class="m-0 text-dark">Detalle del Cliente</h1>
@stop

@section('content') 

<x-adminlte-card> 
    <div class="row">
        {{-- NIT --}} 
        <div class="col-md-6"> 
            <x-adminlte-info-box 
                title="NIT" 
                text="{{ $cliente->nit }}" 
                icon="fas fa-id-card" 
                theme="primary" /> </div>


        {{-- Nombre --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Nombre" 
                text="{{ $cliente->nombre }}" 
                icon="fas fa-user" 
                theme="purple" />
        </div>
    </div>

    <div class="row">
        {{-- Dirección --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Dirección" 
                text="{{ $cliente->direccion }}" 
                icon="fas fa-map-marker-alt" 
                theme="teal" />
        </div>

        {{-- Teléfono --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Teléfono" 
                text="{{ $cliente->telefono }}" 
                icon="fas fa-phone" 
                theme="info" />
        </div>
    </div>

    <div class="row">
        {{-- Email --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Email" 
                text="{{ $cliente->email }}" 
                icon="fas fa-envelope" 
                theme="orange" />
        </div>

        {{-- Estado --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Estado" 
                text="{{ $cliente->estado }}" 
                :icon="$cliente->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'" 
                :theme="$cliente->estado === 'Activo' ? 'success' : 'danger'" />
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a class="btn btn-secondary" href="{{ route('clientes.index') }}">
                <i class="fas fa-undo"></i> Regresar
            </a>
        </div>
    </div>
</x-adminlte-card>


@stop

@section('footer')
 <footer> 
 <p> <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH">
© {{ date('Y') }} S.O.A.H. Sistema De Organización y Administración Hotelera. Todos los derechos reservados. 
</p> 
</footer>
@stop
