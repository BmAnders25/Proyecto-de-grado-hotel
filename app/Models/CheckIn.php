<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{

    protected $table = 'check_ins';

    protected $casts = [
        'fecha_check_in' => 'datetime',
    ];
    protected $fillable = [
        'reserva_id',
        'habitacion_id',
        'empleado_id',
        'fecha_check_in',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
