<?php

namespace App\Models;

use App\Models\ProductoVendido;
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
}