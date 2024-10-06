<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_promocion';

    //ponemos los campos de la tabla
    protected $fillable = [
        'porcentaje_descuento',
        'precio_descuento',
    ];

    //relacion productos (0) a promocions (1)
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
