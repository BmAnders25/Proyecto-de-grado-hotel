<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'cliente_id', 'habitacion_id', 'fecha_emision',
        'subtotal', 'iva', 'total', 'numero_factura'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }


    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function habitacion() {
        return $this->belongsTo(Habitacion::class);
    }

  public function detalles()
{
    return $this->hasMany(DetalleFactura::class, 'factura_id');
}


}
