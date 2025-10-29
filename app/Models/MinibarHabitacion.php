<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinibarHabitacion extends Model
{
    use HasFactory;

    protected $table = 'minibar_habitacion';

    protected $fillable = [
        'habitacion_id',
        'producto_id',
        'cantidad_inicial',
        'cantidad_actual',
    ];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}


