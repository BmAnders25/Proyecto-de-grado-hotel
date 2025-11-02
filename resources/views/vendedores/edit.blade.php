@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Vendedor</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('vendedores.update', $vendedor->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input maxlength="10" name="cedula" label="Cedula" placeholder="Cedula"
                    value="{{ old('cedula', $vendedor->cedula) }}" fgroup-class="col-md-2" />

                <x-adminlte-input name="nombre" label="Nombre" placeholder="Nombre del Vendedor"
                    value="{{ old('nombre', $vendedor->nombre) }}" fgroup-class="col-md-4" />
            </div>

            <div class="row">
                <x-adminlte-input name="direccion" label="Dirección" placeholder="Dirección del Vendedor"
                    value="{{ old('direccion', $vendedor->direccion) }}" fgroup-class="col-md-5" />

                <x-adminlte-input name="telefono" label="Telefono" placeholder="Telefono del Vendedor"
                    value="{{ old('telefono', $vendedor->telefono) }}" fgroup-class="col-md-3" />
            </div>

            <div class="row">
                <x-adminlte-input type="email" name="email" label="Email" placeholder="Email del Vendedor"
                    value="{{ old('email', $vendedor->email) }}" fgroup-class="col-md-6" />
            </div>

            <div class="row">
                <x-adminlte-select name="estado" label="Estado del Vendedor" fgroup-class="col-md-2">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-list"></i>
                        </div>
                    </x-slot>
                    <option value="Activo" {{ old('estado', $vendedor->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado', $vendedor->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Actualizar Vendedor" theme="primary"
                        icon="fas fa-save" />
                    <a href="{{ route('vendedores.index') }}" class="btn btn-secondary mr-2"><i
                            class="fas fa-undo"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </x-adminlte-card>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm Ingeniería
            Informática. Todos los derechos reservados.</p>
    </footer>
@stop
