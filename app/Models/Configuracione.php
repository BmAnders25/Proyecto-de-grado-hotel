<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    use HasFactory;
    
    protected $table = 'configuraciones';
    
    protected $fillable = [
        'nit',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'periodo_id',
        'dia_corte',
        'afiliacion',
        'interes_mora',
        'meses_mora',
        'reintegro',
        'dias_retiro'
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
}
