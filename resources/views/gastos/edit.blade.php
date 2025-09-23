@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Gasto</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('gastos.update', $gastos->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Nombre del Gasto"
                    fgroup-class="col-md-6" :value="$gastos->nombre" />
            </div>
            <div class="row">
                <x-adminlte-select name="estado" label="Estado del Gasto" fgroup-class="col-md-2">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-list"></i>
                        </div>
                    </x-slot>
                    <option value="">Seleccionar Estado</option>
                    <option value="Activo" {{ $gastos->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Retirado" {{ $gastos->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary"
                        icon="fas fa-save" />
                    <a href="{{ route('gastos.index') }}" class="btn btn-secondary mr-2"><i
                            class="fas fa-undo"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </x-adminlte-card>
@stop

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm Ingeniería
            Informática. Todos los derechos reservados.</p>
    </footer>
@stop

