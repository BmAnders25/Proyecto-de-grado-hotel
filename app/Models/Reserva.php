<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 
        'habitacion_id', 
        'piso_id',
        'fecha_entrada', 
        'fecha_salida', 
        'numero_personas', 
        'precio_total', 
        'estado',
    ];

    protected $casts = [
        'fecha_entrada' => 'datetime',
        'fecha_salida' => 'datetime',

    ];

    // Relación con el Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con la Habitacion
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function piso()
{
    return $this->belongsTo(Piso::class);
}

public function checkIn()
{
    return $this->hasOne(CheckIn::class);
}

public function checkOut()
{
    return $this->hasOne(CheckOut::class);
}

    
}
