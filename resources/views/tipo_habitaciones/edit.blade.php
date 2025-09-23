@extends('adminlte::page')

@section('title', 'Editar Tipo de Habitación')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Tipo de Habitación</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('tipo_habitaciones.update', $tipo->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre del Tipo" placeholder="Ej: Suite, Doble, Individual"
                    fgroup-class="col-md-6" value="{{ old('nombre', $tipo->nombre) }}" />
            </div>

            <div class="row">
                <x-adminlte-textarea name="descripcion" label="Descripción" rows="3"
                    placeholder="Ej: Habitación con dos camas, baño privado, aire acondicionado" fgroup-class="col-md-8">
                    {{ old('descripcion', $tipo->descripcion) }}
                </x-adminlte-textarea>
            </div>

            <div class="row">
                <x-adminlte-input name="precio_base" label="Precio Base" type="number" step="0.01"
                    placeholder="Ej: 120000" fgroup-class="col-md-4" value="{{ old('precio_base', $tipo->precio_base) }}" />
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Actualizar Tipo"
                        theme="primary" icon="fas fa-save" />
                    <a href="{{ route('tipo_habitaciones.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-undo"></i> Cancelar
                    </a>
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
        <p>
            <img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo S.O.A.H">
            © {{ date('Y') }} S.O.A.H Todos los derechos reservados.
        </p>
    </footer>
@stop
