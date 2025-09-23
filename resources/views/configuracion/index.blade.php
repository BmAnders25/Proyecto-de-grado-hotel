@extends('adminlte::page')

@section('title', 'Configuración de la Empresa')

@section('content_header')
    <h1 class="m-0 text-dark">Configuración de la Empresa</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form action="{{ route('configuracion.update', $configuracion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input name="nit" label="Nit" value="{{ $configuracion->nit }}"
                    placeholder="Nit de la Empresa" fgroup-class="col-md-2" />
                <x-adminlte-input name="nombre" label="Nombre de la Empresa" value="{{ $configuracion->nombre }}"
                    placeholder="Nombre de la Empresa" fgroup-class="col-md-8" />
            </div>
            <div class="row">
                <x-adminlte-input name="direccion" label="Dirección" value="{{ $configuracion->direccion }}"
                    placeholder="Dirección de la Empresa" fgroup-class="col-md-5" />
                <x-adminlte-input name="telefono" label="Teléfono" value="{{ $configuracion->telefono }}"
                    placeholder="Teléfono de la Empresa" fgroup-class="col-md-2" />
                <x-adminlte-input name="email" type="email" label="Email" value="{{ $configuracion->email }}"
                    placeholder="Email de la Empresa" fgroup-class="col-md-5" autocomplete="email" />
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    @can('editar-configuracion')
                    <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Guardar Configuración" theme="primary" icon="fas fa-save" />
                    @endcan
                    <a href="{{ route('home') }}" class="btn btn-secondary mr-2"><i
                        class="fas fa-undo"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </x-adminlte-card>
@stop

@section('footer')
<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm
        Ingeniería Informática. Todos los derechos reservados.</p>
</footer>
@stop
