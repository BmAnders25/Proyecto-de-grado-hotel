<?php

namespace App\Models;

use App\Models\ProductoVendido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nit',
        'nombre',
        'estado',
        'direccion',
        'telefono',
        'email',
    ];

    public function compras()
{
    return $this->hasMany(ProductoVendido::class);
}

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function facturas()
    {
    return $this->hasMany(Factura::class);
    }

}
