<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    protected $fillable = [
        'tipo_documento',
        'numero',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'edad',
        'lugar_nacimiento',
        'nacionalidad',
        'responsable',
        'genero',
        'rh',
        'estado_civil',
        'nivel_educativo',
        'ultimo_año',
        'direccion',
        'estrato',
        'zona',
        'celular',
        'email',


        
    ];

}

    

