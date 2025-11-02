@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Habitación</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('habitaciones.update', $habitacion->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input name="numero" label="Número de Habitación" placeholder="Ej: 101"
                    fgroup-class="col-md-4" value="{{ old('numero', $habitacion->numero) }}" />
            </div>
            <div class="row">
    <x-adminlte-select name="piso_id" label="Piso" fgroup-class="col-md-4" required>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-dark">
                <i class="fas fa-building"></i>
            </div>
        </x-slot>
        <option value="">Seleccione un piso</option>
        @foreach ($pisos as $piso)
            <option value="{{ $piso->id }}" {{ old('piso_id', $habitacion->piso_id) == $piso->id ? 'selected' : '' }}>
                {{ $piso->nombre }}
            </option>
        @endforeach
    </x-adminlte-select>
</div>


            <div class="row">
                <x-adminlte-textarea name="informacion" label="Información de la Habitación" rows="3"
                    placeholder="Ej: 2 camas, baño privado, vista al jardín" fgroup-class="col-md-6">
                    {{ old('informacion', $habitacion->informacion) }}
                </x-adminlte-textarea>
            </div>

            <div class="row">
                <x-adminlte-select name="estado" label="Estado de la Habitación" fgroup-class="col-md-3">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-bed"></i>
                        </div>
                    </x-slot>
                    <option value="disponible" {{ old('estado', $habitacion->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="ocupada" {{ old('estado', $habitacion->estado) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                    <option value="reservada" {{ old('estado', $habitacion->estado) == 'reservada' ? 'selected' : '' }}>Reservada</option>
                </x-adminlte-select>
            </div>

            {{-- Nuevo campo tipo de habitación --}}
            <div class="row">
                <x-adminlte-select name="tipo_habitacion_id" label="Tipo de Habitación" fgroup-class="col-md-4" required>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-primary">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </x-slot>
                    <option value="">Seleccione un tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipo_habitacion_id', $habitacion->tipo_habitacion_id) == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </x-adminlte-select>
            </div>

            {{-- Campos de precios --}}
            <div class="row">
                <x-adminlte-input name="precio_noche" label="Precio por Noche" type="number" step="0.01"
                    placeholder="Ej: 120000" fgroup-class="col-md-3"
                    value="{{ old('precio_noche', $habitacion->precio_noche) }}" />

                <x-adminlte-input name="precio_dia" label="Precio por Día (opcional)" type="number" step="0.01"
                    placeholder="Ej: 95000" fgroup-class="col-md-3"
                    value="{{ old('precio_dia', $habitacion->precio_dia) }}" />
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Actualizar Habitación"
                        theme="primary" icon="fas fa-save" />
                    <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary mr-2">
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
       <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
