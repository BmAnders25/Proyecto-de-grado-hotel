<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoHabitacion extends Model
{
    use HasFactory;

   
    protected $table = 'tipos_habitacion';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_base',
    ];

    
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class, 'tipo_habitacion_id');
    }
}
