<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria_id',
        'precio_entrada',
        'precio_salida',
        'unidades',
        'stock',
        'estado',
        
    ];

}
