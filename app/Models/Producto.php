<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'producto_id',
        'nombre',
        'precio',
        'unidades',
        'stock',
        'estado',
        'fecha_venta'
    ];



    public function ventas()
    {
        return $this->hasMany(ProductoVendido::class);
    }

    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'minibar_habitacion')
                    ->withPivot('cantidad_inicial', 'cantidad_actual')
                    ->withTimestamps();
    }

    public function detalleFacturas()
{
    return $this->hasMany(DetalleFactura::class);
}
}