@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Empleado</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('empleados.update', $empleado->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input name="cedula" label="Cedula" placeholder="Cedula"
                    value="{{ old('cedula', $empleado->cedula) }}" fgroup-class="col-md-2" />

                <x-adminlte-input name="nombre" label="Nombre" placeholder="Nombre del Empleado"
                    value="{{ old('nombre', $empleado->nombre) }}" fgroup-class="col-md-4" />
            </div>

            <div class="row">
                <x-adminlte-input name="direccion" label="Dirección" placeholder="Dirección del Empleado"
                    value="{{ old('direccion', $empleado->direccion) }}" fgroup-class="col-md-5" />

                <x-adminlte-input name="telefono" label="Telefono" placeholder="Telefono del empleado"
                    value="{{ old('telefono', $empleado->telefono) }}" fgroup-class="col-md-3" />
            </div>

            <div class="row">
                <x-adminlte-input type="email" name="email" label="Email" placeholder="Email del Empleado"
                    value="{{ old('email', $empleado->email) }}" fgroup-class="col-md-6" />
            </div>

            <div class="row">
                <x-adminlte-select name="estado" label="Estado del Empleado" fgroup-class="col-md-2">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-list"></i>
                        </div>
                    </x-slot>
                    <option value="Activo" {{ old('estado', $empleado->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado', $empleado->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Actualizar Empleado" theme="primary"
                        icon="fas fa-save" />
                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary mr-2"><i
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
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
