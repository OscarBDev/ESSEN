<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historialprecio extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_historial_precio';

    //ponemos los campos de la tabla
    protected $fillable = [
        'precio_unitario',
        'cantidad',
        'total_precio',
        'fecha_historial',
        'id_producto',
    ];

    //relacion productos (0) a promocions (1)
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
