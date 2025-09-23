<!DOCTYPE html>
<html>

<head>
    <title>Hoja de Afiliación de Asociado</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 20px;
    }

    .container {
        width: 100%;
        margin: auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: nowrap;
        /* Evita que los elementos se vayan a una nueva línea */
    }

    .header h1,
    .header h2,
    .header p {
        margin: 0;
    }

    .content {
        margin-bottom: 10px;
    }

    .footer {
        text-align: center;
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th,
    td {
        padding: 5px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 10px;
        /* Reducir el tamaño de fuente en la tabla */
    }

    th {
        background-color: #f2f2f2;
    }

    .label {
        font-weight: bold;
    }

    .section-title {
        font-size: 14px;
        /* Tamaño de título más pequeño */
        font-weight: bold;
        margin-bottom: 5px;
        text-decoration: underline;
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .col {
        flex: 1;
        padding-right: 5px;
    }

    p {
        margin: 0;
        /* Reducir los márgenes de los párrafos */
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <!-- Columna de la imagen -->
                    <td width="30%" style="vertical-align: top; text-align: right;">
                        <img src="{{ asset('vendor/adminlte/dist/img/logo.jpeg') }}" alt="Logo Cooperativa"
                            style="max-width: 100%; height: auto;">
                    </td>

                    <!-- Columna de la información -->
                    <td width="70%" style="vertical-align: top; text-align: center; padding-left: 20px;">
                        <h2>{{ $configuracion->nombre }}</h2>
                        <h2>Nit {{ $configuracion->nit }}</h2>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content">
            <div class="content">
                <div class="section-title">Información del Asociado</div>
                <p>Fecha de Afiliación: {{ $asociado->fecha_afiliacion }}</p>
                <p>ID del Asociado: {{ $asociado->id }}</p>
                <p>Nombre del Asociado: {{ $asociado->nombre }} {{ $asociado->primer_apellido }}
                    {{ $asociado->segundo_apellido }}</p>
                <p>Tipo de Documento: {{ $asociado->tipo_documento }} Número: {{ $asociado->cedula }}</p>
                <p>Fecha de Expedición: {{ $asociado->fecha_expedicion }} De:
                    {{ $asociado->municipio_expedicion->nombre }} {{ $asociado->departamento_expedicion->nombre }}</p>
                <p>Fecha de Nacimiento: {{ $asociado->fecha_nacimiento }} Lugar:
                    {{ $asociado->municipio_nacimiento->nombre }} {{ $asociado->departamento_nacimiento->nombre }} Edad:
                    {{ $asociado->edad }}</p>
                <p>Nacionalidad: {{ $asociado->nacionalidad }}</p>
                <p>Género: {{ $asociado->genero }} Estado Civil: {{ $asociado->estado_civil }}</p>
                <p>Personas Adultos a Cargo: {{ $asociado->personas_adultos }} Personas Menores a Cargo:
                    {{ $asociado->personas_menores }} Cabeza de Familia: {{ $asociado->cabeza_familia }}</p>
                <p>Cédula del Representante: {{ $asociado->cedula_representante }} Nombre del Representante:
                    {{ $asociado->nombre_representante }} Edad del Representante: {{ $asociado->edad_representante }}
                </p>
                <p>Tipo de Vivienda: {{ $asociado->tipo_vivienda }} Estrato: {{ $asociado->estrato }}</p>
                <p>Dirección: {{ $asociado->direccion }} {{ $asociado->municipio_residencia->nombre }}
                    {{ $asociado->departamento_residencia->nombre }}</p>
                <p>Teléfono: {{ $asociado->telefono }} Celular: {{ $asociado->celular }}</p>
                <p>Email: {{ $asociado->email }}</p>
                <p>Nivel Educativo: {{ $asociado->nivel_educativo }} Profesión: {{ $asociado->profesion }}</p>
                <p>Idiomas: {{ $asociado->idiomas }} Hobbies: {{ $asociado->hobbies }}</p>
                <p>Autorización Residencia: {{ $asociado->autoriza_residencia }}
                    Autorización Trabajo: {{ $asociado->autoriza_trabajo }}
                    Autorización Familiar: {{ $asociado->autoriza_familiar }}</p>
                <p>Autorización Email: {{ $asociado->autoriza_email }}
                    Autorización Teléfono: {{ $asociado->autoriza_telefono }}
                    Autorización Tratamiento de Datos: {{ $asociado->autoriza_datos }}</p>
                <p>Estado del Asociado: {{ $asociado->estado }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <hr>
            <p>Dirección {{ $configuracion->direccion }} - Telefono {{ $configuracion->telefono }} - Email
                {{ $configuracion->email }} Fecha impresión {{ date('Y-m-d') }}</p>
        </div>
    </div>
</body>

</html>