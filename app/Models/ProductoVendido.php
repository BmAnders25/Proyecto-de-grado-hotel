<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoVendido extends Model
{
    use HasFactory;

    protected $table = 'productos_vendidos';

    protected $casts = [
        'fecha_venta' => 'datetime',
    ];

    protected $fillable = [
        'producto_id',
        'cliente_id',
        'unidades',
        'precio',
        'total',
        'fecha_venta',
        'vendido_por',
        'habitacion_id',
    ];

    // Relaciones

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'vendido_por');
    }

    //  Para descontar stock automáticamente
    /*protected static function booted()
    {
        static::created(function ($venta) {
            $producto = Producto::find($venta->producto_id);

            if ($producto) {
                if ($producto->stock < $venta->unidades) {
                    throw new \Exception('Stock insuficiente para el producto ID ' . $producto->id);
                }

                $producto->decrement('stock', $venta->unidades);
            }
        });
    }*/
}
