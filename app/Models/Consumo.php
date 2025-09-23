<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    // Fuerza el nombre exacto de la tabla
    protected $table = 'consumos'; 

    protected $fillable = [
        'habitacion_id',
        'producto_id',
        'piso_id',
        'unidades',
        'precio',
        'total',
        'fecha_venta',
    ];

    protected $casts = [
    'fecha_venta' => 'datetime',
];

    // Relaciones
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function piso()
    {
        return $this->belongsTo(Piso::class);
    }
}