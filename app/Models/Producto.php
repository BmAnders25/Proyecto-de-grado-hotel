<?php

namespace App\Models;

use App\Models\ProductoVendido;
use App\Models\MinibarInventario;
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($producto) {
            $producto->minibarInventarios()->delete();
        });
    }


    public function ventas()
    {
        return $this->hasMany(ProductoVendido::class);
    }

    public function minibarInventarios()
    {
        return $this->hasMany(MinibarInventario::class, 'producto_id');
    }
}