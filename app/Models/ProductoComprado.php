<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoComprado extends Model
{
    protected $table = 'productos_comprados';

     protected $casts = [
        'fecha_compra' => 'datetime',
    ];

    protected $fillable = [
        'producto_id',
        'unidades',
        'precio',
        'total',
        'fecha_compra',
        'registrado_por',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'registrado_por');
    }
}
