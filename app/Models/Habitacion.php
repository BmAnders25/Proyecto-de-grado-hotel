<?php

namespace App\Models;

use App\Models\ProductoVendido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = [
        'numero',
        'estado',
        'informacion',
        'precio_noche',
        'precio_dia',
        'tipo_habitacion_id',  
    ];

    // Relación: una habitación puede tener muchos consumos
    public function consumos()
    {
        return $this->hasMany(ProductoVendido::class, 'habitacion_id');
    }

    public function piso()
    {
        return $this->belongsTo(Piso::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación con TipoHabitacion
    public function tipo()
    {
        return $this->belongsTo(TipoHabitacion::class, 'tipo_habitacion_id');
    }
}
