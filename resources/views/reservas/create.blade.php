@extends('adminlte::page')

@section('title', 'Registrar Reserva')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Reserva</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" class="shadow-lg rounded-lg">

    <form action="{{ route('reservas.store') }}" method="POST" id="formReserva">
        @csrf
        <div class="row">
            {{-- Cliente --}}
            <x-adminlte-select name="cliente_id" label="Cliente" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </x-adminlte-select>

            {{-- Piso --}}
            <x-adminlte-select name="piso_id" id="piso_id" label="Piso" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-building"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione un piso</option>
                @foreach ($pisos as $piso)
                    <option value="{{ $piso->id }}">{{ $piso->nombre }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            {{-- Habitación --}}
            <div class="form-group col-md-6">
                <label for="habitacion_id">Habitación</label>
                <select id="habitacion_id" name="habitacion_id" class="form-control" required>
                    <option value="">Seleccione una habitación</option>
                    @foreach ($habitaciones as $habitacion)
                        <option value="{{ $habitacion->id }}"
                                data-piso="{{ $habitacion->piso_id }}"
                                data-precio-dia="{{ $habitacion->precio_dia }}"
                                data-precio-noche="{{ $habitacion->precio_noche }}">
                            Habitación {{ $habitacion->numero }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tipo de precio --}}
            <div class="form-group col-md-6">
                <label for="tipo_precio">Tipo de Precio</label>
                <select id="tipo_precio" name="tipo_precio" class="form-control" required>
                    <option value="dia">Por Día</option>
                    <option value="noche">Por Noche</option>
                </select>
            </div>
        </div>

        <div class="row">
            {{-- Precio Unitario --}}
            <div class="form-group col-md-6">
                <label for="precio_unitario">Precio Unitario</label>
                <input type="text" id="precio_unitario" name="precio_unitario" class="form-control" readonly>
            </div>

            {{-- Número de Personas --}}
            <x-adminlte-input name="numero_personas" label="Número de Personas" type="number" min="1" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-users"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Fecha Entrada --}}
            <x-adminlte-input name="fecha_entrada" id="fecha_entrada" label="Fecha de Entrada" type="datetime-local" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Fecha Salida --}}
            <x-adminlte-input name="fecha_salida" id="fecha_salida" label="Fecha de Salida" type="datetime-local" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-minus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Precio Total --}}
            <x-adminlte-input name="precio_total" id="precio_total" label="Precio Total" type="text" fgroup-class="col-md-6" readonly>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Estado --}}
            <x-adminlte-select name="estado" label="Estado" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </x-slot>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
                <option value="completada">Completada</option>
            </x-adminlte-select>
        </div>

        {{-- Botones --}}
        <div class="row mt-3">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Guardar Reserva" theme="primary" icon="fas fa-save" />
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</x-adminlte-card>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pisoSelect = document.getElementById('piso_id');
    const habitacionSelect = document.getElementById('habitacion_id');
    const tipoPrecio = document.getElementById('tipo_precio');
    const precioUnitario = document.getElementById('precio_unitario');
    const precioTotal = document.getElementById('precio_total');
    const fechaEntrada = document.getElementById('fecha_entrada');
    const fechaSalida = document.getElementById('fecha_salida');

    // Filtrar habitaciones por piso
    pisoSelect.addEventListener('change', function() {
        const pisoSeleccionado = this.value;
        Array.from(habitacionSelect.options).forEach(option => {
            if (option.value === "") return;
            option.style.display = option.dataset.piso === pisoSeleccionado ? 'block' : 'none';
        });
        habitacionSelect.value = "";
        precioUnitario.value = "";
        precioTotal.value = "";
    });

    habitacionSelect.addEventListener('change', actualizarPrecio);
    tipoPrecio.addEventListener('change', actualizarPrecio);
    fechaEntrada.addEventListener('change', calcularTotal);
    fechaSalida.addEventListener('change', calcularTotal);

    function obtenerPrecioSeleccionado() {
        const opcion = habitacionSelect.selectedOptions[0];
        if (!opcion || opcion.value === "") return 0;
        const pDia = parseFloat(opcion.dataset.precioDia || 0);
        const pNoche = parseFloat(opcion.dataset.precioNoche || 0);
        return tipoPrecio.value === 'dia' ? pDia : pNoche;
    }

    function formatoMoneda(valor) {
        if (isNaN(valor) || valor === 0) return '';
        return `$${valor.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2})}`;
    }

    function actualizarPrecio() {
        const precio = obtenerPrecioSeleccionado();
        precioUnitario.value = precio ? formatoMoneda(precio) : '';
        calcularTotal();
    }

    function contarUnidadesPorFechasCalendario(entradaIso, salidaIso) {
        if (!entradaIso || !salidaIso) return 0;
        const e = new Date(entradaIso);
        const s = new Date(salidaIso);
        if (isNaN(e) || isNaN(s) || s <= e) return 0;
        // Crear fechas sólo con Y/M/D para contar transiciones de día calendario
        const eDate = new Date(e.getFullYear(), e.getMonth(), e.getDate());
        const sDate = new Date(s.getFullYear(), s.getMonth(), s.getDate());
        const MS_PER_DAY = 24 * 60 * 60 * 1000;
        const dias = Math.round((sDate - eDate) / MS_PER_DAY);
        return Math.max(1, dias);
    }

    function calcularTotal() {
        if (!fechaEntrada.value || !fechaSalida.value) {
            precioTotal.value = '';
            return;
        }
        const unidades = contarUnidadesPorFechasCalendario(fechaEntrada.value, fechaSalida.value);
        if (unidades === 0) {
            precioTotal.value = '';
            return;
        }
        const precioUnit = obtenerPrecioSeleccionado();
        const total = precioUnit * unidades;
        precioTotal.value = formatoMoneda(total);
    }
});
</script>
@stop

@section('footer')
<footer>
   <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H. Sistema De Organización y Administración Hotelera. Todos los derechos reservados.</p>
</footer>
@stop
