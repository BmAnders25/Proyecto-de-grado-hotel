<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Piso extends Model
{
    use HasFactory;

    protected $table = 'pisos';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function consumos()
    {
        return $this->hasMany(Consumo::class);
    }

    public function habitaciones()
{
    return $this->hasMany(Habitacion::class);
}


}