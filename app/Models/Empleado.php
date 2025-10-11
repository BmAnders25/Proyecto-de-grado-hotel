<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'cedula',
        'nombre',
        'estado',
        'direccion',
        'telefono',
        'email',
    ];

    public function ventasRegistradas()
{
    return $this->hasMany(ProductoVendido::class, 'vendido_por');
}

public function checkIns()
{
    return $this->hasMany(CheckIn::class);
}

public function checkOuts()
{
    return $this->hasMany(CheckOut::class);
}

}