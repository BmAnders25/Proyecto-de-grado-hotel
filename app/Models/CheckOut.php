<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{

    protected $table = 'check_outs';

    protected $casts = [
        'fecha_check_out' => 'datetime',
    ];
    protected $fillable = [
        'reserva_id',
        'habitacion_id',
        'empleado_id',
        'fecha_check_out',
        'total'
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
