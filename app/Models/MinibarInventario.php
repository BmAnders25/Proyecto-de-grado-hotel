<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MinibarInventario extends Model
{
    use HasFactory;

    protected $table = 'minibar_inventarios';


    protected $fillable = [
        'producto_id',
        'cantidad_inicial',
        'cantidad_actual',

    ];

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    

}
